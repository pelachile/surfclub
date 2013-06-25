<?php

require_once 'MCAPI.class.php';
require_once 'config.inc.php';

if(isset($_POST['first_name'])) {
	$fname = $_POST['first_name'];
	$email = $_POST['email'];
	
	$api = new MCAPI($apikey);


	$merge_vars = array('FNAME' => $_POST['first_name'], 'EMAIL' => $_POST['email']);

	$retval = $api->listSubscribe($listId, $email, $merge_vars);

		if (!$retval) {

			$status = array(

				'result' => 0,
				'response' => 'We are sorry, but we are unable to process your subscrption. Please try again later'

			);

			
		} else {

			$status = array (

				'result' => 1,
				'response' => 'Subscription successful! - look for the confirmation email'

				);

		}
}

if(isset($status)) {
	echo json_encode($status);

} else {
	echo 'false';
}
