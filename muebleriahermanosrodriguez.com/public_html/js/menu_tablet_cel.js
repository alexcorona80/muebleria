var control = 0;
  $(document).ready(function(){
	  $("#boton").on("click", function(){
		  if(control == 0){
			  $("#pagina").animate({
				  marginLeft: "-200px"
				});
				control++;
				}else{ 
				$("#pagina").animate({
				  marginLeft: "0"
				});
				control--;
				}
				});
				});	