<?php
		session_save_path('./sessions');   
		session_start();
?>

<html>
	<head>
    <title> Survey </title>
		<link rel="stylesheet" type="text/css" href="css/style-tinybox.css" />
		<link rel="stylesheet" type="text/css" href="css/surveycss.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.0.min.js"></script>
		<script type="text/javascript" src="js/tinybox.js"></script>
		<script type="text/javascript" src="js/jquery.tooltipster.min.js"></script>	
  </head>
<body>

	<div class="Intro">
		
		
		<h2>Important remarks</h2>
		<p> * Even if in some case some images appear to be the same, please <b style="color:#ffe7ad">complete the test until the end.</b> </p>
		<p> * When the test is completed, you will be redirected to an finish page with the sign "Done!".
		Please, <b style="color:#ffe7ad"> make sure you click the submit button after the last image</b> and wait for the final page 
		to appear.        
		<p> * From now on, <b style="color:#ffe7ad">descriptions will be only available when you hover your mouse over the bubble icon &nbsp <img src="icon/bubble-icon.png" height="15">&nbsp next to the attribute</b>. Please, remember to use this feature to show a description of the attributes meaning, so that you know what they refer to before answering.</p>
		
		<p> &nbsp </p>
		<p>Before begining the study, we will collect some demographic information:</p>
		
		<div>
			<table style="color:#ffffff;text-align:left">
				<tr>
					<th>Gender:</th>
					<th style="padding-left:10px"><select name="gender" id="gender">
						<option value="-1">Choose an option</option>
						<option value="male">Male</option>
						<option value="female">Female</option>
						<option value="other">Other (specify)</option>
						<option value="NA">Prefer not to answer</option>
				   </select></th>
			   </tr>
			   
			   <tr style="display:none" id="tr-specify">
				   <th>Specify: </th>
				   <th style="padding-left:10px;"><input type="text" id="specify"></th>
			   </tr>
			   
			   <tr>
				   <th>Age: </th>
				   <th style="padding-left:10px"><input type="number" id="age" name="age" min="0" max="120"></th>
			   </tr>
			   
			   <tr>
					<th>Display you are using for this study:</th> 
					<th style="padding-left:10px"><select name="display" id="display">
					    <option value="-1">Choose an option</option>
						<option value="computer">Computer</option>
						<option value="tablet">Tablet</option>
						<option value="smartphone">Smartphone</option>
				   </select></th>
			   </tr>
			   
			   <tr>
					<th>Knowledge of Computer Graphics:</th> 
					<th style="padding-left:10px"><select name="CGExp" id="CGExp">
						<option value="-1">Choose an option</option>
						<option value="none">None</option>
						<option value="basic">Basic</option>
						<option value="intermediate">Intermediate</option>
						<option value="professional">Professional</option>
				   </select></th>
			   </tr>
			   
			   <tr>
					<th>Experience with design or modeling software:</th> 
					<th style="padding-left:10px"><select name="DesExp" id="DesExp">
						<option value="-1">Choose an option</option>
						<option value="none">None</option>
						<option value="basic">Basic</option>
						<option value="intermediate">Intermediate</option>
						<option value="professional">Professional</option>
				   </select></th>
			   </tr>
			   
			   <tr>
				   <th>Artistic experience or knowledge:</th> 
					<th style="padding-left:10px"><select name="ArtExp" id="ArtExp">
					    <option value="-1">Choose an option</option>
						<option value="none">None</option>
						<option value="basic">Basic</option>
						<option value="intermediate">Intermediate</option>
						<option value="professional">Professional</option>
				   </select></th>
			   </tr>
		   
		   </table>
		</div>
	   
		
		<p> &nbsp </p>
		<p><center>That's it, you're good to go! Press <i><b>Start!</b></i> to begin the survey.</center></p>
		
			<button type="button" style="left:45%"onclick="load_test();"><b>Start!</b></button>


	</div>

</body>		
</html>

<script type="text/javascript">

$('#gender').on('change', function() { 
    if ($(this).val() == 'other')
        $('#tr-specify').show();
	else
	{
		$('#specify').val('');
		$('#tr-specify').hide();	

	}
});

function load_test()
{
	if ($('#gender').val()=="-1" 
	   || ( ($('#gender').val()=="other") && ($('#specify').val()=="") ) 
	   || $('#age').val()=="" 
	   || $('#display').val()=="-1" 
	   || $('#CGExp').val()=="-1" 
	   || $('#DesExp').val()=="-1"  
	   || $('#ArtExp').val()=="-1" )
			{alert("Please, fill all the fields")}
	else{
		sessionStorage.setItem('gender', $('#gender').val());
		sessionStorage.setItem('specify',$('#specify').val());
		sessionStorage.setItem('age', $('#age').val());
		sessionStorage.setItem('display', $('#display').val());
		sessionStorage.setItem('CGExp', $('#CGExp').val());
		sessionStorage.setItem('DesExp',  $('#DesExp').val());
		sessionStorage.setItem('ArtExp', $('#ArtExp').val());
		<?php
			$filename = ('appearances/list_counts.json');
			$imgsdir = ('images/');
			//If it doesn't exist, create apparitions array to zeros 
			if(!file_exists ($filename ))
			{
				//$list = scandir($imgsdir);
				$list = preg_grep('~\.(png|jpg)$~', scandir($imgsdir));

				$apps = array();
				foreach ($list as $i)
				{   if($i != "yellow-paint.png")
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
			
			$min_val = min($data);
			$Nimgs = 3;
			$list = array();
			
			do
			{
				$minim = preg_replace( "/\r|\n/", "", array_keys($data, $min_val));
				if ((count($minim)+count($list)) >= $Nimgs)
				{
					$indices = array_rand($minim,$Nimgs);
					for ($i=0;$i<count($indices);$i++)
					{
						array_push($list,$minim[$indices[$i]]); 
					}
				}
				else
				{
					$list = array_merge($list,$minim);
				}	
				$min_val = $min_val+1;			
			}
			while(count($list) < $Nimgs);
				
			for ($i=0;$i<count($list);$i++)
			{
				$data[$list[$i]] = $data[$list[$i]]+ 1; 
			}
			//$data[$list] =$data[$list]+ 1; 
			
			ftruncate($fid,0);
			rewind($fid);
			fwrite($fid,json_encode($data));
			flock($fid,LOCK_UN);
			fclose($fid);		
			
		   //Push control images and shuffle order
			array_push($list, "yellow-paint.png");
			array_push($list, "yellow-paint.png");
			shuffle($list);

			$_SESSION['array_images'] = $list;
			$_SESSION['array_final'] =  array();
		?>
		location.href='attributes_survey.php'
	}
}
window.onload = function() {
	var width = 300;
    var height = 150;
	var top = 100
	var html = "<h2> <center>Great!</h2><p>You have completed the training examples. From now on it’s the real deal. Before you start, some important remarks.</p><p><b>Click outside this box to continue to the last remarks.</b></p>"
	var animate 
	var opacity = 30
	TINY.box.show({html:html,width:width,height:height,opacity:opacity,animate:true,close:false,top:top});
};
</script>