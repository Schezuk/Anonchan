<?php
# TEMPLET head.tpl.php #
require_once $GLOBALS['ROOT_PATH'] . 'cls/language.cls.php';
global $lang;
return <<<EOT
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Cache-Control" content="max-age=0; must-revalidate" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Language" content="zh-cn" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes" />
    <meta name="save" content="history">  
    <title>{$this->headline}</title>

    <link rel="stylesheet" type="text/css" href="src/mainstyle.css" />
    <script type="text/javascript" src="src/mainscript.js"></script>
    <!--[if lt IE 8]><script type="text/javascript" src="src/iedivfix.js"></script><![endif]-->
    <script type="text/javascript">
        // <![CDATA[
        var msgs=['在没有附加图片的情况下，请写入内容','附加图片为系统不支持的格式','侦测到您有输入樱花日文假名的可能性，将自动为您转换'];
        var ext="GIF|JPG|PNG|BMP".toUpperCase().split("|");
        // ]]>
    </script>
    <SCRIPT>function isHidden(oDiv){var vDiv = document.getElementById(oDiv);vDiv.style.display = (vDiv.style.display == 'none')?'block':'none';}</SCRIPT>
</head>
<body>
<div id="header">
    <div id="toplink">
        [<a href="./forum.php?page=1" rel="_top">{$lang->returnForum}</a>]
        [<a href="?">{$lang->refreshPage}</a>]
    </div>
    <br />
    <h1>{$this->headline}</h1>
    <hr class="top" />
