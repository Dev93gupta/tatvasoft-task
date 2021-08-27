<html>
	<head>
		<meta charset="utf-8">
		<title>Create Blog</title>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- Bootstrap JS File -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="card mt-5">
				<div class="header mt-3">
					<h3 class="text-center">Create Blog</h3>
				</div>
				<div class="body mt-5">
					<div class="row">
						<div class="col-lg-12">
							<label class="control-label">Title</label>
							<input type="text" name="blog_title" id="blog_title" maxlength="255" class="form-control">
							<p class="red error" id="blog_title_error"></p>
						</div>
						<div class="col-lg-12">
							<label class="control-label">Description</label>
							<textarea class="form-control" name="description" maxlength="65535" id="description" rows="6"></textarea>
							<p class="red error" id="description_error"></p>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12" id="blog_div">
							<label class="control-label">Tags:</label>
							<input type="text" name="blog_tag[]" id="blog_tag" class="form-control blog_tag col-lg-9">
							<i class="fa fa-plus col-lg-3" id="plus_icon" onclick="cloneTags()"></i>
							<p class="red error" id="blog_title_error"></p>
						</div>
						<div class="col-lg-12">
							<label class="control-label">Image</label>
							<input type="file" name="blog_image" id="blog_image" class="form-control" onchange="validateImage(this);" accept="image/jpg,image/png,image/jpeg">
							<p class="red error" id="image_error"></p>
						</div>
					</div>
					<div class="row mt-5 float-right">
						<div class="col-lg-12 mr-4 mb-2">
							<span class="btn btn-primary" name="submit" id="submit">Submit</span>
							<span class="btn btn-default" name="reset" id="reset">Cancel</span>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			var baseUrl = '<?= base_url(); ?>';
			let flag = true;
			function cloneTags()
			{
				var count = $(".blog_tag").length;
				var htmlData = "";

				htmlData += "<input type='text' name='blog_tag[]' id='blog_tag"+count+"' class='blog_tag form-control col-lg-9'>";

				$("#plus_icon").before(htmlData);
			}

			function validateImage(input)
			{
				var fileSize = input.files[0].size / 1024; // in KB
				fileSize 	 = (Math.round(fileSize * 100) / 100);
				var file 	 = input.files[0];
				var fileType = file["type"];
				var validImageTypes = ["image/jpg", "image/jpeg", "image/png"];

				if(input.files[0].length == 0)
				{
					flag = false;
					$("#image_error").text("Please upload image.");
				}
				else if (fileSize > 100) 
				{
					flag = false;
					$("#image_error").text("Image size cannot be more than 100 KB.");
				} 
				else if ($.inArray(fileType, validImageTypes) < 0) 
				{
					flag = false;
				    $("#image_error").text("Please upload image file in jpg, jpeg or png format.");
				}
			}

			$("#submit").on('click', function(){
				var filename = document.getElementById('blog_image').value;

				var values = $("input[name='blog_tag[]']")
				              .map(function(k,v){ return k +": "+$(this).val();}).get();
				
				var data = [];
				$.each(values, function(k,v){
					var arrayValue = v.split(":");
					data[arrayValue[0]] = arrayValue[1];
				});

				var title 			= $("#blog_title").val();
				var discription  	= $("#description").val();

				if(title == "")
				{
					flag = false;
					$("#blog_title_error").text("Plese enter title.");
				}

				if(discription == "")
				{
					flag = false;
					$("#description_error").text("Plese enter description.");
				}

				if(flag)
				{
					$.ajax({
						type: 'POST',
						url: 'User_Blog/createNewBlog',
						data: {
							title 		: title,
							discription	: discription,
							data 		: JSON.stringify(data),
							filename 	: filename
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

		</script>
	</body>
</html>