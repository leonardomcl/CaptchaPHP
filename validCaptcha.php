<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    empty($_POST['captcha']) ? die('Captcha inválido') : $captcha = trim($_POST['captcha']);
    empty($_SESSION['captchaKey']) ? die('Sessão inválida') : $key = $_SESSION['captchaKey'];

    if (crypt(sha1(urlencode($captcha)), $key) == $key) {
        unset($_SESSION['captchaKey']);
        $_SESSION['captchaSolved'] = true;
        print "success";
    } else {
        unset($_SESSION['captchaKey']);
        unset($_SESSION['captchaSolved']);
        print "fail";
    }

}
