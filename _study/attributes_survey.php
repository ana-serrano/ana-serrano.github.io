<?php  
session_save_path('./sessions');   
session_start();
?>


<html>
	<head>
		<title> Survey </title>
		<link rel="stylesheet" type="text/css" href="css/surveycss.css" />
		<link rel="stylesheet" type="text/css" href="css/stylesheet-pure-css.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.0.min.js"></script>
		<script type="text/javascript" src="js/jquery.tooltipster.min.js"></script>
		<script type="text/javascript" src="js/main.js"></script>
		<script type="text/javascript" src="js/progressbar.js"></script>
		<script>
		$(document).ready(function() {
             $('.tooltip').tooltipster({
                 contentAsHTML: true,
                 interactive: true,
                hideOnClick: true
             });
         });
		</script>
	
		
	</head>
	<body id="output">
	
		<div class="Experiment">
			<?php

				$array_images = $_SESSION['array_images'];
				$count = isset($_POST['img']) ? $_POST['img'] : 0;
				$imagen = $array_images[$count]; 
			?>
			<input type="text" name="count" style="visibility:hidden;" id="count" value=<?php echo $count ?>>
			<input type="text" name="imagen" style="visibility:hidden;" id="imagen" value=<?php echo $imagen ?>>

			<?php 
				$resultados = $_SESSION['array_final'];
				if ($_SERVER['REQUEST_METHOD'] === 'POST') {
					$resultados[$_POST['img']] = array( 
						'image' => $_POST['imagen'],
						'answers' => array(
								'metallic' => $_POST['metallic'],
								'plastic' => $_POST['plastic'],								 
								'ceramic'=> $_POST['ceramic'],
								'fabric' => $_POST['fabric'], 
								'iridescent'=> $_POST['iridescent'],
								'polished'=> $_POST['polished'],
								'coated'=> $_POST['coated'],
								'anisotropic'=> $_POST['anisotropic'],
								'glossy' => $_POST['glossy'], 
								'refsharp' => $_POST['refsharp'],
								'refstrng' => $_POST['refstrng'],
								'haze' => $_POST['haze'],
								'sheen' => $_POST['sheen'], 
								'flop' => $_POST['flop'],
								'rough' => $_POST['rough'],
								'colorful' => $_POST['colorful'], 
								'light' => $_POST['light'],
							)

						);
					$_SESSION['array_final'] = $resultados;
					
					$_SESSION['gender'] = $_POST['gender'];
					$_SESSION['specify'] = $_POST['specify'];
					$_SESSION['age'] = $_POST['age'];
					$_SESSION['display'] = $_POST['display'];
					$_SESSION['CGExp'] = $_POST['CGExp'];
					$_SESSION['DesExp'] = $_POST['DesExp'];
					$_SESSION['ArtExp'] = $_POST['ArtExp'];
                
				
				}
			?>					

			<form method="POST">
			<div id="page" style="visibility:visible;">
			
			
			
			
       <center><i><b><font style='font-size:18;color:#ffe7ad;'>Please, remember you can hover your mouse over the bubble 
	   icon &nbsp <img src="icon/bubble-icon.png" height="15"> &nbsp next to the attributes to see their descriptions.</font></b></i></center>
			<table>
			<tr><td>&nbsp; </td></tr>
				<tr>
					<td>
						<img src="<?php echo './images/'.$imagen ?>" height="400px" width="400px">					
					</td>
						
					<td style="vertical-align:top;width:550px">
						<table class="real-text">	 							
							<tr style="text-align:center;vertical-align:bottom">
								<th style="padding-top:20px"></th> 
								<th>Low-level descriptors</th>
								<th>No</th>								
								<th>Yes</th>
							</tr>					
							
						
							<tr style="text-align: center;vertical-align:middle">
								<td><span class="tooltip" title="Does the surface look overall glossy (lustrous)?"> 
								<img src="icon/bubble-icon.png" height="15"> &nbsp </span>		
								<td style="padding-right:200px;padding-top:3px;text-align:left;border-bottom:1pt dotted #999999;border-top:1pt dotted #999999;">Glossy</td>
								<td class="td-test" style="padding-top: 3px;border-top:1pt dotted #999999;"><input type="radio" name="glossy" value="0"><label><span><span></span></span> </label></td>								
								<td class="td-test" style="padding-top: 3px;border-top:1pt dotted #999999;"><input type="radio" name="glossy" value="1"><label><span><span></span></span> </label></td>
							</tr>	
							<tr style="text-align: center;vertical-align:middle">
								<td><span class="tooltip" title="Do reflections in the surface look very sharp (well defined contours)?"> 
								<img src="icon/bubble-icon.png" height="15"> &nbsp </span>		
								<td class="td-test-att"><label>Sharp reflections</td>
								<td class="td-test"><input type="radio" name="refsharp" value="0"><label><span><span></span></span> </label></td>								
								<td class="td-test"><input type="radio" name="refsharp" value="1"><label><span><span></span></span> </label></td>
							</tr>	
							<tr style="text-align: center;vertical-align:middle">
								<td><span class="tooltip" title="Are reflections in the surface strong (very visible)? If they are very strong, you should be able to see the surroundings reflected in the surface of the object."> 
								<img src="icon/bubble-icon.png" height="15">&nbsp </span>	
								<td class="td-test-att"><label>Strong reflections</td>
								<td class="td-test"><input type="radio" name="refstrng" value="0"><label><span><span></span></span> </label></td>								
								<td class="td-test"><input type="radio" name="refstrng" value="1"><label><span><span></span></span> </label></td>
							</tr>	
							<tr style="text-align: center;vertical-align:middle">
								<td><span class="tooltip" title="Do the regions around the reflections look cloudy or blurry?"> 
								<img src="icon/bubble-icon.png" height="15">&nbsp </span>	
								<td class="td-test-att"><label>Has reflection haze</td>
								<td class="td-test"><input type="radio" name="haze" value="0"><label><span><span></span></span> </label></td>								
								<td class="td-test"><input type="radio" name="haze" value="1"><label><span><span></span></span> </label></td>
							</tr>	
							<tr style="text-align: center;vertical-align:middle">
								<td><span class="tooltip" title="Does it show reflections at grazing angles (surfaces almost parallel to the line of sight)?"> 
								<img src="icon/bubble-icon.png" height="15">&nbsp </span>	
								<td class="td-test-att"><label>Has sheen (at grazing angles)</td>
								<td class="td-test"><input type="radio" name="sheen" value="0"><label><span><span></span></span> </label></td>								
								<td class="td-test"><input type="radio" name="sheen" value="1"><label><span><span></span></span> </label></td>
							</tr>	
							<tr style="text-align: center;vertical-align:middle">
								<td><span class="tooltip" title="Flop shows as a bright color near the more reflecting regions falling off to a dark color far away from those regions.">
								<img src="icon/bubble-icon.png" height="15">&nbsp </span>	
								<td class="td-test-att"><label>Strong flop (color contrast)</td>
								<td class="td-test"><input type="radio" name="flop" value="0"><label><span><span></span></span> </label></td>
								<td class="td-test"><input type="radio" name="flop" value="1"><label><span><span></span></span> </label></td>
							</tr>
							<tr style="text-align: center;vertical-align:middle">
								<td><span class="tooltip" title="Roughness causes light to be reflected in different directions within a small area thus causing fuzzy reflections. Something with very little roughness would have a mirror-like appearance."> 
								<img src="icon/bubble-icon.png" height="15">&nbsp </span>	
								<td class="td-test-att"><label>Rough</td>
								<td class="td-test"><input type="radio" name="rough" value="0"><label><span><span></span></span> </label></td>
								<td class="td-test"><input type="radio" name="rough" value="1"><label><span><span></span></span> </label></td>
							</tr>							
							<tr style="text-align: center;vertical-align:middle">
								<td><span class="tooltip" title="Does the surface look colorful (color saturated)?"> 
								<img src="icon/bubble-icon.png" height="15">&nbsp </span>	
								<td class="td-test-att"><label>Colorful</td>
								<td class="td-test"><input type="radio" name="colorful" value="0"><label><span><span></span></span> </label></td>
								<td class="td-test"><input type="radio" name="colorful" value="1"><label><span><span></span></span> </label></td>
							</tr>	
							<tr style="text-align: center;vertical-align:middle">
								<td><span class="tooltip" title="Does the surface look light (bright, luminous, reflecting a lot of light)?"> 
								<img src="icon/bubble-icon.png" height="15">&nbsp </span>	
								<td class="td-test-att"><label>Light</td>
								<td class="td-test"><input type="radio" name="light" value="0"><label><span><span></span></span> </label></td>
								<td class="td-test"><input type="radio" name="light" value="1"><label><span><span></span></span> </label></td>
							</tr>	
							
							<tr>
								<td colspan="3">&nbsp;</td>
							</tr>
							
							<tr style="text-align:center;vertical-align:bottom">
								<th style="padding-top:20px"></th> 
								<th>High-level descriptors</th>
								<th></th>								
								<th></th>
							</tr>
							
							<tr style="text-align: center;vertical-align:middle">
								<td><span class="tooltip" title="Does it look like a metal? &lt;a href='./examples/metallic.jpg' target='_blank'&gt;Check this link to see a metallic sphere sample.&lt;/a&gt;"> 
								<img src="icon/bubble-icon.png" height="15"> &nbsp </span>		
								<td style="padding-right:200px;padding-top:3px;text-align:left;border-bottom:1pt dotted #999999;border-top:1pt dotted #999999;">Metallic-like</td>
								<td class="td-test" style="padding-top: 3px;border-top:1pt dotted #999999;"><input type="radio" name="metallic" value="0"><label><span><span></span></span> </label></td>								
								<td class="td-test" style="padding-top: 3px;border-top:1pt dotted #999999;"><input type="radio" name="metallic" value="1"><label><span><span></span></span> </label></td>
							</tr>	
							<tr style="text-align: center;vertical-align:middle">
								<td><span class="tooltip" title="Does it look like plastic? &lt;a href='./examples/plastic.jpg' target='_blank'&gt;Check this link to see plastic samples.&lt;/a&gt;"> 
								<img src="icon/bubble-icon.png" height="15">&nbsp </span>	
								<td class="td-test-att"><label>Plastic-like</td>
								<td class="td-test"><input type="radio" name="plastic" value="0"><label><span><span></span></span> </label></td>
								<td class="td-test"><input type="radio" name="plastic" value="1"><label><span><span></span></span> </label></td>
							</tr>	
							<!--<tr style="text-align: center;vertical-align:middle">
								<td><span class="tooltip" title="Does it look like acrylic? &lt;a href='./examples/acrylic.png' target='_blank'&gt;Check this link to see plastic samples.&lt;/a&gt;"> 
								<img src="icon/bubble-icon.png" height="15">&nbsp </span>	
								<td class="td-test-att"><label>Acrylic-like</td>
								<td class="td-test"><input type="radio" name="acrylic" value="0"><label><span><span></span></span> </label></td>
								<td class="td-test"><input type="radio" name="acrylic" value="1"><label><span><span></span></span> </label></td>
							</tr>-->	
							<tr style="text-align: center;vertical-align:middle;">
								<td><span class="tooltip" title="Does it look like ceramic? &lt;a href='./examples/ceramic.jpg' target='_blank'&gt;Check this link to see a ceramic sample.&lt;/a&gt;"> 
								<img src="icon/bubble-icon.png" height="15">&nbsp </span>	
								<td class="td-test-att"><label>Ceramic-like</td>
								<td class="td-test"><input type="radio" name="ceramic" value="0"><label><span><span></span></span> </label></td>
								<td class="td-test"><input type="radio" name="ceramic" value="1"><label><span><span></span></span> </label></td>
							</tr>	
							<tr style="text-align: center;vertical-align:middle;">
								<td><span class="tooltip" title="Does it look like fabric? Fabric refers to any material made through weaving, knitting, spreading, crocheting, or bonding. &lt;a href='./examples/fabric.jpg' target='_blank'&gt;Check this link to see fabric samples.&lt;/a&gt;"> 
								<img src="icon/bubble-icon.png" height="15">&nbsp </span>	
								<td class="td-test-att"><label>Fabric-like</td>
								<td class="td-test"><input type="radio" name="fabric" value="0"><label><span><span></span></span> </label></td>
								<td class="td-test"><input type="radio" name="fabric" value="1"><label><span><span></span></span> </label></td>
							</tr>								
							<tr style="text-align: center;vertical-align:middle;">
								<td><span class="tooltip" title="Does it show luminous colours that seem to change when seen from different angles? &lt;a href='./examples/iridescent.jpg' target='_blank'&gt;Check this link to see an iridescent sample.&lt;/a&gt;"> 
								<img src="icon/bubble-icon.png" height="15">&nbsp </span>	
								<td class="td-test-att"><label>Iridescent</td>
								<td class="td-test"><input type="radio" name="iridescent" value="0"><label><span><span></span></span> </label></td>
								<td class="td-test"><input type="radio" name="iridescent" value="1"><label><span><span></span></span> </label></td>
							</tr>	
							<tr style="text-align: center;vertical-align:middle;">
								<td><span class="tooltip" title="Does the surface look polished? &lt;a href='./examples/polished.jpg' target='_blank'&gt;Check this link to see a polished sample.&lt;/a&gt;"> 
								<img src="icon/bubble-icon.png" height="15">&nbsp </span>	
								<td class="td-test-att"><label>Polished</td>
								<td class="td-test"><input type="radio" name="polished" value="0"><label><span><span></span></span> </label></td>
								<td class="td-test"><input type="radio" name="polished" value="1"><label><span><span></span></span> </label></td>
							</tr>	
							<tr style="text-align: center;vertical-align:middle;">
								<td><span class="tooltip" title="Does the surface look like it has a coating on top of it? &lt;a href='./examples/coated.jpg' target='_blank'&gt;Check this link to see a coated sample.&lt;/a&gt;"> 
								<img src="icon/bubble-icon.png" height="15">&nbsp </span>	
								<td class="td-test-att"><label>Coated</td>
								<td class="td-test"><input type="radio" name="coated" value="0"><label><span><span></span></span> </label></td>
								<td class="td-test"><input type="radio" name="coated" value="1"><label><span><span></span></span> </label></td>
							</tr>	
							<tr style="text-align: center;vertical-align:middle;">
								<td><span class="tooltip" title="Does it show different light reflectance behavior at different angles of the surface? &lt;a href='./examples/anisotropic.jpg' target='_blank'&gt;Check this link to see an anisotropic sample.&lt;/a&gt;"> 
								<img src="icon/bubble-icon.png" height="15">&nbsp </span>	
								<td class="td-test-att"><label>Anisotropic</td>
								<td class="td-test"><input type="radio" name="anisotropic" value="0"><label><span><span></span></span> </label></td>
								<td class="td-test"><input type="radio" name="anisotropic" value="1"><label><span><span></span></span> </label></td>
							</tr>	
						</table>
					</td>
				</tr>
			</table>
			
				
				<div id="progressBar" class="tiny-green"><div></div></div>
				
				<script>	
				//CHANGE THIS TO NIMGS  *******************************************************************
				//*******************************************************************
				progressBar(Number(count.value) + 1,5, $('#progressBar'))				
				</script>
				
				<div>					
				<button type="button" style="margin-top:45px;left:47%" id="butt_submit" onclick="change_flag();javascript: results()">
				<!--CHANGE THIS TO NIMGS -1 *******************************************************************
		//*******************************************************************-->
					<?php $text_subm = $count < 4 ? "Next!" : "Submit your results!"; echo $text_subm; ?></button>
				<input type="text" style="visibility:hidden;" name="flag" id="flag" value="0">
				<!---->
				</div>
			
			</form>
		
	</div>
