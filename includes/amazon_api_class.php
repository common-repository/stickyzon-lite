<?php

    /**
     * Class to access Amazons Product Advertising API
     * @author Sameer Borate
     * @link http://www.codediesel.com
     * @version 1.0
     * All requests are not implemented here. You can easily
     * implement the others from the ones given below.
     */
    
    
    /*
    Permission is hereby granted, free of charge, to any person obtaining a
    copy of this software and associated documentation files (the "Software"),
    to deal in the Software without restriction, including without limitation
    the rights to use, copy, modify, merge, publish, distribute, sublicense,
    and/or sell copies of the Software, and to permit persons to whom the
    Software is furnished to do so, subject to the following conditions:
    
    The above copyright notice and this permission notice shall be included in
    all copies or substantial portions of the Software.
    
    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
    THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
    FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
    DEALINGS IN THE SOFTWARE.
    */
    
    require_once 'aws_signed_request.php';

    class AmazonProductAPI
    {

        /**
         * Your Amazon Access Key Id
         * @access private
         * @var string
         */
        //private $public_key     = $AmazonOpt['amazonApiKey'];
        
        /**
         * Your Amazon Secret Access Key
         * @access private
         * @var string
         */
        //private $private_key    = $AmazonOpt['amazonSecret'];
        
        /**
         * Your Amazon Associate Tag
         * Now required, effective from 25th Oct. 2011
         * @access private
         * @var string
         */
        //private $associate_tag  = $AmazonOpt['amazonAssociateId'];
    
        /**
         * Constants for product types
         * @access public
         * @var string
         */
        
        /*
            Only three categories are listed here. 
            More categories can be found here:
            http://docs.amazonwebservices.com/AWSECommerceService/latest/DG/APPNDX_SearchIndexValues.html
        */
        const ALL = "All";
        const APPAREL = "Apparel";
        const APPLIANCES = "Appliances";
        const ARTSANDCRAFTS = "ArtsAndCrafts";
        const AUTOMOTIVE = "Automotive";
        const BABY = "Baby";
        const BEAUTY = "Beauty";
        const BLENDED = "Blended";
        const BOOKS = "Books";
        const CLASSICAL = "Classical";
        const COLLECTIBLES = "Collectibles";
        const DIGITALMUSIC = "DigitalMusic";
        const DVD = "DVD";
        const ELECTRONICS = "Electronics";
        const GARDEN = "Garden";
        const GOURMETFOOD = "GourmetFood";
        const GROCERY = "Grocery";
        const HEALTHPERSONALCARE = "HealthPersonalCare";
        const HOBBIES = "Hobbies";
        const HOME = "Home";
        const HOMEGARDEN = "HomeGarden";
		const HOMEIMPROVEMENT = "HomeImprovement";
        const INDUSTRIAL = "Industrial";
        const JEWELRY = "Jewelry";
        const KINDLESTORE = "KindleStore";
        const KITCHEN = "Kitchen";
        const LAWNANDGARDEN = "LawnAndGarden";
        const LIGHTING = "Lighting";
        const MAGAZINES = "Magazines";
		const MARKETPLACE = "Marketplace";
        const MISCELLANEOOUS = "Miscellaneous";
        const MOBILEAPPS = "MobileApps";
        const MP3DOWNLOADS = "MP3Downloads";
        const MUSIC = "Music";
        const MUSICALINSTRUMENTS = "MusicalInstruments";
        const MUSICTRACKS = "MusicTracks";
        const OFFICEPRODUCTS = "OfficeProducts";
		const OUTDOORLIVING = "OutdoorLiving";
        const PCHARDWARE = "PCHardware";
        const PETSUPPLIES = "PetSupplies";
        const PHOTO = "Photo";
        const SHOES = "Shoes";
        const SOFTWARE = "Software";
		const SPORTINGGOODS = "SportingGoods";
        const TOOLS = "Tools";
        const TOYS = "Toys";
        const VHS = "VHS";
        const VIDEO = "Video";
        const VIDEOGAMES = "VideoGames";
		const WATCHES = "Watches";
        const WIRELESS = "Wireless";
        const WIRELESSACCESSORIES = "WirelessAccessories";


        
        /**
         * Check if the xml received from Amazon is valid
         * 
         * @param mixed $response xml response to check
         * @return bool false if the xml is invalid
         * @return mixed the xml response if it is valid
         * @return exception if we could not connect to Amazon
         */
        private function verifyXmlResponse($response)
        {
            if ($response === False)
            {
                //throw new Exception("Could not connect to Amazon");
            }
            else
            {
                if (isset($response->Items->Item->ItemAttributes->Title))
                {
                    return ($response);
                }
                else
                {
                   //throw new Exception("Invalid xml response.");
                }
            }
        }
        
        
        /**
         * Query Amazon with the issued parameters
         * 
         * @param array $parameters parameters to query around
         * @return simpleXmlObject xml query response
         */
        private function queryAmazon($parameters, $public_key, $private_key, $associate_tag)
        {
            return aws_signed_request("com", $parameters, $public_key, $private_key, $associate_tag);
        }
        
        
        /**
         * Return details of products searched by various types
         * 
         * @param string $search search term
         * @param string $category search category         
         * @param string $searchType type of search
         * @return mixed simpleXML object
         */
        public function searchProducts($search, $category, $searchType = "UPC", $public_key, $private_key, $associate_tag)
        {
            $allowedTypes = array("UPC", "TITLE", "ARTIST", "KEYWORD");
            $allowedCategories = array("Music", "DVD", "VideoGames");
            
            switch($searchType) 
            {
                case "UPC" :    $parameters = array("Operation"     => "ItemLookup",
                                                    "ItemId"        => $search,
                                                    "SearchIndex"   => $category,
                                                    "IdType"        => "UPC",
                                                    "ResponseGroup" => "Medium");
                                break;
                
                case "TITLE" :  $parameters = array("Operation"     => "ItemSearch",
                                                    "Title"         => $search,
                                                    "SearchIndex"   => $category,
                                                    "ResponseGroup" => "Medium");
                                break;
            
            }
            
            $xml_response = $this->queryAmazon($parameters, $public_key, $private_key, $associate_tag);
            
            return $this->verifyXmlResponse($xml_response);

        }
        
        
        /**
         * Return details of a product searched by UPC
         * 
         * @param int $upc_code UPC code of the product to search
         * @param string $product_type type of the product
         * @return mixed simpleXML object
         */
        public function getItemByUpc($upc_code, $product_type)
        {
            $parameters = array("Operation"     => "ItemLookup",
                                "ItemId"        => $upc_code,
                                "SearchIndex"   => $product_type,
                                "IdType"        => "UPC",
                                "ResponseGroup" => "Medium");
                                
            $xml_response = $this->queryAmazon($parameters);
            
            return $this->verifyXmlResponse($xml_response);

        }
        
        
        /**
         * Return details of a product searched by ASIN
         * 
         * @param int $asin_code ASIN code of the product to search
         * @return mixed simpleXML object
         */
        public function getItemByAsin($asin_code)
        {
            $parameters = array("Operation"     => "ItemLookup",
                                "ItemId"        => $asin_code,
                                "ResponseGroup" => "Medium");
                                
            $xml_response = $this->queryAmazon($parameters);
            
            return $this->verifyXmlResponse($xml_response);
        }
        
        
        /**
         * Return details of a product searched by keyword
         * 
         * @param string $keyword keyword to search
         * @param string $product_type type of the product
         * @return mixed simpleXML object
         */
        public function getItemByKeyword($keyword, $product_type)
        {
            $parameters = array("Operation"   => "ItemSearch",
                                "Keywords"    => $keyword,
                                "SearchIndex" => $product_type);
                                
            $xml_response = $this->queryAmazon($parameters);
            
            return $this->verifyXmlResponse($xml_response);
        }

    }