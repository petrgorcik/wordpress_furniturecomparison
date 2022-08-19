<?php
/**
 *
 * Template Name: page-comparison-final
 * @package WordPress
 * @subpackage furniturecomparison
 * @since furniturecomparison 1.0.0
 */
get_header();
 

 ?>

		
		<?php
		// Start the loop.
		while ( have_posts() ) :
			the_post(); ?>

    <div class="row">
			<!-- fixed menu -->
       <div class="col-lg-3 col-md-3 mx-auto" >
		
	         <div class="sidenav">
               
			   
			   <button class="dropdown-btn"><b>Ložnice</b>    
               </button>
               <div class="dropdown-container">
                 <ul id="fixedMenuUL">
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Postele'); ">Postele</button></li>				
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Ložnicové sestavy'); ">Ložnicové sestavy</button></li>
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Rošty do postele'); ">Rošty do postele</button></li>
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Povlečení'); ">Povlečení</button></li>
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Budíky'); ">Budíky</button></li>
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Chrániče na matrace'); ">Chrániče na matrace</button></li>
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Matrace'); ">Matrace</button></li>
				 </ul> 
               </div>
			    
			   <button class="dropdown-btn"><b>Obývací pokoj</b>               
               </button>
               <div class="dropdown-container">
                 <ul id="fixedMenuUL">
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Obývací stěny'); ">Obývací stěny</button></li>
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Pohovky'); ">Pohovky</button></li>
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Sedací soupravy'); ">Sedací soupravy</button></li>
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Křesla'); ">Křesla</button></li>
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Sedací vaky'); ">Sedací vaky</button></li>
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Koberce a koberečky'); ">Koberce a koberečky</button></li>
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Konferenční stolky'); ">Konferenční stolky</button></li>
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Obrazy'); ">Obrazy</button></li>
				 </ul> 
               </div>
			   
			   <button class="dropdown-btn"><b>Kuchyně a jídelna</b> 
               </button>
               <div class="dropdown-container">
                 <ul id="fixedMenuUL">
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Kuchyňské linky'); ">Kuchyňské linky</button></li>
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Kuchyňské dřezy'); ">Kuchyňské dřezy</button></li>
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Kuchyňské utěrky'); ">Kuchyňské utěrky</button></li>
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Jídelní sety'); ">Jídelní sety</button></li>
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Jídelní stoly'); ">Jídelní stoly</button></li>
				 </ul> 
               </div>			   
			   
			   
			   <button class="dropdown-btn"><b>Koupelna</b>
               </button>
               <div class="dropdown-container">
                 <ul id="fixedMenuUL">
                <li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Koupelnový nábytek'); ">Koupelnový nábytek</button></li>
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Ručníky'); ">Ručníky a župany</button></li>
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Koupelnová zrcadla'); ">Koupelnová zrcadla</button></li>
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Koše na prádlo'); ">Koše na prádlo</button></li>
				 </ul> 
               </div>			   
			   
			   <button class="dropdown-btn"><b>Předsíň</b>
               </button>
               <div class="dropdown-container">
                 <ul id="fixedMenuUL">
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Botníky'); ">Botníky</button></li>
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Věšáky'); ">Věšáky</button></li>	
				 </ul> 
               </div>					   
			   
			   <button class="dropdown-btn"><b>Dětský pokoj</b>
               </button>
               <div class="dropdown-container">
                 <ul id="fixedMenuUL">
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Dětská prostěradla'); ">Dětská prostěradla</button></li>
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Dětské deky'); ">Dětské deky</button></li>
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Dětské pokoje'); ">Dětské pokoje</button></li>
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Dětské polštářky'); ">Dětské polštářky</button></li>
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Dětské postele'); ">Dětské postele</button></li>
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Dětské povlečení'); ">Dětské povlečení</button></li>
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Dětské psací stoly'); ">Dětské psací stoly</button></li>				
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Dětské stoly a židle'); ">Dětské židle</button></li>
				 </ul> 
               </div>				   
			   
			   <button class="dropdown-btn"><b>Celý dům - podlahy</b>
               </button>
               <div class="dropdown-container">
                 <ul id="fixedMenuUL">
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Plovoucí dřevěné podlahy'); ">Plovoucí dřevěné podlahy</button></li>
	            <li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Plovoucí laminátové podlahy'); ">Plovoucí laminátové podlahy</button></li>
		        <li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Plovoucí dřevěné podlahy'); ">Plovoucí korkové podlahy</button></li>
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Vinylové podlahy'); ">Vinylové podlahy</button></li>
                <li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Podlahové lišty'); ">Podlahové lišty</button></li>
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Podlahové podložky'); ">Podlahové podložky</button></li>
				 </ul> 
               </div>			   
			   
			   <button class="dropdown-btn"><b>Kancelář</b>
               </button>
               <div class="dropdown-container">
                 <ul id="fixedMenuUL">
                <li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Kancelářské stoly'); ">Kancelářské stoly</button></li>
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Kancelářská křesla'); ">Kancelářská křesla</button></li>	
                <li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Kancelářské židle'); ">Kancelářské židle</button></li>
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'Kancelářský nábytek'); ">Další kancelářský nábytek</button></li>
				<li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'PC stoly'); ">PC stoly</button></li>
				 </ul> 
               </div>

			   
             </div>	          
					           
					           
	    </div>	

		<!-- search area and result -->
		<div class="col-lg-9 col-md-9 mx-auto">
		
		             <div class="row"> 
		             
                          <div class="col-lg-9 col-md-9 mx-auto" >	 
							 <div style="margin: 4px 2px;">
							 <br>
                              <input type="submit" name="submit" value="VYHLEDEJ" id="submit_id" style="float: right;" />
							      
                                <div class="search-box-cust" id="myInput">
                                    <input id="inpt-main" type="text" autocomplete="off" placeholder="Vyhledej další kategorie ..."  style="width: 100%;"/> 
		           				 
                                    <div class="result"></div>
                                
		           		       </div>
		           			 
							 </div>
		           		  </div>
		           		  <div class="col-lg-3 col-md-3 mx-auto" >	
		           		  </div>
		           		  
		             </div>

		  <br>	
		  
				<div class="row"> 
		                
					        <div class="col-lg-3 col-md-3 mx-auto" >
                            <form>
                            <input type="checkbox" id="onstore" name="onstore" value="goodsonstore" style="width: 17px; height: 17px;" >
                            <label for="onstore">Skladem</label>
                            </form>  
                            </div>
                            
                            <div class="col-lg-3 col-md-3 mx-auto" >
                            <form>
                            <input type="checkbox" id="fromcheap" name="fromcheap" value="fromcheapgoods" style="width: 17px; height: 17px;">
                            <label for="fromcheap">Od nejlevnějšího</label>
                            </form> 
                            </div>
                            
                            <div class="col-lg-3 col-md-3 mx-auto" >
                            <form>
                            <input type="checkbox" id="fromexpensive" name="fromexpensive" value="goodsfromexpensive" style="width: 17px; height: 17px;" checked>
                            <label for="fromexpensive">Od nejdražšího</label>
                            </form>
                            </div>
							
							<div class="col-lg-3 col-md-3 mx-auto" >
                            </div>
                           
						   
			     </div>
				<div class="row"> 
						<div class="col-lg-12 col-md-12 mx-auto" >
                         <br>    
                         <div class="result-final"><br><br><br><br><br><br></div>
						 
						 
						 
						 
						 <div class="chosencategory" style="color:white;">
                         Výběr z kategorie: <span class="chosen_categ_name"></span><br>
						 </div>
						<input type="hidden" id="result_no" value="1">
						</div> 
                </div>     
                    
	
    </div>

  </div>


	   <?php 
	 // End the loop
	 endwhile;
	 ?>
	 

	

