<?php include "../config.php"; ?>
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
	color: #ffffff;
}

a {color: white;}

input[type=text] {
    width: 100%;
    padding: 5px 5px;
    border: 2px solid #ffffff;
	background-color: transparent;
	color: #ffffff;
	margin-bottom: 5px;
	margin-top: 5px;
}

input[type=submit] {
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

</style>
<body bgcolor="#000000" > 



<div  style="max-width:640px; margin: auto; padding: 10px;">
<?php if (!isset($_COOKIE['cooks']) || $_COOKIE['cooks'] != session_id()) {die('Get out of my secret base if you\'re not gonna take my cookies!!!');}

  
  if (!isset($_SESSION['human'])) {

		$captcha;
        if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
          die ("The reCAPTCHA wasn't entered correctly. Go back and try it again.");
          
        }
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$RecaptchaSecret."&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        if($response.success==true)            
        {
          $_SESSION['human']="true";
        }
		else
		{
			
			die ("The reCAPTCHA wasn't entered correctly. Go back and try it again.");
		}
  }

?>