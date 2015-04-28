<?php
# TEMPLET feedback.tpl.php #
require_once $GLOBALS['ROOT_PATH'] . 'cls/language.cls.php';
global $lang;
global $status, $error;
header('Access-Control-Allow-Origin: *'); 
header('Cache-Control: no-store, no-cache, must-revalidate');  
header('Cache-Control: post-check=0, pre-check=0', false);  
header('Pragma: no-cache');
if (isset($_SERVER['HTTP_REFERER'])) header('refresh:' . CONFIG::REFRESH_DURATION . ';url=' . $_SERVER['HTTP_REFERER']);
return # HERE STARTS THE HTML PAGE
<<<EOT
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{$lang->statusMessage[$status]}</title>
    <style type="text/css">
        *{ padding: 0; margin: 0; }
        body{ background: #fff; font-family: 'Microsoft YaHei'; color: #333; font-size: 16px; }
        .system-message{ padding: 24px 48px; }
        .system-message h1{ font-size: 100px; font-weight: normal; line-height: 120px; margin-bottom: 12px; }
        .system-message .jump{ padding-top: 10px}
        .system-message .jump a{ color: #333;}
        .system-message .success,.system-message .error{ line-height: 1.8em; font-size: 36px }
        .system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
    </style>
</head>
<body>
    <div class="system-message">
        <h1>{$lang->statusEmoji[$status]}</h1>
        <p class="{$lang->statusClass[$status]}">{$lang->statusMessage[$status]}</p>
        <p class="detail">{$lang->errorDetail($error)}</p>
    </div>
</body>
</html>
EOT;
# END OF TEMPLET feedback.tpl.php #
