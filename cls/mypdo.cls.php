<?php
require_once $GLOBALS['ROOT_PATH'] . 'pdo/param.inc.php';
switch (strtolower(CONFIG::DB_TYPE)){
	case 'cubrid':  require_once $GLOBALS['ROOT_PATH'] . 'pdo/cubrid.inc.php';  break;
	case 'sybase':  require_once $GLOBALS['ROOT_PATH'] . 'pdo/sybase.inc.php';  break;
	case 'mssql':   require_once $GLOBALS['ROOT_PATH'] . 'pdo/mssql.inc.php';   break;
	case 'dblib':   require_once $GLOBALS['ROOT_PATH'] . 'pdo/dblib.inc.php';   break;
	case 'firebird':require_once $GLOBALS['ROOT_PATH'] . 'pdo/firebird.inc.php';break;
	case 'ibm':     require_once $GLOBALS['ROOT_PATH'] . 'pdo/ibm.inc.php';     break;
	case 'informix':require_once $GLOBALS['ROOT_PATH'] . 'pdo/informix.inc.php';break;
	case 'mysql':   require_once $GLOBALS['ROOT_PATH'] . 'pdo/mysql.inc.php';   break;
	case 'sqlsrv':  require_once $GLOBALS['ROOT_PATH'] . 'pdo/sqlsrv.inc.php';  break;
	case 'oci':     require_once $GLOBALS['ROOT_PATH'] . 'pdo/oci.inc.php';     break;
	case 'odbc':    require_once $GLOBALS['ROOT_PATH'] . 'pdo/odbc.inc.php';    break;
	case 'pgsql':   require_once $GLOBALS['ROOT_PATH'] . 'pdo/pgsql.inc.php';   break;
	case 'sqlite':  require_once $GLOBALS['ROOT_PATH'] . 'pdo/sqlite.inc.php';  break;
	case '4D':      require_once $GLOBALS['ROOT_PATH'] . 'pdo/4D.inc.php';      break;
	default:        require_once $GLOBALS['ROOT_PATH'] . 'pdo/mysql.inc.php';   break;
	}

class MyPdo extends SqlStmt implements TableSize {
	# PDO
	public $queryParam, $transactionCounter;
	protected $pdo, $queryStmt, $queryConst;
	public function __construct(){
		$this->queryParam = self::$QUERY_PARAM;
		$this->transactionCounter = 0;
		$this->pdo =new PDO(CONFIG::DB_TYPE.':dbname='.CONFIG::DB_NAME.';host='.CONFIG::DB_HOST.';port='.CONFIG::DB_PORT.';charset=UTF8',
							CONFIG::DB_USER, 
							CONFIG::DB_PSWD, 
							MyPdo::$OPTIONS
							);
		$this->queryStmt  = self::$QUERY_STATEMENT;
		$this->queryConst = self::$QUERY_CONST;
		foreach ($this->queryStmt as $key => &$value)
			foreach ($this->queryConst[$key] as $search => $replace)
				$value = str_replace($search, $replace, $value);
				
	}
	public function beginTransaction()	{
		if(!$this->transactionCounter++) return $this->pdo->beginTransaction();
		else return $this->transactionCounter >= 0;
	}	
	public function commit() {
		if(!--$this->transactionCounter) return $this->pdo->commit();
		else return $this->transactionCounter >= 0;
	}
	public function rollback() {
		if($this->transactionCounter >= 0) {$this->transactionCounter = 0; return $this->pdo->rollback();}
		else {$this->transactionCounter = 0; return false;}
	}
	public function exec($stmtKey, $stmtParam, $stmtClass = NULL){
		$sql =  $this->queryStmt[$stmtKey];
		if (isset($stmtParam['{$NODES}'])) {
		    if (empty($stmtParam['{$NODES}'])) return array('status' => true, 'count' => 0, 'result' => array()); # IF NO REPLIES TO QUERY FOR.
			$sql = str_replace('{$NODES}', implode(', ', $stmtParam['{$NODES}']), $sql);
			unset($stmtParam['{$NODES}']);
		}
		$stmt = $this->pdo->prepare($sql);
		foreach ($stmtParam as $key => &$value) if($key != '{$NODES}' ) $stmt->bindValue(':' . $key, $value, $this->getType($value)); # $value will be reset, use &$value
		$stmt->debugDumpParams();
		var_dump($stmtParam);
		$status = $stmt->execute();
		if     ($status  ===  false) return array('status' => $status, 'count' => 0, 'result' => array()); 
		elseif (is_null($stmtClass)) return array('status' => $status, 'count' => $stmt->rowCount(), 'result' => array());
		else {
			$count = 0;
			$result = array();
			#$stmt->setFetchMode(PDO::FETCH_CLASS, $stmtClass);
			#$obj = $stmt->fetch(PDO::FETCH_CLASS);
			while (is_object($obj = $stmt->fetchObject($stmtClass))){
				$count++;
				$result[$obj->id] = $obj;
			}
			echo 'here<br>';
			var_dump($result);
			echo 'here<br>';
			return array('status' => $status, 'count' => $count, 'result' => $result);
		}
	}
	public function getType($var){
		switch (true) {
			case is_bool($var): return PDO::PARAM_BOOL;
			case is_int($var) : return PDO::PARAM_INT;
			case is_null($var): return PDO::PARAM_NULL;
			default:            return PDO::PARAM_STR;
		}
	}
}
$GLOBALS['pdo'] = new MyPdo();
