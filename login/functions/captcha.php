<?php
session_start();

// OBS no Xampp deve habilitar ;extension=gd no php.ini

// Gerar uma sequência de caracteres aleatórios para o CAPTCHA
$captchaText = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 5);

// Armazenar o CAPTCHA na sessão para validação posterior
$_SESSION['captcha'] = $captchaText;

// Criar uma imagem
$captchaImage = imagecreate(150, 40);

// Definir a cor de fundo para cinza claro (RGB: 230, 230, 230)
$background_color = imagecolorallocate($captchaImage, 230, 230, 230);

// Definir a cor do texto para vermelho (RGB: 255, 0, 0)
$text_color = imagecolorallocate($captchaImage, 255, 0, 0);

// Calcular as coordenadas do texto para centralizá-lo na imagem
$textWidth = imagefontwidth(5) * strlen($captchaText);
$textHeight = imagefontheight(5);
$imageWidth = imagesx($captchaImage);
$imageHeight = imagesy($captchaImage);
$textX = ($imageWidth - $textWidth) / 2;
$textY = ($imageHeight - $textHeight) / 2;

// Adicionar texto à imagem
imagestring($captchaImage, 5, $textX, $textY, $captchaText, $text_color);

// Exibir a imagem como um PNG
header("Content-type: image/png");
imagepng($captchaImage);

// Liberar memória
imagedestroy($captchaImage);
