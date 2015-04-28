<?php
# TEMPLET tail.php #
require_once $GLOBALS['ROOT_PATH'] . 'cls/language.cls.php';
global $lang;
return <<<EOT
<html>
<hr />
<div id="del">
	<form action="./delete.php" method="post" enctype="multipart/form-data" onsubmit="return check_reply();" id="postform_main">
		<table style="float: right;">
			<tr>
				<td align="center" style="white-space: nowrap;">{$lang->formDelete}</td>
				<td>{$lang->formDel_ID}</td>
				<td>
					<input type="text" name="id" id="fid" size="10" maxlength="10" value=""/>
				</td>
				<td>{$lang->formPwd}</td>
				<td>
					<input type="password" name="pwd" id="fpwd" size="8" maxlength="8" value=""/>
				</td>
				<td>
					[<input type="checkbox" name="onlyimgdel" id="onlyimgdel" value="on" /><label for="onlyimgdel">{$lang->formDelimg}</label>]
				</td>
				<td>
					<input type="submit" value="{$lang->formExecute}" />
				</td>
	        	</tr>
		</table>
	</form>
</div>
<script type="text/javascript">delpost();</script>
<div id="page_switch">
	<div>
		<a class="prev" href="{$this->url}?page=1" style="{$lang->styleDisplay[$this->page > 1]}">[1]</a>
		<a class="num" href="{$this->url}?page={$lang->write($this->page - 4)}" style="{$lang->styleDisplay[$this->page > 5]}">[{$lang->write($this->page > 5 ? $this->page - 4: '')}]</a>
		<a class="num" href="{$this->url}?page={$lang->write($this->page - 3)}" style="{$lang->styleDisplay[$this->page > 4]}">[{$lang->write($this->page > 4 ? $this->page - 3: '')}]</a>
		<a class="num" href="{$this->url}?page={$lang->write($this->page - 2)}" style="{$lang->styleDisplay[$this->page > 3]}">[{$lang->write($this->page > 3 ? $this->page - 2: '')}]</a>
		<a class="num" href="{$this->url}?page={$lang->write($this->page - 1)}" style="{$lang->styleDisplay[$this->page > 2]}">[{$lang->write($this->page > 2 ? $this->page - 1: '')}]</a>
		<span class="current">[{$this->page}]</span>
		<a class="num" href="{$this->url}?page={$lang->write($this->page + 1)}" style="{$lang->styleDisplay[$this->page + 2 < $this->size]}">[{$lang->write($this->page + 2 < $this->size ? $this->page + 1: '')}]</a>
		<a class="num" href="{$this->url}?page={$lang->write($this->page + 2)}" style="{$lang->styleDisplay[$this->page + 3 < $this->size]}">[{$lang->write($this->page + 3 < $this->size ? $this->page + 2: '')}]</a>
		<a class="num" href="{$this->url}?page={$lang->write($this->page + 3)}" style="{$lang->styleDisplay[$this->page + 4 < $this->size]}">[{$lang->write($this->page + 4 < $this->size ? $this->page + 3: '')}]</a>
		<a class="num" href="{$this->url}?page={$lang->write($this->page + 4)}" style="{$lang->styleDisplay[$this->page + 5 < $this->size]}">[{$lang->write($this->page + 5 < $this->size ? $this->page + 4: '')}]</a>
		<a class="end" href="{$this->url}?page={$this->size}" style="{$lang->styleDisplay[$this->page + 1 < $this->size]}">[{$this->size}]</a>
	</div>
</div>
<div id="footer">
	<script type="text/javascript">preset();</script>
	<!--Space for Web Analytics Service.-->
	{$lang->write(CONFIG::WEB_ANALYTICS)}
	<!--End of space for Web Analytics Service.-->
</div>
</body>
</html>
EOT;
# END OF TEMPLET tail.php #
