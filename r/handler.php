<?php 
require_once("start.php");
date_default_timezone_set('EST');

if (time() - ( isset($_SESSION['last_submit'])?$_SESSION['last_submit']:0 )< 30) {header("Location: index.php?err=2"); die('Post limit exceeded. Please wait at least 30 seconds'); }
    

// update the session
$_SESSION['last_submit'] = time(); 



function autolink($str, $attributes=array()) {
	$attrs = '';
	foreach ($attributes as $attribute => $value) {
		$attrs .= " {$attribute}=\"{$value}\"";
	}

	$str = ' ' . $str;
	$str = preg_replace(
		'`([^"=\'>])((http|https|ftp)://[^\s<]+[^\s<\.)])`i',
		'$1<a href="$2" target="_blank"'.$attrs.'>$2</a>',
		$str
	);
	$str = substr($str, 1);
	
	$str = ' ' . $str;
	$str = preg_replace(
		'/#([\da-fA-F]{2})([\da-fA-F]{2})([\da-fA-F]{2})/',
		'<font color="#$1$2$3">#$1$2$3</font>',
		$str
	);
	$str = substr($str, 1);
	
	return $str;
}


if(isset($_POST['addition']) && !empty($_POST['addition']) && strlen(strip_tags($_POST['addition']))>0 && strlen($_POST['addition'])<1201)
	{
	if (filesize("bbs.html") > 250000) {
		$file_data = '<head> <style type="text/css"> html, body {background-color: black;}</style></head>';
		$file_data .= file_get_contents('bbs.html');
		file_put_contents('bbs.html', $file_data);
		
		rename('bbs.html', 'archive/'.date("YmdHis").'bbs.html');
		file_put_contents('template.html', '<font color="#FFFFFF"><strong>#ffffff(BOT)</strong> on '.date('l jS \of F Y h:i:s A').'<br><br>Board was <a href="./archive/">archived</a>.<br><hr width="100%"></font>');
		copy("template.html", "bbs.html");
	}
	// The Regular Expression filter
	$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

	// The Text you want to filter for urls
	$text = strip_tags($_POST['addition']);
	
	
	// Check if there is a url in the text
	$text = autolink($text);
	
	
	
	//remove other shit tags
	$text =  preg_replace('/\pM+/u', '', $text);
	
	$file_data = '<font color="' . $_SESSION['color'] . '"><strong><a href="#" style="color:' . $_SESSION['color'] . ';" onclick="add(\''.$_SESSION['color'].'\'); setFocusToTextBox();" >'.$_SESSION['color'].'</a></strong> on '. date('l jS \of F Y h:i:s A') . "<br><br>" . $text . '<br><hr width="100%"></font>';
	$file_data .= file_get_contents('bbs.html');
	file_put_contents('bbs.html', $file_data);
	
	header("Location: index.php"); 
	}
	else
	{
	header("Location: index.php?err=1");
	}


?> 