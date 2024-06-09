<?php 
// DB credentials.
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','tms');
// Establish database connection.

//Stripe credentials

// Product Details 
// Minimum amount is $0.50 US 
// $itemName = "Demo Product"; 
// $itemPrice = 25;  
$currency = "INR";  
 
/* Stripe API configuration 
 * Remember to switch to your live publishable and secret key in production! 
 * See your keys here: https://dashboard.stripe.com/account/apikeys 
 */ 


define('STRIPE_API_KEY', 'sk_test_51NNs0sSFSdMle1ytXfNmc5eDoLCVB8a1522ycDVSdO1iogtn5708Eyjixoa81eGcXek95v44CK0w5t5EWX6AL8n400ObjFWISx'); 
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_51NNs0sSFSdMle1ytpm6SMwNEoZgMC5dkbuX1RG3HLddbRpI945aUwUXcNxsF8MIKByKswDM0BrV6tBjrQhIpIrJb00NkiwP2xA'); 
  



//Stripe credentials End


try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}


$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);  
  
// Display error if failed to connect  
if ($db->connect_errno) {  
    printf("Connect failed: %s\n", $db->connect_error);  
    exit();  
}


?>