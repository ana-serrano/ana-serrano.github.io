<html>
	<head>
		<title> Survey </title>
		<link rel="stylesheet" type="text/css" href="css/surveycss.css" />
		<link rel="stylesheet" type="text/css" href="css/stylesheet-pure-css.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

	</head>
	<body>
	<div class="Intro">
	
	
			
			<h2>Thank you for taking the time to participate in our user study.</h2>
			<p>Please make sure to read the following instructions carefully before proceeding.<br></p>
			
			<h2>Why this test? Material Appearance</h2>
			<p>Material appearance is a hot topic in Computer Graphics, Design and Architecture, among other fields. 
			In this experiment we want to analyze how users perceive material appearance, that is, how does a material look 
			(e.g. how much metallic-like does it look, or how bright it is).</p> 
			
			<h2>How does the test work?</h2>
			<p>We will show you an <font color="#ffe7ad">image of an object made up of a certain material</font>, 
			and we will provide you with a <font color="#ffe7ad">list of attributes</font> that may describe its visual appearance 
			(e.g., bright, metallic-like, with strong reflections, ...).  
			For each attribute you will have to <font color="#ffe7ad">respond whether this attribute applies to the material or not (yes/no).</font> 
			Please note that while some materials that you will rate are very
			similar between them, all materials that you will see are different.</p> 
			<p><font color="#ffe7ad">Before starting with the real test we will explain some of the attributes you will use and show you 
			some examples.</font>
			
			<h2>Technicalities </h2>
			<p> Firefox and Google Chrome are the preferred browsers. Other browsers should be avoided if possible. 
			Please note that javascript should be enabled for the survey to work correctly.</p>
			
			<h2>Final (important) remarks</h2>
			<p>You must complete the survey until the end.
			Please <font color="#ffe7ad">do not refresh the browser nor click back</font> while in the middle of the survey!
			If you do so, you will have to start over.</p>
			
			<h2>Consent for participation on the study</h2>
			<input type="checkbox" id="consent" name="consent" value="consent"> &nbsp;
			I agree to participate in the research study. I understand the purpose and nature of this study and I am participating voluntarily. 
			I understand that I can withdraw from the study at any time, without any penalty or consequences. I grant permission for the data generated 
			from this questionnaire to be used in the researcher's publications on this topic. The generated data will be stored anonymously under a randomly 
			generated unique ID. Any information that is obtained in connection with this study and that may be identified with you will remain 
			confidential and will be disclosed only with your permission.
			
			
					
			<p><button type="button" style="left:40%" onclick="consent()">Proceed to examples</button>
			</p>
			<p><center><a style="color:#d1f5ff;text-decoration:none" href="https://imprint.mpi-klsb.mpg.de/inf/material-study.mpi-inf.mpg.de" target="_blank">Imprint</a><br>
			<a style="color:#d1f5ff;text-decoration:none" href="https://data-protection.mpi-klsb.mpg.de/inf/material-study.mpi-inf.mpg.de?lang=en" target="_blank">Data protection</a></center></p>
			
			
	
	</div>
	</body>
	
</html>

<script type="text/javascript">
	function consent() 
	{
		const checkbox = document.getElementsByName('consent');
		
		if ($('#consent').prop('checked')==true)
		{
			location.href='explanation.php';

		}
		else{
			alert("Please, accept the consent for participation before proceeding.");
		}
		
	}


	
</script>

