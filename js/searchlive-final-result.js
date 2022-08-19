// front end part of solution - receive and send data to server from form in html element class search-box-cust input..., 
// then input received data to html element with class result-final.




// main search button
jQuery(function($) {
	
  $('#submit_id').click( function() {
        
	 // unset category to html element
	$('span.chosen_categ_name').html('');
	
     func_returns_final_result_based_on_input_field();

		
    });  
	
});



// load more button

function Load_More(){
	
jQuery(function($) {
	
        	 

	 func_returns_final_result_based_on_input_field(1, 0, 0);
		
	
}); // end of jquery

};


// load previous button

function Load_Previous(){
	
jQuery(function($) {
	
        	 

	 func_returns_final_result_based_on_input_field(0, 1, 0);
		
	
}); // end of jquery

};



//left only alphabets, numbers and space - everything in LOWER CASE
function cleanUpSpecialChars2(str)
{
    return str
	    .toLowerCase()
        //.replace(/[á]/g,"a")
        //.replace(/[č]/g,"c")
        //.replace(/[ď]/g,"d")
        //  .replace(/[í]/g,"i")
        // .replace(/[ň]/g,"n")
        // .replace(/[ó]/g,"o")
        // .replace(/[í]/g,"i")
        //.replace(/[ř]/g,"r")
        // .replace(/[š]/g,"s")
        // .replace(/[ť]/g,"t")
        // .replace(/[ú]/g,"u")
		//.replace(/[ů]/g,"u")
		//.replace(/[ý]/g,"y")		
        //.replace(/[ž]/g,"z")
		//.replace(/[é]/g,"e")
		//.replace(/[ě]/g,"ě")
        .replace(/[^a-zA-Z0-9čČďĎěĚňŇřŘšŠťŤůŮžŽáÁéÉíÍóÓúÚýÝ ]/g, ''); // final clean up
};



function func_exact_category(x){

	jQuery(function($) {
		
	  $('span.chosen_categ_name').html(x);
	  
	});
	  
  };
  
 
  


  function func_returns_final_result_based_on_input_field(is_load_more_param, is_previous_button_param, searchlive_suggest_category_field) {
	  
   jQuery(function($) {
		     	        		
       var result_numb_var;
	   var result_numb_var_before;
	   

	    // get current number from html element
        result_numb_var_before = $('#result_no').val();
		result_numb_var = Number(result_numb_var_before);
	   
	   
	   
	   if(searchlive_suggest_category_field !== 0)
	   {
		  $('span.chosen_categ_name').html(searchlive_suggest_category_field); 
	   }
	   
	   
	   //if iniciated by LOAD MORE BUTTON
       if(is_load_more_param){
	    
            			
				  if(result_numb_var==1)
				  {
					// change html element  
				    $('#result_no').val('20');
				  }
				  else
				  {
					// change html element which will be used as limit for next load more
				    $('#result_no').val(result_numb_var+10);	
				  }
          
	   }

	  // if iniciated by SHOW PREVIOUS button
	   else if(is_previous_button_param)
	   {
		   
				
				  if(result_numb_var==20)
				  {
					// change html element  
				    $('#result_no').val('1');  
					 
				  }
				  else
				  {
					  					// var used in q
                    result_numb_var = result_numb_var-20;				
				    // change html element 
					$('#result_no').val(result_numb_var+10);
					
				  }
				  
				  
	   }
	   
	  //if NOT INICIATED by load more button or previous button 
	  else
	   {
	            // called from other button then load more, set value to initial number 1
	            $('#result_no').val('1');  
				 result_numb_var = 1;

	   
	   }	
	   
	   

	   
	   
       var category_input =   $('.search-box-cust input[type="text"]').val();		
	   var CategorySet = $('span.chosen_categ_name').text();
	   		
				
		// begin of if input contains value		
       if((category_input != '') || (CategorySet != '') ) { 
			
			var is_exact_category;
			var category_parametr_to_be_sent;
			
			if (CategorySet != '') {
				is_exact_category = 'true';
				category_parametr_to_be_sent = CategorySet;


				
			}
			else if (category_input != '') {
				is_exact_category = 'false';
				category_input = category_input.substr(0, 30);	
			    //left only alphabets, numbers and space - everything in LOWER CASE
                category_input = cleanUpSpecialChars2(category_input);
				category_parametr_to_be_sent = category_input;

				
			}

			
            var is_from_cheap;
			var is_from_expensive;
			var is_on_store;
		
			if( $('input#fromcheap').prop('checked')) 
			{ is_from_cheap = 'true';   }
		    else if( $('input#fromexpensive').prop('checked')) 
			{ is_from_expensive = 'true';    }		


		    if( $('input#onstore').prop('checked')) 
			{  is_on_store = 'true';   }	
		    
  	        
            					    
								//alert(result_numb_var + " is previous: " + is_previous_button_param +" is load more" +is_load_more_param);
  	                      		//var resultDropdown = $(this).siblings(".result");

                                    var data = {
                                        'action': 'get_final_result_by_ajax', 
                                        'category-final': category_parametr_to_be_sent,        		
										'is_exact_category': is_exact_category,
										'is_from_cheap': is_from_cheap,
										'is_from_expensive': is_from_expensive,
										'is_on_store': is_on_store,
										'result_numb': result_numb_var,
										'is_load_more': is_load_more_param,
										'is_previous': is_previous_button_param,
                                        'security': searchlive_cust_scripts_input_arr_final.security,  		//cryptografic token tied to 
                                    }
                              	 // post method - send data to the server using a HTTP POST request. post(url, data, success, datatype)
                              	 // url = string containing the url to which the request is sent; ajaxurl is url to the admin area for site admin-ajax.php, 
                              	 // resp. admin_url( 'admin-ajax.php' )
                              	 // data = plain object or string that is sent to the server with the request.
                              	 // success = a callback function that is executed if the request succeeds. Required if dataType is provided, but can be null in that case.
                              	 // datatype = the type of data expected from the server. Default: Intelligent Guess (xml, json, script, text, html).
                                    $.post(searchlive_cust_scripts_input_arr_final.ajaxurl, data, function(response) {
                                        $('.result').html('');
                              		    $('.result-final').html(response);  
									    
								         if((is_load_more_param !== undefined) || (is_previous_button_param !== undefined)){
								        //$('html, body').animate({ scrollTop: 0 }, 'fast');
								        
								         $(window).scrollTop($('.result').offset().top);
								         }
									 
                                 });
								 

  	          
             
             }  // end of if input contains value
           
	 
	 
	});  //end jquery function
         

	
}; // end of func_returns









// when click checkable field, then return result:
jQuery(function($) {

	
$('input#fromcheap').on('change', function() {
    
	$('input#fromexpensive').prop('checked', false); 
	func_returns_final_result_based_on_input_field();
	
});


$('input#fromexpensive').on('change', function() {

    $('input#fromcheap').prop('checked', false);
	func_returns_final_result_based_on_input_field();

	
});


$('input#onstore').on('change', function() {
	
	func_returns_final_result_based_on_input_field();
	
});
	
	
	
	
});


