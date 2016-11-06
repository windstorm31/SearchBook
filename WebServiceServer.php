<?php
	require 'lib/nusoap.php';
	$server=new nusoap_server();
	$server->configureWSDL("book","urn:book");
	$server->wsdl->addComplexType("ArrayOfString", 
                 "complexType", 
                 "array", 
                 "", 
                 "SOAP-ENC:Array", 
                 array(), 
                 array(array("ref"=>"SOAP-ENC:arrayType","wsdl:arrayType"=>"xsd:string[]")), 
                 "xsd:string");  
	$server->register(
			"find",
			array("book"=>'xsd:string'),
			array("return"=>'xsd:string')
			);
	$server->register(
			"find_xml",
			array("book_xml"=>'xsd:string'),
			array("return"=>"xsd:intger")
			);
	$server->register(
			"category",
			array("book_attr"=>'xsd:string'),
			array("return"=>"tns:ArrayOfString")
			);
	$server->register(
			"allbook",
			array("book_all"=>'xsd:string'),
			array("return"=>"tns:ArrayOfString")
			);
	function find($book)
	{
		$xmlStr=file_get_contents('BookStore.xml'); 
		$xml=new SimpleXMLElement($xmlStr);
		$ans=$xml->xpath("child::*");
		$i=0;
		for($i;$i<sizeof($ans);$i++){
			foreach ($ans[$i] as $key => $value) {
				if($book==$value)
					$result=$value;
			
			}
			
		}
		return $result;
	}
	function find_xml($book_xml)
	{
		$xmlStr=file_get_contents('BookStore.xml'); 
		$xml=new SimpleXMLElement($xmlStr);
		$ans=$xml->xpath("child::*");
		$i=0;
		for($i;$i<sizeof($ans);$i++){
			foreach ($ans[$i] as $key => $value) {
				if($book_xml==$value)
					$result=$i;
			
			}
			
		}
		return $result;
	}
	function category($book_attr){
		$xml = simplexml_load_file('BookStore.xml');
		$result = array();
		foreach ($xml->book as $book) {
		  if ((string) $book['category'] == $book_attr) {
		        //return $book->title . "<br>";
		        array_push($result,$book->title);
		        //$result = $book->title."<br>";
		    }
		}	
		return $result;
	}
	function allbook($book_all){
		$xml = simplexml_load_file('BookStore.xml');
		$result = array();
		$num = count($xml->book);
		foreach ($xml->book as $book) {
		//for($i=0;$i<100;$i++){
			array_push($result,$book->title);
		}
		    
		//}	
		return $result;
	}
	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : ''; 
	$server->service($HTTP_RAW_POST_DATA); 	
?>
