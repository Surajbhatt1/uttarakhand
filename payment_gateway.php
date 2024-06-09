<?php 
// Include configuration file  
// require_once 'config.php'; 
session_start();
// error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
	{	
header('location:index.php');
}

?>

<!-- Stripe JS library -->
<script src="https://js.stripe.com/v3/"></script>

<link rel="stylesheet" href="css/stripe.css">
<?php 
// echo "<pre>";
// print_r($_GET);
// echo "</pre>";
// echo 
$decoded_id = base64_decode($_GET['encoded_id']);
$pid=intval($decoded_id);
$sql = "SELECT  t.`BookingId`,p.PackagePrice,t.PackageId,p.PackageName,p.PackageType,p.PackageCategoryId,cat.name FROM `tblbooking` t LEFT JOIN tbltourpackages p ON t.PackageId=p.PackageId LEFT JOIN tblpackagecategory cat ON cat.id=p.PackageCategoryId WHERE t.`BookingId` = :pid;";
$query = $dbh->prepare($sql);
$query -> bindParam(':pid', $pid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

if ($query->rowCount() > 0) {
    $itemName = $packageName = $results[0]->PackageName;
    $packageType = $results[0]->PackageType;
    $categoryName = $results[0]->name;
    $itemPrice = $packagePrice = $results[0]->PackagePrice;
    $bookingId = $packagePrice = $results[0]->BookingId;

    $_SESSION['checkoutDetails'] = $results[0];
//     echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
}



?>
<input type="hidden" value="<?php echo $itemPrice;?>" id="itemPrice">
<input type="hidden" value="<?php echo $itemName;?>" id="itemName">
<input type="hidden" value="<?php echo $bookingId;?>" id="bookingId">



<script src="js/checkout.js" STRIPE_PUBLISHABLE_KEY="<?php echo STRIPE_PUBLISHABLE_KEY; ?>" defer></script>


<div class="panel">
    <div class="panel-heading">xx   ``x `               ``````````````````````````````````````````````````````````````````````
        <h3 class="panel-title">Pay <?php echo '₹'.$itemPrice; ?> with Stripe</h3>
        
        <!-- Product Info -->
        <p><b>Package Name:</b> <?php echo $packageName; ?></p>
        <p><b>Package Type:</b> <?php echo $packageType; ?></p>
        <p><b>Category Name:</b> <?php echo $categoryName; ?></p>
        <p><b>Price:</b> <?php echo '₹'.$itemPrice.' '.$currency; ?></p>
    </div>
    <div class="panel-body">
        <!-- Display status message -->
        <div id="paymentResponse" class="hidden"></div>
        
        <!-- Display a payment form -->
        <form id="paymentFrm" class="hidden">
            <div class="form-group">
                <label>NAME</label>
                <input type="text" id="name" class="field" placeholder="Enter name" required="" autofocus="">
            </div>
            <div class="form-group">
                <label>EMAIL</label>
                <input type="email" id="email" class="field" placeholder="Enter email" required="">
            </div>
            
            <div id="paymentElement">
                <!--Stripe.js injects the Payment Element-->
            </div>
            
            <!-- Form submit button -->
            <button id="submitBtn" class="btn btn-success">
                <div class="spinner hidden" id="spinner"></div>
                <span id="buttonText">Pay Now</span>
            </button>
        </form>
        
        <!-- Display processing notification -->
        <div id="frmProcess" class="hidden">
            <span class="ring"></span> Processing...
        </div>
        
        <!-- Display re-initiate button -->
        <div id="payReinit" class="hidden">
            <button class="btn btn-primary" onClick="window.location.href=window.location.href.split('?')[0]"><i class="rload"></i>Re-initiate Payment</button>
        </div>
    </div>
</div>