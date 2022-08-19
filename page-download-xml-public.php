<?php
/**
 *
 * Template Name: page-download-xml-public
 * @package WordPress
 * @subpackage furniturecomparison
 * @since furniturecomparison 1.0.0
 */
get_header();
 
 ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
	
		<?php
		// Start the loop.
		while ( have_posts() ) :
			the_post(); ?>

		<?php		
		//DOWNLOAD XML ------------------				//links to xml files to download, first is name of saved xml file, second link to xml, third the number of seller in database table cust_seller				// to create workable solution, you need to SET PROPER LINKS TO XML SOURCES !!! And set number of links in code below.
		$links_to_xml = array (
					array('maxipostele','https://feeds.mergado.com/maxi-postele-cz-heureka-cz-547c7feaccc42a8747a8470128bbfec9.xml',1),
					array('donashop','https://dona-shop.cz/feed/heureka.xml',2),
					array('primazidle','https://feeds.mergado.com/primazidle-cz-heureka-cz-82de897860360949484e120826c76d5c.xml', 3),
					array('povlecemevas','https://www.povlecemevas.cz/heureka/export/products.xml', 4),
					array('nejlevnejsipodlahy','http://www.nejlevnejsipodlahy.cz/customdatafeed/9baf0a13-0f59-477b-8e1f-88ffa9ca9e5d', 5),
					array('nabytekforliving','https://www.nabytek-forliving.cz/export/ehub.xml', 6)
                    //array('kutilcz','https://www.kutil.cz/feed/heureka', 6),
                    //array('idomacipotreby','http://www.i-domacipotreby.cz/export/heureka_cs.xml', 7),
					);	
			// ------- SET PARAMETERS !!!! for developer purspose ----------------------------
			// need to be changed manually - NUMBER OF LINKS in $links_to_xml !!
			$number_of_links = 6;
			// xml will DOWNLOAD if set to 1, if se to 0, download will ignore	
			$download_xml_turn_on = 1;		
			// UPLOAD to PRODUCTION TABLE if set to 1, if set to 0, upload to developer table
			$upload_to_prod_table = 1;		
		    // --------------- set default table  ---------------------
			if($upload_to_prod_table)
			{
				// upload to prod table
				$target_table = 'oxek_cust_products';
			}
			else
			{
				// upload to developer table
				$target_table = 'oxek_cust_products_dev';
			}		
	    // ----------- downloading XML - SET PROPER LOCATION FOR XML DOWNLOADING!"      --------------------------	
		if($download_xml_turn_on){

			for ($i = 0; $i < $number_of_links; $i++) 
			{
			$file = $links_to_xml[$i][1];			// --- change location for downloading xml ---
			$newfile = '/data/web/virtuals/214410/virtual/www/domains/pohadkovebydleni.cz/wp-content/uploads/xml/' . $links_to_xml[$i][0] . '.xml';
			if(copy($file, $newfile)){					
				}
			else
			{				
				}

			} //end of for
			
		} // end of if downlaod xml turn on
				
		//END OF DOWNLOAD XML -------------------
		
//----------------------SAVE DATA TO DATABASE ------------------

global $wpdb;
//---------------------- FIRST CREATE INFO IN TABLE oxek_cust_products_insert_data_info, id and actual time is created in database ------------//

$info_table = 'oxek_cust_products_insert_data_info';
$sql_insert = 'INSERT INTO ' . $info_table   . '
              (is_product_table) 
            VALUES
              (%d) ;';

$sql_prep_insert = $wpdb->prepare($sql_insert,
                        (integer)$upload_to_prod_table);
		
$wpdb->query($sql_prep_insert);

//---------------------- SECOND GET INSERTED ID FROM TABLE oxek_cust_products_insert_data_info ------------//
$sql_get = 'SELECT id FROM ' . $info_table   . ' ORDER BY id DESC LIMIT 1;';

$sql_prep_get = $wpdb->prepare($sql_get);
		
$results_of_get_id = $wpdb->get_results($sql_prep_get);

