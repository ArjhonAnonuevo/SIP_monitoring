<?php
session_start();
session_unset();
session_destroy();
header("Location: /SIP/interns account/internslogin.php");
exit();
?>
