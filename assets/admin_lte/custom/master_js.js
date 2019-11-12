if (typeof jQuery === 'undefined') {
	throw new Error('My Login Function requires jQuery')
}

var url = $('input[name="url"]').val();
var page_url = $('input[name="page_url"]').val();
var page = $('input[name="page"]').val();
var data = {
	'page_url': page_url,
	'page': page
};

load_table();

$(document).off('click', '.btn-add-data').on('click', '.btn-add-data', function () {
	$(this).slideUp();
	load_form('');
});

$(document).off('click', '.btn-remove-form').on('click', '.btn-remove-form', function () {
	$('.btn-add-data').slideDown().promise().done(function () {
		$('.box-form').remove();
	});
	load_table();
});

$(document).off('submit', '#formSubmit').on('submit', '#formSubmit', function (e) {
	e.preventDefault();
	let url = $('input[name="url"]').val();
	let form = this;
	$('.form-alert').slideUp(function () {
		$(this).html('').promise().done(function () {
			$('.form-overlay').show().promise().done(function () {
				submit_form(url, form)
					.done(function (data) {
						moveTo('.view-container');
						$('input[name="csrf_token_sim_klinik"]').val(data.csrf_val);
						$('.form-overlay').hide().promise().done(function () {
							if (data.status == 'error') {
								$('.form-alert').html(data.msg).promise().done(function () {
									$(this).slideDown();
								});
							} else if (data.status == 'success') {
								remove_box('.box-form');
								$('.table-alert').html(data.msg).promise().done(function () {
									$(this).slideDown();
									$('.btn-add-data').slideDown();
									load_table();
								});
							}
						});
					})
					.fail(function () {
						alert('Sorry system encountered error!');
						// window.location.reload();
					});
			});
		});
	});
});

function load_table() {
	$('.table-alert').slideUp(function () {
		$(this).html('').promise().done(function () {
			get_page(url + '/load_form', data)
				.done(function (html) {
					$('.view-container').prepend(html).promise().done(function () {
						$('.form-loader').slideUp(function () {
							$('.form-container').slideDown();
							moveTo('.view-container');
						});
					});
				})
				.fail(function () {
					alert('Sorry system encountered error!');
					// window.location.reload();
				});
		});
	});
	$('.table-loader').slideUp(function () {
		$(this).html('').promise().done(function () {
			get_page(url + '/load_table', data)
				.done(function (html) {
					$('.table-container').html(html).promise().done(function () {
						$('.table-loader').slideUp().promise().done(function () {
							$('.table-container').slideDown();
							moveTo('.view-container');
						});
					});
				})
				.fail(function () {
					alert('Sorry system encountered error!');
					// window.location.reload();
				});
		});
	});
}

function view_detail(id) {
	data.id = id;
	remove_box('.box-form');
	$('.btn-add-data').slideDown();
	$('.table-alert').slideUp(function () {
		$(this).html('').promise().done(function () {
			get_page(url + '/load_detail', data)
				.done(function (html) {
					$('.view-container').prepend(html).promise().done(function () {
						$('.form-loader').slideUp(function () {
							$('.form-container').slideDown();
							moveTo('.view-container');
						});
					});
				})
				.fail(function () {
					alert('Sorry system encountered error!');
					// window.location.reload();
				});
		});
	});
}

function load_form(id) {
	data.id = id;
	if (id != '') {
		$('.btn-add-data').slideDown();
	}
	remove_box('.box-form');
	$('.table-alert').slideUp(function () {
		$(this).html('').promise().done(function () {
			get_page(url + '/load_form', data)
				.done(function (html) {
					$('.view-container').prepend(html).promise().done(function () {
						$('.form-loader').slideUp(function () {
							$('.form-container').slideDown();
							moveTo('.view-container');
						});
					});
				})
				.fail(function () {
					alert('Sorry system encountered error!');
					// window.location.reload();
				});
		});
	});
}

function delete_data(id) {
	data.id = id;
	remove_box('.box-form');
	$('.table-alert').slideUp(function () {
		$(this).html('').promise().done(function () {
			get_page(url + '/delete_data', data)
				.done(function (data) {
					$('.table-alert').html(data.msg).promise().done(function () {
						$(this).slideDown();
						load_table();
					});
				})
				.fail(function () {
					alert('Sorry system encountered error!');
					// window.location.reload();
				});
		});
	});
}
