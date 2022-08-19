<?php


add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
 
    $parent_style = 'twentysixteen-style'; 
 
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_uri(),
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}




/** ------------------------------- search live - suggestions------------------------------------------------------- **/

function searchlive_cust_scripts() {
    // Register the script
    wp_register_script( 'searchlive-custom-script', get_stylesheet_directory_uri(). '/js/searchlive.js', array( 'jquery' ), false, true );
  
    // Localize the script with new data
    $script_data_arr = array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),       //Retrieves the URL to the admin area for the current site.
        'security' => wp_create_nonce( 'load_categories' ),   //Creates a cryptographic token tied to a specific action, user, user session, and window of time.
    );
    wp_localize_script( 'searchlive-custom-script', 'searchlive_cust_scripts_input_arr', $script_data_arr ); // array script_data_array is added to custom-script and is named as blog
  
    // Enqueued script with localized data.
    wp_enqueue_script( 'searchlive-custom-script' );
}


add_action('wp_enqueue_scripts', 'searchlive_cust_scripts');




add_action('wp_ajax_get_states_by_ajax2', 'get_states_by_ajax2_callback');
add_action('wp_ajax_nopriv_get_states_by_ajax2', 'get_states_by_ajax2_callback');

// server side part of solution
// the code which will return categories in the HTML drop-down format.
// below response will send to our jQuery code. And using jQuery we append  drop-down.
function get_states_by_ajax2_callback() {
    check_ajax_referer('load_categories', 'security');    
	$category = $_POST['category'];
	
    global $wpdb;
	
	$prepstring = "SELECT distinct categorytext FROM ".$wpdb->prefix."cust_products WHERE categorytext like '%%" . $category . "%%'";
    $aCategories = $wpdb->get_results( $wpdb->prepare( $prepstring));
       if ( $aCategories ) {
		   ?>
		   <ul id="myUL">
		   
		   <?php
            foreach ($aCategories as $aCategory) {
				?><li> <button onclick="func_returns_final_result_based_on_input_field(0,0,'<?php echo $aCategory->categorytext;?>'); "><?php echo $aCategory->categorytext; ?></button> </li><?php
            }
			?>
			
			</ul>
<?php 
    }
		

    wp_die();
}




// css used at search page
add_action( 'wp_enqueue_scripts', 'search_live_css_func' );
function search_live_css_func() {
if (is_page( 'srovnavac-bydleni' ) || is_page( 'srovnavac-bydleni-dev' ) ){
wp_enqueue_style( 'search_live_css',  get_stylesheet_directory_uri() . '/css/search_live.css' );
}
}

/** ------------------------------- end of search live - suggestions------------------------------------------------------- **/





/** ------------------------------- search live - final result script ------------------------------------------------------- **/

function searchlive_cust_scripts_final() {
    // Register the script
    wp_register_script( 'searchlive-custom-script-final', get_stylesheet_directory_uri(). '/js/searchlive-final-result.js', array( 'jquery' ), false, true );
  
    // Localize the script with new data
    $script_data_arr_final = array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),       //Retrieves the URL to the admin area for the current site.
        'security' => wp_create_nonce( 'final_result' ),   //Creates a cryptographic token tied to a specific action, user, user session, and window of time.
    );
    wp_localize_script( 'searchlive-custom-script-final', 'searchlive_cust_scripts_input_arr_final', $script_data_arr_final ); // array script_data_array is added to custom-script and is named as blog
  
    // Enqueued script with localized data.
    wp_enqueue_script( 'searchlive-custom-script-final' );
}


add_action('wp_enqueue_scripts', 'searchlive_cust_scripts_final');



// called when user input just SOME STRING!
add_action('wp_ajax_get_final_result_by_ajax', 'get_final_result_by_ajax_callback');
add_action('wp_ajax_nopriv_get_final_result_by_ajax', 'get_final_result_by_ajax_callback');

