<?php

	var_dump('stripe token is '.$_POST['stripe-token'].' ~~~ Good job!!');

try {
	  require_once('vendor/autoload.php');
	  \Stripe\Stripe::setApiKey("sk_test_mzrAOEbPOwpBMMT7PsdqJDex"); //Replace with your Secret Key

	  $token  = $_POST['stripe-token'];

	  $customer = \Stripe\Customer::create(array(
		    'email' => $_POST['emailAddress'],
		    'source' => $token));

	  $charge = \Stripe\Charge::create(array(
	  "customer" => $customer->id,
	  "amount" => "20000",
	  "currency" => "usd",
	  "description" => "Purchased a slipknot black shirt"));

  	

	  echo "<strong>Thank you for your support. Keep rockin!.</strong>";
	}catch(Exception $e) {
  	echo 'Message: ' .$e->getMessage();
	}
?>
<script>
function backButton() {
    window.history.back()
}
</script>

<button onclick="backButton()">Go Back</button>	

?>