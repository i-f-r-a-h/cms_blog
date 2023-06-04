$(document).ready(function () {

	var user_href;
	var user_href_splitted;
	var user_id;
	var image_src;
	var image_href_splitted;
	var image_name;
	var photo_id;


	$(".modal_thumbnails").click(function () {

		$("#set_user_image").prop('disabled', false);

		$(this).addClass('selected');
		user_href = $("#user-id").prop('href');
		user_href_splitted = user_href.split("=");
		user_id = user_href_splitted[user_href_splitted.length - 1];


		image_src = $(this).prop("src");
		image_href_splitted = image_src.split("/");
		image_name = image_href_splitted[image_href_splitted.length - 1];


		photo_id = $(this).attr("data");


		$.ajax({
			url: "includes/ajax_code.php",
			data: {
				photo_id: photo_id
			},
			type: "POST",
			success: function (data) {
				if (!data.error) {

					$("#modal_sidebar").html(data);
				}
			}

		});




	});



	$("#set_user_image").click(function () {


		$.ajax({

			url: "includes/ajax_code.php",
			data: {
				image_name: image_name,
				user_id: user_id
			},
			type: "POST",
			success: function (data) {

				if (!data.error) {

					$(".user_image_box a img").prop('src', data);


					// location.reload(true);

				}


			}





		});






	});





	/*************Edit Photo side bar************/



	$(".info-box-header").click(function () {


		$(".inside").slideToggle("fast");

		$("#toggle").toggleClass("glyphicon-menu-down glyphicon , glyphicon-menu-up glyphicon ");



	});


	/***********Delete Functio***********/


	// $(".delete_link").click(function () {

	// 	return confirm("Are you sure you want to delete this item");

	// });



	// tinymce.init({
	// 	selector: "#textarea"
	// });

	// });


	/*********** search bar ***********/

	$(document).ready(function () {

		//On pressing a key on "Search box" in "search.php" file. This function will be called.
		$("#search-blog").keyup(function () {
			console.log("hello");
			//Assigning search box value to javascript variable named as "name".
			$('#default-search').hide();
			let name = $('#search-blog').val();
			//Validating, if "name" is empty.
			if (name == "" || name == null) {
				//Assigning empty value to "display" div in "search.php" file.
				$("#display-search-result").html("");
				$('#default-search').show();
			}
			//If name is not empty.
			else {
				//AJAX is called.
				$.ajax({
					//AJAX type is "Post".
					type: "POST",
					//Data will be sent to "ajax.php".
					url: "/blog/controller/search/post.php",
					//Data, that will be sent to "ajax.php".
					data: {
						//Assigning value of "name" into "search" variable.
						search: name
					},
					//If result found, this funtion will be called.
					success: function (html) {
						//Assigning result to "display" div in "search.php" file.
						$("#display-search-result").html(html);
					}
				});
			}
		});
	});
});