var perfilExpandido = false;
var perfilExpandidoMobile = false;

var globalColor = "";



//EL DOCUMENTO ESTA LISTO
$( document ).ready(function() {
	
    console.log( "listo!" );
		
	
});

function setProfileColor(color)
{
	globalColor = color;
	
	$("#menu_bar,#selected_tab").css("background-color",color);
	
		$("#info_extra_perfil_mobile").css("background-color",color);


	
	$("#perfil_mobile").css("background-color",color);
	
	
	
	
}

//EL DOCUMENTO HIZO SCROLL
$( window ).scroll(function() {
	
	scrollAdjustPerfil();
	
});


// LA VENTANA HA CAMBIADO DE TAMANO
$(window).resize(function(){
		
   	generateSmartPane(id);
	
	
});


function expandirPerfil() {
	"use strict";
	
	if (perfilExpandido)
	{
		 $("#info_extra_perfil").animate({ height: "0px" }, "slow" );

		
	}
	else{	
		
		document.getElementById("info_extra_perfil").setAttribute('style', 'height:auto');
		
		var calcH = document.getElementById("info_extra_perfil").clientHeight;
				
			document.getElementById("info_extra_perfil").setAttribute('style', 'height:0px');

		
  		$("#info_extra_perfil").animate({ height: calcH  }, "slow" );

		
	}
	
	perfilExpandido = !perfilExpandido;

	
	
}

function expandirPerfilMobile() {
	"use strict";
	
	if (perfilExpandidoMobile)
	{
		 $("#info_extra_perfil_mobile").animate({ height: "0px" }, "slow" );

		
	}
	else{	
		

		document.getElementById("info_extra_perfil_mobile").setAttribute('style', 'height:auto');
		
		var calcH = document.getElementById("info_extra_perfil_mobile").clientHeight;
				
			document.getElementById("info_extra_perfil_mobile").setAttribute('style', 'height:0px');
		
					$("#info_extra_perfil_mobile").css("background-color",globalColor);


		
  		$("#info_extra_perfil_mobile").animate({ height: calcH  }, "slow" ,"swing", function() {
			
    	$("#info_extra_perfil_mobile").css("height", "auto");

			
  });

		
		
	}
	
	perfilExpandidoMobile = !perfilExpandidoMobile;

	
	
}

											   
function scrollAdjustPerfil() {
	

		var scrollTop = $(window).scrollTop();

		scrollTop = Math.min(Math.max(-45,scrollTop),75);

		$("#perfil_mobile").height(120-scrollTop);


	//___

		var squareSize = 80-(scrollTop*0.6);

		$(".foto_perfil_container_mobile").css("height",(squareSize)+"px");
		$(".foto_perfil_container_mobile").css("width",(squareSize)+"px");
		var border = 2;
		$(".foto_perfil_container_mobile").css("border-radius",Math.max((squareSize+border),0)+"px");

		var calcFontSize = 16-(scrollTop*(20/80));
		var calcOpacity = 1-(scrollTop*(3/80));

	//____

		$("#profile_mobile_table #direccion_perfil").css("opacity",Math.max(calcOpacity,0));

		$("#profile_mobile_table #direccion_perfil").css("height",Math.max(calcFontSize,0));

		$("#profile_mobile_table #direccion_perfil").css("font-size",Math.max(calcFontSize,0));


		if (calcFontSize<=0)
		{
			$("#profile_mobile_table #direccion_perfil").css("display","none");

		}
		else{
			$("#profile_mobile_table #direccion_perfil").css("display","block");

		}

		//____

		calcFontSize = 25-(scrollTop*(8/80));

		$("#profile_mobile_table #nombre_perfil").css("font-size",Math.max(calcFontSize,0));

	
	//__
		var calcBadgePositionY = 115-(scrollTop);
		var calcBadgePositionX = 67-(scrollTop*(30/80));

		var calcBadgeOpacity = 1-(scrollTop*(3/80));


		$("#profile_mobile_table .badge").css("opacity",Math.max(calcOpacity,0));

		$("#profile_mobile_table .badge").css("top",Math.max(calcBadgePositionY,0));
	
	$("#profile_mobile_table .badge").css("left",Math.max(calcBadgePositionX,0));




		//_____


		var calcWidth = 160-(scrollTop*(110/80));

		calcWidth = Math.min(calcWidth,110);
	
		$("#controlled_td").css("width",Math.max(calcWidth,0));


		//___

		var calcShadow = 160-(scrollTop*(110/80));

		calcWidth = Math.min(calcWidth,110);
	
		$("#controlled_td").css("width",Math.max(calcWidth,0));
		
		
	
}



