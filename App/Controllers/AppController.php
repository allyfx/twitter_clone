<?php

	namespace App\Controllers;

	use MF\Controller\Action;
	use MF\Model\Container;

	class AppController extends Action {
		public function validaAutenticacao() {
			session_start();

			if($_SESSION['id'] == '' || $_SESSION['nome'] == '') {
				header('location: /');
			}
		}

		public function timeline() {
			$this->validaAutenticacao();

			$tweet = Container::getModel('tweet');
			$tweet->__set('id_usuario', $_SESSION['id']);
			$tweets = $tweet->getAll();

			$this->view->tweets = $tweets;

			$this->render('timeline');
		}

		public function tweet() {
			$this->validaAutenticacao();

			$tweet = Container::getModel('Tweet');

			$tweet->__set('tweet', $_POST['tweet']);
			$tweet->__set('id_usuario', $_SESSION['id']);

			$tweet->salvar();

			header('location: /timeline');
		}

		public function quemSeguir() {
			$this->validaAutenticacao();

			$pesquisarPor = isset($_GET['pesquisarPor']) ? $_GET['pesquisarPor'] : '';

			$usuarios = array();

			if($pesquisarPor != '') {
				$usuario = Container::getModel('usuario');
				$usuario->__set('nome', $_GET['pesquisarPor']);

				$usuarios = $usuario->getAll();
			}

			$this->view->usuarios = $usuarios;
			$this->render('quemSeguir');
		}
	}
?>