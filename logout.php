<?php
session_start(); #starts the session with its values

session_destroy(); #destroys its values so no username, password... has been saved

header("Location: index.php "); #redirects to the home page after it has removed the alues from the session

?>