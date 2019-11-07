function search(element, barcode) {
	let drug_id = $(element).siblings('.nama').find('input[name=\'drug_id[]\']');
	let nama = $(element).siblings('.nama').find('input[name=\'nama[]\']');
	let drug_price = $(element).siblings('.drug-price').find('input[name=\'drug_price[]\']');
	get_page(url + '/search_purchase', {
			barcode: barcode
		})
		.done((response) => {
			const result = JSON.parse(response);
			if (result.status === "success") {
				drug_id.val(result.id);
				nama.val(result.name);
				drug_price.val(result.purchase_price);
			} else {
				alert("Data Tidak Ditemukan");
			}
		})
		.fail(() => {
			alert('Sorry system encountered error!');
		});
}

$(document).on('keydown', 'input[name=\'barcode[]\']', (event) => {
	let $this = $(event.currentTarget).parents('.barcode');
	let barcode = event.target.value;
	if (event.keyCode == 13) {
		event.preventDefault();
		search($this, barcode);
		$($this).siblings('.drug-quantity').find('input[name=\'drug_quantity[]\']').focus();
	}
});
