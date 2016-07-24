<?php

if ('https' == $_SERVER['HTTP_X_FORWARDED_PROTO'])
  $_SERVER['HTTPS'] = 'on';

header('Cache-Control: max-age=5, s-maxage=13');
header("Expires: " . gmdate("D, d M Y H:i:s e", time() + 30) );
?>

<a href="/">/</a>
<table>
<?php
foreach ($_SERVER as $h => $v)
  if (0 === strpos($h, 'HTTP'))
    echo "<tr><td>$h<td>$v\n";
?>
</table>
