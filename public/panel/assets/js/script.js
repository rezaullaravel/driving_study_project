


(function ($) {
	"use strict";

	$(document).ready(function () {


	  // sidebar dropdown
	  $(".has-dropdown > a").on("click",function (e) {
		e.preventDefault();
		var $submenu = $(this).next(".sidebar-submenu");
		var $parent = $(this).parent();
		if ($submenu.css("display") === "block") {
		  $submenu.slideUp(200);
		  $parent.removeClass("active");
		} else {
		  $(".sidebar-submenu").not($submenu).slideUp(200);
		  $(".has-dropdown.active").removeClass("active");
		  $parent.addClass("active");
		  $submenu.slideDown(200);
		}
	  });

	  $(".dashboard-body__bar-icon").on("click", function () {
		$(".sidebar-menu").addClass('show-sidebar');
		$(".sidebar-overlay").addClass('show');
	  });
	  $(".sidebar-menu__close, .sidebar-overlay").on("click", function () {
		$(".sidebar-menu").removeClass('show-sidebar');
		$(".sidebar-overlay").removeClass('show');
	  });

	});

	// preloader
	$(window).on("load", function () {
	  $("#loading").fadeOut();
	})



	// toggle show hide password
	$(".toggle-password-change").on('click', function () {
	  var targetId = $(this).data("target");
	  var target = $("#" + targetId);
	  var icon = $(this);
	  if (target.attr("type") === "password") {
		target.attr("type", "text");
		icon.removeClass("fa-eye-slash");
		icon.addClass("fa-eye");
	  } else {
		target.attr("type", "password");
		icon.removeClass("fa-eye");
		icon.addClass("fa-eye-slash");
	  }

      console.log('sssssssssssssssssssss')
	});



	$(document).ready(function() {
		$('.js-example-basic-multiple').select2();
	});



	$(document).ready(function() {
		$('#summernote').summernote();
	  });



  })(jQuery);


