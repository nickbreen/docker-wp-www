<?php

if ('https' == $_SERVER['HTTP_X_FORWARDED_PROTO'])
  $_SERVER['HTTPS'] = 'on';

// setcookie("HTTPS", $_SERVER['HTTPS']);
?>
<a href="/">/</a>
<table>
<?php
foreach ($_SERVER as $h => $v)
  if (0 === strpos($h, 'HTTP'))
    echo "<tr><td>$h<td>$v\n";
?>
</table>
