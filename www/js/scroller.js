


	lastAddedLiveFunc();
     var userid = "94";
 
 	function lastAddedLiveFunc() {
		      $('div#lastPostsLoader').html('<img src="png/bigLoader.gif"/>');
 
		$.ajax({
    type: "POST",
    url: "http://www.a-information.com/chatdawg/partyposts.php",
    // The key needs to match your method's input parameter (case-sensitive).
    data: {'userid': userid },
    success: function(data){
    var parsed_data = $.parseJSON(data);
    $.each(parsed_data, function(index, element) {
      var content = "<br><hr5> "+element.username+"<br><hr5> "+element.post+"</hr5><br><img src='http://www.a-information.com/chatdawg/fups/"+element.postpictureID+"'/><a href=\"\" onClick=\"voteClick('"+element.k1+"','"+userid+"','s');\">Smile: <div id=\"smile\"></div></a>("+element.smile+") Frown("+element.frown+") Sad("+element.sad+") "+element.date+"<br>";
      $(".items").append(content);
      $('div#lastPostsLoader').empty();
    });
    },
    failure: function(errMsg) {
        
    }
	});
        }
 
 
    //lastAddedLiveFunc();
    $(window).scroll(function(){
 
        var wintop = $(window).scrollTop(), docheight = $(document).height(), winheight = $(window).height();
        var  scrolltrigger = 0.95;
 
        if  ((wintop/(docheight-winheight)) > scrolltrigger) {
         //console.log('scroll bottom');
         lastAddedLiveFunc();
        }
    });
    
    
    var Smilevalue=0;

function voteClick(postidv,useridv,votev) { 
	var count = 0;
		alert(postidv);
    $.ajax({
        url: "http://a-information.com/chatdawg/votehndlr.php",
        type: "POST",
        async: false,
        data: {postid:postidv,userid:useridv,vote:votev},
        dataType: "json",
        success : function(data){
        	alert(data.count);
        	count = data.count;
        	
        }
        ,
	    error : function(x, e) {
            if(x.status==0){
                alert('You are offline!!\n Please Check Your Network.');
            }else if(x.status==404){
                alert('Requested URL not found.');
            }else if(x.status==500){
                alert('Internel Server Error.');
            }else if(e=='parsererror'){
                alert('Error.\nParsing JSON Request failed.');
            }else if(e=='timeout'){
                alert('Request Time out.');
            }else {
                alert('Unknow Error.\n'+x.responseText);
            }
        }
		  
    });
}


   function capturePhoto() {
      // Take picture using device camera and retrieve image as base64-encoded string
      navigator.camera.getPicture(onPhotoDataSuccess, onFail, { quality: 50 });
    }