// server side part of solution
// the code which will return final result in the HTML drop-down format.
// below response will send to our jQuery code. And using jQuery we append final result to given class.
function get_final_result_by_ajax_callback() {
    check_ajax_referer('final_result', 'security');
    $category_final = $_POST['category-final'];	
	$is_exact_category = $_POST['is_exact_category'];
	$is_from_cheap = $_POST['is_from_cheap'];	
	$is_from_expensive = $_POST['is_from_expensive'];	
	$is_on_store = $_POST['is_on_store'];
	$result_numb = $_POST['result_numb'];	
	$is_load_more = $_POST['is_load_more'];	
	$is_previous = $_POST['is_previous'];	

	
	global $wpdb;
	
	
	$is_first_10 = false;
	$wild = '%%%%%';
	
	
	//for degu purpose only;
	$tempCheck;
	$tempCheckSentence = "is_load_more: " . $is_load_more . " is_previous: " . $is_previous . " result_numb: " . $result_numb;
	

	
	
	// if checked field OnStore (skladem)	
	if($is_on_store)
	{  $parametr_additional_sql_delivery  = " AND t1.delivery_date = 0 "; }


    // default value is order by from most expensive
    $parametr_additional_sql_order = " ORDER BY t1.price_vat DESC ";
	
   // if checked field from cheapest (od nejlevnejsiho) or if checked field from most expensive (od nejdrazsiho)
	if($is_from_cheap)
	{  $parametr_additional_sql_order  = " ORDER BY t1.price_vat ASC "; }
    elseif($is_from_expensive)
	  { $parametr_additional_sql_order  = " ORDER BY t1.price_vat DESC ";}
		
	
	
	// if LOAD MORE BUTTON is called  first time
	if($is_load_more && ($result_numb == 1))
	{
			$parametr_additional_sql_limit = " LIMIT 10, 11 "; 
			$tempCheck = "Load more first page ";
	}
	
	// if LOAD MORE BUTTON is called second or more times
    elseif($is_load_more && ($result_numb !== 1))
    {
			 $parametr_additional_sql_limit =  " LIMIT " . (intval($result_numb)) . ", 11";
			 $tempCheck = "Load more another pages result of is_load_more value: ". $is_load_more;
			   
		
    }
	// if SHOW PREVIOUS BUTTON is called first time
	elseif($is_previous && ($result_numb == 20))
	{

			  $tempCheck = "Previous - result numb == 20 ok";
			  $parametr_additional_sql_limit = " LIMIT 0, 11 "; 
			  $is_first_10 = true;
    }
		   
	//if show previous button is called second or more times
	elseif($is_previous && ($result_numb !== 20))
	{
			   $tempCheck = "Previous - result numb - another ";
			   $parametr_additional_sql_limit =  " LIMIT " . (intval($result_numb)) . ", 11";
			   	
	}
	
	// if NEITHER previous or load more button initiated call
	else
	{
		$parametr_additional_sql_limit = " LIMIT 0, 11 ";
		$is_first_10 = true;
		$tempCheck = "first page only";
	}
	
	

   
	
	$tbl_cust_products = $wpdb->prefix . "cust_products";
	$tbl_cust_seller =  $wpdb->prefix . "cust_seller";
	
	// get final result which will be rendered to user
	if($is_exact_category)
	{
	$prepstring_final = "SELECT t1.item_id, t1.seller, t1.productname, t1.product, t1.imgurl, SUBSTRING(t1.description, 1, 200 ) as description, t1.price_vat, t1.manufacturer, t1.delivery_date, t1.categorytext, CONCAT(t2.affil_part, t1.URL) as URL, t1.EAN FROM " . $tbl_cust_products . " as t1 INNER JOIN  " . $tbl_cust_seller . " as t2 ON t1.seller = t2.id WHERE t1.categorytext ='" .  $category_final . "' " . $parametr_additional_sql_delivery ." ". $parametr_additional_sql_order ." ". $parametr_additional_sql_limit;    
	}
	else
	{
	$prepstring_final = "SELECT t1.item_id, t1.seller, t1.productname, t1.product, t1.imgurl, SUBSTRING(t1.description, 1, 200 ) as description, t1.price_vat, t1.manufacturer, t1.delivery_date, t1.categorytext, CONCAT(t2.affil_part, t1.URL) as URL, t1.EAN FROM " . $tbl_cust_products . " as t1 INNER JOIN  " . $tbl_cust_seller . " as t2 ON t1.seller = t2.id WHERE t1.categorytext like '%%" .  $category_final . "%%' " . $parametr_additional_sql_delivery ." ". $parametr_additional_sql_order ." ". $parametr_additional_sql_limit;    
	}

	
    $prepstring_final2= $wpdb->prepare( $prepstring_final);

	$aQueryResults = $wpdb->get_results($prepstring_final2);

   // write information to file
  // $target_file_1= get_home_path() . 'myDebugFile.txt';	
   //file_put_contents($target_file_1, $prepstring_final);
   

    // if there is more than 10 results, change this variable to true
	$is_more_then_10 = false;
	

	

	
       if ( $aQueryResults ) {
		        
				
				// show previous result button 
			 	// everytime load more is called
	          if($is_first_10==false)
					{
		 	?>
     
		
           <div class="row">
           
                <div class="col-lg-4 col-md-4 mx-auto" >
                </div>
           	 
                <div class="col-lg-4 col-md-4 mx-auto" >
           
           	    <input type="button" id="load_previous" value="Načíst předchozí" onclick="Load_Previous();">
                
				</div>
           	 
                <div class="col-lg-4 col-md-4 mx-auto" >
           	 
                </div>
           
           </div>
		   <br>

	  
	 	  
		  
		  <?php
		   // show previous result button end
		   }
		   
		   //definition of counter before foreach
		    $counter = 0;
			
            foreach ($aQueryResults as $aQueryResult) {
				
                          $counter++;
				           
				           // only for first 10 rows of query
				           if ($counter < 11) 
				            {
				         				

				?>
				
				
	                   		<div class="row" style="background-color:#BCC6CC;padding: 10px;">
	                   			
	                   			<div class="col-lg-6 col-md-6 mx-auto" >
	                   			  <img src="<?php echo $aQueryResult->imgurl; ?>" alt="<?php echo $aQueryResult->productname; ?>" >
	                   			</div>
	                   			
	                   			<div class="col-lg-6 col-md-6 mx-auto" >					
	                   			<h2><?php echo $aQueryResult->productname; ?></h2>
	                   			<?php echo $aQueryResult->description; ?>
	                   			
	                   			<?php if( $aQueryResult->delivery_date == 0){						
	                   			echo "<br><br><b>Zboží skladem</b>";
	                   			  }?>
	                   			<br><br>
	                   			Cena: <b><?php echo $aQueryResult->price_vat; ?> Kč</b>
	                   			
	                   			<a href="<?php echo $aQueryResult->URL; ?>" onclick="func1111()">
	                   			<button style="float:right;">Navštívit obchod</button>	
	                   			</a>
                                  </div>
	                   			
	                   			
	                   		</div>
                        <br>

<?php

						   } //end of if
						   
						   // if there is more then 10 rows in result
						   else
						   {
							   $is_more_then_10 = true;	
						   }   
            } // end of foreach


?>


<div class="row">

     <div class="col-lg-4 col-md-4 mx-auto" >
     </div>
	 
     <div class="col-lg-4 col-md-4 mx-auto" >

     <?php 
	 // if exists another rows in database, show user load more
      if($is_more_then_10){
	 echo "<input type=\"button\" id=\"load\" value=\"Načíst další\" onclick=\"Load_More();\"> ";
	  }// end of if add load more
	 
	 ?>
     </div>
	 
     <div class="col-lg-4 col-md-4 mx-auto" >
	 
     </div>

</div>
  
<?php			
      

    } // end of query
		
		
	// info if admin	
	  global $current_user;
      wp_get_current_user() ;
      $current_user_1 = $current_user->user_login;
	  $current_user_1  = substr($current_user_1,0, 5);
     // insert log to database
	$sql_1 ="insert into " . $wpdb->prefix . "cust_products_log (query, query_after_prepare, login_user) values (%s, %s, %s) ;";
    $sql_prep_1 = $wpdb->prepare($sql_1, (string)$prepstring_final, (string)$prepstring_final2, (string)$current_user_1);
    $wpdb->query($sql_prep_1);

	

    wp_die();
}


