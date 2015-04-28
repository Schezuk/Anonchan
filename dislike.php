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
	$result = $info->POST_DISLIKE(Config::getUid());
	if($result['status']===false || $result['count']===0) throw new Exception('Waterloo Bridge.', -2);# ERROR HANDLING
	if(!$GLOBALS['pdo']->commit()) throw new Exception('Waterloo Bridge.', -2);# ERROR HANDLING
	else Config::showReady();
} catch (Exception $e) {
	# END TRANSACTION
	$GLOBALS['pdo']->rollback();
	Config::showError($e);
}
exit;
	