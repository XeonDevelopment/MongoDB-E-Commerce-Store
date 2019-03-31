<?php 
require_once 'init/core.php';
if(!isset($_GET['action'])){
	exit("Not to be accessed directly");
}
if(!isLoggedIn()){
	redirectTo("login.php");
}



switch ($_GET['action']) {
	case 'add':
		addToBasket($_GET['prod_id']);
		redirectTo("cart.php");
		break;
	
	case 'del':
		removeFromBasket($_GET['prod_id']);
		redirectTo("cart.php");
		break;

	case 'checkout':
		checkout($_SESSION['user_id']);
		redirectTo("order_history.php");
		break;
	default:
		break;
}



?>