<?php
session_start();

if (!extension_loaded('gd')) {
    die("install/enable GD extension");
}

header('Content-type: image/png');


$captchakey = randomString(2);
$im = imagecreatetruecolor(138, 44);


imagefill($im, 0, 0, imagecolorallocate($im, random_int(10, 120), random_int(50, 180), random_int(30, 190)));

for ($i = 0; $i < 80; $i++) {
    $lines = imagecolorallocatealpha($im, random_int(10, 120), random_int(50, 180), random_int(30, 190), 80);
    $start_x = rand(0, 138);
    $start_y = rand(0, 44);
    $end_x = $start_x + rand(0, 1000);
    $end_y = $start_y + rand(0, 1000);
    imageline($im, $start_x, $start_y, $end_x, $end_y, $lines);
}

$textcolor = imagecolorallocate($im, 255, 255, 255);
$font = imageloadfont("font.gdf");
imagestring($im, $font, rand(28, 50), rand(8, 15), $captchakey, $textcolor);
imagefilter($im, IMG_FILTER_SCATTER, 0, 2);
$gaussian = array(array(random_int(0.9, 1), random_int(0.9, 1), random_int(0.9, 1)), array(2.0, 4.0, 2.0), array(random_int(0.9, 1), random_int(0.9, 1), random_int(0.9, 1)));
imageconvolution($im, $gaussian, 13, 0);

$token = crypt(sha1(urlencode($captchakey)), setToken(10));
$_SESSION['captchaKey'] = $token;

imagepng($im);
imagedestroy($im);


function randomString($bytes)
{
    return bin2hex(random_bytes($bytes));
}

function setToken($char)
{
    $token = '';
    do {
        $bytes = random_bytes($char);
        $token .= str_replace(
            ['.', '/', '='],
            '',
            base64_encode($bytes)
        );
    } while (strlen($token) < $char);
    return sha1($token);
}