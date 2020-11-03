<?php 
session_save_path('./sessions');   
session_start();
session_destroy();   
session_unset();  
$token = $_POST["token"];
?>

<html>
	<head>
		<title> Survey </title>
		<link rel="stylesheet" type="text/css" href="css/surveycss.css" />
	</head>
	<body>
    
		<div class="Intro">
			<h2> Done! </h2>
			<p style="font-size:18px;"><b> This is your code for inserting in MTurks: </b></p>
			<p><input type="text" class="token" name="west" value="<?php echo $token;?>" readonly /></p>
			<p>&nbsp </p>
			<p>&nbsp </p>
			<p> Thanks for your time! You have successfully completed the survey and submitted your answers. </p>
			<!--<p>If you have any comments or questions, please email us at: <a style="color:#457dd8" href="mailto:anase@unizar.es">anase@unizar.es</a>.</p>-->
			
		</div>

	</body>
	<script type="text/javascript">
	
     window.onbeforeunload = function() { return "Are you sure you want to leave? Make sure you copied your code for MTurk!!!"; }
	</script>
	
	
</html>
