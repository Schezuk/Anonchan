<?php
require_once $GLOBALS['ROOT_PATH'] . 'cfg/config.ini.php';
class Config extends iConfig{
	public static function getUid() {
		# Get dotted address string.
		$env[] = getenv('HTTP_CLIENT_IP');
		$env[] = getenv('HTTP_X_FORWARDED_FOR');
		$env[] = getenv('REMOTE_ADDR');
		if (isset($_SERVER['REMOTE_ADDR'])) {
			$env[] = $_SERVER['REMOTE_ADDR'];
		}
		# Check if valid and assign it to $onlineip.
		foreach ($env as $value) {
			if ($value && strcasecmp($value, 'unknown')) {
				$onlineip = '0.0.0.0';
			} else {
				$onlineip = $value;
				break;
			}
		} unset($value);
		# Proccess $onlineip into tripcode
		$onlineip = ip2long($onlineip) & 0xEEEEEEEE;
		$onlineip = pack("H*", $onlineip) . self::TRIPCODE_SALT;
		$onlineip = base64_encode(sha1($onlineip, true)); 
		$onlineip = substr($onlineip, 0, SqlStmt::LEN_UID);
		return $onlineip;
	}
	public static function intRange($value, $min, $max) {
		return min(max(intval($value),$min),max($min,$max));
	}
	public static function enjson($arr) {
		if (version_compare(PHP_VERSION, '5.4.0', '>=')){
			return json_encode($arr, JSON_UNESCAPED_UNICODE);
		} else {
			return self::unescape_utf8(json_encode($arr));
		} # I haven't figure out how mb_decode_numericentity() works yet.
	}
	protected static function unescape_utf8($str) {
		return str_replace('\\/', '/', preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', 'unescape_utf8_callback', $str));
	}
	public static function showInfo($info){
		if (isset($_REQUEST['callback'])) echo "typeof getRid === 'function' && getRid(" . Config::enjson($info) . ");";
		else if (isset($_REQUEST['json'])) echo Config::enjson($info);
		else $info->showHtml();
	}
	public static function showError($error){
			$GLOBALS['error'] = $error;
			$GLOBALS['status'] = false;
			if (isset($_REQUEST['callback'])) echo "typeof getRid === 'function' && getRid(" . Config::enjson($error) . ");";
			else if (isset($_REQUEST['json'])) echo Config::enjson($error);
			else echo require $GLOBALS['ROOT_PATH'] . 'tpl/feedback.tpl.php';
	}
	public static function showReady(){
			$GLOBALS['error'] = NULL;
			$GLOBALS['status'] = true;
			if (isset($_REQUEST['callback']))  echo 'typeof getRid === \'function\' && getRid({"code":"0",message:"Succeed"});';
			else if (isset($_REQUEST['json'])) echo '{"code":"0",message:"Succeed"}';
			else echo require $GLOBALS['ROOT_PATH'] . 'tpl/feedback.tpl.php';
	}
}
function unescape_utf8_callback($match) {
	return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
}

