<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>User Login</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<!-- Bootstrap JS File -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="card mt-5">
			<div class="header">
				<h3 class="text-center">Login</h3>
			</div>
			<div class="body mt-5">
				<div class="row">
					<div class="col-lg-12">
						<label class="control-label">Email</label>
						<input type="email" name="email" id="email" class="form-control">
						<p class="red error" id="email_error"></p>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<label class="control-label">Password</label>
						<input type="password" name="password" id="password" class="form-control">
						<p class="red error" id="password_error"></p>
					</div>
				</div>
				<div class="row mt-5 float-right">
					<div class="col-lg-12 mr-4 mb-2">
						<span class="btn btn-primary" name="submit" id="submit">Login</span>
						<span class="btn btn-default" name="reset" id="reset">Cancel</span>
					</div>
				</div>
				<div class="row">
					<span id="message"></span>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		var baseUrl = '<?= base_url(); ?>';

		$("#submit").on('click', function(){
			console.log(baseUrl);
			var email		= $("#email").val();
			var password 	= $("#password").val();

			var flag = true;

			$(".error").text('');

			if(email == '')
			{
				flag = false;
				$("#email_error").text("Plese enter email.");
			}

			if(password == '')
			{
				flag = false;
				$("#password_error").text("Plese enter password.");
			}

			if(email != '' && !ValidateEmail(email))
			{
				flag = false;
				$("#email_error").text("Plese enter valid email.");
			}
			
			if(flag)
			{
				$.ajax({
					type: 'POST',
					url: baseUrl+'registration/checkLogin',
					data: {
						email 		: email,
						password 	: password
					},
					success: function(response)
					{
						var data = JSON.parse(response);

						if(data.success == true)
						{
							$("#message").text(data.message);
							setTimeout(function(){ window.location = baseUrl+'User_Blog/index/'+data.userId; }, 2000);
						}
						else
						{
							$("#message").text(data.message)
						}
					},
					error: function(e)
					{
						alert(e.message);
					}
				});
			}

		});

		function ValidateEmail(mail) 
		{
			if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
			{
				return (true)
			}
			else
			{
				return (false)
			}
		}

	</script>

</body>
</html>