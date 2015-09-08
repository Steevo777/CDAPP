


$(function()
{ 

$('#create_user_form').on('submit', createUser);
$('#login_user_form').on('submit', validateUser);
$('search_for_users').click(loadAllUsers);
$('#usrCentralLnk').click(loadUsersScreen);
$('#usrICanSeebtn').click(loadAllUsersICanSee);
$('#usrCanSeeMebtn').click(loadAllUsersCanSeeMe);
$('#user_list_div').on('click', action_notifi);
  

  		
function createUser(event)
	{
  		//Validate data
  		event.stopPropagation(); // Stop stuff happening
	    event.preventDefault(); // Totally stop stuff happening
  		
  		// Create a jQuery object from the form
	  	$form = $(event.target);
		
		// Serialize the form data
		var formData = $form.serialize();
	
	    $.ajax({
	        url: 'http://www.a-information.com/chatdawg/crusr.php',
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
	                //alert('Your account was successfully added for: ' + data.username);
	                welcomeUser(data.username); 
	                
	            }
	            else
	            {
	                // Handle errors here
	                console.log('ERRORS: ' + data.error);
	                errorCreating();
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
		
function welcomeUser(username)
	{
		close_all_divs();
		$('#welcome_user_div').show();
		document.getElementById('welcome_user_div').innerHTML = 
		"<h1>Welcome "+username+"! <br> You're ready to begin posting.</h1>"+
		"<h2>Let's get you connected with some other dawgers.<h2>"+
		"<div class='input-group'>"+
      	"	<input type='text' class='form-control' placeholder='Search for...'>"+
      	"	<span class='input-group-btn'>"+
        "		<button id='search_for_users' class='btn btn-default' type='button'><span class='glyphicon glyphicon-search' aria-hidden='true'></span></button>"+
      	"	</span>"+
      	"</div>"; 
      	
      	loadAllUsersScreen();
      	
	}

function searchUsersclick(event)
	{
		/*var jsonData = $.ajax({
				url: "http://www.a-information.com/chatdawg/getsusers.php?eid=34e5r",
				dataType:"json",
				async: false
				}).responseText;
				
				var contentList = "";
				
				
				jsonData = JSON.parse(jsonData);
				$.each(jsonData, function(i,item){
					
					contentList += "<div class='container-fluid no-padding'  style='background-color: "+groupcolor+"'><div class='row'>";
				
					//No pic
					if (item.postpictureID == null)
					{
					contentList += "<b class=>" +item.username + "</b><br>" + item.post + "<br><br>"+" "+item.date+" &nbsp;&nbsp;&nbsp;&nbsp; <img src='png/glyphicons-499-sunglasses.png'> "+Math.floor((Math.random() * 10) + 1)+" &nbsp;&nbsp;&nbsp;&nbsp; <img src='png/glyphicons-344-thumbs-up.png' >"+Math.floor((Math.random() * 10) + 1)+" <img src='png/glyphicons-345-thumbs-down.png'>"+Math.floor((Math.random() * 10) + 1)+"   <hr>";
					}
					else if (item.linkedpost != null)
					{
					contentList += "<b>" +item.username + "</b><br>" + item.post + "<br><img src='"+item.linkedpost +"' class='img-responsive'><br><br>  "+" "+item.date+" &nbsp;&nbsp;&nbsp;&nbsp; <img src='png/glyphicons-499-sunglasses.png'>"+Math.floor((Math.random() * 10) + 1)+" &nbsp;&nbsp;&nbsp;&nbsp; <img src='png/glyphicons-344-thumbs-up.png'>  " +Math.floor((Math.random() * 10) + 1)+  "<img src='png/glyphicons-345-thumbs-down.png'>  "+Math.floor((Math.random() * 10) + 1)+" <hr>";
					}
					else 
					{
					contentList += "<b>" +item.username + "</b><br>" + item.post + "<br><img src='http://www.a-information.com/chatdawg/fups/"+item.postpictureID +"' class='img-responsive'><br><br>  "+" "+item.date+" &nbsp;&nbsp;&nbsp;&nbsp; <img src='png/glyphicons-499-sunglasses.png'>"+Math.floor((Math.random() * 10) + 1)+" &nbsp;&nbsp;&nbsp;&nbsp; <img src='png/glyphicons-344-thumbs-up.png'>  " +Math.floor((Math.random() * 10) + 1)+  "<img src='png/glyphicons-345-thumbs-down.png'>  "+Math.floor((Math.random() * 10) + 1)+" <hr>";
					}
					
					contentList += "</div></div>"
					
					});
					
					
					document.getElementById("list_div").innerHTML = contentList;
					document.getElementById("list_header_div").innerHTML = type;
					$('#list_div').show(); */
		
}	

function loadAllUsers()
	{
		
		var username = store('usrvld');
		var usrid = store('usrid');
		formData = 'usrid='+usrid+'&usid='+username;
		var jsonData = $.ajax({
			url: "http://www.a-information.com/chatdawg/37edusr.php",
			type: 'POST',
			dataType:'json',
			data: formData,
			async: false
			}).responseText;
		
				var contentList = "";
				
				jsonData = JSON.parse(jsonData);
				$.each(jsonData, function(i,item){
					
					contentList += "<div class='container-fluid no-padding'><div class='row'>";
					contentList += "<b>" +item.username + "</b>";
					if (item.family == '1')
						{
							contentList += "<button id='rema"+item.k1+"' class='btn btn-default' type='button' value='"+item.k1+"'>Remove</button>";
						}
						else
						{
							contentList += "<button id='reqa"+item.k1+"' class='btn btn-default' type='button' value='"+item.k1+"'>Request Family</button>";
						}
						
					if (item.friends == '1')
						{
							contentList += "<button id='remf"+item.k1+"' class='btn btn-default' type='button' value='"+item.k1+"'>Remove</button>";
						}
						else
						{
							contentList += "<button id='reqf"+item.k1+"' class='btn btn-default' type='button' value='"+item.k1+"'>Request Friends</button>";
						}
						
					if (item.party == '1')
						{
							contentList += "<button id='remp"+item.k1+"' class='btn btn-default' type='button' value='"+item.k1+"'>Remove</button>";
						}
						else
						{
							contentList += "<button id='reqp"+item.k1+"' class='btn btn-default' type='button' value='"+item.k1+"'>Request Party</button>";
						}		
					contentList += "</div></div>"
				});
					
					
					close_all_divs();
					document.getElementById("user_list_div").innerHTML = contentList;
					$('#user_list_div').show();	
}

function loadUsersScreen()
	{
		//Close add div
		close_all_divs();
		$('#usrlistOrder_div').show();
		
	}


function loadAllUsersCanSeeMe()
	{
		
		var username = store('usrvld');
		var usrid = store('usrid');
		formData = 'usrid='+usrid+'&usid='+username;
		var jsonData = $.ajax({
			url: "http://www.a-information.com/chatdawg/37edusr.php",
			type: 'POST',
			dataType:'json',
			data: formData,
			async: false
			}).responseText;
		
				var contentList = "";
				
				jsonData = JSON.parse(jsonData);
				
				contentList += "<div class='container-fluid no-padding'>";
				contentList += "<div class='row'>";
				contentList += "<div class='panel panel-default'>";
				contentList += "<div class='panel-heading'>"+username+": Can See Me</div>";
				contentList += "<table class='table'><thead><tr><th>Username</th><th>Family</th><th>Friends</th><th>Party</th></tr></thead><tbody>";
        		
				$.each(jsonData, function(i,item){
					
					
					contentList += "<tr><th scope='row'><b>" +item.username + "</b></th>";
					if (item.family == '1')
						{
							contentList += "<td><button id='rema"+item.k1+"' class='btn btn-primary outline' type='button' value='"+item.k1+"'>Remove</button></td>";
						}
						else
						{
							contentList += "<td><button id='reqa"+item.k1+"' class='btn btn-default btn-primary' type='button' value='"+item.k1+"'>Request Family</button></td>";
						}
						
					if (item.friends == '1')
						{
							contentList += "<td><button id='remf"+item.k1+"' class='btn btn-default btn-primary outline' type='button' value='"+item.k1+"'>Remove</button></td>";
						}
						else
						{
							contentList += "<td><button id='reqf"+item.k1+"' class='btn btn-default btn-primary' type='button' value='"+item.k1+"'>Request Friends</button></td>";
						}
						
					if (item.party == '1')
						{
							contentList += "<td><button id='remp"+item.k1+"' class='btn btn-default btn-primary outline' type='button' value='"+item.k1+"'>Remove</button></td>";
						}
						else
						{
							contentList += "<td><button id='reqp"+item.k1+"' class='btn btn-default btn-primary' type='button' value='"+item.k1+"'>Request Party</button></td>";
						}		
					contentList += "</tr>"
				});
					contentList += "</tbody></table></div></div>";
					
					close_all_divs();
					document.getElementById("user_list_div").innerHTML = contentList;
					$('#usrlistOrder_div').show();
					$('#user_list_div').show();	
					
}

function loadAllUsersICanSee()
	{
		
		var username = store('usrvld');
		var usrid = store('usrid');
		formData = 'usrid='+usrid+'&usid='+username;
		var jsonData = $.ajax({
			url: "http://www.a-information.com/chatdawg/41edusr.php",
			type: 'POST',
			dataType:'json',
			data: formData,
			async: false
			}).responseText;
		
				var contentList = "";
				
				jsonData = JSON.parse(jsonData);
				
				contentList += "<div class='container-fluid no-padding'>";
				contentList += "<div class='row'>";
				contentList += "<div class='panel panel-default'>";
				contentList += "<div class='panel-heading'>"+username+": I Can See</div>";
				contentList += "<table class='table'><thead><tr><th>Username</th><th>Family</th><th>Friends</th><th>Party</th></tr></thead><tbody>";
        		
				$.each(jsonData, function(i,item){
					
					
					contentList += "<tr><th scope='row'><b>" +item.username + "</b></th>";
					if (item.family == '1')
						{
							contentList += "<td><button id='reva"+item.k1+"' class='btn btn-primary outline' type='button' value='"+item.k1+"'>Remove</button></td>";
						}
						else
						{
							contentList += "<td><button id='reqa"+item.k1+"' class='btn btn-default btn-primary' type='button' value='"+item.k1+"'>Request Family</button></td>";
						}
						
					if (item.friends == '1')
						{
							contentList += "<td><button id='revf"+item.k1+"' class='btn btn-default btn-primary outline' type='button' value='"+item.k1+"'>Remove</button></td>";
						}
						else
						{
							contentList += "<td><button id='reqf"+item.k1+"' class='btn btn-default btn-primary' type='button' value='"+item.k1+"'>Request Friends</button></td>";
						}
						
					if (item.party == '1')
						{
							contentList += "<td><button id='revp"+item.k1+"' class='btn btn-default btn-primary outline' type='button' value='"+item.k1+"'>Remove</button></td>";
						}
						else
						{
							contentList += "<td><button id='reqp"+item.k1+"' class='btn btn-default btn-primary' type='button' value='"+item.k1+"'>Request Party</button></td>";
						}		
					contentList += "</tr>"
				});
					contentList += "</tbody></table></div></div>";					
					
					close_all_divs();
					document.getElementById("user_list_div").innerHTML = contentList;
					$('#usrlistOrder_div').show();
					$('#user_list_div').show();	
}


function action_notifi(event)
	 {
    	//alert(event.target.id);
	  	// Create a jQuery object from the form
	  	usrid = store('usrid');
	  	var targetClick=event.target.id;
	  		
		if (targetClick.substring(0,2) == 're')
		{
			// You should sterilise the file names
			formData = 'usrid='+usrid+'&req=' + targetClick;
			
		    $.ajax({
	        url: 'http://www.a-information.com/chatdawg/crnotifi.php',
	        type: 'POST',
	        data: formData,
	        cache: false,
	        dataType: 'json',
	        success: function(data, textStatus, jqXHR)
	        {
	            if(typeof data.error === 'undefined')
	            {
	                // Success so call function to process the form
	                alert('SUCCESS: ' + data.success);
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
}	



function validateUser(event, data)
	{
		//Stop closing
		event.stopPropagation(); // Stop stuff happening
	    event.preventDefault(); // Totally stop stuff happening
  		
		//Init
		var contentList = "";
		var uservalid= "";
		var userid = "";
		
		// Create a jQuery object from the form
		$form = $(event.target);
		
		// Serialize the form data
		var formData = $form.serialize();
		
		$.ajax({
			url: 'http://www.a-information.com/chatdawg/34vdusr.php',
            type: 'POST',
            data: formData,
            cache: false,
            dataType: 'json',
            success: function(data, textStatus, jqXHR)
            {
            	if(typeof data.error === 'undefined')
            	{
            		// Success so call function to process the form
            		console.log('SUCCESS Login: ' + data.success);
            		//alert('Data: ' + data);
            		
            		uservalid=data.usrd;
            		userid = data.usrid;
            		store ('usrvld',uservalid);
            		store ('usrid',userid);
					
					document.getElementById("username_div").innerHTML = uservalid;
					$('#login_user_div').hide();
					$('#username_div').show();
					doCounts(uservalid);
					
            	}
            	else
            	{
            		// Handle errors here
            		console.log('ERRORS: ' + data.error);
            		alert('ERRORS: ' + data.error);
            	}
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
            	// Handle errors here
            	console.log('ERRORS: ' + textStatus);
            	alert('ERRORS: ' + textStatus);
            },
            complete: function()
            {
            	// STOP LOADING SPINNER
            }
		});
		
		document.getElementById("username_div").innerHTML = uservalid;
		$('#login_user_div').hide();
		$('#username_div').show();
		doCounts(uservalid);
			 
	}

});

var store = function store(key, value) {
	
	 /*USAGE:
	 * ----------------------------------------
	 * Set New / Modify:
	 *   store('my_key', 'some_value');
	 *
	 * Retrieve:
	 *   store('my_key');
	 *
	 * Delete / Remove:
	 *   store('my_key', null);
	 */
 
 
    var lsSupport = false;
    
    // Check for native support
    if (localStorage) {
        lsSupport = true;
    }
    
    // If value is detected, set new or modify store
	if (typeof value !== "undefined" && value !== null) {
	    // Convert object values to JSON
	    if ( typeof value === 'object' ) {
	        value = JSON.stringify(value);
	    }
	    value2=""+value; //20150515
	    // Set the store
	    if (lsSupport) { // Native support
	        window.localStorage.setItem(key, value2);//20150515
	    } else { // Use Cookie
	        createCookie(key, value, 30);
	    }
	}
	
	// No value supplied, return value
	if (typeof value === "undefined") {
	    // Get value
	    if (lsSupport) { // Native support
	        data = window.localStorage.getItem(key);
	    } else { // Use cookie 
	        data = readCookie(key);
	    }
	
	    // Try to parse JSON...
	    try {
	       data = JSON.parse(data);
	    }
	    catch(e) {
	       data = data;
	    }
	    if (data!=null) {
	    data=""+data; //lp20150515
	}
	    return data;
	
	}

    // Null specified, remove store
    if (value === null) {
        if (lsSupport) { // Native support
            localStorage.removeItem(key);
        } else { // Use cookie
            createCookie(key, '', -1);
        }
    }
    
    /**
     * Creates new cookie or removes cookie with negative expiration
     * @param  key       The key or identifier for the store
     * @param  value     Contents of the store
     * @param  exp       Expiration - creation defaults to 30 days
     */
    
    function createCookie(key, value, exp) {
        var date = new Date();
        date.setTime(date.getTime() + (exp * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
        document.cookie = key + "=" + value + expires + "; path=/";
    }
    
    /**
     * Returns contents of cookie
     * @param  key       The key or identifier for the store
     */
    
    function readCookie(key) {
        var nameEQ = key + "=";
        var ca = document.cookie.split(';');
        for (var i = 0, max = ca.length; i < max; i++) {
            var c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }
    
};




