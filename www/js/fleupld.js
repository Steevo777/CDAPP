$(function()
{
	// Variable to store your files
	var files;
	var fileNameUni;
	
	// Add events
	$('input[type=file]').on('change', prepareUpload);
	$('#add_post_form').on('submit', resizeAndUpload);
	
	// Grab the files and set them to our variable
	function prepareUpload(event)
	{
		  files = event.target.files;
	}
	
	
	
	// Catch the form submit and upload the files
	function uploadFiles(event)
	{
	    event.stopPropagation(); // Stop stuff happening
	    event.preventDefault(); // Totally stop stuff happening
	
	    // Create a formdata object and add the files
	    var data = new FormData();
	    //var fileobj = compressImage(files[0], 35, "jpg");
	    resizeAndUpload(files[0]);
	    
	    
	    /*$.each(files, function(key, value)
	    {
	        data.append(key, value);
	    });
	    
	    $('#upload_progess').show();
	    $.ajax({
			  xhr: function() {
			    var xhr = new window.XMLHttpRequest();
			
			    xhr.upload.addEventListener("progress", function(evt) {
			      if (evt.lengthComputable) {
			        var percentComplete = evt.loaded / evt.total;
			        percentComplete = parseInt(percentComplete * 100);
			        if (percentComplete)
			        {
			        	$('.progress-bar').css('width', percentComplete+'%').attr('aria-valuenow', percentComplete);
			        	$('div#upload_file_progress_bar').html(percentComplete+'%');
			        	
				        if (percentComplete === 100) {
				        }
			      	}
			      }
			    }, false);
			
			    return xhr;
			  },
			  url: 'http://www.a-information.com/chatdawg/fleupld.php?files',
			  type: "POST",
			  data: data,
			  cache: false,
			  dataType: "json",
			  processData: false, // Don't process the files
	          contentType: false, // Set content type to false as jQuery will tell the server its a query string request
	      	  success: function(data, result) {
			    if(typeof data.error === 'undefined')
	            {
	                // Success so call function to process the form
	                //$('div#upload_spinner').empty();
	                submitForm(event, data);
	            }
	            else
	            {
	                // Handle errors here
	                console.log('ERRORS: ' + data.error);
	                //$('div#upload_spinner').empty();
	                //$('div#upload_spinner').html('<img src="png/errorloading.gif"/>');
	            }
			  }
		});*/
	
	    
	}
	
	function submitForm(event, data)
	{
	  // Create a jQuery object from the form
	  $form = $(event.target);
		
		// Serialize the form data
		var formData = $form.serialize();
		
		// You should sterilise the file names
		formData = formData + '&filename=' + fileNameUni;
		formData = formData + '&usid=' + store('usrid');
		formData = formData + '&username=' + store('usrvld');
	
	    $.ajax({
	        url: 'http://www.a-information.com/chatdawg/fleupld.php',
	        type: 'POST',
	        data: formData,
	        cache: false,
	        dataType: 'json',
	        success: function(data, textStatus, jqXHR)
	        {
	            if(typeof data.error === 'undefined')
	            {
	                // Success so call function to process the form
	                //alert('SUCCESS: ' + data.success);
	                alert('SUCCESS: ' + data.formData);
	                $('#upload_progess').hide();
	                close_all_divs();
	                
	                
	            }
	            else
	            {
	                // Handle errors here
	                console.log('ERRORS: ' + data.error);
	            }
	        },
	        error: function(jqXHR, textStatus, errorThrown)
	        {
	            // Handle errors here
	            console.log('ERRORS: ' + textStatus);
	        },
	        complete: function()
	        {
	         	// STOP LOADING SPINNER
            }
		});
	}
	
	
	/**
	* Receives an Image Object (can be JPG OR PNG) and returns a new Image Object compressed
	* @param {Image} source_img_obj The source Image Object
	* @param {Integer} quality The output quality of Image Object
	* @param {String} output format. Possible values are jpg and png
	* @return {Image} result_image_obj The compressed Image Object
	*/

    function compressImage(source_img_obj, quality, output_format){
             
 	    
             var mime_type = "image/jpeg";
             if(typeof output_format !== "undefined" && output_format=="png"){
                mime_type = "image/png";
             }
             
             var reader = new FileReader();
             var tempImg = new Image();
    		 tempImg.src = reader.result;
             
             var cvs = document.createElement('canvas');
             cvs.width = source_img_obj.naturalWidth;
             cvs.height = source_img_obj.naturalHeight;
             var ctx = cvs.getContext("2d").drawImage(source_img_obj, 0, 0);
             var newImageData = cvs.toDataURL(mime_type, quality/100);
             var result_image_obj = new Image();
             result_image_obj.src = newImageData;
             return result_image_obj;
    	
    }
	
	
	
	function resizeAndUpload(event) {
		
		event.stopPropagation(); // Stop stuff happening
	    event.preventDefault(); // Totally stop stuff happening
		
		
		alert ("Resize started");
		var data = new FormData();
	    $.each(files, function(key, value)
	    {
	        data.append(key, value);
	    });
		
		
		var reader = new FileReader();
	    reader.onloadend = function() {
	 
	    var tempImg = new Image();
	    tempImg.src = reader.result;
	    tempImg.onload = function() {
	 
	        var MAX_WIDTH = 1280;
	        var MAX_HEIGHT = 740;
	        var tempW = tempImg.width;
	        var tempH = tempImg.height;
	        if (tempW > tempH) {
	            if (tempW > MAX_WIDTH) {
	               tempH *= MAX_WIDTH / tempW;
	               tempW = MAX_WIDTH;
	            }
	        } else {
	            if (tempH > MAX_HEIGHT) {
	               tempW *= MAX_HEIGHT / tempH;
	               tempH = MAX_HEIGHT;
	            }
	        }
	 		alert ("Resize half way");
	        var canvas = document.createElement('canvas');
	        canvas.width = tempW;
	        canvas.height = tempH;
	        var ctx = canvas.getContext("2d");
	        ctx.drawImage(this, 0, 0, tempW, tempH);
	        var dataURL = canvas.toDataURL("image/jpeg");
	 
	 
	 		alert ("Resize completed transfer");
	        var xhr = new XMLHttpRequest();
	        xhr.onreadystatechange = function(ev){
	        		alert ("Onready");
	        		$('#upload_progess').show();
	        		alert('Upload Status '+xhr.status+'  ReadyState'+xhr.readyState);
	        		if (xhr.readyState==4 && xhr.status==200){
			        	console.log('xhr.readyState=',xhr.readyState);
			          	console.log('xhr.status=',xhr.status);
			          	console.log('response=',xhr.responseText);
						
			          	var dataReturn = $.parseJSON(xhr.responseText);
			          	var uploadResult = dataReturn['file'];
			          	fileNameUni = dataReturn['file'];
			          	var uploadStatus = dataReturn['status'];
			          	console.log('uploadResult=',uploadResult);
			
			        	if (uploadStatus=='success'){
			        		console.log('successfully uploaded file');
			            	submitForm(event, data);
			            	alert('Upload Complete');
	                		$('#upload_progess').hide();
	                		close_all_divs();
			            }else
			            {
			          	console.log('failed to upload file');
			            displayError('failed to upload')
			        	}
			       	}
	            	
	                
	        };
	        
	        //File progress
	        xhr.onprogress= function(evt)
	        {
			      if (evt.lengthComputable) {
			        var percentComplete = evt.loaded / evt.total;
			        percentComplete = parseInt(percentComplete * 100);
			        if (percentComplete)
			        {
			        	$('.progress-bar').css('width', percentComplete+'%').attr('aria-valuenow', percentComplete);
			        	$('div#upload_file_progress_bar').html(percentComplete+'%');
			        	
				        if (percentComplete === 100) {
				        }
			      	}
			      }
			};
	        //end file progress
	        
	        xhr.onerror = function () { alert("errorstatus: " + xhr.status + " ajaxoptions: " + ajaxOptions + " throwError: " + thrownError); };
	 		alert("after open");
	        xhr.open('POST', 'http://www.a-information.com/chatdawg/484flue.php', true);
	        alert("after open");
	        xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	        var data = 'image=' + dataURL;
	        alert("before send");
	        xhr.send(data);
	      }
	 
	      alert ("ended send");		 
	   }
	   reader.readAsDataURL(files[0]);
}
});