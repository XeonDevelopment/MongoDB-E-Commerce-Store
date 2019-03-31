<?php
require_once 'init/core.php';
if(isLoggedIn()){
  redirectTo("index.php");
}


//Select a collection 
$collection = $db->customer;


 ?>
<html lang="en"><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="/favicon.ico">

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">

  <!-- Link Font Awesome for Icons -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



  <title>Game Website</title>

</head>


<body>
  <section header="">
    <header>
      <div class="container">
        <img src="img/logo.png" class="logo">

              <?php include 'sidebar.php';
?>
      </div>
    </header>
  </section>

  <div class="fullpage">

<?php
if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	//Convert to PHP array
$dataArray = [
    "name" => $name, 
    "email" => $email, 
    "password" => $password
 ];

//Add the new product to the database
$returnVal = $collection->insert($dataArray);
    
//Echo result back to user
if($returnVal['ok']==1){
    redirectTo("login.php");
}
else {
    echo 'Error adding customer';
}

//Close the connection
$mongoClient->close();
header("Location: login.php");	
	
	
}
	
	
	
	?>




    <div class="regpg">
      <div class="regimg">
        <p style="text-align: Center;">Register</p>
        <div class="reginp">
		<form class="reginp" method="post">		
			
			
		<input type="text" name="name">
          <input input type="text" name="email">
          <input type="password" name="password">
		  <input class="button reg" type="submit" name="submit" />

	
		</form>
		<a href="login.php"><button class="button reg"><span>Login</span></button></a>


        </div>


      </div>
    </div>





  </div>



  <section>


    <footer>
      <p><b>Group Project © 2019</b></p>
    </footer>



  </body></html>