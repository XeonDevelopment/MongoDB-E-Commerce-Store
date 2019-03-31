<?php 
require_once 'init/core.php';

$collection = $db->product;


if(!isset($_REQUEST['string'])){
  $_REQUEST['string'] = '';
}

if(!isset($_REQUEST['sort'])){
  $_REQUEST['sort'] = -1;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  global $db;
  $string = $_REQUEST['string'];
  $collection = $db->product;
  $regex = new MongoRegex("/^$string/i");
  if(strlen($_REQUEST['category'])>2){
    $info = array(
    'product_name' => $regex,
    'category' => $_REQUEST['category']
  );
  }else{
    $info = array(
    'product_name' => $regex
  );
  }


  
  $res = $collection->find($info)->sort(array('product_price' => (int) $_REQUEST['sort']));
}else{
  $res = [];
}

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

  <div class="subhead">
    <h1>Search</h1>
  </div>

<div class="cat-nav">
            <ul class="list-inline go-center">
            <li class="list-inline-item filterDiv skip" onclick="filterSelection('all')">All</li>
             <li class="list-inline-item filterDiv skip" onclick="filterSelection('skip')">Skips</li>
             <li class="list-inline-item filterDiv addon" onclick="filterSelection('addon')">Addons</li>
             <li class="list-inline-item filterDiv restarts" onclick="filterSelection('restarts')">Restarts</li>
              <br><br>
              <form action="search.php" method="POST">
                Price:
                <select name="sort">
                <option value="1">Ascending</option>
                <option value="-1">Descending</option>
                </select> 
                <input type="text" name="string" value="<?php echo $_REQUEST['string']; ?>">
                <input type="hidden" name="category" value="<?php if(isset($_REQUEST['category'])){echo $_REQUEST['category'];} ?>">
                <input type="submit" name="submit" value="Search">
              </form>
            </ul>
          </div>
  <section>


      <div class="grid-containerbas">

        <br>
          <div class="grid-item-right">
            <?php 
            $num = 0;
            foreach($res as $result){
            $num+=1;
            ?>
            <div class="basketitem filterDiv <?php echo $result['category']; ?>">
             <p style="text-align:left;"><?php echo $result['product_name']; ?></p>
             <p style="text-align:left;"><?php echo $result['product_price']; ?>$</p>
             <p style="text-align:left;"><?php echo $result['product_description']; ?> </p>
              <a href="product.php?prod_id=<?php echo $result['_id']; ?>"><button class="button white active"><span>View product</span></button></a>

            </div>

           <?php 
            }
            if($num==0){
              echo "No results.";
            }
            ?>
            </div>
          
 
    </div>



</div>



</section>



<style>
.filterDiv {
  display: none;
}

.show {
  display: block;
}
</style>



<script>
filterSelection("all")
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("filterDiv");
  if (c == "all") c = "";
  for (i = 0; i < x.length; i++) {
    w3RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
  }
}

function w3AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
  }
}

function w3RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);     
    }
  }
  element.className = arr1.join(" ");
}

// Add active class to the current button (highlight it)
var btnContainer = document.getElementById("myBtnContainer");
var btns = btnContainer.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function(){
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}
</script>


















<footer>
  <p><b>Group Project © 2019</b></p>
</footer>



</body></html>