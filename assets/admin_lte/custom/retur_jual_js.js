if (typeof jQuery === 'undefined') {
	throw new Error('My Login Function requires jQuery')
}

var url = $('input[name="url"]').val();
var page_url = $('input[name="page_url"]').val();

$(document).off('click', '#btnDetailTransaksiRetur').on('click', '#btnDetailTransaksiRetur', function () {
	let retur = $('input[name=\'no_retur\']').val();
	getMutasiRetur(retur);
});

async function getMutasiRetur(retur) {
	return await get_page(url + '/retur_jual', {
		retur: retur,
		page_url: page_url
	}).then(response => {
		$('.modal-retur').slideUp(function () {
			$(this).html(response).promise().done(function () {
				$('.modal-retur').slideDown();
			});
		});
	}).catch(error => {
		$('.modal-retur').slideUp(function () {
			$(this).html(error.response).promise().done(function () {
				$('.modal-retur').slideDown();
			});
		});
	});
}
