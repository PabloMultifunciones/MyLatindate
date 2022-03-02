$(document).ready(function() {
	
	var have_children = $("#have_children").val();
	if (have_children == "No") {
		$("#number_children").prop('disabled', true);
		$("#oldest_children").prop('disabled', true);
		$("#youngest_children").prop('disabled', true);
		$("#more_children").prop('disabled', true);
	} else {
		$("#number_children").prop('disabled', false);
		$("#oldest_children").prop('disabled', false);
		$("#youngest_children").prop('disabled', false);
		$("#more_children").prop('disabled', false);
	}

	var country_residence = $("#country_residence").val();
	if (country_residence == "") {
		$("#state_residence").prop('disabled', true);
		$("#city_residence").prop('disabled', true);
	}

	var maxLengthPH = 100;
	var maxLengthAY = 200;
	var maxLengthLP = 200;

	$("html").click(function() {
		if ($("#navbarToggleExternalContent").hasClass("show")) {
			$("#navbarToggleExternalContent").removeClass("show");
		}
	});
	$('#navbarToggleExternalContent').click(function (e) {
		e.stopPropagation();
	});
	
	$("#form_myprofile").on("submit", function(e) {
		e.preventDefault();

		quitoErroresColorCampos();

		var url    = $("#form_myprofile").attr("action");
		var method = $("#form_myprofile").attr("method");
		
		$.ajax({
			type        : method,
			url         : url,
			data        : new FormData(this),
			processData : false,
			contentType : false,
			success     : validate_profile_creation,
			dataType    : "json"
		});
	});

	$("#have_children").on('change', function() {
		var res = $("#have_children").val();
		if (res == "No") {
			$("#number_children").prop('disabled', true);
			$("#oldest_children").prop('disabled', true);
			$("#youngest_children").prop('disabled', true);
			$("#more_children").prop('disabled', true);
		} else {
			$("#number_children").prop('disabled', false);
			$("#oldest_children").prop('disabled', false);
			$("#youngest_children").prop('disabled', false);
			$("#more_children").prop('disabled', false);
		}
	});

	$('#profile_heading').keyup(function() {
		var textlen = maxLengthPH - $(this).val().length;
		$('#rcharsPH').text(textlen);
	});   
	$('#about_yourself').keyup(function() {
		var textlen = maxLengthAY - $(this).val().length;
		$('#rcharsAY').text(textlen);
	});   
	$('#looking_partner').keyup(function() {
		var textlen = maxLengthLP - $(this).val().length;
		$('#rcharsLP').text(textlen);
	});
	$("#cover_upload").click(function() {
		$("#name_location").val("cover_image_user");
		$("#upload_img").css("display", "block");
	})
	$("#profile_upload").click(function() {
		$("#name_location").val("profile_image_user");
		$("#upload_img").css("display", "block");
	})

	$("#more-profile").click(function() {
		$("#more-profile").addClass("display-none");
		$("#show-more").removeClass("display-none");
		$("#less-profile").removeClass("display-none");
	});
	$("#less-profile").click(function() {
		$("#less-profile").addClass("display-none");
		$("#show-more").addClass("display-none");
		$("#more-profile").removeClass("display-none");
	});

	$("#more-activities").click(function() {
		$("#more-activities").addClass("display-none");
		$("#show-more-activities").removeClass("display-none");
		$("#less-activities").removeClass("display-none");
	});
	$("#less-activities").click(function() {
		$("#less-activities").addClass("display-none");
		$("#show-more-activities").addClass("display-none");
		$("#more-activities").removeClass("display-none");
	});

	$("#more-popular").click(function() {
		$("#more-popular").addClass("display-none");
		$("#show-more-popular").removeClass("display-none");
		$("#less-popular").removeClass("display-none");
	});
	$("#less-popular").click(function() {
		$("#less-popular").addClass("display-none");
		$("#show-more-popular").addClass("display-none");
		$("#more-popular").removeClass("display-none");
	});

	$("#country_residence").on("change", function() {
		var id_country = $("#country_residence").val();
		var id_country_split = id_country.split(",");

		$.ajax({
			url     :     "getState/" + id_country_split[0],
			type    :     "POST",
			success :     function(response) {
				$("#state_residence").html(response);
				$("#state_residence").prop('disabled', false);
			}
		})
	});

	$("#state_residence").on("change", function() {
		var id_state = $("#state_residence").val();
		var id_state_split = id_state.split(",");

		$.ajax({
			url     :     "getCity/" + id_state_split[0],
			type    :     "POST",
			success :     function(response) {
				$("#city_residence").html(response);
				$("#city_residence").prop('disabled', false);
			}
		})
	});

	$("#form_message").submit(function(e) {
		e.preventDefault();

		var data   = $("#form_message").serialize();
		var url    = $("#form_message").attr("action");
		var method = $("#form_message").attr("method");

		$.ajax({
			url       : url,
			data      : data,
			method    : method,
			success   : function(resp) {
				if (resp == "Enviado") {

					$("#txt_message").val("");
					$("#container-messages").stop().animate({scrollTop: $("#last").offset().top - 90}, 1000);
				}
			}
		});
	});
});

