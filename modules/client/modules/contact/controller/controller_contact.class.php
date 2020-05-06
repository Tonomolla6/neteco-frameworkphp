<?php
	class controller_contact {
		function __construct(){
			$_SESSION['module'] = "contact";
		}
		
		function view() {
			$paths = array("head.php","contact_page.html");
        	loadView('modules/contact/view/', $paths);
		}
		
		function send_mail(){
			echo "hola";
		// 	$data_mail = array();
		// 	$data_mail = json_decode($_POST['fin_data'],true);
		// 	$arrArgument = array(
		// 		'type' => 'contact',
		// 		'token' => '',
		// 		'inputName' => $data_mail['cname'],
		// 		'inputEmail' => $data_mail['cemail'],
		// 		'inputSubject' => $data_mail['matter'],
		// 		'inputMessage' => $data_mail['message']
		// 	);
			
		// 	//set_error_handler('ErrorHandler');
		// 	try{
	    //         echo "<div class='alert alert-success'>".enviar_email($arrArgument)." </div>";
		// 	} catch (Exception $e) {
		// 		echo "<div class='alert alert-error'>Server error. Try later...</div>";
		// 	}
		// 	//restore_error_handler();

		// 	$arrArgument = array(
		// 		'type' => 'admin',
		// 		'token' => '',
		// 		'inputName' => $data_mail['cname'],
		// 		'inputEmail' => $data_mail['cemail'],
		// 		'inputSubject' => $data_mail['matter'],
		// 		'inputMessage' => $data_mail['message']
		// 	);
		// 	try{
	    //         enviar_email($arrArgument);
		// 	} catch (Exception $e) {
		// 		echo "<div class='alert alert-error'>Server error. Try later...</div>";
		// 	}
		// }
	}
}