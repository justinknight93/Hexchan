# Hexchan

Hexchan is a simple text forum that I wrote in PHP back in 2016 to learn a little bit about sessions and cookies. 

Users are given a random color when they start their session. This color works as their username so that others can reply directly to each other as well. Other features include notification sounds, notification settings, auto-refreshing, automatic board archiving, character limits, and Recaptcha intergration. 

### Pretty Pictures
![hexchan1](https://user-images.githubusercontent.com/19812682/74511935-be3a2d00-4ecc-11ea-8ecf-588f563e6cae.PNG) 
![hexchan2](https://user-images.githubusercontent.com/19812682/74512418-d2325e80-4ecd-11ea-950f-d744eaff0e5a.PNG)




### Installation is pretty straight forward

1. Obtain a v2 Checkbox public and secret key from https://www.google.com/recaptcha/
2. Open and edit the variables in config.php. You'll need to add your keys here and change your URL to whatever domain you'll be hosting from.
3. Upload everything to a web server with PHP running and you should be good to go. 


### Adding boards

1. Duplicate the 'r' folder and rename it to whatever you'd like. 
2. Edit libs/gettitle.php by adding a line that connects your new board's folder name to its plain English name. For example, if you created the folder "auto", you'd want to add the line `if ($dir=="auto"){echo "automotive";}` just below the line for the random board.
3. Edit the root index.php to add a link to the list. The board list starts at line 72. Copy lines 73 and 74, paste them onto the next line down, and change the 'r' in `<?php $folder="r"; ?>` to whatever you named your board's folder.
4. If anyone has posted in the board you copied make sure to empty out in the "bbs.html" file in your new board directory.