<script>

var currentURL = window.location.href;

/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}


var firsttime = (function() {
    var executed = false;
    return function() {
        if (!executed) {
            executed = true;
			
			    if(currentURL.indexOf('?') === -1){func_returns_final_result_based_on_input_field(0,0,'Postele'); }					
				
				else if(currentURL.indexOf('postele') !== -1){func_returns_final_result_based_on_input_field(0,0,'Postele'); }
				else if(currentURL.indexOf('loznicove-sestavy') !== -1){func_returns_final_result_based_on_input_field(0,0,'Ložnicové sestavy'); }
				else if(currentURL.indexOf('rosty-do-postele') !== -1){func_returns_final_result_based_on_input_field(0,0,'Rošty do postele'); }
				else if(currentURL.indexOf('povleceni') !== -1){func_returns_final_result_based_on_input_field(0,0,'Povlečení'); }
				else if(currentURL.indexOf('budiky') !== -1){func_returns_final_result_based_on_input_field(0,0,'Budíky'); }
				else if(currentURL.indexOf('chranice-na-matrace') !== -1){func_returns_final_result_based_on_input_field(0,0,'Chrániče na matrace'); }
				else if(currentURL.indexOf('matrace') !== -1){func_returns_final_result_based_on_input_field(0,0,'Matrace'); }
								
				else if(currentURL.indexOf('obyvaci-steny') !== -1){func_returns_final_result_based_on_input_field(0,0,'Obývací stěny'); }			
				else if(currentURL.indexOf('pohovky') !== -1){func_returns_final_result_based_on_input_field(0,0,'Pohovky'); }
				else if(currentURL.indexOf('sedaci-soupravy') !== -1){func_returns_final_result_based_on_input_field(0,0,'Sedací soupravy'); }
				else if(currentURL.indexOf('kresla') !== -1){func_returns_final_result_based_on_input_field(0,0,'Křesla'); }
				else if(currentURL.indexOf('sedaci-vaky') !== -1){func_returns_final_result_based_on_input_field(0,0,'Sedací vaky'); }
				else if(currentURL.indexOf('koberce-a-koberecky') !== -1){func_returns_final_result_based_on_input_field(0,0,'Koberce a koberečky'); }
				else if(currentURL.indexOf('konferencni-stolky') !== -1){func_returns_final_result_based_on_input_field(0,0,'Konferenční stolky'); }
				else if(currentURL.indexOf('obrazy') !== -1){func_returns_final_result_based_on_input_field(0,0,'Obrazy'); }
				
				else if(currentURL.indexOf('kuchynske-linky') !== -1){func_returns_final_result_based_on_input_field(0,0,'Kuchyňské linky'); }
				else if(currentURL.indexOf('kuchynske-drezy') !== -1){func_returns_final_result_based_on_input_field(0,0,'Kuchyňské dřezy'); }
				else if(currentURL.indexOf('kuchynske-uterky') !== -1){func_returns_final_result_based_on_input_field(0,0,'Kuchyňské utěrky'); }
				else if(currentURL.indexOf('jidelni-sety') !== -1){func_returns_final_result_based_on_input_field(0,0,'Jídelní sety'); }
				else if(currentURL.indexOf('jidelni-stoly') !== -1){func_returns_final_result_based_on_input_field(0,0,'Jídelní stoly'); }
				
				
				else if(currentURL.indexOf('koupelnovy-nabytek') !== -1){func_returns_final_result_based_on_input_field(0,0,'Koupelnový nábytek'); }
				else if(currentURL.indexOf('rucniky') !== -1){func_returns_final_result_based_on_input_field(0,0,'Ručníky');}
				else if(currentURL.indexOf('koupelnova-zrcadla') !== -1){func_returns_final_result_based_on_input_field(0,0,'Koupelnová zrcadla');}
				else if(currentURL.indexOf('kose-na-pradlo') !== -1){func_returns_final_result_based_on_input_field(0,0,'Koše na prádlo'); }
				
				
				else if(currentURL.indexOf('botniky') !== -1){func_returns_final_result_based_on_input_field(0,0,'Botníky');  }
				else if(currentURL.indexOf('vesaky') !== -1){func_returns_final_result_based_on_input_field(0,0,'Věšáky'); }
				
				else if(currentURL.indexOf('detska-prosteradla') !== -1){func_returns_final_result_based_on_input_field(0,0,'Dětská prostěradla'); }
				else if(currentURL.indexOf('detske-deky') !== -1){func_returns_final_result_based_on_input_field(0,0,'Dětské deky'); }
				else if(currentURL.indexOf('detske-pokoje') !== -1){func_returns_final_result_based_on_input_field(0,0,'Dětské pokoje'); }
				else if(currentURL.indexOf('detske-polstarky') !== -1){func_returns_final_result_based_on_input_field(0,0,'Dětské polštářky'); }
				else if(currentURL.indexOf('detska-postel') !== -1){func_returns_final_result_based_on_input_field(0,0,'Dětské postele'); }
				else if(currentURL.indexOf('detske-povleceni') !== -1){func_returns_final_result_based_on_input_field(0,0,'Dětské povlečení'); }
				else if(currentURL.indexOf('detske-psaci-stoly') !== -1){func_returns_final_result_based_on_input_field(0,0,'Dětské psací stoly'); }				
				else if(currentURL.indexOf('detske-stoly-a-zidle') !== -1){func_returns_final_result_based_on_input_field(0,0,'Dětské stoly a židle'); }
				
				
				else if(currentURL.indexOf('plovouci-drevene-podlahy') !== -1){func_returns_final_result_based_on_input_field(0,0,'Plovoucí dřevěné podlahy'); }
				else if(currentURL.indexOf('plovouci-laminatove-podlahy') !== -1){func_returns_final_result_based_on_input_field(0,0,'Plovoucí laminátové podlahy'); }					
				else if(currentURL.indexOf('plovouci-dreven-podlahy') !== -1){func_returns_final_result_based_on_input_field(0,0,'Plovoucí dřevěné podlahy'); }
				else if(currentURL.indexOf('vinylove-podlahy') !== -1){func_returns_final_result_based_on_input_field(0,0,'Vinylové podlahy'); }
				else if(currentURL.indexOf('podlahove-listy') !== -1){func_returns_final_result_based_on_input_field(0,0,'Podlahové lišty'); }					
				else if(currentURL.indexOf('podlahove-podlozky') !== -1){func_returns_final_result_based_on_input_field(0,0,'Podlahové podložky'); }
				
				else if(currentURL.indexOf('kancelarske-stoly') !== -1){func_returns_final_result_based_on_input_field(0,0,'Kancelářské stoly'); }
				else if(currentURL.indexOf('kancelarske-kreslo') !== -1){func_returns_final_result_based_on_input_field(0,0,'Kancelářská křesla');}	
				else if(currentURL.indexOf('kancelarske-zidle') !== -1){func_returns_final_result_based_on_input_field(0,0,'Kancelářské židle');  }
				else if(currentURL.indexOf('kancelarsky-nabytek') !== -1){func_returns_final_result_based_on_input_field(0,0,'Kancelářský nábytek'); }	
				else if(currentURL.indexOf('pc-stoly') !== -1){func_returns_final_result_based_on_input_field(0,0,'PC stoly');  }
				
				else{func_returns_final_result_based_on_input_field(0,0,'Postele'); }
					
			
		};
    };
})();



window.addEventListener("load", function(){
    firsttime(); 
});



</script>
   	 
	
<?php get_footer(); ?>	