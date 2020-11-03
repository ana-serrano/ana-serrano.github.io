<html>
	<head>
		<title> Survey </title>
		
		<link rel="stylesheet" type="text/css" href="css/stylesheet-pure-css.css" />
		<link rel="stylesheet" type="text/css" href="css/style-tinybox.css" />
		<link rel="stylesheet" type="text/css" href="css/surveycss.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.0.min.js"></script>
		<script type="text/javascript" src="js/tinybox.js"></script>
		<script type="text/javascript" src="js/jquery.tooltipster.min.js"></script>
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
<body >
	
	<div class="Experiment">	
			<div class="info">
			<p>Your screen will look like this one, except that you will have multiple questions instead of just one. 
			The questions we will ask you will refer to the <font color="#ffe7ad">visual appearance of the material shown in the image.</font> 
			We will ask you about different characteristics of it. In this case, the question refers to the <font color="#ffe7ad"><b><i>roughness</i></b></font> of the material. </p>
			
			<p><center><font color="#ffe7ad">A description of <b><i>roughness</i></b> is provided if you hover your mouse over the bubble icon &nbsp <img src="icon/bubble-icon.png" height="15"> &nbsp next to the attribute.</p>
			</center>
			</font>
			</div>
			
			<table>
				<tr>
					<td>
						<img src="training/rough_roughness_blue-metallic-paint.png" height="300px" width="300px">					
					</td>
						
					<td style="vertical-align:top;width:550px">
						<table class="Experiment-text">	
							
							<tr style="text-align:center;vertical-align:bottom">
								<th style="padding-top:20px"></th> 
								<th></th>
								<th>No</th>								
								<th>Yes</th>
							</tr>				
						
							<tr style="text-align: center;vertical-align:top">
								<td><span class="tooltip" title="Roughness causes light to be reflected in different directions within a small area thus causing fuzzy reflections. Something with very little roughness would have a mirror-like appearance."> 
								<img src="icon/bubble-icon.png" height="15"></span>		
								<td style="padding-right: 100px;padding-top:3px;text-align:left"><b>Rough</b></td>
								<td style="padding-top: 3px;vertical-align:middle;"><input type="radio" onclick="training()" name="roughness" value="0"><label><span><span></span></span> </label></td>
								<td style="padding-top: 3px;vertical-align:middle;"><input type="radio" onclick="training()" name="roughness" value="1"><label><span><span></span></span> </label></td>
							</tr>	
							
						</table>
					</td>
				</tr>
			</table>
			
			
		<div id="mssgs" style="width:750px;border:3px solid white;color:black;border-radius:0.7em;padding:10px">
			<span id="msg" style="visibility: hidden;"> Mensaje </span>
		</div>

			<button type="button"  id="but-cont" style="visibility: hidden;left:45%;" onclick="location.href='example2.php'" >Next example!</button>
			
	</div>

</body>
</html>

		

<script type="text/javascript">
	function training() {
		var radios = document.getElementsByName('roughness');
		var chosen;

		for (var i = 0, length = radios.length; i < length; i++) {
		    if (radios[i].checked) {
		        chosen = radios[i].value;
		        break;
		    }
		}

		if (chosen == 0){
			document.getElementById("mssgs").style.background = '#994d4d';
			document.getElementById("mssgs").style.visibility = 'visible';
			document.getElementById("msg").innerHTML = 'Are you sure? Please, check again and <b>revise your answer</b>. A rough material makes reflections appear fuzzy and not very sharp because within a small area, light gets reflected in multiple directions. Something not rough would look like a mirror. (If you are utterly convinced that this is your answer, just choose 4 or 5 to continue. Your results are not being stored yet.)';
			document.getElementById("msg").style.visibility = 'visible';
			document.getElementById("but-cont").style.visibility = 'hidden';
		}		
		else if (chosen == 1)
		{
			document.getElementById("mssgs").style.background = '#59985a';
			document.getElementById("mssgs").style.visibility = 'visible';
			document.getElementById("msg").innerHTML = 'Great! A rough material makes reflections appear fuzzy and not very sharp because within a small area, light gets reflected in multiple directions.  Something not rough would look like a mirror, but this one is not the case. <b> Proceed to the next one!</b>';
			document.getElementById("msg").style.visibility = 'visible';
			document.getElementById("but-cont").style.visibility = 'visible';

		}
		else{
			alert("Please, chose an option");
		}
	}

	
window.onload = function() {
	var width = 340;
    var height = 160;
	var top = 100
	var html = "<h2>Welcome!</h2><p>Before we begin with the actual test, we will show you explanations of some of the attributes so that you can get a feel of how the test will be like.</p> <p><b>Click outside this box to begin with the example.</b></p>"
	var animate 
	var opacity = 30
	TINY.box.show({html:html,width:width,height:height,opacity:opacity,animate:true,close:false,top:top});
};

	
</script>
