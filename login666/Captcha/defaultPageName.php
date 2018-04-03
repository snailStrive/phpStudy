<?php
session_start();
header("content-type:image/png");
$validateLength=4;
$strToDraw="";
$chars=[
  "0","1","2","3","4",
  "5","6","7","8","9",
  "a","b","c","d","e","f","g",
  "h","i","j","k","l","m","n",
  "o","p","q","r","s","t",
  "u","v","w","x","y","z",
  "A","B","C","D","E","F","G",
  "H","I","J","K","L","M","N",
  "O","P","Q","R","S","T",
  "U","V","W","X","Y","Z"
];
$imgW=80;
$imgH=30;
$imgRes=imagecreate($imgW,$imgH);
$imgColor=imagecolorallocate($imgRes,255,255,255);
$color=imagecolorallocate($imgRes,0,0,0);
for($i=0;$i<$validateLength;$i++){
  $rand=rand(1,58);
  $strToDraw=$strToDraw." ".$chars[$rand];
}
$_SESSION['rndCode']=str_replace(" ","",$strToDraw);
imagestring($imgRes,5,0,7,$strToDraw,$color);
for($i=0;$i<100;$i++){
  imagesetpixel($imgRes,rand(0,$imgW),rand(0,$imgH),$color);
}
imagepng($imgRes);
imagedestroy($imgRes);

?>