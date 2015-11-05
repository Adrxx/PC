var border = 4;
var id = "";

function generateSmartPane(divId)
{
	
	id = divId;
		
	
	var lienzo = document.getElementById(divId);
	
	var calculedHeight = Math.ceil(lienzo.clientWidth / 2);
	
	lienzo.setAttribute('style', 'height:'+calculedHeight+'px' );
	
	
	//___
	
	
	var lienzoH = lienzo.clientHeight;
	
	var lienzoW = lienzo.clientWidth;
	
	//console.log(lienzoH);
	
	calculedHeight = 0;
	
	var calculatedWidth = 0;
	
	var calculatedX = 0;
	var calculatedY = 0;
	
	//_____
	
	var f1 = document.getElementById("SPP1");
	 
	calculedHeight = lienzoH;
	
	calculedHeight -= border*2;
	
	calculatedY = border;
	
	calculatedX = border;
	
	
	calculatedWidth = (lienzoW * 0.63)-border*2
	
	f1.setAttribute('style', 'height:'+calculedHeight+'px;'+ 'width:'+calculatedWidth+'px;' + 'left:'+calculatedX+'px;' + 'top:'+calculatedY+'px;'   );
	
	
	
	calculedHeight = lienzoH*0.5 - (border);
	

	calculatedX = calculatedWidth + border*2;
	

	calculatedWidth = (lienzoW -calculatedWidth)- (border*3);

	
	
	var f2 = document.getElementById("SPP2");
	
	f2.setAttribute('style', 'height:'+calculedHeight+'px;'+ 'width:'+calculatedWidth+'px;' + 'left:'+calculatedX+'px;' + 'top:'+calculatedY+'px;'   );
	
	
	calculatedY=border*2;
	
	calculedHeight = calculedHeight - border;
		
	var f3 = document.getElementById("SPP3");
	
	f3.setAttribute('style', 'height:'+calculedHeight+'px;'+ 'width:'+calculatedWidth+'px;' + 'left:'+calculatedX+'px;'+ 'top:'+calculatedY+'px;'   )
	
	
	



}

