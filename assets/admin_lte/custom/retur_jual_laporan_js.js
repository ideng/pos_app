if (typeof jQuery === 'undefined') {
	throw new Error('My Login Function requires jQuery')
}

var url = $('input[name="url"]').val();
var page_url = $('input[name="page_url"]').val();

$(document).off('click', '#btnDetailTransaksi').on('click', '#btnDetailTransaksi', function () {
	let start = $('input[name=\'start_date\']').val();
	let end = $('input[name=\'end_date\']').val();
	getMutasiData(start, end);
});

async function getMutasiData(start, end) {
	return await get_page(url + '/retur_jual_data', {
		start: start,
		end: end,
		page_url: page_url
	}).then(response => {
		$('.modal-body').slideUp(function () {
			$(this).html(response).promise().done(function () {
				$('.modal-body').slideDown();
			});
		});
	}).catch(error => {
		$('.modal-body').slideUp(function () {
			$(this).html(error.response).promise().done(function () {
				$('.modal-body').slideDown();
			});
		});
	});
}
