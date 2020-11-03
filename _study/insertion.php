<?php 
session_save_path('./sessions');   
session_start();
?>

<html>
	<head>
		<title> Survey </title>
		<link rel="stylesheet" type="text/css" href="css/surveycss.css" />
	</head>
	<body>
		
		<?php 
    if (isset($_SESSION['array_final']))
    {
		$var = $_SESSION['array_final'];		
		$token = uniqid();
		$var["token"] = $token;
		$var["gender"] = $_SESSION['gender'];
		$var["specify"] = $_SESSION['specify'];
		$var["age"] = $_SESSION['age'];
		$var["display"] = $_SESSION['display'];
		$var["CGExp"] = $_SESSION['CGExp'];
		$var["DesExp"] = $_SESSION['DesExp'];
		$var["ArtExp"] = $_SESSION['ArtExp'];		
				
		//array_push($var,array('token'=>$token));
		file_put_contents("./data/".$token.".json",json_encode($var));
		
		
		
		
		$filename = 'appearances/list_counts_fin.json';		
		if(!file_exists ($filename ))
		{
			$imgsdir = ('images/');
			$list = preg_grep('~\.(png)$~', scandir($imgsdir));

			$apps = array();
			foreach ($list as $i)
			{
				//array_push($apps,array($i=>0));
				$apps[$i] = 0;
			}
			$fp = fopen($filename, 'w');
			fwrite($fp, json_encode($apps));
			fclose($fp);
		}
		
		$fid = fopen($filename,"c+");
		flock($fid,LOCK_EX);
		$file = fread($fid, filesize($filename));
		$data = json_decode($file, true);
		
		$aux = $_SESSION['array_images'];
		for ($i=0;$i<count($aux);$i++)
		{
			$data[$aux[$i]] =$data[$aux[$i]]+ 1; 
		}
			
		//$data[$_SESSION['list']] =$data[$_SESSION['list']]+ 1; 
		ftruncate($fid,0);
		rewind($fid);
		fwrite($fid,json_encode($data));
		flock($fid,LOCK_UN);
		fclose($fid);
    }
    
		?>
		
   <div id="page" style="visibility:visible;">
		<div class="Intro">
			<h2> Please wait while submitting the results...</h2>
			
		</div>
		</div>
   <div id="error" style="visibility:hidden; position: fixed;top: 30px;left: 30px;width:800px;">
	<table style="width:70%;background-color: #ffffff;border-style: groove;"> 
	<tr><td style="text-align:center"> An error has occurred. Please return to the beggining.<br><br><br><br>
	<button type="button"  style="position: fixed;top: 60px;left: 250px;" onclick="location.href='index.php'" >Start again!</button>
	</td></tr>
	</table>
  </div>
  
  <?php			
			
			if (!isset($_SESSION['array_final'])) 
			{
		?>
				<script type="text/javascript">document.getElementById('page').style.visibility = 'hidden';</script>
				<script type="text/javascript">document.getElementById('error').style.visibility = 'visible';</script>
		<?php
			}
			else
			{
		?>     
			<script type="text/javascript">
			setTimeout(function(){ document.form.submit() },2500);
			</script>
		<?php
			}
		?>
   
   
		<form name="form" action="end.php" method="POST">
			<input style="visibility:hidden" name = "token" type="text" value="<?php echo $token ?>">
		</form>
		
		
		
		

	</body>
</html>