<div id="error" style="visibility:hidden; position: fixed;top: 30px;left: 30px;width:800px;">
	<table style="width:70%;background-color: #ffffff;border-style: groove;"> 
	<tr><td style="text-align:center"> An error has occurred. Please return to the beggining.<br><br><br><br>
	<button type="button"  style="position: fixed;top: 60px;left: 250px;" onclick="location.href='index.php'" >Start again!</button>
	</td></tr>
	</table>
</div>
	</body>
	</html>

		<?php
			
			
			if (!isset($_SESSION['array_images'])) 
			{
		?>
				<script type="text/javascript">document.getElementById('page').style.visibility = 'hidden';</script>
				<script type="text/javascript">document.getElementById('error').style.visibility = 'visible';</script>
		<?php
			}
		?>
		
 <script type="text/javascript">
	var cc = document.getElementById("count").value;
	if (cc=1)
	{
		document.getElementById("butt_submit").value = "Submit your results!";
	}
		
	function change_flag()
	{
		var f = document.getElementById("flag");
		f.value = "1";
	};

	window.onbeforeunload = function()
	{	
		var submit = document.getElementById("flag").value;
		var c = document.getElementById("count").value;
		//CHANGE THIS TO NIMGS  *******************************************************************
		//*******************************************************************
		if (submit==0 && c!=5)	
		{			
			$.ajax({
				type: 'POST',
				async: false,
				url: 'closePage.php',
			});
		}
		
	}		
 </script>
