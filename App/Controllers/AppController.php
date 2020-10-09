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

		public function tweet() {
			session_start();

			if($_SESSION['id'] == '' || $_SESSION['nome'] == '') {
				header('location: /');
			}

			$tweet = Container::getModel('Tweet');

			$tweet->__set('tweet', $_POST['tweet']);
			$tweet->__set('id_usuario', $_SESSION['id']);

			$tweet->salvar();

			header('location: /timeline');
		}
	}
?>