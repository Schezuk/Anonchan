<?php
class Node {
	# PROPERTIES OF ROOT
	protected $id, $parent, $updatedAt, $createdAt, $replyCount, $uid, $name, $email, $title, $image, $content;
	protected $hide, $sage, $lock, $delete, $pwd, $like, $liker, $dislike,$disliker;
	protected $recentReply00, $recentReply01, $recentReply02, $recentReply03, $recentReply04;
	protected $recentReply05, $recentReply06, $recentReply07, $recentReply08, $recentReply09;
	protected $recentReply10, $recentReply11, $recentReply12, $recentReply13, $recentReply14;
	protected $recentReply15, $recentReply16, $recentReply17, $recentReply18, $recentReply19;
	# METHODS OF ROOT
	protected function prepareParam($stmtKey){
	    $queryParam = MyPdo::$QUERY_PARAM[$stmtKey];
	    $stmtParam = array();
	    foreach ($queryParam as $key) $stmtParam[$key] = $this->$key; return $stmtParam;
	}
	protected function updateProperty($stmtKey, $extraParam = array(), $stmtClass = NULL){
	    $stmtParam = $extraParam + $this->prepareParam($stmtKey);
	    return $GLOBALS['pdo']->exec($stmtKey, $stmtParam, $stmtClass);
	} # $extraParam should be first.
	# METHODS FROM MYPDO
	public function NODE_SELECT($id, $stmtClass){return $this->updateProperty('NODE_SELECT', array('id'=>$id), $stmtClass);}
	public function __construct(){
	    #http://php.net/manual/zh/pdostatement.fetch.php#82846
	    #https://bugs.php.net/bug.php?id=44341
	    #http://php.net/manual/zh/pdostatement.fetchall.php#114253
	    $this->id         = intval($this->id);
	    $this->parent     = intval($this->parent);
	    $this->updatedAt  = intval($this->updatedAt);
	    $this->createdAt  = intval($this->createdAt);
	    $this->replyCount = intval($this->replyCount);
	    $this->uid        = strval($this->uid);
	    $this->name       = strval($this->name);
	    $this->email      = strval($this->email);
	    $this->title      = strval($this->title);
	    $this->image      = strval($this->image);
	    $this->content    = strval($this->content);
	    $this->hide       = intval($this->hide);
	    $this->sage       = intval($this->sage);
	    $this->lock       = intval($this->lock);
	    $this->delete     = intval($this->delete);
	    $this->pwd        = strval($this->pwd);
	    $this->like       = intval($this->like);
	    $this->liker      = strval($this->liker);
	    $this->dislike    = intval($this->dislike);
	    $this->disliker   = strval($this->disliker);
		$this->recentReply00 = intval($this->recentReply00);
		$this->recentReply01 = intval($this->recentReply01);
		$this->recentReply02 = intval($this->recentReply02);
		$this->recentReply03 = intval($this->recentReply03);
		$this->recentReply04 = intval($this->recentReply04);
		$this->recentReply05 = intval($this->recentReply05);
		$this->recentReply06 = intval($this->recentReply06);
		$this->recentReply07 = intval($this->recentReply07);
		$this->recentReply08 = intval($this->recentReply08);
		$this->recentReply09 = intval($this->recentReply09);
		$this->recentReply10 = intval($this->recentReply10);
		$this->recentReply11 = intval($this->recentReply11);
		$this->recentReply12 = intval($this->recentReply12);
		$this->recentReply13 = intval($this->recentReply13);
		$this->recentReply14 = intval($this->recentReply14);
		$this->recentReply15 = intval($this->recentReply15);
		$this->recentReply16 = intval($this->recentReply16);
		$this->recentReply17 = intval($this->recentReply17);
		$this->recentReply18 = intval($this->recentReply18);
		$this->recentReply19 = intval($this->recentReply19);
	}
}
class Post extends Node{
    # NEW PROPERTIES AND METHODS
	public function showHtml() {if($this->delete === 0) echo require ($GLOBALS['ROOT_PATH'] . $this->templet);} # BLINK
	# PROTECTED PROPERTIES OF POST
	protected $templet;		# UNDEFINED, WILL BE DEFINED IN SUBCLASS
	# PUBLISHED PROPERTIES FROM NODE
	public    $id, $parent, $updatedAt, $createdAt, $replyCount, $uid, $name, $email, $title, $image, $content;
	public    $hide, $sage, $lock, $delete,       $like, $liker, $dislike,$disliker; # WITHOUT $pwd
	# METHODS FROM MYPDO
	public function POST_INSERT     (){return $this->updateProperty('POST_INSERT');}
	# CLONING COPIES PRIVATE PROPERTIES, SO DON'T WORRY.
	public function ROOT_UPDATE     (){return $this->updateProperty('ROOT_UPDATE');}
	public function DADY_UPDATE     (){return $this->updateProperty('DADY_UPDATE');}
	public function POST_DELIMG     (){$result = $this->updateProperty('POST_DELIMG' ); if($result['status'] && 1 === $result['count']) $this->image =''; return $result;}
	public function POST_DELETE     (){$result = $this->updateProperty('POST_DELETE' ); if($result['status'] && 1 === $result['count']) ++$this->delete ; return $result;}
	public function POST_LIKE   ($uid){$result = $this->updateProperty('POST_LIKE'   ,array('uid',$uid)); if($result['status'] && 1 === $result['count']) ++$this->like   ; $this->liker    = $uid.','.$this->liker;    return $result;}
	public function POST_DISLIKE($uid){$result = $this->updateProperty('POST_DISLIKE',array('uid',$uid)); if($result['status'] && 1 === $result['count']) ++$this->dislike; $this->disliker = $uid.','.$this->disliker; return $result;}
	public function ADMIN_DEL       (){$result = $this->updateProperty('ADMIN_DEL'   ); if($result['status'] && 1 === $result['count']) ++$this->delete ; return $result;}
	public function ADMIN_SAGE      (){$result = $this->updateProperty('ADMIN_SAGE'  ); if($result['status'] && 1 === $result['count']) ++$this->sage   ; return $result;}
	public function ADMIN_LOCK      (){$result = $this->updateProperty('ADMIN_LOCK'  ); if($result['status'] && 1 === $result['count']) ++$this->lock   ; return $result;}
	public function ADMIN_HIDE      (){$result = $this->updateProperty('ADMIN_HIDE'  ); if($result['status'] && 1 === $result['count']) ++$this->hide   ; return $result;}
	public function ADMIN_UNDEL     (){$result = $this->updateProperty('ADMIN_UNDEL' ); if($result['status'] && 1 === $result['count']) 0>--$this->delete?:$this->delete=0; return $result;}
	public function ADMIN_UNSAGE    (){$result = $this->updateProperty('ADMIN_UNSAGE'); if($result['status'] && 1 === $result['count']) 0>--$this->sage  ?:$this->sage  =0; return $result;}
	public function ADMIN_UNLOCK    (){$result = $this->updateProperty('ADMIN_UNLOCK'); if($result['status'] && 1 === $result['count']) 0>--$this->lock  ?:$this->lock  =0; return $result;}
	public function ADMIN_UNHIDE    (){$result = $this->updateProperty('ADMIN_UNHIDE'); if($result['status'] && 1 === $result['count']) 0>--$this->hide  ?:$this->hide  =0; return $result;}
	public function ADMIN_EDIT ($text){$result = $this->updateProperty('ADMIN_EDIT',array('content',$text)); if($result['status'] && 1 === $result['count']) $this->content = 'name: '.$this->name.'<br />content: '.$this->content.'<br />edit time: '.time().'<br /><hr />'.$text; return $result;}
	public function ADMIN_RENAME    (){$result = $this->updateProperty('ADMIN_RENAME'); if($result['status'] && 1 === $result['count']) $this->name = '<b><div style="color=#FF0000">ADMIN</div>'; return $result;}
}
class Reply extends Post {
	protected $templet = 'tpl/reply.tpl.php';
}
class Topic extends Post {
	protected $templet = 'tpl/parent.tpl.php';
	public $replies;
	public function recentReplies(){
		$recentReplies = array();
		foreach ($this as $key => $value)
			if(strpos($key, 'recentReply') !== false && isset($value) && $value > 0)
				$recentReplies[] = $value;
		return $recentReplies;
	}
	public function pushReplies($array){
		foreach ($array as $key => &$value) { # EMPTY ARRAY IS FINE
			if ($value->parent === $this->id && $value->delete === 0)
				$this->replies[$key] = $value;
		}
	}
	public function showHtml(){
		parent::showHtml();      # BLINK
		if($this->delete === 0 && !empty($this->replies)) # BLINK 
			foreach ($this->replies as $key => &$value)
				$value->showHtml();# WHY EMPTY ARRAY FAILES?????????????????????????????????????????????????????????????????????
	}
}
class Root extends Node {
    # NEW PROPERTIES AND METHODS
    public $page, $size, $limit, $offset, $headline;
	public $forumName = Config::FORUM_NAME;
	public $boardName = Config::BOARD_NAME;
	public $threads   = array();
	# PROTECTED PROPERTIES OF ROOT
	protected $templet_head = 'tpl/head.tpl.php';
	protected $templet_tail = 'tpl/tail.tpl.php';
	# PUBLISHED PROPERTIES FROM NODE
	public $id, $url;  # MYSQL ACCEPT HARDCODED LIMIT AND OFFSET ONLY
	# METHODS OF ROOT
	public function showHtml(){
		echo require $GLOBALS['ROOT_PATH'] . $this->templet_head;
		foreach ($this->threads as $key => $value)
			if($value->delete === 0) # BLINK
				$value->showHtml();
		echo require $GLOBALS['ROOT_PATH'] . $this->templet_tail;
	}
	# METHODS FROM MYPDO
	public function SONS_SELECT($arr, $stmtClass){return $this->updateProperty('SONS_SELECT', array('{$NODES}'=>$arr), $stmtClass);}
	public function PAGE_SELECT(      $stmtClass){return $this->updateProperty('PAGE_SELECT', array('id'=> $this->id) , $stmtClass);}
	# MAKE SURE IT IS CALLED BY THIS, BECAUSE ONLY ROOT (AND THREAD/FORUM) HAS $limit
	public function fetch(){} # UNDEFINED, WILL BE DEFINED IN SUBCLASS
}
	
