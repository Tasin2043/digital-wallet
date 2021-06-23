<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Digital Wallet</title>
</head>
<body>

	<h1>Page 1 [Home]</h1>
	<h3> Digital Wallet</h3>

	<p>1.<a href="page1.php">Home</a> 2.<a href="page2.php">Transaction History</a></p>

	<h3> Fund Transfer: </h3>

	<?php
   define("filepath", "data.txt");

  $selectCategory = $tO= $amounT ="";
  $selectCategoryErr = $tOErr = $amounTErr = "";
  $successfulMessage = $errorMessage = "";
  $flag = false;

  if($_SERVER['REQUEST_METHOD'] ==="POST") {
    
   
    if(empty($selectCategory)) {
      $selectCategoryErr = "Empty";
    
    $flag = true;

  }
   if(empty($tO)) {
    $tOErr = "Please give your number!";
    $flag = true;
  }

  if(empty($amounT)) {
    $amounTErr = "Please give your amount!";
    $flag = true;
  }

  if(!$flag){
    $selectCategory = test_input($selectCategory);
    $tO = test_input($tO);
    $amounT = test_input($amounT);

    $data = array("$selectCategory" => $selectCategory, "tO" => $tO,"amounT" => $amounT );
    $data_encode = json_encode($data);
    $result1 = write($data_encode);
if($result1){
   $successfulMessage = "Successfully saved!";
 }
 else{
  $errorMessage = "Error while saving!";
     }
   }
 }
  function write($content){
    $resource = fopen(filepath, "a");
      $fw = fwrite($resource, $content . "\n");
      fclose($resource);
      return $fw;
  }


  function test_input($data) {
         $data =trim($data);
         $data =stripslashes($data);
         $data = htmlspecialchars($data);
         return $data;
       } 

?>

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		
			 <label for="selectcategory">Select Category:</label>
  <select class="form-control dropdown" id="selectcategory" name="selectcategory">
    <option value="" selected="selected" disabled="disabled">-- select a value --</option>
    <option value="mobilerecharge">Mobile Recharge</option>
    <option value="sendmoney">Send Money</option>
    <option value="merchantpay">Merchant Pay</option> 
   <input type="option">

  <br><br> 
    
			<label for="to">To:</label>
			<input type="tel" name="to" id="to">
			<span style="color:red"><?php echo $tOErr; ?></span>
</form>
			<br>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
			<label for="amount">Amount:</label>
			<input type="number" pattern="(\d{3})[\.](\d{2})" id="amount">
			<span style="color:red"><?php echo $amounTErr; ?></span>

			<br><br>

			<input type="submit" name="submit" value="Submit">

<span style ="color:green;"><?php echo $successfulMessage; ?></span>
<span style ="color:red;"><?php echo $errorMessage; ?></span>

<?php
function read() {
		$resource = fopen(filepath, "r");
		$fz = filesize(filepath);
		$fr = "";
		if($fz > 0) {
			$fr = fread($resource, $fz);
		}
		fclose($resource);
		return $fr;
	} 
?>

</form>
</body>
</html>
