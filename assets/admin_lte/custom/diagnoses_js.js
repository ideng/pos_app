if (typeof jQuery === 'undefined') {
	throw new Error('My Login Function requires jQuery')
}

var url = $('input[name="url"]').val();
var page_url = $('input[name="page_url"]').val();
var page = $('input[name="page"]').val();

function payment_detail(id) {
	remove_box('.box-form');
	$('.btn-add-data').slideDown();
	$('.table-alert').slideUp(function () {
		$(this).html('').promise().done(function () {
			get_page(url + '/payment_detail', {
					page: page,
					page_url: page_url,
					id: id
				})
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
