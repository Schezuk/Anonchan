<?php
class SqlStmt {
	# DATABASE
	public static $OPTIONS = array(
			PDO::ATTR_CASE                    => PDO::CASE_NATURAL,
			PDO::ATTR_TIMEOUT                 => 10,
			PDO::ATTR_ERRMODE                 => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_ORACLE_NULLS            => PDO::NULL_TO_STRING,
			PDO::ATTR_DEFAULT_FETCH_MODE      => PDO::FETCH_ASSOC,
			PDO::MYSQL_ATTR_FOUND_ROWS        => TRUE,
			PDO::MYSQL_ATTR_INIT_COMMAND      => 'SET NAMES \'UTF8\'',
			PDO::MYSQL_ATTR_USE_BUFFERED_QUERY=> false
	);
	public static $QUERY_STATEMENT = array(
				# POST
				'NODE_INSERT'  => 'INSERT INTO `{$TABLENAME}` (
									`parent`, `updatedAt`, `createdAt`, `replyCount`,`uid`, `name`, `email`, `title`, `image`, `content`,
									`hide`, `sage`, `lock`, `delete`, `pwd`, `like`, `liker`, `dislike`, `disliker`,
									`recentReply00`, `recentReply01`, `recentReply02`, `recentReply03`, `recentReply04`,
									`recentReply05`, `recentReply06`, `recentReply07`, `recentReply08`, `recentReply09`,
									`recentReply10`, `recentReply11`, `recentReply12`, `recentReply13`, `recentReply14`,
									`recentReply15`, `recentReply16`, `recentReply17`, `recentReply18`, `recentReply19`
									) VALUES (
									:parent, :updatedAt, :createdAt, 0, :uid, :name, :email, :title, :image, :content,
									0, :sage, 0, 0, :pwd, 0, "", 0, "",
									0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0
									);',
				'DADY_UPDATE'  => 'UPDATE `{$TABLENAME}` SET
								    `updatedAt`  = :updatedAt,
									`replyCount` = `replyCount` + 1,
								    `recentReply19` = `recentReply18`,
								    `recentReply18` = `recentReply17`,
								    `recentReply17` = `recentReply16`,
								    `recentReply16` = `recentReply15`,
								    `recentReply15` = `recentReply14`,
								    `recentReply14` = `recentReply13`,
								    `recentReply13` = `recentReply12`,
								    `recentReply12` = `recentReply11`,
								    `recentReply11` = `recentReply10`,
								    `recentReply10` = `recentReply09`,
								    `recentReply09` = `recentReply08`,
								    `recentReply08` = `recentReply07`,
								    `recentReply07` = `recentReply06`,
								    `recentReply06` = `recentReply05`,
								    `recentReply05` = `recentReply04`,
								    `recentReply04` = `recentReply03`,
								    `recentReply03` = `recentReply02`,
								    `recentReply02` = `recentReply01`,
								    `recentReply01` = `recentReply00`,
								    `recentReply00` = :recentReply00
									WHERE `id` = :parent;',
				'ROOT_UPDATE'  => 'UPDATE `{$TABLENAME}` SET `content` = SUBSTRING((CHAR(:createdAt)||:uid||`content`) FROM 1 FOR {$LEN_REPLYRECORD}) WHERE `id` = 0;',
				# READ
				'NODE_SELECT'  => 'SELECT * FROM `{$TABLENAME}` WHERE `id` = :id;',
				'SONS_SELECT'  => 'SELECT * FROM `{$TABLENAME}` WHERE `id` IN ({$NODES});',
				'PAGE_SELECT'  => 'SELECT * FROM `{$TABLENAME}` WHERE `parent` = :id ORDER BY `updatedAt` DESC LIMIT :limit OFFSET :offset;',
				# EDIT
				'POST_DELIMG'  => 'UPDATE `{$TABLENAME}` SET `image` = "" WHERE `id` = :id AND `pwd` = :pwd;',
				'POST_DELETE'  => 'UPDATE `{$TABLENAME}` SET `delete` = 1 WHERE `id` = :id AND `pwd` = :pwd;',
				'POST_LIKE'    => 'UPDATE `{$TABLENAME}` SET
									`hide` = (CASE WHEN `dislike` > ((`like` + 1) * $HIDE_RATIO + $HIDE_DIVIATION) THEN 1 ELSE 0 END),
								    `like` = `like` + 1,
									`liker` = SUBSTRING((:uid||","||`liker`) FROM 1 FOR {$LEN_LIKER})
									WHERE `id` = :id AND `liker` NOT LIKE CONCAT("%", :uid, ",", "%");',
				'POST_DISLIKE' => 'UPDATE `{$TABLENAME}` SET
									`hide` = (CASE WHEN (`dislike` + 1) > (`like` * $HIDE_RATIO + $HIDE_DIVIATION) THEN 1 ELSE 0 END),
									`dislike`  = `dislike` + 1,
									`disliker` = SUBSTRING((:uid||","||`disliker`) FROM 1 FOR {$LEN_DISLIKER})
									WHERE `id` = :id AND `disliker` NOT LIKE CONCAT("%", :uid, ",", "%");',
				# ADMIN FUNCTIONS
				'ADMIN_DEL'    => 'UPDATE `{$TABLENAME}` SET `delete` = `delete` + 1 WHERE `id` = :id;',
				'ADMIN_SAGE'   => 'UPDATE `{$TABLENAME}` SET `sage`   = `sage`   + 1 WHERE `id` = :id;',
				'ADMIN_LOCK'   => 'UPDATE `{$TABLENAME}` SET `lock`   = `lock`   + 1 WHERE `id` = :id;',
				'ADMIN_HIDE'   => 'UPDATE `{$TABLENAME}` SET `hide`   = `hide`   + 1 WHERE `id` = :id;',
				'ADMIN_UNDEL'  => 'UPDATE `{$TABLENAME}` SET `delete` = (CASE WHEN `delete` > 0 THEN `delete` - 1 ELSE 0 END) WHERE `id` = :id;',
				'ADMIN_UNSAGE' => 'UPDATE `{$TABLENAME}` SET `sage`   = (CASE WHEN `sage`   > 0 THEN `sage`   - 1 ELSE 0 END) WHERE `id` = :id;',
				'ADMIN_UNLOCK' => 'UPDATE `{$TABLENAME}` SET `lock`   = (CASE WHEN `lock`   > 0 THEN `lock`   - 1 ELSE 0 END) WHERE `id` = :id;',
				'ADMIN_UNHIDE' => 'UPDATE `{$TABLENAME}` SET `hide`   = (CASE WHEN `hide`   > 0 THEN `hide`   - 1 ELSE 0 END) WHERE `id` = :id;',
				'ADMIN_EDIT'   => 'UPDATE `{$TABLENAME}` SET `content`= "name: "||`name`||"<br />content: "||`content`||"<br />edit time:"||NOW()||"<br /><hr />"||:content WHERE `id` = :id;',
				'ADMIN_RENAME' => 'UPDATE `{$TABLENAME}` SET `name` = "<b><div style=\"color=#FF0000\">ADMIN</div>" WHERE `id` = :id;'
	);
	public static $QUERY_PARAM = array(
				# POST
				'NODE_INSERT'  => array('parent','updatedAt','createdAt','uid','name','email','title','image','content','sage','pwd'),
				'DADY_UPDATE'  => array('updatedAt','parent'),
				'ROOT_UPDATE'  => array('createdAt','uid'),
				# READ
				'NODE_SELECT'  => array('id'),
				'SONS_SELECT'  => array(),
				'PAGE_SELECT'  => array('id','limit','offset'),
				# EDIT
				'POST_DELIMG'  => array('id','pwd'),
				'POST_DELETE'  => array('id','pwd'),
				'POST_LIKE'    => array('id','uid'),
				'POST_DISLIKE' => array('id','uid'),
				# ADMIN FUNCTIONS
				'ADMIN_DEL'    => array('id'),
				'ADMIN_SAGE'   => array('id'),
				'ADMIN_LOCK'   => array('id'),
				'ADMIN_HIDE'   => array('id'),
				'ADMIN_UNDEL'  => array('id'),
				'ADMIN_UNSAGE' => array('id'),
				'ADMIN_UNLOCK' => array('id'),
				'ADMIN_UNHIDE' => array('id'),
				'ADMIN_EDIT'   => array('id','content'),
				'ADMIN_RENAME' => array('id')
	);
	public static $QUERY_CONST = array(
				# POST
				'NODE_INSERT'  => array('{$TABLENAME}'=>CONFIG::TABLE_NAME),
				'DADY_UPDATE'  => array('{$TABLENAME}'=>CONFIG::TABLE_NAME, '{$LEN_REPLYRECORD}' => TableSize::LEN_REPLYRECORD),
				'ROOT_UPDATE'  => array('{$TABLENAME}'=>CONFIG::TABLE_NAME),
				# READ
				'NODE_SELECT'  => array('{$TABLENAME}'=>CONFIG::TABLE_NAME),
				'SONS_SELECT'  => array('{$TABLENAME}'=>CONFIG::TABLE_NAME),
				'PAGE_SELECT'  => array('{$TABLENAME}'=>CONFIG::TABLE_NAME),
				# EDIT
				'POST_DELIMG'  => array('{$TABLENAME}'=>CONFIG::TABLE_NAME),
				'POST_DELETE'  => array('{$TABLENAME}'=>CONFIG::TABLE_NAME),
				'POST_LIKE'    => array('{$TABLENAME}'=>CONFIG::TABLE_NAME, '{$LEN_REPLYRECORD}' => TableSize::LEN_REPLYRECORD),
				'POST_DISLIKE' => array('{$TABLENAME}'=>CONFIG::TABLE_NAME, '{$LEN_REPLYRECORD}' => TableSize::LEN_REPLYRECORD),
				# ADMIN FUNCTIONS
				'ADMIN_DEL'    => array('{$TABLENAME}'=>CONFIG::TABLE_NAME),
				'ADMIN_SAGE'   => array('{$TABLENAME}'=>CONFIG::TABLE_NAME),
				'ADMIN_LOCK'   => array('{$TABLENAME}'=>CONFIG::TABLE_NAME),
				'ADMIN_HIDE'   => array('{$TABLENAME}'=>CONFIG::TABLE_NAME),
				'ADMIN_UNDEL'  => array('{$TABLENAME}'=>CONFIG::TABLE_NAME),
				'ADMIN_UNSAGE' => array('{$TABLENAME}'=>CONFIG::TABLE_NAME),
				'ADMIN_UNLOCK' => array('{$TABLENAME}'=>CONFIG::TABLE_NAME),
				'ADMIN_UNHIDE' => array('{$TABLENAME}'=>CONFIG::TABLE_NAME),
				'ADMIN_EDIT'   => array('{$TABLENAME}'=>CONFIG::TABLE_NAME),
				'ADMIN_RENAME' => array('{$TABLENAME}'=>CONFIG::TABLE_NAME)
	);
}