function validate_profile_creation(data){

	if (data['result']=='KO'){

		$('#carg_error_msg').html(data['errorTexto']);
		$('#carg_error_msg').removeClass('display-none');
		$('#carg_error_msg').show();
		anadoColorErroresCampos(data['error_campos'])
		$('html, body').animate({scrollTop:0}, 1500, 'swing');

	}else if (data['result']=='OK'){
		window.location.href = data['retorno'];
	}
}

function quitoErroresColorCampos(){
	$(".has-error").each(function() {
		$( this ).removeClass("has-error");
	});
}

function anadoColorErroresCampos(campos){
	for (i = 0; i < campos.length; ++i) {
		$("#"+campos[i]).addClass("has-error");
	}
}

function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#blah')
			.attr('src', e.target.result);
		};

		reader.readAsDataURL(input.files[0]);
	}
}

var iconSelect;
var selectedText;

window.onload = function(){
    
    window.addEventListener('resize', function() {
        console.log(window.innerWidth)
		//if (window.innerHeight < window.innerWidth && window.innerWidth > 900) {
		if (window.innerHeight < 50 && window.innerWidth > 900) {
			document.querySelector('#desktopTest').style.display = 'block';
			document.querySelector('#mobileTest').style.display = 'none';
		} else {
			document.querySelector('#desktopTest').style.display = 'none';
			document.querySelector('#mobileTest').style.display = 'block';
		}
	})

	if (window.innerHeight < window.innerWidth && window.innerWidth > 900) {
		document.querySelector('#mobileTest').style.display = 'none';
		document.querySelector('#desktopTest').style.display = 'block';
	} else {
	 	document.querySelector('#desktopTest').style.display = 'none';
	 	document.querySelector('#mobileTest').style.display = 'block';
	}

	iconSelect = new IconSelect("my-icon-select");

	var icons = [];
	icons.push({'iconFilePath':'img/icons/english.png', 'iconValue':'English'});
	icons.push({'iconFilePath':'img/icons/spanish.png', 'iconValue':'Spanish'});
	icons.push({'iconFilePath':'img/icons/portuguese.png', 'iconValue':'Portuguese'});

	iconSelect.refresh(icons);

	iconSelectMobile = new IconSelect("my-icon-select-mobile");

	var icons = [];
	icons.push({'iconFilePath':'img/icons/english.png', 'iconValue':'English'});
	icons.push({'iconFilePath':'img/icons/spanish.png', 'iconValue':'Spanish'});
	icons.push({'iconFilePath':'img/icons/portuguese.png', 'iconValue':'Portuguese'});

	iconSelectMobile.refresh(icons);
};

// Banners

function MostrarBanners() {
	var bannerLeft = document.querySelector('.side-banner--left')
	var bannerRight = document.querySelector('.side-banner--right')
	var body = document.getElementsByTagName('body')[0]
	var bodyHeight = body.clientHeight
	bannerLeft.style.height = `${bodyHeight}px`
	bannerRight.style.height = `${bodyHeight}px`

	body.classList.add('body--banner')
}

function QuitarBanners() {
	var bannerLeft = document.querySelector('.side-banner--left')
	var bannerRight = document.querySelector('.side-banner--right')

	bannerLeft.style.height = `0px`
	bannerRight.style.height = `0px`

	var body = document.getElementsByTagName('body')[0]
	body.classList.remove('body--banner')
}