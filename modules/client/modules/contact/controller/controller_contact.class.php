<?php
	class controller_contact {
		function __construct(){
			$_SESSION['module'] = "contact";
		}
		
		function view() {
        	loadView('modules/contact/view/', 'contact_page.html');
	    }

	}
