$(function()
{ 
	 function buildCarousel(carouselData)
	 {
 
		contentCarousel = "";
		jsonData = carouselData;
		
		//<!-- Indicators -->
		contentCarousel =  '<ol class="carousel-indicators">';
		$.each(jsonData, function(i,item){
 		  
 		  	alert(i);
 		  	contentCarousel += '<li data-target="#hdCarousel" data-slide-to="'+i+'"></li>';
 		  	//"<b>" +item.postuser + "</b><br>" + item.post + "<br><img src='http://www.a-information.com/chatdawg/fups/"+item.postpictureID +"' class='img-responsive'><br><br>  "+" "+item.date+" &nbsp;&nbsp;&nbsp;&nbsp; <img src='png/glyphicons-499-sunglasses.png'>"+Math.floor((Math.random() * 10) + 1)+" &nbsp;&nbsp;&nbsp;&nbsp; <img src='png/glyphicons-344-thumbs-up.png'>  " +Math.floor((Math.random() * 10) + 1)+  "<img src='png/glyphicons-345-thumbs-down.png'>  "+Math.floor((Math.random() * 10) + 1)+" <hr>";
					
		});	
        
        contentCarousel += '</ol>';
         /*<!-- Indicators -->
		  <ol class="carousel-indicators">
		    <li data-target="#hdCarousel" data-slide-to="0" class="active"></li>
		    <li data-target="#hdCarousel" data-slide-to="1"></li>
		    <li data-target="#hdCarousel" data-slide-to="2"></li>
		    <li data-target="#hdCarousel" data-slide-to="3"></li>
		  </ol>*/
		
		  
		  //<!-- Wrapper for slides -->
		  contentCarousel += '<div class="carousel-inner" role="listbox">';
		  $.each(jsonData, function(i,item){
 		  	
 		  	if (i=0)
 		  		{
 		  			contentCarousel += '<div class="item active">'+
		      		'<img src="http://www.a-information.com/chatdawg/fups/'+item.postpictureID+'" class="img-responsive"> '+
		    		'</div>';
		    	}
		    	else
		    	{
		    		contentCarousel += '"<div class="item">'+
		      		'<img src="http://www.a-information.com/chatdawg/fups/'+item.postpictureID +'" class="img-responsive"> '+
		    		'</div>';
		    	}
		  	//"<b>" +item.postuser + "</b><br>" + item.post + "<br><img src='http://www.a-information.com/chatdawg/fups/"+item.postpictureID +"' class='img-responsive'><br><br>  "+" "+item.date+" &nbsp;&nbsp;&nbsp;&nbsp; <img src='png/glyphicons-499-sunglasses.png'>"+Math.floor((Math.random() * 10) + 1)+" &nbsp;&nbsp;&nbsp;&nbsp; <img src='png/glyphicons-344-thumbs-up.png'>  " +Math.floor((Math.random() * 10) + 1)+  "<img src='png/glyphicons-345-thumbs-down.png'>  "+Math.floor((Math.random() * 10) + 1)+" <hr>";
					
			});	
		  
		  	contentCarousel += '</div>"';
		  
		    /*--- Div Image model
		    <div class="item active">
		      <img src="img_chania.jpg" alt="Chania">
		    </div>
		
		    <div class="item">
		      <img src="img_chania2.jpg" alt="Chania">
		    </div>
		  </div> 
		  ---close image model*/
		
		contentCarousel += '<!-- Left and right controls -->'+
		  '<a class="left carousel-control" href="#hdCarousel" role="button" data-slide="prev">'+
		    '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>'+
		    '<span class="sr-only">Previous</span>'+
		  '</a>'+
		  '<a class="right carousel-control" href="#hdCarousel" role="button" data-slide="next">'+
		    '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>'+
		    '<span class="sr-only">Next</span>'+
		  '</a>';
		  return contentCarousel;
	}
});
