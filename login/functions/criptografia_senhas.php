<?php
$senha = '1';
$senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

echo 'Senha Normal:'.$senha . '<br>';
echo 'Senha Criptografada:'.$senhaCriptografada;