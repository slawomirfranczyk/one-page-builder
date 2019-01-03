<?php
session_start();

define("CORE_PATH",str_replace("\\","/",dirname(__FILE__)) . "/");

include CORE_PATH."parsedown/Parsedown.php";
include CORE_PATH."functions.php";

?>
