// front end part of solution - receive and send data to server from form in html element class search-box-cust input..., 
// then input received data to html element with class result.


jQuery(function($) {
	
    $('.search-box-cust input[type="text"]').on("keyup input", function() {

        
		//select first 30 letters of search
		var category_input = $(this).val();	


		
		
        if(category_input != '') {
			
			
			category_input = category_input.substr(0, 30);
						
			
			//left only alphabets, numbers and space - everything in LOWER CASE
			category_input = cleanUpSpecialChars(category_input);

           
            var data = {
                'action': 'get_states_by_ajax2', 
                'category': category_input,        		//chosen country id by user
                'security': searchlive_cust_scripts_input_arr.security,  		//cryptografic token tied to load_states
            }
			

			// post method - send data to the server using a HTTP POST request. post(url, data, success, datatype)
			 // url = string containing the url to which the request is sent; ajaxurl is url to the admin area for site admin-ajax.php, 
			 // resp. admin_url( 'admin-ajax.php' )
			 // data = plain object or string that is sent to the server with the request.
			 // success = a callback function that is executed if the request succeeds. Required if dataType is provided, but can be null in that case.
			 // datatype = the type of data expected from the server. Default: Intelligent Guess (xml, json, script, text, html).
            $.post(searchlive_cust_scripts_input_arr.ajaxurl, data, function(response) {
                 $('.result').html(response); 				 // find element with class load-state at page and insert html returned by function post.
				  //alert(response);
				 //$('.result').html("<p>test</p><br><p>test2</p>"); 
		   });
        }	// end of if void	
		
		
		
    });
});



//left only alphabets, numbers and space - everything in LOWER CASE
function cleanUpSpecialChars(str)
{
    return str
	    .toLowerCase()
        //.replace(/[??]/g,"a")
        //.replace(/[??]/g,"c")
        //.replace(/[??]/g,"d")
        //  .replace(/[??]/g,"i")
        // .replace(/[??]/g,"n")
        // .replace(/[??]/g,"o")
        // .replace(/[??]/g,"i")
        //.replace(/[??]/g,"r")
        // .replace(/[??]/g,"s")
        // .replace(/[??]/g,"t")
        // .replace(/[??]/g,"u")
		//.replace(/[??]/g,"u")
		//.replace(/[??]/g,"y")		
        //.replace(/[??]/g,"z")
		//.replace(/[??]/g,"e")
		//.replace(/[??]/g,"??")
        .replace(/[^a-zA-Z0-9???????????????????????????????????????????????????????????? ]/g, ''); // final clean up
}


