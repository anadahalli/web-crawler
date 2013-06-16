<?php
/*
 * crawler_curl.php
 * 
 * Copyright 2013 Ashwath Nadahalli <ashwathnadahalli@gmail.com>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */
?>
<?php
	
	//curl function to fetch the file
	function file_get_contents_curl($url) 
	{
	      $ch = curl_init();
	      curl_setopt($ch, CURLOPT_HEADER, 0);
	      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	      curl_setopt($ch, CURLOPT_URL, $url);
	      $data = curl_exec($ch);
	      curl_close($ch);
	      return $data;
	}
	
	//crawls the web for particular ID in a given URL
	function crawler($url, $id)
	{        
		$html = file_get_contents_curl($url);
  
	 	// create document object model
	  	$dom = new DOMDocument();
  
  		// load html into document object model
  		@$dom->loadHTML($html);
  
		// create domxpath instance
		$xPath = new DOMXPath($dom);
  
		// get all elements with a particular id and then loop through and print the values
		$data = "";
		$elements = $xPath->query($id);
  	
  		foreach ($elements as $e) 
  		{
      			$data .= $e->nodeValue;
  		}   
  		
  		//strip the comma in prices
  		$pattern = '/,/';
		$final = preg_replace($pattern, "", $data);
  		
  		return $data;
	}
?>
