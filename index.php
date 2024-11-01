<?php
/*
Plugin Name: StickyZon Lite
Plugin URI: http://StickyZon.com/
Description: WordPress Affiliate Marketing Plugin Sticks and Monetizes Content Related Products on Blogs and Websites.
Date: 2016, Aug 6
Author: Ziki De Naim 
Author URI: http://StickyZon.com/
Version: 2.0
*/

/*
Author: Ziki De Naim
Website: http://www.PluginAlchemy.com
Copyright 2013-16 Ziki De Naim All Rights Reserved.

This software is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

include("includes/amazon_api_class.php");

//=====================================================================
// Menu Options Page
// =====================================================================
function stickyzon_create_menu() {

	// Create top-level menu
	add_menu_page( 'StickyZon Lite', 'StickyZon Lite', 'administrator', __FILE__, 'sz_home_page', plugins_url('images/stickyzon.png', __FILE__) );

}


// Plugin Home Page
function sz_home_page() {
?>
<div class="wrap">

<div id="poststuff" class="metabox-holder">
	<img src="<?php echo plugins_url('images/banner.png', __FILE__); ?>" title="StickyZon Pro" />
</div>


<div id="icon-link-manager" class="icon32"></div>
<h2>StickyZon Settings</h2>

<div id="poststuff" class="metabox-holder has-right-sidebar">

	<div class="inner-sidebar">
		<div id="side-sortables" class="meta-box-sortabless ui-sortable" style="position:relative;">
			<div id="sm_pnres" class="postbox">
				<h3 class="hndle"><span>About this Plugin:</span></h3>
				<div class="inside">
					<a class="sm_button sm_pluginHome" href="http://stickyzon.com" target="_blank">Plugin Homepage</a>
					<a class="sm_button sm_pluginHome" href="http://www.netcommarketing.com/Support/" target="_blank">Suggest a Feature</a>
					<a class="sm_button sm_pluginSupport" href="https://wordpress.org/plugins/stickyzon-lite/" target="_blank">Support Discussions</a>
					<a class="sm_button sm_pluginBugs" href="http://www.netcommarketing.com/Support/" target="_blank">Report a Bug</a>
					<a class="sm_button sm_pluginReview" href="https://wordpress.org/plugins/stickyzon-lite/" target="_blank">Submit Review</a>
					<a class="sm_button sm_donatePayPal" href="http://stickyzon.com/Donate.html" target="_blank">Donate with PayPal</a>
				</div>
			</div>

		<div id="sm_pnres" class="postbox">
				<h3 class="hndle"><span>Share Some Love:</span></h3>
				<div class="inside">
					<a href="https://www.facebook.com/pluginalchemy/" target="_blank"><img src="<?php echo plugins_url('stickyzon-lite'); ?>/images/facebook.png"></a>
					<a href="https://twitter.com/zikidenaim" target="_blank"><img src="<?php echo plugins_url('stickyzon-lite'); ?>/images/twitter.png"></a>
				</div>
			</div>

			<div id="sm_pnres" class="postbox">
				<h3 class="hndle"><span>StickyZon Lite Tutorial</span></h3>
				<div class="inside">
                    <a href="https://www.youtube.com/watch?v=wKmio6nYaq4&feature=youtu.be" rel="prettyPhoto" title="StickyZon Tutorial"><img src="http://stickyzon.com/images/plugin-alchemy-videobox-blue.jpg" alt="StickyZon Tutorial" width="250" /></a>
				</div>
			</div>

<div id="sm_pnres" class="postbox">
				<h3 class="hndle"><span>StickyZon Pro Tutorial</span></h3>
				<div class="inside">
                    <a href="https://www.youtube.com/watch?v=zo2FGwVcAe8&feature=youtu.be" rel="prettyPhoto" title="StickyZon Tutorial"><img src="http://stickyzon.com/images/plugin-alchemy-videobox-blue.jpg" alt="StickyZon Tutorial" width="250" /></a>
                    <center><br/><h3><a href="http://stickyzon.com">Check out StickyZon Pro</a></h3></center>
				</div>
			</div>

		</div>
	</div>

	<div class="has-sidebar sm-padded">
	<div id="post-body-content" class="has-sidebar-content">
	<div class="meta-box-sortabless">

	<div class="postbox">
	<h3 class="hndle">General Settings</h3>
	<div class="inside">

		<?php $szSettingsOpt = get_option('sz_Settings'); ?>

		<form method="post" action="">
		<table>
		<tr>
			<td colspan=2><p><input type="checkbox" name="enableTags" value="1" <?php if(($szSettingsOpt['enableTags']) == 1 ) echo 'checked="checked"'; ?> /> Use Post Tags to search products <img src="<?php echo plugins_url('assets/css/images/question_blue.png', __FILE__); ?>" title="Check this to enable product search using post tags"/></p></td>
		</tr>
		<tr>
			<td colspan=2><p><input type="checkbox" name="enableCategories" value="1" <?php if(($szSettingsOpt['enableCategories']) == 1) echo 'checked="checked"'; ?> /> Use Post Categories to search products <img src="<?php echo plugins_url('assets/css/images/question_blue.png', __FILE__); ?>" title="Check this to enable product search using post categories"/></p></td>
		</tr>
		<tr>
			<td colspan=2><p>Default search keywords: <input type="text" size="60" name="defaultKeywords" value="<?php echo $szSettingsOpt[defaultKeywords]; ?>" title="Default search keywords" /> <img src="<?php echo plugins_url('assets/css/images/question_blue.png', __FILE__); ?>" title="Enter default search keywords that will be used if no products found using tags or categories"/></p></td>
		</tr>
		<tr>
			<td><p>Widget Title:</p></td>
			<td><p><input type="text" size="40" name="widgetTitle" value="<?php echo $szSettingsOpt[widgetTitle]; ?>" /> <img src="<?php echo plugins_url('assets/css/images/question_blue.png', __FILE__); ?>" title="Set a title for product widget section"/></p></td>
		</tr>
		<tr>
			<td><p>Buy Now Link Text:</p></td>
			<td><p><input type="text" size="20" name="buyNowText" value="<?php echo $szSettingsOpt[buyNowText]; ?>" /> <img src="<?php echo plugins_url('assets/css/images/question_blue.png', __FILE__); ?>" title="Set product link anchor text"/></p></td>
		</tr>
		<tr>
			<td colspan=2><p><input type="checkbox" name="enableSponsorLink" value="1" <?php if(($szSettingsOpt['enableSponsorLink']) == 1) echo 'checked="checked"'; ?> /> Show sponsor link <img src="<?php echo plugins_url('assets/css/images/question_blue.png', __FILE__); ?>" title="Check this if you want to enable sponsor link and show some love"/></p></td>
		</tr>
		<tr>
			<td colspan=2>
			<p class="submit">
			<input type="hidden" name="sz_settings" value="Y" />
			<input type="submit" class="button-primary" value="<?php _e('Save') ?>" />
			</p>
			</td>
		</tr>
		</table>
		</form>

	</div>
	</div> <!--postbox-->


	<div class="postbox">
	<h3 class="hndle">Amazon Settings</h3>
	<div class="inside">

		<?php $szAmazonOpt = get_option('sz_Amazon_Settings'); ?>

		<form method="post" action="">
		<table>
		<tr>
			<td><p>Amazon Affiliate ID:</p></td>
			<td><p><input type="text" size="20" name="amazonAssociateId" value="<?php echo $szAmazonOpt[amazonAssociateId]; ?>" />  <img src="<?php echo plugins_url('assets/css/images/question_blue.png', __FILE__); ?>" title="Enter your Amazon Associate Id"/></p></td>
		</tr>
		<tr>
			<td><p>API Key (Access Key ID):</p></td>
			<td><p><input type="text" size="30" name="amazonApiKey" value="<?php echo $szAmazonOpt[amazonApiKey]; ?>" />  <img src="<?php echo plugins_url('assets/css/images/question_blue.png', __FILE__); ?>" title="Enter your Amazon API Key"/></p></td>
		</tr>
		<tr>
			<td><p>Secret Access Key:</p></td>
			<td><p><input type="text" size="50" name="amazonSecret" value="<?php echo $szAmazonOpt[amazonSecret]; ?>" />  <img src="<?php echo plugins_url('assets/css/images/question_blue.png', __FILE__); ?>" title="Enter your Amazon Secret"/></p></td>
		</tr>
		<tr>
			<td><p>Amazon Product Category:</p></td>
			<td>
			<p><select name="amazonCategory">
			<option value="All" <?php if ($szAmazonOpt['amazonCategory'] == 'All') echo 'selected';?>> All
			<option value="Apparel" <?php if ($szAmazonOpt['amazonCategory'] == 'Apparel') echo 'selected';?>> Apparel
			<option value="Appliances" <?php if ($szAmazonOpt['amazonCategory'] == 'Appliances') echo 'selected';?>> Appliances
			<option value="ArtsAndCrafts" <?php if ($szAmazonOpt['amazonCategory'] == 'ArtsAndCrafts') echo 'selected';?>> Arts And Crafts
			<option value="Automotive" <?php if ($szAmazonOpt['amazonCategory'] == 'Automotive') echo 'selected';?>> Automotive
			<option value="Baby" <?php if ($szAmazonOpt['amazonCategory'] == 'Baby') echo 'selected';?>> Baby
			<option value="Beauty" <?php if ($szAmazonOpt['amazonCategory'] == 'Beauty') echo 'selected';?>> Beauty
			<option value="Blended" <?php if ($szAmazonOpt['amazonCategory'] == 'Blended') echo 'selected';?>> Blended
			<option value="Books" <?php if ($szAmazonOpt['amazonCategory'] == 'Books') echo 'selected';?>> Books
			<option value="Classical" <?php if ($szAmazonOpt['amazonCategory'] == 'Classical') echo 'selected';?>> Classical
			<option value="Collectibles" <?php if ($szAmazonOpt['amazonCategory'] == 'Collectibles') echo 'selected';?>> Collectibles
			<option value="DigitalMusic" <?php if ($szAmazonOpt['amazonCategory'] == 'DigitalMusic') echo 'selected';?>> Digital Music
			<option value="DVD" <?php if ($szAmazonOpt['amazonCategory'] == 'DVD') echo 'selected';?>> DVD
			<option value="Electronics" <?php if ($szAmazonOpt['amazonCategory'] == 'Electronics') echo 'selected';?>> Electronics
			<option value="Garden" <?php if ($szAmazonOpt['amazonCategory'] == 'Garden') echo 'selected';?>> Garden	 	 
			<option value="GourmetFood" <?php if ($szAmazonOpt['amazonCategory'] == 'Gourmet Food') echo 'selected';?>> Gourmet Food
			<option value="Grocery" <?php if ($szAmazonOpt['amazonCategory'] == 'Grocery') echo 'selected';?>> Grocery
			<option value="HealthPersonalCare" <?php if ($szAmazonOpt['amazonCategory'] == 'Health Personal Care') echo 'selected';?>> Health Personal Care
			<option value="Hobbies" <?php if ($szAmazonOpt['amazonCategory'] == 'Hobbies') echo 'selected';?>> Hobbies
			<option value="Home" <?php if ($szAmazonOpt['amazonCategory'] == 'Home') echo 'selected';?>> Home
			<option value="HomeGarden" <?php if ($szAmazonOpt['amazonCategory'] == 'HomeGarden') echo 'selected';?>> Home Garden
			<option value="HomeImprovement" <?php if ($szAmazonOpt['amazonCategory'] == 'HomeImprovement') echo 'selected';?>> Home Improvement
			<option value="Industrial" <?php if ($szAmazonOpt['amazonCategory'] == 'Industrial') echo 'selected';?>> Industrial
			<option value="Jewelry" <?php if ($szAmazonOpt['amazonCategory'] == 'Jewelry') echo 'selected';?>> Jewelry
			<option value="KindleStore" <?php if ($szAmazonOpt['amazonCategory'] == 'KindleStore') echo 'selected';?>> Kindle Store
			<option value="Kitchen" <?php if ($szAmazonOpt['amazonCategory'] == 'Kitchen') echo 'selected';?>> Kitchen
			<option value="LawnAndGarden" <?php if ($szAmazonOpt['amazonCategory'] == 'LawnAndGarden') echo 'selected';?>> Lawn And Garden
			<option value="Lighting" <?php if ($szAmazonOpt['amazonCategory'] == 'Lighting') echo 'selected';?>> Lighting
			<option value="Magazines" <?php if ($szAmazonOpt['amazonCategory'] == 'Magazines') echo 'selected';?>> Magazines
			<option value="Marketplace" <?php if ($szAmazonOpt['amazonCategory'] == 'Marketplace') echo 'selected';?>> Marketplace
			<option value="Miscellaneous" <?php if ($szAmazonOpt['amazonCategory'] == 'Miscellaneous') echo 'selected';?>> Miscellaneous
			<option value="MobileApps" <?php if ($szAmazonOpt['amazonCategory'] == 'MobileApps') echo 'selected';?>> Mobile Apps
			<option value="MP3Downloads" <?php if ($szAmazonOpt['amazonCategory'] == 'MP3Downloads') echo 'selected';?>> MP3 Downloads
			<option value="Music" <?php if ($szAmazonOpt['amazonCategory'] == 'Music') echo 'selected';?>> Music
			<option value="MusicalInstruments" <?php if ($szAmazonOpt['amazonCategory'] == 'MusicalInstruments') echo 'selected';?>> Musical Instruments
			<option value="MusicTracks" <?php if ($szAmazonOpt['amazonCategory'] == 'MusicTracks') echo 'selected';?>> Music Tracks
			<option value="OfficeProducts" <?php if ($szAmazonOpt['amazonCategory'] == 'OfficeProducts') echo 'selected';?>> Office Products
			<option value="OutdoorLiving" <?php if ($szAmazonOpt['amazonCategory'] == 'OutdoorLiving') echo 'selected';?>> Outdoor Living
			<option value="PCHardware" <?php if ($szAmazonOpt['amazonCategory'] == 'PCHardware') echo 'selected';?>> PC Hardware
			<option value="PetSupplies" <?php if ($szAmazonOpt['amazonCategory'] == 'PetSupplies') echo 'selected';?>> Pet Supplies
			<option value="Photo" <?php if ($szAmazonOpt['amazonCategory'] == 'Photo') echo 'selected';?>> Photo
			<option value="Shoes" <?php if ($szAmazonOpt['amazonCategory'] == 'Shoes') echo 'selected';?>> Shoes
			<option value="Software" <?php if ($szAmazonOpt['amazonCategory'] == 'Software') echo 'selected';?>> Software
			<option value="SportingGoods" <?php if ($szAmazonOpt['amazonCategory'] == 'SportingGoods') echo 'selected';?>> Sporting Goods
			<option value="Tools" <?php if ($szAmazonOpt['amazonCategory'] == 'Tools') echo 'selected';?>> Tools
			<option value="Toys" <?php if ($szAmazonOpt['amazonCategory'] == 'Toys') echo 'selected';?>> Toys
			<option value="VHS" <?php if ($szAmazonOpt['amazonCategory'] == 'VHS') echo 'selected';?>> VHS
			<option value="Video" <?php if ($szAmazonOpt['amazonCategory'] == 'Video') echo 'selected';?>> Video
			<option value="VideoGames" <?php if ($szAmazonOpt['amazonCategory'] == 'VideoGames') echo 'selected';?>> Video Games
			<option value="Watches" <?php if ($szAmazonOpt['amazonCategory'] == 'Watches') echo 'selected';?>> Watches
			<option value="Wireless" <?php if ($szAmazonOpt['amazonCategory'] == 'Wireless') echo 'selected';?>> Wireless
			<option value="WirelessAccessories" <?php if ($szAmazonOpt['amazonCategory'] == 'WirelessAccessories') echo 'selected';?>> Wireless Accessories
			</select>  <img src="<?php echo plugins_url('assets/css/images/question_blue.png', __FILE__); ?>" title="Select the Amazon product depertment"/></p>
			</td>
		</tr>
		<tr>
			<td colspan=2>
				<p class="submit">
				<input type="hidden" name="sz_updateAmazon" value="Y" />
				<input type="submit" class="button-primary" value="<?php _e('Save') ?>" />
				</p>
			</td>
		</tr>
		</table>
		</form>

	</div>
	</div> <!--postbox-->


	<div class="postbox">
	<h3 class="hndle">Amazon Associates</h3>
	<div class="inside">

		<p>Earn up to 10% advertising fees with a trusted e-commerce leader. Choose from over a million products
to advertise to your customers.</p>

		<h2><a href="http://affiliate-program.amazon.com/gp/associates/apply/main.html" target="_blank" title="Signup with Amazon Associates">Signup with Amazon Associates</a></h2>

	</div>
	</div> <!--postbox-->
	
	<div class="postbox">
	<div class="inside">

			<p><a href="http://pluginalchemy.com/" target="_blank"><img src="<?php echo plugins_url('images/pluginalchemy_logo.png', __FILE__); ?>" title="Plugin Alchemy" /></a></p>

	</div>
	</div> <!--postbox-->


	</div> <!--has-sidebar-content-->
	</div> <!--meta-box-sortabless-->
	</div> <!--has-sidebar sm-padded-->


</div> <!--metabox-holder has-right-sidebar-->
</div> <!--wrap-->

<?php
}


if( $_POST['sz_settings'] == 'Y' ) {
	
	$tagCheckbox = isset($_POST["enableTags"]) ? $_POST["enableTags"] : 0;
	$categoryCheckbox = isset($_POST["enableCategories"]) ? $_POST["enableCategories"] : 0;
	$sponsorCheckbox = isset($_POST["enableSponsorLink"]) ? $_POST["enableSponsorLink"] : 0;

	$szSettingsOpt = array (
    	'enableTags' => $tagCheckbox,
    	'enableCategories' => $categoryCheckbox,
    	'defaultKeywords' => $_POST['defaultKeywords'],
    	'widgetTitle' => $_POST['widgetTitle'],
    	'buyNowText' => $_POST['buyNowText'],
    	'enableSponsorLink' => $sponsorCheckbox
	);

	update_option('sz_Settings', $szSettingsOpt);

	echo '<div class="updated"><p><strong>StickyZon Settings updated successfully.</strong></p></div>';

}


if( $_POST['sz_updateAmazon'] == 'Y' ) {
	
	$szAmazonOpt = array (
    	'amazonAssociateId' => $_POST['amazonAssociateId'],
    	'amazonApiKey' => $_POST['amazonApiKey'],
    	'amazonSecret' => $_POST['amazonSecret'],
    	'amazonCategory' => $_POST['amazonCategory']
	);

	update_option('sz_Amazon_Settings', $szAmazonOpt);

	echo '<div class="updated"><p><strong>Amazon settings updated successfully.</strong></p></div>';

} 


//=====================================================================================
// Modify post content before showing on page and link the keywords with affiliate link
//=====================================================================================
function prepare_stickyzon( $post_content ) {

	global $post;

	// Skip if it is feed or homepage
	if( is_feed() || is_home() )
		return $post_content;

	$szSettingsOpt = get_option('sz_Settings');

	// Grab the search terms
	$arrSearchTerms = array();

	if( $szSettingsOpt['enableTags'] == 1 ) {

		$posttags = get_the_tags($post->ID);
		if( $posttags ) {
			foreach( $posttags as $tag ) {
     			$arrSearchTerms[] = $tag->name;
  			}
		}
	}
	if( $szSettingsOpt['enableCategories'] == 1 ) {

		$category = get_the_category(); 
		$arrSearchTerms[] = $category[0]->cat_name;
	} 
	if( !empty($szSettingsOpt['defaultKeywords']) ) {
		$defaultKeys = explode(',', $szSettingsOpt['defaultKeywords']);
		$arrSearchTerms = array_merge((array)$arrSearchTerms, (array)$defaultKeys);
	}
	
	// Grab the search terms
	if( empty($arrSearchTerms) ) return $post_content;
	else shuffle($arrSearchTerms);

	$products = sz_search_products( $arrSearchTerms);

	// Widget Outputs
	$strProducts = '';

	if( !empty($products) ) { 
    
    	$strProducts .= '<div id="sz-wrapper">';
		$strProducts .= '<div id="sz-widget-title">'. $szSettingsOpt['widgetTitle'] .'</div>';

		$productsFound = count($products);
		$showProducts = ( $productsFound < 4 ? $productsFound : 4 );

		for( $i=0; $i<$showProducts; $i++ ) {

			$strProducts .= '<div id="sz-product-wrap">';
	 	   	$strProducts .= '<div id="sz-product-img"><img src="'.$products[$i]['image'].'" class="sz-product-img" alt="'.$products[$i]['title'].'" title="'.$products[$i]['title'].'" /></div>';
	    	$strProducts .= '<div id="sz-product-title"><a href="'.$products[$i]['url'].'" title="'.$products[$i]['title'].'" target="_blank">'. substr($products[$i]['title'], 0, 40) .'</a></div>';	
	    	$strProducts .= '<div id="sz-product-price">Price: '.$products[$i]['price'].'</div>';
	    	$strProducts .= '<div id="sz-product-link"><a href="'.$products[$i]['url'].'" title="'.$products[$i]['title'].'" target="_blank">'. $szSettingsOpt['buyNowText'] .'</a></div>';
	    	$strProducts .= '</div>';
		}

		if( $szSettingsOpt['enableSponsorLink'] == 1 )
    	$strProducts .= '<div id="sz-sponsor"><a href="http://stickyzon.com" title="Powered By StickyZon" target="_blank">Powered By StickyZon</a></div>';

    	$strProducts .= '</div>';

	}

	$post_content = $post_content . $strProducts;

	return $post_content;

}

function sz_search_products( $arrSearchTerms ) {

	$products = array();
	$szSettingsOpt = get_option('sz_Settings');
	$szAmazonOpt = get_option('sz_Amazon_Settings');

	if( empty($szAmazonOpt['amazonApiKey']) OR empty($szAmazonOpt['amazonSecret']) OR empty($szAmazonOpt['amazonAssociateId']) )
		return;


    $obj = new AmazonProductAPI();
    try {
        $result = $obj->searchProducts(	$arrSearchTerms[0],
										$szAmazonOpt['amazonCategory'],
										"TITLE",
										$szAmazonOpt['amazonApiKey'],
										$szAmazonOpt['amazonSecret'],
										$szAmazonOpt['amazonAssociateId']
										);
    } catch(Exception $e) {
        echo $e->getMessage();
    }
    //print_r($result);

	if( !empty($result) ) { 

		$productsFound = count($result->Items->Item);
		for( $i=0; $i<$productsFound; $i++ ) {

		    $products[$i]['title'] = (string) $result->Items->Item[$i]->ItemAttributes->Title;
		    $products[$i]['image'] = (string) $result->Items->Item[$i]->MediumImage->URL;
		    $products[$i]['price'] = (string) $result->Items->Item[$i]->OfferSummary->LowestNewPrice->FormattedPrice;
		    $products[$i]['url'] = (string) $result->Items->Item[$i]->DetailPageURL;
		}

		shuffle($products);
		return $products;

	}
	else return;

}

// Enqueue scripts
function sz_add_scripts() {
 
	wp_register_style( 'sz_styles', plugins_url('stickyzon-lite') . '/assets/css/sz-styles.css', false, '1.0.0' );
	wp_enqueue_style( 'sz_styles' );

	wp_register_style( 'sz_uistyles', 'http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css', false, '1.10.3' );
	wp_enqueue_style( 'sz_uistyles' );

	wp_enqueue_script( 'jquery-ui', 'http://code.jquery.com/ui/1.11.4/jquery-ui.min.js', array(), '1.0.0', true );
	wp_enqueue_script( 'sz_script', plugins_url('stickyzon-lite') . '/assets/js/sz_script.js', array(), '1.0.0', true );

	wp_enqueue_script( 'prettyPhoto_script', plugins_url('stickyzon-lite') . '/assets/js/prettyPhoto/jquery.prettyPhoto.js', array(), '3.1.6', true );
	wp_register_style( 'prettyPhoto_styles', plugins_url('stickyzon-lite') . '/assets/js/prettyPhoto/css/prettyPhoto.css', false, '3.1.6' );
	wp_enqueue_style( 'prettyPhoto_styles' );

}
add_action( 'admin_enqueue_scripts', 'sz_add_scripts' );
add_action( 'wp_enqueue_scripts', 'sz_add_scripts' );

// create custom plugin settings menu
add_action( 'admin_menu', 'stickyzon_create_menu');

add_action('init', 'sz_activate_au');

function sz_activate_au() {
    require_once ('sz_autoupdate.php');
    $sz_plugin_current_version = '1.8';
    $sz_plugin_remote_path = 'https://s3.amazonaws.com/stickyzon/repository/sz_autoupdate.php';
    $sz_plugin_slug = plugin_basename(__FILE__);
    new sz_autoupdate ($sz_plugin_current_version, $sz_plugin_remote_path, $sz_plugin_slug);
}
// Prepare content before pageview
add_filter('the_content', 'prepare_stickyzon', 5);
