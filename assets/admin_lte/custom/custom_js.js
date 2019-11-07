if (typeof jQuery === 'undefined') {
	throw new Error('My Custom Function requires jQuery')
}

function submit_form(url, form_element) {
	return $.ajax({
		type: 'POST',
		url: url,
		data: new FormData(form_element),
		contentType: false,
		processData: false
	});
}

function get_page(url, data) {
	return $.ajax({
		type: 'GET',
		url: url,
		data: data
	});
}

function moveTo(element) {
	$('html, body').animate({
		scrollTop: $(element).offset().top - $('header').height()
	}, 'fast');
}

function remove_box(box_element) {
	$(box_element).slideUp(500, function () {
		$(this).remove();
	});
}
