<?php

if ('https' == @$_SERVER['HTTP_X_FORWARDED_PROTO']) {
    $_SERVER['HTTPS'] = 'on';
}

header('Content-Type: text/plain');
header('Cache-Control: max-age=15, s-maxage=30');
header("Location: /test.txt");
?>

<?php

$n = array_reduce(array_keys($_SERVER), function ($carry, $item) {
    return max($carry, strlen($item));
}, 0);

foreach ($_SERVER as $h => $v) {
    header("X-${h}: ${v}");
    // printf("%-${n}s\t%s".PHP_EOL, $h, $v);
}


echo $_SERVER['DOCUMENT_ROOT'].PHP_EOL;
echo $_SERVER['REQUEST_URI'].PHP_EOL;

echo (substr($_SERVER['REQUEST_URI'], 0, strlen($_SERVER['DOCUMENT_ROOT'])) === $_SERVER['DOCUMENT_ROOT'] ? "Fail" : "Pass!").PHP_EOL;
