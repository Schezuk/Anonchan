<?php
$GLOBALS['ROOT_PATH'] = dirname(__FILE__) . '/';
require_once $GLOBALS['ROOT_PATH'] . 'initialize.php';
try {
	# START TRANSACTION
	if(!$GLOBALS['pdo']->beginTransaction()) throw new Exception('Waterloo Bridge.', -2);# ERROR HANDLING
	$id = $_REQUEST['id'];
	if($id !== Config::intRange($id, 1, MyPdo::MAX_INTEGER)) throw new Exception('Casablanca',-3);
	$time = time();
	$param = array( 'parent'    => $_REQUEST['id'],
					'updatedAt' => $time,
					'createdAt' => $time,
					'uid'       => Config::getUid(),
					'name'      => substr(htmlspecialchars($_REQUEST['name'],  ENT_NOQUOTES, 'UTF-8'), 0, MyPdo::LEN_NAME ),
					'email'     => substr(htmlspecialchars($_REQUEST['email'], ENT_NOQUOTES, 'UTF-8'), 0, MyPdo::LEN_EMAIL),
					'title'     => substr(htmlspecialchars($_REQUEST['title'], ENT_NOQUOTES, 'UTF-8'), 0, MyPdo::LEN_TITLE),
					'image'     => substr(htmlspecialchars($_REQUEST['image'], ENT_NOQUOTES, 'UTF-8'), 0, MyPdo::LEN_IMAGE),
					'content'   => nl2br(substr(htmlspecialchars($_REQUEST['content'], ENT_NOQUOTES, 'UTF-8'),0,MyPdo::LEN_CONTENT)),
					'sage'      => (strcasecmp($_REQUEST['email'],'sage') ? 1 : 0),
					'pwd'       => substr($_REQUEST['pwd'],0,MyPdo::LEN_PWD)
					);
	$regexp = '/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i';
	if (0 < preg_match($regexp, $param['image']) or stristr($param['image'],'javascript')) throw new Exception('Casablanca',-3);
	# ROOT
	$result = $this->NODE_SELECT(0, 'POST');
	if($result['status']===false || $result['count']!==1) throw new Exception('Waterloo Bridge.', -2);# ERROR HANDLING
	else $root = $result['result'][0];
	if ($root->delete >0) throw new Exception('Gone with the wind.', -1);# ERROR HANDLING
	if ($root->lock   >0) throw new Exception('Casablanca',-3);
	$history = explode(',',$root->content);
	foreach ($history as $record) 
		if(substr($record, MyPdo::LEN_CREATEDAT, MyPdo::LEN_UID) === $param['uid']) 
			if(unpack('H*',substr($record, 0, MyPdo::LEN_CREATEDAT)) + Config::COOL_DOWN < $time) break;
			else throw new Exception('Casablanca',-3);
	# PARENT
	$result = $this->DADY_SELECT($id, 'POST');
	if($result['status']===false || $result['count']!==1) throw new Exception('Waterloo Bridge.', -2);# ERROR HANDLING
	else $parent = $result['result'][$id];
	if ($parent->delete >0) throw new Exception('Gone with the wind.', -1);# ERROR HANDLING
	if ($parent->lock   >0) throw new Exception('Casablanca',-3);
	if ($parent->parent!=0) throw new Exception('Casablanca',-3);
	# INSERT
	$info = new Post();
	foreach ($param as $key => $value) $info->$key = $value;
	$result = $info->POST_INSERT();
	if($result['status']===false || $result['count']!==1) throw new Exception('Waterloo Bridge.', -2);# ERROR HANDLING
	# UPDATE ROOT
	$result = $info->ROOT_UPDATE();
	if($result['status']===false || $result['count']!==1) throw new Exception('Waterloo Bridge.', -2);# ERROR HANDLING
	# UPDATE PARENT
	$result = $info->DADY_UPDATE();
	if($result['status']===false || $result['count']!==1) throw new Exception('Waterloo Bridge.', -2);# ERROR HANDLING
	# END TRANSACTION
	if(!$GLOBALS['pdo']->commit()) throw new Exception('Waterloo Bridge.', -2);# ERROR HANDLING
	else Config::showReady();
} catch (Exception $e) {
	# END TRANSACTION
	$GLOBALS['pdo']->rollback();
	Config::showError($e);
}
exit;
	