

var globalColor = "";




//EL DOCUMENTO ESTA LISTO
$( document ).ready(function() {
	
	
	var canvaz1 = Snap("#one");
	
	var canvaz2 = Snap("#two");
	
	var canvaz3 = Snap("#three");

	
	var indicator1 = canvaz1.polygon(10,13,20,13,15,18,15,18);
	
	var indicator2 = canvaz2.polygon(10,13,20,13,15,18,15,18);

	var indicator3 = canvaz3.polygon(10,13,20,13,15,18,15,18);
	
	//indicator1.animate({"points" : [15,13,15,13,20,18,10,18] },2000, mina.easeinout);

	
	
$("#buscar_boton").click(function() 
{
	
		//window.location("http://www.ment.com.mx/buscar.php?texto="+"&filtro="+filtro);

	var text = $("#search_box").val();
	
	
	var filtro = $(".filtro_active").attr("value");
	
	
	window.location.replace("http://www.ment.com.mx/pc/buscar.php?texto="+text+"&filtro="+filtro);
	
});
	
	
	
$(".filtro_interes").click(function() {
	
	var texto = $(this).contents().eq(0).text();
	
	
	var filtro  = $(this).parent().prev();
	
	var indicator = $(filtro).find(".indicator");

	var descFiltro = $(filtro).find("span");
	
	
	
	if (texto.trim()=="Sin filtro") 
	{
		texto = $(descFiltro).attr("placeholder");
		
		
		$(filtro).attr("id","filtros_interes");


	}
	else
	{
		
		$(filtro).attr("id","filtros_interes_selected");
		
	}

	
	//console.log("ss"+  $(this).contents().eq(0).text());
	
	$(descFiltro).text(texto);

	
	$(".filtro_active").attr("value",$(this).attr("value"));
	
	var cosa = $(this).parent().prev();
	
	expandirFiltro(cosa.get(0));
	
	
});


});

function animateIndicator(indicator,onoff)
{
	
	
	if (onoff)
	{
	
	var canvaz = Snap($(indicator).get(0));
	
	canvaz.clear();
	
	var poly = canvaz.polygon(10,13,20,13,15,18,15,18);
	
	poly.animate({"points" : [15,13,15,13,20,18,10,18] },400, mina.easeinout);
	
	}
	else
	{
		
		var canvaz = Snap($(indicator).get(0));

		canvaz.clear();

		var poly = canvaz.polygon(15,13,15,13,20,18,10,18);

		poly.animate({"points" : [10,13,20,13,15,18,15,18] },400, mina.easeinout);
		
	}
		
	
}

function setProfileColor(color)
{
	globalColor = color;
		
	$("#menu_bar,#selected_tab").css("background-color",color);
	
	$("#foto_perfil_container_mobile,#foto_perfil_container").css("background-color",color);
	
	$("#progress,#inscribe_button").css("background-color",color);


	
	
	$("#perfil_mobile").css("background-color",color);
	
	
	
	
}

//EL DOCUMENTO HIZO SCROLL
$( window ).scroll(function() {
	
	scrollAdjustPerfil();
	
	
	
	
});
											   
function scrollAdjustPerfil() {
	

		var scrollTop = $(window).scrollTop();

		scrollTop = Math.min(Math.max(-45,scrollTop),75);

		$("#perfil_mobile").height(120-scrollTop);


	//___

		var squareSize = 80-(scrollTop*0.6);

		$("#foto_perfil_container_mobile").css("height",(squareSize)+"px");
		$("#foto_perfil_container_mobile").css("width",(squareSize)+"px");
		var border = 2;
		$("#foto_perfil_container_mobile").css("border-radius",Math.max((squareSize+border),0)+"px");

		var calcFontSize = 16-(scrollTop*(20/80));
		var calcOpacity = 1-(scrollTop*(3/80));

	//____

		$("#profile_mobile_table #direccion_perfil").css("opacity",Math.max(calcOpacity,0));

		$("#profile_mobile_table #direccion_perfil").css("height",Math.max(calcFontSize,0));

		$("#profile_mobile_table #direccion_perfil").css("font-size",Math.max(calcFontSize,0));
	
	
	$("#profile_mobile_table #estrellas_perfil").css("opacity",Math.max(calcOpacity,0));

		$("#profile_mobile_table #estrellas_perfil").css("height",Math.max(calcFontSize,0));

		$("#profile_mobile_table #estrellas_perfil").css("font-size",Math.max(calcFontSize,0));


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



		//_____


		var calcWidth = 160-(scrollTop*(110/80));

		calcWidth = Math.min(calcWidth,110);
	
		$("#controlled_td").css("width",Math.max(calcWidth,0));


		//___

		var calcShadow = 160-(scrollTop*(110/80));

		calcWidth = Math.min(calcWidth,110);
	
		$("#controlled_td").css("width",Math.max(calcWidth,0));
		
		
	
}



function expandirFiltro(parent)
{
	
	
	var divObj = $(parent).next();
	
	var indicator =   $(parent).find(".indicator");



	var expandido = (parent.getAttribute("expanded") == "true");

	//divObj.animate({ height: "100px" }, "slow" );

	
	//flechita.animate({"points" : [15,13,15,13,20,18,10,18] },2000, mina.easeinout);


	if (expandido)
	{
		
		
			animateIndicator(indicator,false);

		 
			//flechita.animate({"points" : [15,13,15,13,20,18,10,18] },2000, mina.easeinout);
		
			divObj.animate({ height: "0px" },"fast" );

			parent.setAttribute("expanded","false");
	}
	else{	
		
		
			animateIndicator(indicator,true);


		divObj.css("height","auto");
		
		var calcH = divObj.height();
				
		divObj.css("height","0px");
		
		//divObj.css("background-color",globalColor);

  		divObj.animate({ height: calcH  }, "fast" ,"swing",
		
		function() {
			
    	divObj.css("height", "auto");
			
			
		parent.setAttribute("expanded","true");

			
  	});

		
		
	}
	
	
	
	

}


