<?php

	function getDistance($addressFrom, $addressTo, $unit = ''){
	    $apiKey = 'AIzaSyA9H63h-S2tE1U6P5DbdRdvrdoQsxxynMo';
	    
	    $formattedAddrFrom    = str_replace(' ', '+', $addressFrom);
	    $formattedAddrTo     = str_replace(' ', '+', $addressTo);
	    
	    $geocodeFrom = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrFrom.'&sensor=false&key='.$apiKey);
	    $outputFrom = json_decode($geocodeFrom);
	    if(!empty($outputFrom->error_message)){
	        return $outputFrom->error_message;
	    }
	    
	    $geocodeTo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrTo.'&sensor=false&key='.$apiKey);
	    $outputTo = json_decode($geocodeTo);
	    if(!empty($outputTo->error_message)){
	        return $outputTo->error_message;
	    }
	    
	    $latitudeFrom    = $outputFrom->results[0]->geometry->location->lat;
	    $longitudeFrom    = $outputFrom->results[0]->geometry->location->lng;
	    $latitudeTo        = $outputTo->results[0]->geometry->location->lat;
	    $longitudeTo    = $outputTo->results[0]->geometry->location->lng;
	    
	    $theta    = $longitudeFrom - $longitudeTo;
	    $dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
	    $dist    = acos($dist);
	    $dist    = rad2deg($dist);
	    $miles    = $dist * 60 * 1.1515;
	    
	    $unit = strtoupper($unit);
	    if($unit == "K"){
	        return round($miles * 1.609344, 2).' km';
	    }elseif($unit == "M"){
	        return round($miles * 1609.344, 2).' meters';
	    }else{
	        return round($miles, 2).' miles';
	    }
	}

	
	$addressFrom = 'B5 L2 villa consolacion barangay, Magsaysay, San Pedro, Laguna';
	$addressTo   = 'Ayala Blvd, Ermita, Manila, 1000 Metro Manila';

	$distance = getDistance($addressFrom, $addressTo, "M");
	echo($distance);