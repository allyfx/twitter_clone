<?php

	namespace App\Controllers;

	use MF\Controller\Action;
	use MF\Model\Container;

	class AppController extends Action {
		public function timeline() {
			session_start();

			if($_SESSION['id'] == '' || $_SESSION['nome'] == '') {
				header('location: /');
			}

			$this->render('timeline');
		}
	}
?>