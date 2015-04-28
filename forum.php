<?php
$GLOBALS['ROOT_PATH'] = dirname(__FILE__) . '/';
require_once $GLOBALS['ROOT_PATH'] . 'initialize.php';
try {
    $page = isset($_REQUEST['page'])? Config::intRange($_REQUEST['page'],1,MyPdo::MAX_INTEGER) : 1;
	$info = new Forum($page);

	$info->fetch();
	Config::showInfo($info);
} catch (Exception $e) {
	Config::showError($e);
	#var_dump($info);
}
exit;
