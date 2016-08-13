<?php

if ('https' == @$_SERVER['HTTP_X_FORWARDED_PROTO']) {
    $_SERVER['HTTPS'] = 'on';
}

header('Content-Type: text/plain');
header('Cache-Control: max-age=15, s-maxage=30');
//header("Expires: " . gmdate("D, d M Y H:i:s e", time() + 30));
?>

<?php

$n = array_reduce(array_keys($_SERVER), function ($carry, $item) {
    return max($carry, strlen($item));
}, 0);

foreach ($_SERVER as $h => $v) {
    printf("%-${n}s\t%s".PHP_EOL, $h, $v);
}

echo "Pass!";
