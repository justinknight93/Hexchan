<?php include "config.php"; ?>

<?php
session_start();
setcookie("cooks", session_id());
?>
<head>
<meta charset="UTF-8">
<meta name="description" content="A colorful forum.">
<meta name="keywords" content="hexchan,text chan,internet forum,chan,freedom,freespeech,chat,uncensored">
<meta name="author" content="#ffffff">
<link rel='shortcut icon' type='image/x-icon' href='favicon.ico'/>
<title><?php echo $SiteHeader; ?></title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<?php if ($_COOKIE['refresh']!='false') { ?>
<script type="text/javascript">// <![CDATA[
$(document).ready(function() {
$.ajaxSetup({ cache: false }); // This part addresses an IE bug.  without it, IE will only load the first number and will never refresh
setInterval(function() {
$('#results').load('board.php');
}, 10000); // the "3000" here refers to the time to refresh the div.  it is in milliseconds. 
});
// ]]>
document.cookie = "filesize=" + <?php echo filesize('bbs.html');?>;
</script>
<?php
}
?>

<script language = "Javascript">
maxL=1200;
var bName = navigator.appName;
function taLimit(taObj) {
	if (taObj.value.length==maxL) return false;
	return true;
}

function taCount(taObj,Cnt) { 
	objCnt=createObject(Cnt);
	objVal=taObj.value;
	if (objVal.length>maxL) objVal=objVal.substring(0,maxL);
	if (objCnt) {
		if(bName == "Netscape"){	
			objCnt.textContent=maxL-objVal.length;}
		else{objCnt.innerText=maxL-objVal.length;}
	}
	return true;
}
function createObject(objId) {
	if (document.getElementById) return document.getElementById(objId);
	else if (document.layers) return eval("document." + objId);
	else if (document.all) return eval("document.all." + objId);
	else return eval("document." + objId);
}
function add(text){
    var TheTextBox = document.getElementById("addition");
    TheTextBox.value = TheTextBox.value + text + " ";
}
function setFocusToTextBox(){
    var textbox = document.getElementById("addition");
    textbox.focus();
    textbox.scrollIntoView();
}
function show(id){
	if (document.getElementById(id).style["display"] == "inline-block"){
		document.getElementById(id).style["display"] = "none";
	}
	else
	{
		document.getElementById(id).style["display"] = "inline-block";
	}
	
}
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length,c.length);
        }
    }
    return "";
}



</script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<?php include '../libs/head.php'; ?>
</head>
<style>

@font-face {
    font-family: 'vga-dos';
    src: url('dos-font.ttf');
}

@font-face {
    font-family: 'vga-dos-bold';
    src: url('dos-font-bold.ttf');
}

* {
	font-family: vga-dos;
}

strong {
	font-family: vga-dos-bold !important;
}

html, body {
    max-width: 100%;
    overflow-x: hidden;
	-webkit-font-smoothing: none; 
	-moz-osx-font-smoothing: unset;
	-font-smoothing: unset;
}

a {color: white;}

#addition {
    width: 100%;
    padding: 5px 5px;
    border: 2px solid #ffffff;
	background-color: transparent;
	color: #ffffff;
	margin-bottom: 5px;
	margin-top: 5px;
}

#main {
	color: #ffffff;
	background-color: #000000;
}

#buttonstyle {
    background: transparent; 
    border: 2px solid #ffffff;
    cursor: pointer;
	padding: 5px 5px;
	padding-left: 10px;
	padding-right: 10px;
	color: #ffffff;
	margin-bottom: 5px;
	margin-top: 5px;
}

.hold-right {
				position: fixed; 
				top: 0; 
				right: 0; 
				border: 0;
				
			}
			
#setting-img {
				margin-top: 3px;
				margin-right: 5px;
				margin-left: 2px;
				margin-bottom: 2px;
			}
			
#settings {
				margin-top: 22px;
				color: #ffffff;
				text-align: right;
				background-color: #000000;
				border: 2px solid #ffffff;
			}
#results {
	word-wrap: break-word;
}
			