foreach($results_of_get_id as $result_of_get_id)
{
	$id_inserted = $result_of_get_id->id;
}
//------------------ for goes through all links. SET PROPER LOCATION WHERE XML DOWNLOADED ----------

for ($i = 0; $i < $number_of_links; $i++) 
{ 
$xml = simplexml_load_file('/data/web/virtuals/214410/virtual/www/domains/pohadkovebydleni.cz/wp-content/uploads/xml/' . $links_to_xml[$i][0] . '.xml') or die("Error: Cannot create object");
// delete all values from given seller before import
$sql_1 ="delete from " . $target_table ." where seller = %d";
$sql_prep_1 = $wpdb->prepare($sql_1, (integer)$links_to_xml[$i][2]);
$wpdb->query($sql_prep_1);

//----------- foreach goes through specific xml-------
foreach($xml->SHOPITEM as $item){    
// ---------- default values of variables --------------
$manufacturer = "-";
$deliverydate = "9999";
$item_ean = "-";
$categtxt = "-";
$whatIWantWithoutSpace = "-";
$categorytext_all = "-";

// ------------ assign xml items to variable ------------

$itemid = strval($item->ITEM_ID);
$seller_number = $links_to_xml[$i][2];
$productname = $item->PRODUCTNAME;
$product = $item->PRODUCT;
$imgurl = $item->IMGURL;
$description = $item->DESCRIPTION;						
$price = intval($item->PRICE_VAT);
$manufacturer = $item->MANUFACTURER;
$deliverydate = $item->DELIVERY_DATE;

$categtxt = $item->CATEGORYTEXT; 
$categorytext_all = str_replace('|', '-', $categtxt);
$categorytext_all = str_replace('|', '-', $categorytext_all);


$whatIWantWithoutSpace;
// get last category  
//check if string contain | 
if (strpos($categtxt, '|') !== false) { 
   $whatIWant = substr($categtxt, strrpos($categtxt, '|') + 1); 
   //$whatIWantWithoutSpace = preg_replace('/\s+/', '', $whatIWant);
   $whatIWantWithoutSpace = trim($whatIWant);
}
else
{ 
$whatIWantWithoutSpace = trim($categtxt); 
}	

$whatIWantWithoutSpace = mb_strtolower($whatIWantWithoutSpace);

$item_url = $item->URL;
$item_ean = $item->EAN;
// ----------- print variable to table ---------------------
// ---------------- EDIT VALUES FROM XML SOURCES. DIFFERENT CHANGES IN DIFFERENT XML VALUES FROM DIFFERENT ESHOPS. DEPENDS ON SOURCE XML. ---
// ---------------- edit categories ---------------------------
			if($whatIWantWithoutSpace == 'árkové poukazy')
			{
				$whatIWantWithoutSpace = 'Dárkové poukazy';
			}
		// ------------ if seller is donashop -----------------------
		
			if($links_to_xml[$i][2]==2){
						
			$whatIWantWithoutSpace = trim(mb_strtolower($whatIWantWithoutSpace));
		   	switch ($whatIWantWithoutSpace) {			
                 case "kuchyně":
                   $whatIWantWithoutSpace = "Kuchyně ostatní";
                   break;
                 case "organizace kuchyně":
                   $whatIWantWithoutSpace = "Kuchyně ostatní";
                   break;		
                 		 
             } // end of switch

		    }// end of if  

         // ---------- if seller is povlecemevas ---------------------
						if($links_to_xml[$i][4]==4){
						
			$whatIWantWithoutSpace = trim(mb_strtolower($whatIWantWithoutSpace));

		   	switch ($whatIWantWithoutSpace) {
				
				
                 case "ložnice":
                   $whatIWantWithoutSpace = "prostěradla";
                   break;		
                 		 
             } // end of switch			 
		    }// end of if 
		// ---------- if seller is nejlevnejsipodlahy ---------------------
		elseif($links_to_xml[$i][2]==5){
						
			// get first part of category string
			$arr = explode("|", $item->CATEGORYTEXT, 2);
            $whatIWantWithoutSpace = $arr[0];
			
			$whatIWantWithoutSpace = trim(mb_strtolower($whatIWantWithoutSpace));

			// filter out problematic description
			if(strpos(mb_strtolower($description), "span style") == true) 
			{
			$descripiton = null;
			}
			
		   	switch ($whatIWantWithoutSpace) {
				
				
                 case "doplňky":
                   $whatIWantWithoutSpace = "Doplňky podlahy";
                   break;
                 case "dřevěné podlahy":
                   $whatIWantWithoutSpace = "Dřevěné podlahy";
                   break;		
                 case "ekologické podlahy":
                   $whatIWantWithoutSpace = "Ekologické podlahy";
                   break;	
                 case "koberce":
                   $whatIWantWithoutSpace = "Koberce";
                   break;	
                 case "plovoucí dřevěné podlahy":
                   $whatIWantWithoutSpace = "Plovoucí dřevěné podlahy";
                   break;	
                 case "plovoucí korkové podlahy":
                   $whatIWantWithoutSpace = "Plovoucí korkové podlahy";
                   break;	
                 case "plovoucí laminátové podlahy":
                   $whatIWantWithoutSpace = "Plovoucí laminátové podlahy";
                   break;	
                 case "podlahové lišty":
                   $whatIWantWithoutSpace = "Podlahové lišty";
                   break;
                 case "podlahové podložky":
                   $whatIWantWithoutSpace = "Podlahové podložky";
                   break;
                 case "přechodové lišty":
                   $whatIWantWithoutSpace = "Přechodové lišty";
                   break;
                 case "pvc role":
                   $whatIWantWithoutSpace = "PVC role";
                   break;
                 case "stavební chemie":
                   $whatIWantWithoutSpace = "Stavební chemie";
                   break;				   
                 case "vinylové podlahy":
                   $whatIWantWithoutSpace = "Vinylové podlahy";
                   break;				   
                 case "stavební chemie":
                   $whatIWantWithoutSpace = "Stavební chemie";
                   break;				   
                 case "výprodej":
                   $whatIWantWithoutSpace = "Výprodej";
                   break;				   
 
				 default:
                   $whatIWantWithoutSpace = null;				 
						   
	   
             } // end of switch
			 
		    }// end of if seller 5
			
	// ------------ if seller is nabytekforliving -----------------------
		
			if($links_to_xml[$i][6]==6){
						
			$whatIWantWithoutSpace = trim(mb_strtolower($whatIWantWithoutSpace));
			
		   	switch ($whatIWantWithoutSpace) {		
                 case "kuchyně":
                   $whatIWantWithoutSpace = "Kuchyně ostatní";
                   break;	
                 		 
             } // end of switch

		    }// end of if  		
	// change of category
	
	if( strpos($whatIWantWithoutSpace, "barové židle") || strpos($whatIWantWithoutSpace, "barové stolky") || strpos($whatIWantWithoutSpace, "barový nábytek") )
	{
	$whatIWantWithoutSpace = "barové židle a stolky";
	}
	if($whatIWantWithoutSpace == "matrace")
	{
       if( strpos(mb_strtolower($productname), "chránič"))
       {
          $whatIWantWithoutSpace = "chrániče na matrace"  ;
       }
	   
    }	   
	
	if($whatIWantWithoutSpace == "koberce")
	{

          $whatIWantWithoutSpace = "koberce a koberečky"  ;
	   
    }
	if($whatIWantWithoutSpace == "matrace")
	{
        if($price<659)
		{
			$whatIWantWithoutSpace = null;
		}
    }	
	
	if($whatIWantWithoutSpace == "křesla")
	{
        if($price<3659)
		{
			$whatIWantWithoutSpace = null;
		}
    }	
	
	if($whatIWantWithoutSpace == "postele")
	{
        if(strpos(mb_strtolower($productname), "šuplík pod post"))
		{
			$whatIWantWithoutSpace = "šuplíky pod postel";
		}
    }	
	
	
	if($whatIWantWithoutSpace == "obývací stěny")
	{
        if(strpos(mb_strtolower($productname), "sestava") || strpos(mb_strtolower($productname), "stěna")|| strpos(mb_strtolower($productname), "obývací pokoj"))
		{
          $whatIWantWithoutSpace = "obývací stěny"  ;
		}
		else
		{
			$whatIWantWithoutSpace = null;
		}
    }
	
	if($whatIWantWithoutSpace == "sedací soupravy")
	{
				
        if(strpos(mb_strtolower($productname), "sedací soupr") && ($price>8950))
		{
          $whatIWantWithoutSpace = "sedací soupravy"  ;
		}
        elseif(strpos(mb_strtolower($productname), "křesl") )
		{
          $whatIWantWithoutSpace = "křesla"  ;
		}
		elseif(strpos(mb_strtolower($productname), "pohovk") )
		{
          $whatIWantWithoutSpace = "pohovky"  ;
		}
		else
		{
			$whatIWantWithoutSpace = null;
		}
    }	
	if($whatIWantWithoutSpace == "kuchyňské linky")
	{
		if($price>3700)
				
		{

        if(strpos(mb_strtolower($productname), "kuchyňská link") || strpos(mb_strtolower($productname), "kitchen set")|| strpos(mb_strtolower($productname), "rohová kuchyně"))

		{
			$whatIWantWithoutSpace = "kuchyňské linky";
		}
		
		}
		
		else
		{
			$whatIWantWithoutSpace = null;
		}
		
    }	
	
// ------------- prepare SQL -----------------------------			
	   $sql = 'INSERT INTO ' . $target_table   . '
              (item_id, seller, productname, product, imgurl, description, price_vat, manufacturer, delivery_date, categorytext, URL, EAN, categorytext_all, id_insert_data_info) 
            VALUES
              (%s, %d, %s, %s, %s, %s, %d, %s, %s, %s, %s, %s, %s, %d ) ;';

    $sql_prep = $wpdb->prepare($sql,
                        (string)$itemid,
                        (integer)$seller_number,
                        (string)$productname,
                        (string)$product,
                        (string)$imgurl,
                        (string)$description,						
                        (integer)$price,
                        (string)$manufacturer,
                        (string)$deliverydate,
                        (string)$whatIWantWithoutSpace,							
                        (string)$item_url,
                        (string)$item_ean,
						(string)$categorytext_all,
						(integer)$id_inserted);	
    $wpdb->query($sql_prep);
} //----------- end of foreach which goes through specific xml ----------

} // ------------ end of for which goes through all links
//---------------------- GET NUMBER OF ROWS INSERTED IN TABLE oxek_cust_products  ------------//

$sql_get_number_of_rows = 'SELECT count(*) as totalcount FROM ' . $target_table   . ' WHERE id_insert_data_info=' . $id_inserted . ';';

$sql_prep_get_number_of_rows = $wpdb->prepare($sql_get_number_of_rows);
		
$results_of_get_number_of_rows = $wpdb->get_results($sql_prep_get_number_of_rows);

foreach($results_of_get_number_of_rows as $result_of_get_number_of_rows)
{
	$inserted_rows_to_table = $result_of_get_number_of_rows->totalcount;
}
//---------------------- UPDATE INFO IN TABLE oxek_cust_products_insert_data_info about number of rows inserted ------------//
$sql_update_number_of_rows = 'UPDATE ' . $info_table   . ' SET number_of_inserted_records = '. $inserted_rows_to_table .' WHERE id = ' . $id_inserted . ';';

$sql_update_number_of_rows_p = $wpdb->prepare($sql_update_number_of_rows);
		
$wpdb->query($sql_update_number_of_rows_p);
//----------------------END OF SAVE DATA TO DATABASE ------------------
	 ?>   
	   <?php 
	 // End the loop
	 endwhile;
	 ?>
	</main> 
</div> <!-- content area -->	
<?php get_footer(); ?>						   

