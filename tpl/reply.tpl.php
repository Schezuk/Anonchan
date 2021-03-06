<?php
# TEMPLET reply.php #
require_once $GLOBALS['ROOT_PATH'] . 'cls/language.cls.php';
global $lang;
return <<<EOT
<div class="reply" id="{$this->id}">
    <div class="replywrap">
    	<input type="checkbox" onclick="if (this.checked) \$_('fid').value='{$this->id}'; else \$_('fid').value='';" />
    	<img src="{$this->image}" class='img' style='max-width:250px; max-height:250px' />
    	<span class="title">{$this->title}</span>
    	<span class="name" >{$this->name}</span>
    	<span class="email" >{$this->email}</span>
    	<span class="sage" style="color: #FF0000">{$lang->textSage[$this->sage>0]}</span>
    	<span class="time" >{$lang->textTime($this->createdAt)}</span>
    	<span class="uid">[ID:{$this->uid}]</span>
    	<a href="./thread.php?id={$this->parent}#{$this->id}" class="qlink">No.{$this->id}</a>
    	<br />
		<div style="{$lang->styleDisplay[$this->hide>0]};cursor:hand" onclick="isHidden('h{$this->id}')">{$lang->textHide[$this->hide>0]}</DIV>
		<div style="{$lang->styleHide[$this->hide>0]}"  class="quote" id="h{$this->id}">{$this->content}</div>
	    <div style="{$lang->styleDisplay[Config::SHOW_LIKER >= 0]}"    class="like"    >{$lang->textLike($this->like)}
		<div style="{$lang->styleDisplay[Config::SHOW_LIKER >  0]}"    class="liker"   >{$lang->textLiker($this->liker)}</div><br /></div>
		<div style="{$lang->styleDisplay[Config::SHOW_DISLIKER >= 0]}" class="dislike" >{$lang->textDislike($this->dislike)}
		<div style="{$lang->styleDisplay[Config::SHOW_DISLIKER >  0]}" class="disliker">{$lang->textDisliker($this->disliker)}</div><br /></div>
	</div>
</div>
EOT;
# END OF TEMPLET head.php #	
