// hexagonalGraph.js

var polygon;
var arregloFinaldePuntosParaAnimar = [];
var stepIndex = 0;

var animationSpeed = 400;


function initPolygonalGraph(values,labels)
{
		
	
	color = globalColor;
	var s = Snap("#polygraph_surface");
	
	
	
	//CREACION DE BG
	var radius = 43;
	var angleDiference = 360/values.length; 
	
	var centerX = $("#polygraph_surface").width()/2;
	var centerY = $("#polygraph_surface").height()/2;
	
	var puntos = [];
	var puntosParaGuidelines = [];
	var ratePuntosParaGuidlines = 1.2;
	
	var puntosInit = [];
	
	var initValueRate = 0.05;
	
	var angle =210;
	
	for (var i = 0; i < values.length; i++) 
	{ 
		
		angle = angle + angleDiference;

		puntos.push(Math.floor( radius*Math.cos(angle* Math.PI / 180) + centerX ));
		
		puntos.push(Math.floor( radius*Math.sin(angle* Math.PI / 180) + centerY ));
		
		
		
		puntosParaGuidelines.push(Math.floor( radius*ratePuntosParaGuidlines*Math.cos(angle* Math.PI / 180) + centerX ));
		
		puntosParaGuidelines.push(Math.floor( radius*ratePuntosParaGuidlines*Math.sin(angle* Math.PI / 180) + centerY ));
		
		
		
		
		puntosInit.push(Math.floor( initValueRate*radius*Math.cos(angle* Math.PI / 180) + centerX ));
		
		puntosInit.push(Math.floor( initValueRate*radius*Math.sin(angle* Math.PI / 180) + centerY ));
		
	}

	
	var polygonBG = s.polygon(puntos);
	

	
	polygonBG.attr({
    fill: "#d0d0d0"
	});
	//___
	
	
	//_______
	
	
	var puntosValores = [];
	
	for (var i = 0; i < values.length; i++) 
	{ 
		
		angle = angle + angleDiference;

		
		puntosValores.push(Math.floor( radius*(values[i]/10)*Math.cos(angle* Math.PI / 180) + centerX ));
		
		puntosValores.push(Math.floor( radius*(values[i]/10)*Math.sin(angle* Math.PI / 180) + centerY ));
		
				
	}

	
	var puntosAnimacion = [];
	
	
	for (var i = 0; i < values.length; i++)
	{
		
		j = i * 2;	
		
		puntosAnimacion.push(puntosValores[j]);
		puntosAnimacion.push(puntosValores[j+1]);
		
		var trim = puntosInit.slice((j+2),puntosInit.length);
		
		
		
		
		var puntosAnimacionFinal = puntosAnimacion.concat(trim);

		puntosAnimacionFinal = puntosAnimacionFinal.slice(0,(values.length*2));
		
			
		arregloFinaldePuntosParaAnimar.push(puntosAnimacionFinal);
		

		
	}
	
	for (var i = 0; i < puntosParaGuidelines.length/2; i++)
	{
		
		var symetricLen = Math.floor(puntosParaGuidelines.length /2);
		
		j = i*2;
		
		var toX = puntosParaGuidelines[j];
		var toY = puntosParaGuidelines[j+1];
		
		var guideLines = s.line(centerX,centerY,toX,toY);

		var spacing = 6;
		var text = s.text((toX),(toY),labels[i]);
		
		text.attr({
			
			"font-family": "RobotoCondensed Light",
			"font-size": "11px"
		});
		
		
		var textBB = text.getBBox();
		
		
		text.remove();
		
	
		var x= toX;
		var y= toY;
		
		if (textBB.x < centerX)
		{
			
			x= x-textBB.w-spacing; 
			
		}
		else if (textBB.x == centerX)
		{
			x = x - (textBB.w/2);
			if (toY > centerY)
			{
				y += spacing;
			}
			else
			{
				y-= spacing;
			}
			
		}
		else
		{
			x = x + spacing;
		}
		
		if (textBB.y > centerY)
		{
			y = y+textBB.h;
		}
		else
		{
			y = y -spacing;
			
		}
			
		
		text = s.text(x,y,labels[i]);
		
		text.attr({
			
			"font-family": "RobotoCondensed Light",
			"font-size": "13px",
			fill: "#525252"
			
		});
		

		guideLines.attr({
			
		stroke: "#9b9b9b",
		strokeWidth: 1

		});
		
		
		
		
	}
	
	
	polygon = s.polygon(puntosInit);
	
	polygon.attr({
		
		stroke: color,
		strokeWidth: 1,
		fill:  color,
		opacity: 0.6
		
	});
	
	
	
	for (var i = 0; i < arregloFinaldePuntosParaAnimar.length; i++)
	{
		


		setTimeout(function(){
			
			stepAnimation();

			
		}, (500+(animationSpeed/2)*i));
		
		
	}
	
	
	//___ CREA EL CENTRO 
	
	var centerCircle = s.circle(centerX,centerY,3);
	
	centerCircle.attr({
		
		fill: "#525252",
		stroke: color

	});
	
	
}


function stepAnimation()
{
	
	polygon.animate({"points":arregloFinaldePuntosParaAnimar[stepIndex]},animationSpeed,mina.bounce);
	
	stepIndex++;
}
