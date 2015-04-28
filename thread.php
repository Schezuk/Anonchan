<?php
$GLOBALS['ROOT_PATH'] = dirname(__FILE__) . '/';
require_once $GLOBALS['ROOT_PATH'] . 'initialize.php';
try {
    $id   = isset($_REQUEST['id'])  ? Config::intRange($_REQUEST['id']  ,1,MyPdo::MAX_INTEGER) : 1;
    $page = isset($_REQUEST['page'])? Config::intRange($_REQUEST['page'],1,MyPdo::MAX_INTEGER) : 1;
	$info = new Thread($id,$page);
	$info->fetch();
	Config::showInfo($info);
} catch (Exception $e) {
	Config::showError($e);
}
exit;
