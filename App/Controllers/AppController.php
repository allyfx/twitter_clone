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

			$usuario = Container::getModel('usuario');
			$usuario->__set('nome', $pesquisarPor);
			$usuario->__set('id', $_SESSION['id']);

			if($pesquisarPor != '') {
				$usuarios = $usuario->getAll();
			} else if($pesquisarPor == '') {
				$usuarios = $usuario->getAllUsers();
			}

			$this->view->usuarios = $usuarios;
			$this->render('quemSeguir');
		}

		public function acao() {
			$this->validaAutenticacao();

			$acao = isset($_GET['acao']) ? $_GET['acao'] : '';
			$id_usuario = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : '';

			$usuario = Container::getModel('Usuario');
			$usuario->__set('id', $_SESSION['id']);

			if($acao == 'seguir') {
				$usuario->seguirUsuario($id_usuario);
				header('location: /quem_seguir');
			} else if($acao = 'deixar_de_seguir') {
				$usuario->deixarSeguirUsuario($id_usuario);
				header('location: /quem_seguir');
			}
		}
	}
?>