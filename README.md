# Exploiting PHP-GD imagecreatefromgif() function
Developer uses GD (or Imagemagick) library in order to image header script execution by recreating the image with the new one. This will wipe the image headers, and any embedded code present.

This is the script to generate the payload

```PHP
<?php
$gif = imagecreatefromgif('poc.gif');
imagegif($gif, 'exploit.gif');
imagedestroy($gif);
?>
```
>So this is the hexadecimal dump before the new image recreation. As you can see at the 4th and 5th lines, there are nothing and please notice that there are still EXIF data.

![before](http://i.imgur.com/DSuLQdy.png "Before Recreate")

>After the recreation, the new image file hexadecimal dump also have that "sweet spot" where nothing is appended there. Also the EXIF data is already removed after the recreation process. So let's try injecting our backdoor there.

![after](http://i.imgur.com/E9Ycpro.png "After Recreate")

>Now, the PHP backdoor is append at that blank space because this is the only space that stay the same before and after the recreation process.

![before](http://i.imgur.com/6UxVL50.png "Before Injection")

>Voila !, as you can see the code is still there even after the recreation of new image file.

![after](http://i.imgur.com/37tjMQS.png "After Injection")

So what next? the attacker just need to append .php extension and upload the exploit.
