<?php

session_start();

session_unset();

session_destroy();

header("Location: /nti/FinalProject/ecommerce-project/index.php");

exit();

?>