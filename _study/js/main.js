function results() {
		console.log("1");
		var ans01 = $('input[name="metallic"]:checked').val();
		var ans02 = $('input[name="plastic"]:checked').val();		
		var ans03 = $('input[name="ceramic"]:checked').val();;
		var ans04 = $('input[name="fabric"]:checked').val();
		var ans05 = $('input[name="iridescent"]:checked').val();
		var ans06 = $('input[name="polished"]:checked').val();
		var ans07 = $('input[name="coated"]:checked').val();
		var ans08 = $('input[name="anisotropic"]:checked').val();
		var ans09 = $('input[name="glossy"]:checked').val();
		var ans10 = $('input[name="refsharp"]:checked').val();
		var ans11 = $('input[name="refstrng"]:checked').val();
		var ans12 = $('input[name="haze"]:checked').val();
		var ans13 = $('input[name="sheen"]:checked').val();
		var ans14 = $('input[name="flop"]:checked').val();
		var ans15 = $('input[name="rough"]:checked').val();
		var ans16 = $('input[name="colorful"]:checked').val();
		var ans17 = $('input[name="light"]:checked').val();

		

	    var counter = $('input[name="count"]').val();
	    var imagen = $('input[name="imagen"]').val();
		
		
		if (ans01 == undefined || ans02 == undefined  || ans03 == undefined || ans04 == undefined  || ans05 == undefined  || ans06 == undefined  || ans07 == undefined  || ans08 == undefined  || ans09 == undefined || ans10 == undefined  || ans11 == undefined  || ans12 == undefined || ans13 == undefined || ans14 == undefined || ans15 == undefined || ans16 == undefined || ans17 == undefined){
			alert("Please, make sure you filled all the fields");
		}else{
			counter++;
			$.ajax({
			  type: "POST",
			  url: "attributes_survey.php",
			  data: {img: counter, imagen: imagen, 
			  gender: sessionStorage.getItem('gender'), 
			  specify: sessionStorage.getItem('specify'),
			  age: sessionStorage.getItem('age'),
			  display: sessionStorage.getItem('display'),
			  CGExp: sessionStorage.getItem('CGExp'),
			  DesExp: sessionStorage.getItem('DesExp'),
			  ArtExp: sessionStorage.getItem('ArtExp'),
			  metallic: ans01, plastic: ans02, ceramic: ans03, fabric: ans04, iridescent: ans05, polished: ans06, coated: ans07, 
			  anisotropic: ans08, glossy: ans09, refsharp: ans10, refstrng: ans11, haze: ans12, sheen: ans13, flop: ans14, rough: ans15, colorful: ans16, light: ans17},
			  success: function(data)
			  {
		  		$('#count').val(counter);
		 		$("#output").html(data);
		 		//CHANGE THIS TO NIMGS -1 *******************************************************************
			//*******************************************************************
		 		if (counter >4){
					
		 			window.location.href = "insertion.php";
		 		}
			  }
			});
		}

		
	}
 
 