<?php

if ('https' == @$_SERVER['HTTP_X_FORWARDED_PROTO']) {
    $_SERVER['HTTPS'] = 'on';
}

header('Content-Type: text/plain');
header('Cache-Control: max-age=15, s-maxage=30');

foreach (['REQUEST_URI','PATH_INFO'] as $i) {
    if (!isset($_SERVER[$i])) continue;
    echo $i.": ".$_SERVER[$i].PHP_EOL;
    user_error($i.": ".$_SERVER[$i]);
}

echo date('r', time()).PHP_EOL;

echo (substr($_SERVER['REQUEST_URI'], 0, strlen($_SERVER['DOCUMENT_ROOT'])) === $_SERVER['DOCUMENT_ROOT'] ? "Fail" : "Pass!").PHP_EOL;