</div>
<script type="text/javascript">
window.onload = function() {
	var ds_textarea = document.getElementById("fcom");
	var faceList = ["|∀ﾟ", "(´ﾟДﾟ`)", "(;´Д`)", "(｀･ω･)", "(=ﾟωﾟ)=", "| ω・´)", "|-` )", "|д` )", "|ー` )", "|∀` )", "(つд⊂)", "(ﾟДﾟ≡ﾟДﾟ)", "(＾o＾)ﾉ", "(|||ﾟДﾟ)", "( ﾟ∀ﾟ)", "( ´∀`)", "(*´∀`)", "(*ﾟ∇ﾟ)", "(*ﾟーﾟ)", "(　ﾟ 3ﾟ)", "( ´ー`)", "( ・_ゝ・)", "( ´_ゝ`)", "(*´д`)", "(・ー・)", "(・∀・)", "(ゝ∀･)", "(〃∀〃)", "(*ﾟ∀ﾟ*)", "( ﾟ∀。)", "( `д´)", "(`ε´ )", "(`ヮ´ )", "σ`∀´)", " ﾟ∀ﾟ)σ", "ﾟ ∀ﾟ)ノ", "(╬ﾟдﾟ)", "(|||ﾟдﾟ)", "( ﾟдﾟ)", "Σ( ﾟдﾟ)", "( ;ﾟдﾟ)", "( ;´д`)", "(　д ) ﾟ ﾟ", "( ☉д⊙)", "(((　ﾟдﾟ)))", "( ` ・´)", "( ´д`)", "( -д-)", "(>д<)", "･ﾟ( ﾉд`ﾟ)", "( TдT)", "(￣∇￣)", "(￣3￣)", "(￣ｰ￣)", "(￣ . ￣)", "(￣皿￣)", "(￣艸￣)", "(￣︿￣)", "(￣︶￣)", "ヾ(´ωﾟ｀)", "(*´ω`*)", "(・ω・)", "( ´・ω)", "(｀・ω)", "(´・ω・`)", "(`・ω・´)", "( `_っ´)", "( `ー´)", "( ´_っ`)", "( ´ρ`)", "( ﾟωﾟ)", "(oﾟωﾟo)", "(　^ω^)", "(｡◕∀◕｡)", "/( ◕‿‿◕ )\\", "ヾ(´ε`ヾ)", "(ノﾟ∀ﾟ)ノ", "(σﾟдﾟ)σ", "(σﾟ∀ﾟ)σ", "|дﾟ )", "┃電柱┃", "ﾟ(つд`ﾟ)", "ﾟÅﾟ )　", "⊂彡☆))д`)", "⊂彡☆))д´)", "⊂彡☆))∀`)", "(´∀((☆ミつ"];
	var optionsList = document.getElementById("emotion").options;
	for (var i = 0; i < faceList.length; i++) {
		optionsList[1 + i] = new Option(faceList[i], faceList[i]);
	}
	document.getElementById("emotion").onchange = function(i) {
		if (this.selectedIndex != 0) {
			ds_textarea.value += this.value;
			//alert(this.value);
			var l = ds_textarea.value.length;
			ds_textarea.focus();
			ds_textarea.setSelectionRange(l, l);
		}
	}
}
</script>
<div id="postform" style="text-align: center;">
<form action="/post.php" method="post" enctype="multipart/form-data" onsubmit="return check_reply();" id="postform_main">
<input type="hidden" name="id" value="{$this->id}">
<table cellpadding="1" cellspacing="1" id="postform_tbl" style="margin: 0px auto; text-align: left;">
	<tr>
		<td class="Form_bg"><b>{$lang->formName}</b></td>
		<td>
			<input type="text" name="name" id="fname" size="28" value=""/>
			<input type="submit" name="sendbtn" style="width: 80px;" value="{$lang->formSubmit}"/>
		</td>
	</tr>
	<tr>
		<td class="Form_bg"><b>{$lang->formMail}</b></td>
		<td>
			<input type="text" name="email" id="femail" size="28" value=""/>
		</td>
	</tr>
	<tr>
		<td class="Form_bg"><b>{$lang->formTitle}</b></td>
		<td>
			<input type="text" name="title" id="fsub" size="28" value=""/>
		</td>
	</tr>
	<tr>
		<td class="Form_bg"><b>{$lang->formEmoji}</b></td>
		<td>
			<select id='emotion'>
				<option value='' selected='selected'>颜文字</option>
				<option value='|∀ﾟ'>|∀ﾟ</option>
				<option value='(´ﾟДﾟ`)'>(´ﾟДﾟ`)</option>
				<option value='(;´Д`)'>(;´Д`)</option>
				<option value='(｀･ω･)'>(｀･ω･)</option>
				<option value='(=ﾟωﾟ)='>(=ﾟωﾟ)=</option>
				<option value='| ω・´)'>| ω・´)</option>
				<option value='|-` )'>|-` )</option>
				<option value='|д` )'>|д` )</option>
				<option value='|ー` )'>|ー` )</option>
				<option value='|∀` )'>|∀` )</option>
				<option value='(つд⊂)'>(つд⊂)</option>
				<option value='(ﾟДﾟ≡ﾟДﾟ)'>(ﾟДﾟ≡ﾟДﾟ)</option>
				<option value='(＾o＾)ﾉ'>(＾o＾)ﾉ</option>
				<option value='(|||ﾟДﾟ)'>(|||ﾟДﾟ)</option>
				<option value='( ﾟ∀ﾟ)'>( ﾟ∀ﾟ)</option>
				<option value='( ´∀`)'>( ´∀`)</option>
				<option value='(*´∀`)'>(*´∀`)</option>
				<option value='(*ﾟ∇ﾟ)'>(*ﾟ∇ﾟ)</option>
				<option value='(*ﾟーﾟ)'>(*ﾟーﾟ)</option>
				<option value='(　ﾟ 3ﾟ)'>(　ﾟ 3ﾟ)</option>
				<option value='( ´ー`)'>( ´ー`)</option>
				<option value='( ・_ゝ・)'>( ・_ゝ・)</option>
				<option value='( ´_ゝ`)'>( ´_ゝ`)</option>
				<option value='(*´д`)'>(*´д`)</option>
				<option value='(・ー・)'>(・ー・)</option>
				<option value='(・∀・)'>(・∀・)</option>
				<option value='(ゝ∀･)'>(ゝ∀･)</option>
				<option value='(〃∀〃)'>(〃∀〃)</option>
				<option value='(*ﾟ∀ﾟ*)'>(*ﾟ∀ﾟ*)</option>
				<option value='( ﾟ∀。)'>( ﾟ∀。)</option>
				<option value='( `д´)'>( `д´)</option>
				<option value='(`ε´ )'>(`ε´ )</option>
				<option value='(`ヮ´ )'>(`ヮ´ )</option>
				<option value='σ`∀´)'>σ`∀´)</option>
				<option value=' ﾟ∀ﾟ)σ'> ﾟ∀ﾟ)σ</option>
				<option value='ﾟ ∀ﾟ)ノ'>ﾟ ∀ﾟ)ノ</option>
				<option value='(╬ﾟдﾟ)'>(╬ﾟдﾟ)</option>
				<option value='(|||ﾟдﾟ)'>(|||ﾟдﾟ)</option>
				<option value='( ﾟдﾟ)'>( ﾟдﾟ)</option>
				<option value='Σ( ﾟдﾟ)'>Σ( ﾟдﾟ)</option>
				<option value='( ;ﾟдﾟ)'>( ;ﾟдﾟ)</option>
				<option value='( ;´д`)'>( ;´д`)</option>
				<option value='(　д ) ﾟ ﾟ'>(　д ) ﾟ ﾟ</option>
				<option value='( ☉д⊙)'>( ☉д⊙)</option>
				<option value='(((　ﾟдﾟ)))'>(((　ﾟдﾟ)))</option>
				<option value='( ` ・´)'>( ` ・´)</option>
				<option value='( ´д`)'>( ´д`)</option>
				<option value='( -д-)'>( -д-)</option>
				<option value='(&gt;д&lt;)'>(&gt;д&lt;)</option>
				<option value='･ﾟ( ﾉд`ﾟ)'>･ﾟ( ﾉд`ﾟ)</option>
				<option value='( TдT)'>( TдT)</option>
				<option value='(￣∇￣)'>(￣∇￣)</option>
				<option value='(￣3￣)'>(￣3￣)</option>
				<option value='(￣ｰ￣)'>(￣ｰ￣)</option>
				<option value='(￣ . ￣)'>(￣ . ￣)</option>
				<option value='(￣皿￣)'>(￣皿￣)</option>
				<option value='(￣艸￣)'>(￣艸￣)</option>
				<option value='(￣︿￣)'>(￣︿￣)</option>
				<option value='(￣︶￣)'>(￣︶￣)</option>
				<option value='ヾ(´ωﾟ｀)'>ヾ(´ωﾟ｀)</option>
				<option value='(*´ω`*)'>(*´ω`*)</option>
				<option value='(・ω・)'>(・ω・)</option>
				<option value='( ´・ω)'>( ´・ω)</option>
				<option value='(｀・ω)'>(｀・ω)</option>
				<option value='(´・ω・`)'>(´・ω・`)</option>
				<option value='(`・ω・´)'>(`・ω・´)</option>
				<option value='( `_っ´)'>( `_っ´)</option>
				<option value='( `ー´)'>( `ー´)</option>
				<option value='( ´_っ`)'>( ´_っ`)</option>
				<option value='( ´ρ`)'>( ´ρ`)</option>
				<option value='( ﾟωﾟ)'>( ﾟωﾟ)</option>
				<option value='(oﾟωﾟo)'>(oﾟωﾟo)</option>
				<option value='(　^ω^)'>(　^ω^)</option>
				<option value='(｡◕∀◕｡)'>(｡◕∀◕｡)</option>
				<option value='/( ◕‿‿◕ )\'>/( ◕‿‿◕ )\</option>
				<option value='ヾ(´ε`ヾ)'>ヾ(´ε`ヾ)</option>
				<option value='(ノﾟ∀ﾟ)ノ'>(ノﾟ∀ﾟ)ノ</option>
				<option value='(σﾟдﾟ)σ'>(σﾟдﾟ)σ</option>
				<option value='(σﾟ∀ﾟ)σ'>(σﾟ∀ﾟ)σ</option>
				<option value='|дﾟ )'>|дﾟ )</option>
				<option value='┃電柱┃'>┃電柱┃</option>
				<option value='ﾟ(つд`ﾟ)'>ﾟ(つд`ﾟ)</option>
				<option value='ﾟÅﾟ )　'>ﾟÅﾟ )　</option>
				<option value='⊂彡☆))д`)'>⊂彡☆))д`)</option>
				<option value='⊂彡☆))д´)'>⊂彡☆))д´)</option>
				<option value='⊂彡☆))∀`)'>⊂彡☆))∀`)</option>
				<option value='(´∀((☆ミつ'>(´∀((☆ミつ</option>
			</select>
		</td>
	</tr>
	<tr>
		<td class="Form_bg"><b>{$lang->formContent}</b></td>
		<td>
			<textarea name="content" id="fcom" cols="48" rows="4" style="width: 320px; height: 80px;"></textarea>
		</td>
	</tr>
	<tr>
		<td class="Form_bg"><b>{$lang->formImage}</b></td>
		<td>
			<input type="text" name="upfile" id="fupfile" style="width: 320px;" value="" />
		</td>
	</tr>
	<tr>
		<td class="Form_bg"><b>{$lang->formPwd}</b></td>
		<td>
			<input type="password" name="pwd" id="fpwd" size="8" maxlength="8" value=""/>
			<small>{$lang->helpPwd}</small>
		</td>
	</tr>
</table>
<script type="text/javascript">newpost();</script>
<div>{$lang->helpCooldown}<br /></div>
<noscript>{$lang->helpNoscript}</noscript>
</form>
</div>
EOT;
# END OF TEMPLET head.tpl.php #
