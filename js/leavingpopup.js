// show message when user leaves to external website alert("Opouštíte web."); if($(this).attr("href").indexOf("pohadkove") != 0)


jQuery(function($) {
	

		$('a').click(function() {
			
			
			var lnk = $(this).attr("href");
			
			 if(   (lnk.indexOf("https://www.pohadkovebydleni") == -1) && (lnk.indexOf("https://pohadkovebydleni") == -1) && (lnk.indexOf("gorcik.cz") == -1)   ) {
			
		 
		 // check if cookie is accepted
		 cookie12x = document.cookie;
		 const parts12x = cookie12x.split(';');	  
	     for(var i = 0; i < parts12x.length; i++)
		 {
 		 parts12x[i] = parts12x[i].replace(' ', '');
		 }
				
		 if(parts12x.includes("cmplz_marketing=allow")){
			 // do nothing
		 }
		 else {		 
				 
		// reload and second check if cookie is accepted		 
		 location.reload();		 
		 cookie12 = document.cookie;
		 const parts12 = cookie12.split(';');	  
	     for(var i = 0; i < parts12.length; i++)
		 {
 		 parts12[i] = parts12[i].replace(' ', '');
		 }
				
				 if(parts12.includes("cmplz_marketing=allow")){
		
				  // do nothing
															    }
				 
				 else{
					    // prevent link
					 	event.preventDefault();
						if(confirm("Vážení zákazníci, aby Vám fungovaly všechny odkazy, potřebujeme Váš souhlas s marketingovými cookies. Lišta se souhlasem je na webu uvedena úplně dole.")){
							
							//$(this).attr("href").click();
							//window.open(lnk);
															};
					 
					 
					} ; // end of first else, first check if cookie not accepted
				 
				 
				 
				} ; // end of first else, first check if cookie not accepted
				 
				 
				 
				 
																}
			
		
	});
	

	
	
});


jQuery(function($) {
	
     function addEvent(event, selector, callback, context) {
            document.addEventListener(event, e => {
                if ( e.target.closest(selector) ) {
                    callback(e);
                }
            });
        }

        addEvent($('click', '.cmplz-show-banner', function(){
            document.querySelectorAll('.cmplz-manage-consent').forEach(obj => {
                obj.click();
            });
        }));



});
