<!DOCTTYPE HTML>
<hmtl>
	<head>
	<meta charset="UTF-8">
	</head>
		<body>
			<form action="Try_submit.php" id="payment-form" method="post">
				<span class="payment-errors" style="color:red; font:12px"></span>
				<p>
					<label for="">Business Name</label>
					<input type="text" data-stripe="name">
				</p>

				<p>
					<label for="">Business Email Address</label>
					<input type="email" name="emailAddress">
				</p>

				<p>
					<label for="">Card Number</label>
						<input type="text" data-stripe="number">
					</label>
				</p>

				<p>
					<label for="">CVC</label>
					<input type="text" data-stripe="cvc">
				</p>

				<p>
					<label for="">Expiration MM/YY</label>
					<input type="text" data-stripe="exp-month">
					<input type="text" data-stripe="exp-year">
				</p>

				<button type="submit">Submit</button>
			</form>

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			<script src="https://js.stripe.com/v2/"></script>
			<script>
				Stripe.setPublishableKey('pk_test_yBffBfFiRD34sNvaV1cw0v2i');

				$('#payment-form').submit(function(e){
					$form = $(this);

					$form.find('button').prop('disabled',true);

					Stripe.card.createToken($form, function(status, response){
						console.log(status);
						console.log(response);


						if(response.error){
							$form.find('.payment-errors').text(response.error.message);
							$form.find('button').prop('disabled', false);
						}else{
							var token=response.id;

							//append the token and submit
							$form.append($('<input type="hidden" name="stripe-token"/>').val(token));
							$form.get(0).submit();
						}
					})

					return false;
				});

			</script>
		</body>
</hmtl>