if (typeof jQuery === 'undefined') {
	throw new Error('My Login Function requires jQuery')
}

var url = $('input[name="url"]').val();
var page_url = $('input[name="page_url"]').val();

$(document).off('click', '#btnDetailTransaksiName').on('click', '#btnDetailTransaksiName', function () {
	let name = $('input[name=\'name_view\']').val();
	getMutasiName(name);
});

async function getMutasiName(name) {
	return await get_page(url + '/retur_jual_name', {
		name: name,
		page_url: page_url
	}).then(response => {
		$('.modal-name').slideUp(function () {
			$(this).html(response).promise().done(function () {
				$('.modal-name').slideDown();
			});
		});
	}).catch(error => {
		$('.modal-name').slideUp(function () {
			$(this).html(error.response).promise().done(function () {
				$('.modal-name').slideDown();
			});
		});
	});
}
