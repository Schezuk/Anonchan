/* Based on JavaScript from h.acfunwiki.org */
/* Beautified by tool.lu/js */

/* =======Public_Methods.js======== */
function $_(a) {
	return document.getElementById(a);
}

function getCookie(keyname) {
	var strCookie = " " + document.cookie + ";";
	var lenCookie = strCookie.length;
	var i;
	while (i < lenCookie) {
		var indexSemicolon = strCookie.indexOf(";", i);
		var subStr = strCookie.substring(i + 1, indexSemicolon);
		var indexEqual = subStr.indexOf("=");
		if (subStr.substring(0, indexEqual) === keyname) return window.unescape(subStr.substring(indexEqual + 1, indexSemicolon - i - 1));
		i = indexSemicolon + 1;
	}
	return "";
}

function setCookie(keyname, keyvalue) {
	var objDate = new Date;
	objDate.setTime(objDate.getTime() + 6048E5);
	document.cookie = keyname + "=" + window.escape(keyvalue) + "; expires=" + objDate.toGMTString();
}
/* ====End of Public_Methods.js==== */

/* ===========Sakura.js============ */
var arrSakuraTbl = [
		[63223, 12353, 82],
		[63306, 12449, 85],
		[63486, 12535, 4]
	];
var arrSakuraTblsp = [
		[63216, 63219, 63210, 63211, 63212, 63213],
		[12293, 12540, 12541, 12542, 12445, 14446]
	];

function replace_sakura(a) {
	var d = a.value,
		b = 0,
		e = 0,
		g = arrSakuraTbl.length,
		f;
	for (b = 0; b < g; b++) {
		f = arrSakuraTbl[b];
		for (e = 0; e <= f[2]; e++) d = d.replace(new RegExp(String.fromCharCode(f[0] + e), "g"), String.fromCharCode(f[1] + e));
	}
	g = arrSakuraTblsp[0].legnth;
	for (b = 0; b < g; b++) {
		f = arrSakuraTblsp;
		d = d.replace(new RegExp(String.fromCharCode(f[0][b]), "g"), String.fromCharCode(f[1][b]));
	}
	a.value = d;
}

function check_sakura(a) {
	a = $_(a);
	if (window.escape(a.value).toLowerCase().match(/%uf(6[ef]|7[0-9a-f]|80)[0-9a-f]/) !== null) {
		alert(msgs[2]);
		replace_sakura(a);
	}
}
/* ========End of Sakura.js======== */

/* ===========Preset.js============ */
var previous_replyhlno = 0;
var arrPresetFunc = [];

function fixalllinks() {
	if (document.getElementsByTagName) {
		var aArray = document.getElementsByTagName("a");
		var loop = aArray.length;
		var i;
		for (i = 0; i < loop; i++) {
			var a = aArray[i];
			if (a.getAttribute("href")) {
				if (a.getAttribute("rel") === "_top") a.target = "_top";
				if (a.getAttribute("rel") === "_blank") a.target = "_blank";
			}
		}
	}
}

function replyhl(replyId, replaceClassname) {
	var domReplyId = $_(replyId);
	if (domReplyId) if (replaceClassname) domReplyId.className = domReplyId.className.replace(" reply_hl", "");
	else {
		previous_replyhlno && replyhl(previous_replyhlno, true);
		previous_replyhlno = replyId;
		domReplyId.className += " reply_hl";
	}
}

function quote(replyId) {
	try {
		$_("fcom").focus();
		$_("fcom").value += ">>No." + replyId + "\r\n";
	} catch (e) {}
}

function hookPresetFunction(IEdivfix) {
	typeof IEdivfix === "function" && arrPresetFunc.push(IEdivfix);
}
function preset() {
	fixalllinks();
	var loop = arrPresetFunc.length;
	var i;
	for (i = 0; i < loop; i++) {
		var anonymousFunction = arrPresetFunc[i];
		typeof anonymousFunction === "function" && anonymousFunction();
	}
	docUrl = location.href;
	if (docUrl.indexOf("?res=")) {
		docUrl.match(/#[rq]([0-9]+)$/) && replyhl(RegExp.$1, false);
		docUrl.match(/#q([0-9]+)$/) && quote(RegExp.$1);
	}
}
/* ========End of Preset.js======== */

/* =========Mainscript.js========== */
function showform() {
	$_("postform").className = "";
	$_("postform_tbl").className = "";
	$_("hide").className = "show";
	$_("show").className = "hide";
}

function hideform() {
	$_("postform").className = "hide_btn";
	$_("postform_tbl").className = "hide";
	$_("hide").className = "hide";
	$_("show").className = "show";
}

function newpost() {
	var namec = getCookie("namec");
	var emailc = getCookie("emailc");
	var inputbox;
	if (inputbox = $_("fname")) inputbox.value = namec;
	if (inputbox = $_("femail")) inputbox.value = emailc;
}

function delpost() {
	var pwdc = getCookie("pwdc");
	var doc = document;
	var docLen = doc.forms.length;
	var i;
	for (i = 0; i < docLen; i++) if (doc.forms[i].pwd) doc.forms[i].pwd.value = pwdc;
}

function check_reply() {
	try {
		if ($_("fcom").value) {
			//do nothing
		} else if ($_("fupfile").value) {
			var fupfile = !$_("fupfile").value;
			var loop = fupfile.length;
			var attrib = 0;
			var i;
			for (i = 0; i < e; i++) {
				if (fupfile.substr(fupfile.length - 3, 3).toUpperCase() === ext[i]) {
					attrib = 1;
					break;
				}
			}
			if (!attrib) {
				alert(msgs[1]);
				return false;
			}
		} else {
			alert(msgs[0]);
			return false;
		}
		check_sakura("fname");
		check_sakura("femail");
		check_sakura("fsub");
		check_sakura("fcom");
		check_sakura("fupfile");
		check_sakura("fpwd");
		document.forms[0].sendbtn.disabled = true;
	} catch (e) {}
	$_("fname").value && setCookie("namec", $_("fname").value);
	$_("femail").value && setCookie("emailc", $_("femail").value);
	$_("fpwd").value && setCookie("pwdc", $_("fpwd").value);
}
/* ======End of Mainscript.js====== */
