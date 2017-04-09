<?php
ob_start(function ($buff, $phase) {
    // header(sprintf("Content-Length: %d", ob_get_length()));
});
session_start();

header("Cache-Control: max-age=30; private");

echo file_get_contents("../LICENSE");

user_error('REQUEST_URI'.': '.$_SERVER['REQUEST_URI']);
