<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>User Registration</title>

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
				<h3 class="text-center">Registration</h3>
			</div>
			<div class="body mt-5">
				<div class="row">
					<div class="col-lg-6">
						<label class="control-label">First Name</label>
						<input type="text" name="first_name" id="first_name" class="form-control">
						<p class="red error" id="first_name_error"></p>
					</div>
					<div class="col-lg-6">
						<label class="control-label">Last Name</label>
						<input type="text" name="last_name" id="last_name" class="form-control">
						<p class="red error" id="last_name_error"></p>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<label class="control-label">Email</label>
						<input type="email" name="email" id="email" class="form-control">
						<p class="red error" id="email_error"></p>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<label class="control-label">Password</label>
						<input type="password" name="password" id="password" class="form-control">
						<p class="red error" id="password_error"></p>
					</div>
					<div class="col-lg-6">
						<label class="control-label">Confirm Password</label>
						<input type="password" name="c_password" id="c_password" class="form-control">
						<p class="red error" id="c_password_error"></p>
					</div>
				</div>

				<div class="row mt-5 float-right">
					<div class="col-lg-12 mr-4 mb-2">
						<span class="btn btn-primary" name="submit" id="submit">Submit</span>
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
		$("#submit").on('click', function(){
			
			var firstName 	= $("#first_name").val();
			var lastName  	= $("#last_name").val();
			var email		= $("#email").val();
			var password 	= $("#password").val();
			var confirmPass = $("#c_password").val();

			var flag = true;

			$(".error").text('');

			if(firstName == '')
			{
				flag = false;
				$("#first_name_error").text("Plese enter first name.");
			}

			if(lastName == '')
			{
				flag = false;
				$("#last_name_error").text("Plese enter last name.");
			}

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

			if(confirmPass == '')
			{
				flag = false;
				$("#c_password_error").text("Plese enter confirm password.");
			}

			if(email != '' && !ValidateEmail(email))
			{
				flag = false;
				$("#email_error").text("Plese enter valid email.");
			}

			if(password != '' && confirmPass != '' && password != confirmPass)
			{
				flag = false;
				$("#c_password_error").text("password and confirm password should be same.");
			}
			
			if(flag)
			{
				$.ajax({
					type: 'POST',
					url: 'registration/createUser',
					data: {
						firstName 	: firstName,
						lastName	: firstName,
						email 		: email,
						password 	: password,
						confirmPass	: confirmPass
					},
					success: function(response)
					{
						var data = JSON.parse(response);

						if(data.success == true)
						{
							$("#message").text(data.message);
						}
						else
						{
							$("#message").text(data.message)
						}
					},
					error: function(e)
					{
						alert(e);
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