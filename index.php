<?php include "config.php"; ?>

<head>
<meta charset="UTF-8">
<meta name="description" content="A colorful forum.">
<meta name="keywords" content="hexchan,text chan,internet forum,chan,freedom,freespeech,chat,uncensored">
<meta name="author" content="#ffffff">
<link rel='shortcut icon' type='image/x-icon' href='favicon.ico'/>
<title><?php echo $SiteHeader; ?></title>
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

html, body, a {
    max-width: 100%;
    overflow-x: hidden;
	color: white;
	-webkit-font-smoothing: none; 
	-moz-osx-font-smoothing: unset;
	-font-smoothing: unset;
}

input[type=text] {
    width: 100%;
    padding: 5px 5px;
    border: 2px solid #ffffff;
	background-color: transparent;
	color: #ffffff;
	margin-bottom: 5px;
	margin-top: 5px;
}
</style>
</head>

<script>
function show(id){
	if (document.getElementById(id).style["display"] == "inline-block"){
		document.getElementById(id).style["display"] = "none";
	}
	else
	{
		document.getElementById(id).style["display"] = "inline-block";
	}
	
}
</script>
<body bgcolor="#000000" > 



<div  style="max-width:640px; margin: auto; padding: 10px;">
<font color="white">
<h1><?php echo $SiteHeader; ?></h1>

<?/* boardlink block start */?>
<?php $folder="r"; ?> 
<img src="folder.png" alt="*" style="vertical-align:text-bottom;"> <a href="<?php echo $folder; ?>"><?php $dir = $folder; include './libs/gettitle.php'; ?></a> <img src="embed.png" onclick='show("<?php echo $folder; ?>")' alt="*" style="vertical-align:text-bottom;"> <input type="text" id="<?php echo $folder; ?>" style="display: none;" value='<iframe src="<?php echo $URL."/".$folder; ?>/" height="500" width="640" frameBorder="0">Browser not compatible.</iframe>'>


<br>
<br>
<?php include("./libs/counter.php"); ?>
<br>

Copyright &copy;<script> document.write(new Date().getFullYear()); </script> <?php echo $SiteCopywriteLine; ?>
</font>
</div>
</body>