/** ------------------------------- search live - end of final result script ------------------------------------------------------- **/


// css used at search page
add_action( 'wp_enqueue_scripts', 'bootstrap_spec_func' );
function bootstrap_spec_func() {

if (is_page( 'srovnavac-bydleni' ) || is_page( 'srovnavac-bydleni-dev' ) || is_tag('calounene-postele')){
wp_enqueue_style( 'bootstrap-grid-spec',  get_stylesheet_directory_uri() . '/css/bootstrap-grid.css' );
//wp_enqueue_style( 'bootstrap-grid-spec-all',  get_stylesheet_directory_uri() . '/css/bootstrap.css' );
}


}


/** ------------------------------- search live - final result script ------------------------------------------------------- **/

function leaving_popup_scripts_final() {
	

	 
    // Register the script
    wp_register_script( 'leaving-popup-custom-script-final', get_stylesheet_directory_uri(). '/js/leavingpopup.js', array( 'jquery' ), false, true );
  
  
    // Enqueued script with localized data.
    wp_enqueue_script( 'leaving-popup-custom-script-final' );
	

}


add_action('wp_enqueue_scripts', 'leaving_popup_scripts_final');


/** ------------------------------- end of search live - final result script ------------------------------------------------------- **/


/**
 * Show the banner when a html element with class 'cmplz-show-banner' is clicked
 */
function cmplz_show_banner_on_click() {
	?>
	<script>
        function addEvent(event, selector, callback, context) {
            document.addEventListener(event, e => {
                if ( e.target.closest(selector) ) {
                    callback(e);
                }
            });
        }
        addEvent('click', '.cmplz-show-banner', function(){
            document.querySelectorAll('.cmplz-manage-consent').forEach(obj => {
                obj.click();
            });
        });
	</script>
	<?php
}
add_action( 'wp_footer', 'cmplz_show_banner_on_click' );




