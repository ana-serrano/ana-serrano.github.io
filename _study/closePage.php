<?php
session_save_path('./sessions');   
session_start();
session_destroy();   
session_unset();  
?>
