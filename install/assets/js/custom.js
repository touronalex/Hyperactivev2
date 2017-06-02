$(document).ready(function() {	

	$(".not-switched").find("a").click(function(){
		return false;
	});

	$(".check-start").click(function(){

		if ($(this).hasClass("disabled")){
		} else {

			$(this).addClass("disabled").html("Checking...");

			StartCheck();
		}

		return false;
	});

	if ((".form-administrator").length){

		$(".admin-btn-next").click(function(e){

			var error = false;

			if ($("input[name=user]").val() == ""){
				error = error || FixClass($("input[name=user]").parent() , "error");
			} else {
				error = error || FixClass($("input[name=user]").parent() , "ok");
			}

			if ($("input[name=pass]").val() == ""){
				error = error || FixClass($("input[name=pass]").parent() , "error");
			} else {
				error = error || FixClass($("input[name=pass]").parent() , "ok");
			}

			if ($("input[name=confirm]").val() != $("input[name=pass]").val()){
				error = error || FixClass($("input[name=confirm]").parent() , "error");
			} else {
				error = error || FixClass($("input[name=confirm]").parent() , "ok");
			}

			if ($("input[name=email]").val() == ""){
				error = error || FixClass($("input[name=email]").parent() , "error");
			} else {
				error = error || FixClass($("input[name=email]").parent() , "ok");
			}


			if (error == false)	{
				var form = $(".form-administrator");

				$.ajax({

					url:form.attr("action"),
					type:form.attr("method"),

					data:form.serialize(),

				}).done(function(msg){
					switch (msg){
						case "1":
							window.location.href="index.php?step=6";
						break;
					}
				});			
			}

			return false;
		});
	}

	if ($(".mysql-check").length){

		$("input").keyup(function(e) {
				$(".btn-next").addClass("hide");
				$(".mysql-check").removeClass("hide");

				$(this).parent().removeClass("correct");
		});
	}


	$(".mysql-check").click(function(){
		var form = $(".form-database");

		$.getJSON( 
			form.attr("action"),
			form.serialize(),
			function(data){
				var error = false;


				error = error || FixClass($("input[name=server]").parent() , data.server);
				error = error || FixClass($("input[name=user]").parent() , data.user);
				error = error || FixClass($("input[name=pass]").parent() , data.pass);
				error = error || FixClass($("input[name=database]").parent() , data.database);

				if (error == true){
					$(".btn-next").addClass("hide");
					$(".mysql-check").removeClass("hide");
				} else {
					$(".btn-next").removeClass("hide");
					$(".mysql-check").addClass("hide");
				}
			}
		);
	});


	if ($(".install-result").length){

		$(".install-start").click(function(){

			if ($(this).hasClass("disabled")){
			} else {

				$(this).addClass("disabled").html("Installing...");

				InstallStatus();
			}

			return false;
		});
		
	}

});



function InstallStatus() {

	$.getJSON( 
		$(".install-result").attr("data-url") , 
		
		function(data) {

			if (typeof data.progress != "undefined"){
				//update the progress
				$(".install-progress").find(".status").css("width" , data.progress + "%");				
				$(".install-progress").find(".status-perc").html(data.progress + "%");				

			}

			if (typeof data.output != "undefined"){
				//...
				if (data.output != null)	{
					for (i in data.output){
						$(".install-result").html( $(".install-result").html() + "\n" + data.output[i] );
						$(".install-result").animate({ scrollTop: $(".install-result")[0].scrollHeight}, 100);
					}
				}
			}			

			if (typeof data.link != "undefined"){
				$(".install-result").attr("data-url" , data.link);
				InstallStatus();
			} else {

				//check if there are any error messages
				window.location.href="index.php?step=7";

			}

		}
	);

} 


function StartCheck() {
	$.getJSON( 
		$(".check-result").attr("data-url") , 
		
		function(data) {

			if (typeof data.progress != "undefined"){
				//update the progress
				$(".check-progress").find(".status").css("width" , data.progress + "%");				
				$(".check-progress").find(".status-perc").html(data.progress + "%");				

			}

			if (typeof data.errors != "undefined"){
				//...
				if (data.errors != null)	{
					for (i in data.errors){
						$(".check-result").html( $(".check-result").html() + "\n" + data.errors[i] );
						$(".check-result").animate({ scrollTop: $(".check-result")[0].scrollHeight}, 0);
					}
				}
			}			

			if (typeof data.link != "undefined"){
				//update the link to the last versio
				$(".check-result").attr("data-url" , data.link);

				//run check again
				StartCheck();
			} else {

				if ($(".check-result").html().trim()){
					$(".check-progress").hide();
					$(".action-button").hide();
					$(".check-info").fadeIn();
				} else {
					window.location.href="index.php?step=3";
				}

			}

		}
	);
}

function FixClass(handler , status) {
	var error = false;

	switch (status){
		case "error":
			error = true;
			handler.addClass("incorrect").removeClass("correct");
		break;

		case "ok":
			handler.removeClass("incorrect").addClass("correct");
		break;

		default:
			handler.removeClass("incorrect").addClass("correct");
		break;	
	}

	return error;
}