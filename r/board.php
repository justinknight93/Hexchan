<?php
$string = file_get_contents( "bbs.html" );

echo $string;


function writefilesize() {
	$File = "boardsize.txt";  
	$Handle = fopen($File, 'w'); 
	$Data = filesize("./bbs.html");  
	fwrite($Handle, $Data);  
	fclose($Handle); 
}
function readfilesize() {
	$YourFile = "boardsize.txt";  
	$handle = fopen($YourFile, 'r');  
	$Data = fread($handle, 512);  
	fclose($handle);  
	return $Data; 
}
?>

<script>
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

var mycolor = "<?php session_start(); echo $_SESSION['color'];?>";
var filesizejava = <?php echo filesize('bbs.html');?>;
var newtextstring = '<?php 
if (isset($_COOKIE['filesize'])){
	$filepartsize = filesize('bbs.html')-$_COOKIE['filesize'];
		if ($filepartsize > 5)
		{
			$fh = fopen("bbs.html", "rb");
			$data = fread($fh, $filepartsize);
			fclose($fh);
			$data=str_replace('"', "", $data);
			$data=str_replace("'", "", $data);
			$data=htmlspecialchars($data);
			echo $data;
		}
		else
		{
			echo 0;
		}
	} 
	else
	{
		echo 0;
	}

?>';
console.log(filesizejava)
if (getCookie('filesize') != filesizejava) {
	if (getCookie('mute') != "true"){
		
	if (getCookie('reply') == "true"){
		if (newtextstring != "0"){
			
			var n = newtextstring.search(mycolor);
			if (n>0){
			var audio = new Audio('../libs/notification.mp3');
			audio.play();
			}
		}
	}else{
		var audio = new Audio('../libs/notification.mp3');
		audio.play();
	}	
	
	}
	document.cookie = "filesize=" + filesizejava;
}
</script>