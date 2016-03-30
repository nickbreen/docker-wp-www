<?php

foreach ($_SERVER as $h => $v)
  if (0 === strpos($h, 'HTTP_'))
    echo "$h\t$v\n";
