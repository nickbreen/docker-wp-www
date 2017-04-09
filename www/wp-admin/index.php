<?php
session_name("test-session");
session_start();

header("Cache-Control: max-age=30");

echo file_get_contents("../LICENSE");
