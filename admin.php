<?php
$GLOBALS['ROOT_PATH'] = dirname(__FILE__) . '/';
require_once $GLOBALS['ROOT_PATH'] . 'initialize.php';
try {
	# START TRANSACTION
	if(!$GLOBALS['pdo']->beginTransaction()) throw new Exception('Waterloo Bridge.', -2);# ERROR HANDLING
	$id = $_REQUEST['id'];
	if($id !== Config::intRange($id, 1, MyPdo::MAX_INTEGER)) throw new Exception('Casablanca',-3);
	$info = new Post();
	$info->id = $id;
	$text = isset($_REQUEST['text']) ? $_REQUEST['text'] : '';
	switch (strtolower(trim($_REQUEST['action']))){
		case 'delete'   : $result = $info->ADMIN_DEL();
		case 'sage'     : $result = $info->ADMIN_SAGE();
		case 'lock'     : $result = $info->ADMIN_LOCK();
		case 'hide'     : $result = $info->ADMIN_HIDE();
		case 'undelete' : $result = $info->ADMIN_UNDEL();
		case 'unsage'   : $result = $info->ADMIN_UNSAGE();
		case 'unlock'   : $result = $info->ADMIN_UNLOCK();
		case 'unhide'   : $result = $info->ADMIN_UNHIDE();
		case 'edit'     : $result = $info->ADMIN_EDIT($text);
		case 'rename'   : $result = $info->ADMIN_RENAME();
	}
	if(!$GLOBALS['pdo']->commit()) throw new Exception('Waterloo Bridge.', -2);# ERROR HANDLING
	else Config::showReady();
} catch (Exception $e) {
	# END TRANSACTION
	$GLOBALS['pdo']->rollback();
	Config::showError($e);
}
exit;
	