if (typeof jQuery === 'undefined') {
	throw new Error('My Login Function requires jQuery')
}

var url = $('input[name="url"]').val();
var page_url = $('input[name="page_url"]').val();

$(document).off('click', '#btnDetailTransaksiFaktur').on('click', '#btnDetailTransaksiFaktur', function () {
	let faktur = $('input[name=\'no_faktur\']').val();
	getMutasiFaktur(faktur);
});

async function getMutasiFaktur(faktur) {
	return await get_page(url + '/penjualan_faktur', {
		faktur: faktur,
		page_url: page_url
	}).then(response => {
		$('.modal-faktur').slideUp(function () {
			$(this).html(response).promise().done(function () {
				$('.modal-faktur').slideDown();
			});
		});
	}).catch(error => {
		$('.modal-faktur').slideUp(function () {
			$(this).html(error.response).promise().done(function () {
				$('.modal-faktur').slideDown();
			});
		});
	});
}
