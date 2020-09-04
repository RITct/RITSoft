<?php

/**
 * @Author: indran
 * @Date:   2018-07-01 16:21:39
 * @Last Modified by:   indran
 * @Last Modified time: 2018-07-01 20:56:04
 */


if(session_id() == '') {
	session_start();
}

header('Content-Type: application/json');
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

$returnArray = array();






if( isset($_POST['action']) &&  IS_AJAX  ) {

	switch( $_POST['action'] ) { 

		case 'get-all-religion': 
		$returnArray = getReligion();
		break;

		case 'get-a-caste':
		$religion = $_POST['religion'];  

		$returnArray = adminLogin($religion);
		break;


















		default :
		$data = null;
		break;		
	}


	echo json_encode($returnArray); 
}  









/*=================================================================================================================================================== */
/*========================================================== funcitons ===============================================================================*/
/*====================================================================================================================================================*/



function religion_cast () {
	return $religion_cast =  ' [
	{ "religion":"HINDU", "caste":[ "Nair","Ezhavas","Brahmins","Nadar Hindus","Viswakarma","Namboothiri","Marar","Warrier"] },
	{ "religion":"CHRISTIAN", "caste":[ "Syro-Malabar Catholics","Syro-Malankara Catholics","Latin Catholics","Jacobite Syrians","Orthodox Syrians","Marthoma Syrians","Pentecost","RC","RCSC","Jacobite"] },
	{ "religion":"MUSLIM", "caste":["Muslims","Shia Muslims","Sunni Muslims"] }
]'; 
}


function  getReligion() { 
	$arrayReturn = array(); 

	try {
		$json = json_decode(religion_cast(), true); 
		foreach($json as $key => $value){			
			array_push($arrayReturn, array( 'value' => $value['religion'] , 'name' =>  $value['religion'] ));
		}
	} catch (Exception $e) {

	}

	return $arrayReturn;
}

function adminLogin($religion) { 

	$arrayReturn = array();


	try { 
		$json = json_decode(religion_cast(), true);

		foreach($json as $key => $value){
			if($value['religion'] == $religion){
				if(isset($value['caste'])) {
					foreach($value['caste'] as $keyIn => $valueIn){
						array_push($arrayReturn, array( 'value' => $valueIn , 'name' =>  $valueIn )); 
					}
				}
			}
		}

	} catch (Exception $e) {

	}


	return $arrayReturn;

}














?>