class Thread extends Root {
	public $url    = './thread.php';
	public $size   = 0;
	public $offset = Config::REPLIES_PER_PAGE;
	public function __construct($id, $page){
	    parent::__construct();
		$id = Config::intRange($id, 1, MyPdo::MAX_INTEGER); # IT IS FINE EVEN IF ID IS A REPLY ID
		$this->id   = $id;
		$this->page = $page;
		$this->limit= $this->offset * ($this->page - 1);
		$this->headline = "No.{$this->id} - {$this->forumName} @ {$this->boardName}";
	}
	public function showHtml(){
		if($this->threads[$this->id]->delete === 0) parent::showHtml(); # BLINK
		else throw new Exception('Gone with the wind.', -1);# ERROR HANDLING
	}
	public function fetch(){
		$result  = $this->NODE_SELECT($this->id, 'TOPIC');
		if($result['status']===false || $result['count']===0) throw new Exception('Waterloo Bridge.', -2);# ERROR HANDLING
		$threads = $result['result'];
		foreach ($threads as $id => &$thread) $this->size = ceil($thread->replyCount/$this->offset); # ONE THREAD ONLY
		$this->page = Config::intRange($this->page, 1, $this->size); # RESIZE
		$replies = $this->PAGE_SELECT('REPLY');                               # EMPTY ARRAY IS FINE
		foreach ($threads as $id => &$thread) $thread->pushReplies($replies); # EMPTY ARRAY IS FINE
		$this->threads = $threads;
	}
}
class Forum extends Root {
	public $url = './forum.php';
	public $size   = 0;
	public $offset = Config::THREADS_PER_PAGE;
	public function __construct($page){
	    parent::__construct();
		$this->id   = 0;
		$this->page = $page;
		$this->limit= $this->offset * ($this->page - 1);
		$this->headline = "{$this->forumName} @ {$this->boardName}";
	}
	public function fetch(){
		$rc = $this->NODE_SELECT($this->id, 'POST'); # NOT FORUM, BECAUSE IT NEEDS PARAM FOR __construct()
		if($rc['status']===false || $rc['count']===0) throw new Exception('Waterloo Bridge.', -2);# ERROR HANDLING		
		$roots = $rc['result'];
		foreach ($roots as $id => &$root) {
			$this->size = ceil($root->replyCount/$this->offset);  # ONE NODE ONLY, OF WHICH ID = 0
			foreach ($root as $key => $value) $this->$key = $value; # OBJECT CLONING THANKS TO PUBLIC PROPERTIES OF OF CLASS POST
		}
		$this->page = Config::intRange($this->page, 1, $this->size); # RESIZE
 		$result = $this->PAGE_SELECT('TOPIC');
		if($result['status']===false || $result['count']===0) throw new Exception('Waterloo Bridge.', -2);# ERROR HANDLING
		$threads = $result['result'];
		$replyID = array();
		foreach ($threads as $id => &$thread) $replyID = $replyID + $thread->recentReplies();
		$replies = $this->SONS_SELECT($replyID, 'REPLY');                     # EMPTY ARRAY IS FINE
		if($replies['status']===false) throw new Exception('Waterloo Bridge.', -2);# ERROR HANDLING		
		foreach ($threads as $id => &$thread) $thread->pushReplies($replies['result']); # EMPTY ARRAY IS FINE
		$this->threads = $threads;
	}
}
