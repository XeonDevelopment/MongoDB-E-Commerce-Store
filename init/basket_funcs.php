<?php 
require_once 'core.php';

function isLoggedIn(){
	if(isset($_SESSION['user_id'])){
		return 1;
	}else{
		return 0;
	}
}



function addToBasket($id){
	global $db;
	$collection = $db->basket;

	$prods_array = getProducts($_SESSION['user_id']);
	if($prods_array==NULL){

		$info = array(
		'products' => array(
			'product_id' => "$id"
		),
		'user_id' => $_SESSION['user_id']
		);

		$collection->insert($info);
	}else{
		array_push($prods_array, $id);
		$x = implode("|", $prods_array);
		$info = array(
		'products' => array(
			'product_id' => "$x"
		),
		'user_id' => $_SESSION['user_id']
	);

	$collection->update(array('user_id' => $_SESSION['user_id']), $info);
	}
	

}


function getProduct($product_id){
	// return: product array
	global $db;
	$collection = $db->product;
	$product = [];
	try{
		$cursor = $collection->findOne(array(
		'_id' => new MongoId($product_id)));
	}catch(Exception $e){
		$cursor['product_name']="not found";
		$cursor['product_description']="not found";

	}
	return $cursor;
}


function getProducts($user_id){
	global $db;
	$collection = $db->basket;
	$basket = [];
	$cursor = $collection->find(array(
		'user_id' => $user_id));

	$results = [];
	foreach($cursor as $res){
		array_push($results, $res);
	}


	try {
		@$x = $results[0];
	} catch (Exception $e) {
	    $x = [];
	}
	
	return $x['products'];
}


function findUser($user_id){
	global $db;
	$collection = $db->customer;
	$info = array(
		'_id' => $user_id 
	);
	return $collection->findOne($info);
}



function redirectTo($path){
	header("Location: $path");
	exit();
}


function removeFromBasket($prod_id){
	global $db;
	$collection = $db->basket;
	$count = 1;
	$prods_array = getProducts($_SESSION['user_id'])['product_id'];
	$prods = explode("|", $prods_array);
	$key = array_search($prod_id, $prods);
	if ($key !== FALSE) {
	  unset($prods[$key]);
	}
	$final = implode("|", $prods);

	$info = array(
	'products' => array(
		'product_id' => "$final"
	),
	'user_id' => $_SESSION['user_id']
	);

	$collection->update(array('user_id' => $_SESSION['user_id']), $info);

}


function checkout($user_id){
	global $db;
	
	$collection = $db->basket;
	$products = getProducts($_SESSION['user_id'])['product_id'];
	if(strlen($products)<5){
	  redirectTo('cart.php');
	}
	$collection->remove(array('user_id' => $user_id));
	$total = 0;

	$x = explode("|", $products);
	foreach($x as $prod){
		$lmao = getProduct($prod);
		$total += $lmao['product_price'];
		$lmao['bought'] += 1;
		$col = $db->product;
		$upd = array(
			'_id' => $lmao['_id']
		);
		$col->update($upd, $lmao);
	}


	$collection = $db->history;

	$info = array(
	'userid' => $user_id,
	'items' => array('product_id' => "$products"),
	'date' => date("Y/m/d"),
	'total' => $total
	);

	$collection->insert($info);
}

function getHistory($user_id){
	//get history for user, foreach the result
	global $db;
	$collection = $db->history;
	$info = array(
		'userid' => $user_id 
	);
	return $collection->find($info);
}


function search($string, $limit=0){
	//search function, foreach the result

	global $db;
	$collection = $db->product;
	$regex = new MongoRegex("/^$string/i");
	$info = array(
		'product_name' => $regex
	);
	
	if($limit!=0){
		$cursor = $collection->find($info)->limit($limit);
	}else{
		$cursor = $collection->find($info);
	}
	return $cursor;


}


function logout(){
	session_unset();
	session_destroy();
}