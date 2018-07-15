<?php

class helper {
	
	public function url_slug($str){
		$search = array("ß",	"ä",	"ö",	"ü",	"Ä",	"Ö",	"Ü");
		$dst 		= array("ss",	"ae",	"oe",	"ue",	"ae",	"oe",	"ue");
		$src = array();
		foreach ($search AS $item){
			$src[] = utf8_encode($item);
		}
		$str = str_replace($src, $dst, $str);
		
		if($str !== mb_convert_encoding( mb_convert_encoding($str, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32') )
		$str = mb_convert_encoding($str, 'UTF-8', mb_detect_encoding($str));
		$str = htmlentities($str, ENT_NOQUOTES, 'UTF-8');
		$str = preg_replace('`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '\1', $str);
		$str = html_entity_decode($str, ENT_NOQUOTES, 'UTF-8');
		$str = preg_replace(array('`[^a-z0-9]`i','`[-]+`'), '-', $str);
		$str = strtolower( trim($str, '-') );
		return $str;
	}
	
	public function isPartUppercase($string) {
    return (bool) preg_match('/[A-Z]/', $string);
	}
	
	public function formatHashrate($value) {
	  $i = 0;
	  $units = array('KH', 'MH', 'GH', 'TH', 'PH');
	  $numbers = 2;
	  while ($value > 1000) {
	    $value = $value / 1000;
	    $i++;
	  }
	  return number_format($value, $numbers, ".", "").' '.$units[$i];
	}
	
	public function formatTime($value) {
	
		$minutes = $value;
		if ($minutes <= 2) return $minutes." minute";
		if ($minutes <= 60) return $minutes." minutes";
		
		$hours = round($minutes/60);
		if ($hours <= 2) return $hours." hour";
		if ($hours <= 24) return $hours." hours";
		
		$days = round($hours/24);
		if ($days <= 1) return $days." day";
		if ($days >= 1) return $days." days";
	}
	
	public function input_in($input_in_eingabe, $input_in_typ =""){
		switch (addslashes($input_in_typ)){
		     case "string":
		     		return addslashes(trim(strip_tags(stripslashes($input_in_eingabe))));
		     		break;
		     case "url":
		     		return addslashes(trim(strip_tags(stripslashes(rawurldecode($input_in_eingabe)))));
		     		break;
		     case "int": 
		     		if(settype($input_in_eingabe,"integer")) return $input_in_eingabe;
		     		else return 0;
		     		break;
		     case "int+": 
		     		if(settype($input_in_eingabe,"int")) return abs($input_in_eingabe);
		     		else return 0;
		     		break;
		     case "arr": 
		        $arr_new = array();
		        foreach ($input_in_eingabe AS $key => $wert){
		        	$arr_new[ input_in($key) ]= input_in($wert);	        
		        }
		     		return $arr_new;
		     		break;
		     case "arr_int": 
		        $arr_new = array();
		        foreach ($input_in_eingabe AS $key => $wert){
		        	$arr_new[ input_in($key) ]= input_in($wert,"int");	        
		        }
		     		return $arr_new;
		     		break;
		     case "arr_int+": 
		        $arr_new = array();
		        foreach ($input_in_eingabe AS $key => $wert){
		        	$arr_new[ input_in($key) ]= input_in($wert,"int+");	     
		        }
		     		return $arr_new;
		     		break;
		     case "float_de":
		     		if(settype($input_in_eingabe,"float")) return str_replace(",",".",$input_in_eingabe);
		     		break;
		     case "float":
		     		if(settype($input_in_eingabe,"float")) return $input_in_eingabe;
		     		break;
		     default: return addslashes(trim(strip_tags(stripslashes($input_in_eingabe))));
		}
	}

	
}

?>