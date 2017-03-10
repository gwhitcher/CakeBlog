<?php
function show_captcha() {
    if (session_id() == "") {
        session_name("CAKEPHP");
        session_start();
    }

    //$path= VENDORS.'captcha';
    $path = (APP.'../plugins'.DS.'captcha'.DS);
    $imgname = 'noise.jpg';
    $imgpath  = $path.'images/'.$imgname;

    $captchatext = md5(time());
    $captchatext2 = substr($captchatext, 0, 5);
    $_SESSION['captcha']=$captchatext2;


    if (file_exists($imgpath) ){
        $im = imagecreatefromjpeg($imgpath);
        $grey = imagecolorallocate($im, 99, 99, 99);
        $font = $path.'/fonts/'.'TTWPGOTT.ttf';

        imagettftext($im, 22, 0, 10, 23, $grey, $font, $captchatext2) ;

        header('Content-Type: image/jpeg');
        header("Cache-control: private, no-cache");
        header ("Last-Modified: " . gmdate ("D, d M Y H:i:s") . " GMT");
        header("Pragma: no-cache");
        imagejpeg($im);

        imagedestroy($im);
        ob_flush();
        flush();
    }
    else{
        echo 'captcha error';
        exit;
    }
}