</style>
<body id="main"> 

<?php include '../libs/topbody.php'; ?>

<div  style="max-width:640px; margin: auto; padding: 10px;">
<h1><font color="white"><a href="../"><?php echo $URL; ?></a> - <?php $dir = basename(dirname(__FILE__)); include '../libs/gettitle.php'; ?></font></h1>
<?php
if(isset($_GET["err"]) && htmlspecialchars($_GET["err"])==1){echo '<font color="red"><strong>Error, could not send message.</strong></font>';}
if(isset($_GET["err"]) && htmlspecialchars($_GET["err"])==2){echo '<font color="red"><strong>Error, please wait 30 seconds between post.</strong></font>';}


include 'randomcolor.php';
use \Colors\RandomColor;
$_SESSION['filesize'] = filesize("bbs.html");

if (isset($_SESSION['human'])){
	// Returns a hex code for an attractive color

    if (!isset($_SESSION['color'])){$_SESSION['color'] = RandomColor::one(); }
}
else
{
	// Returns a hex code for an attractive color

    $_SESSION['color'] = RandomColor::one(); 
}


?>



<form name="posttext" action="handler.php" method="post"> 
<div style="max-width:640px;"> 
<!-- This is the code for the gear -->
		<div class="hold-right">
			<img src="../gear.png" class="hold-right" id="setting-img" onclick="show('settings');"/>
			<table id="settings" style="display:none;">
				<tr>
					<th>Only Notify Me of Replies</th>
					<th><input type="checkbox" id="replycheck" <?php if ($_COOKIE['reply']=='true'){echo "checked";}?> /></th>
					
				</tr>
				<tr>
					<th>Mute All Notifications</th>
					<th><input type="checkbox" id="mutecheck" <?php if ($_COOKIE['mute']=='true'){echo "checked";}?> /></th>
					
				</tr>
				<tr>
					<th>Auto Refresh Board</th>
					<th><input type="checkbox" id="autocheck" <?php if ($_COOKIE['refresh']!='false'){echo "checked";}?> /></th>
					
				</tr>
				<!--
				<tr>
					<td><input type="checkbox" checked/></td>
					<td>Dark</td>
				</tr>
				-->
			</table>
		</div>
		
<input type="submit" value="Post" id="buttonstyle" style="float: right"/> 
<div style="overflow: hidden; padding-right: .5em;">
<input type="text" autofocus autocomplete="off" id="addition" name="addition" style="width: 100%; color: <?php echo $_SESSION['color']; ?>;" onKeyPress="return taLimit(this)" onKeyUp="return taCount(this,'myCounter')"> 
</div>
<font color="white">You have <B><SPAN id=myCounter>1200</SPAN></B> characters remaining.</font>
<div style="height: 5px;"><!-- padding --></div>
<?php
if (isset($_SESSION['human'])){

}
else
{
    $publickey = $RecaptchaPublic; // you got this from the signup page
    
	echo '<div class="g-recaptcha" data-sitekey="'.$publickey.'"></div>';
}
?>
</div>
<br>

<div id="results"><?php 
$string = file_get_contents( "bbs.html" );
echo $string; ?></div>

</form>
</div>

<?php include '../libs/bottombody.php'; ?>
<script>
document.getElementById('mutecheck').onclick = function() {
    // access properties using this keyword
    if ( this.checked ) {
		
        
		document.cookie = "mute=true";
        
    } else {
        // if not checked ...
		
		document.cookie = "mute=false";
    }
};
document.getElementById('autocheck').onclick = function() {
    // access properties using this keyword
    if ( this.checked ) {
		
        
		document.cookie = "refresh=true";
		location.reload();
        
    } else {
        // if not checked ...
		
		document.cookie = "refresh=false";
		location.reload();
    }
};
document.getElementById('replycheck').onclick = function() {
    // access properties using this keyword
    if ( this.checked ) {
		
        
		document.cookie = "reply=true";
		
        
    } else {
        // if not checked ...
		
		document.cookie = "reply=false";
		
    }
};
</script>
</body>
