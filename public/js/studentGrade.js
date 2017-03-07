	$(document).ready(function() {
		$("#show").click(function() {
			alert("html:" + $("#test").html());
			$("#test1").text("hello world");
			$(".navbar").show();
			$("table").show();	
		});

		$("#hide").click(function() {
			alert("text:" + $("#test").text());
			$("#test2").html("<b>hello world</b>");
			$("#test").remove();
			$("#test1").remove();
			$("#test2").remove();
			$(".navbar").hide();// this is class selector
			$("table").hide();
		});

		$("#sunday").click(function() {
			$("#test3").val("sunday");
			alert($("#dogy").attr("href"));

		});
		$("#animation").click(function() {
			$("#box").animate({left:'250px'});

		});
	}) ;		
	function appendText() {
		var txt1 = "<p> This is Text along with html markup</p>"; // Create text with HTML
		var txt2 = $("<p></p>").text("This is text."); // Create text With jQuery
		var txt3 = document.createElement("p");
		txt3.innerHTML = "Text created using the DOM"; // Create text with the dom
		$("body").append(txt1,txt2,txt3); // Append new Elements

	}
