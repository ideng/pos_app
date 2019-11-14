function search(elemen, name) {
	let drug_id = $(elemen).siblings('.barcode').find('input[name=\'drug_id[]\']');
	let barcode = $(elemen).siblings('.barcode').find('input[name=\'barcode[]\']');
	let drug_price = $(elemen).siblings('.drug-price').find('input[name=\'drug_price[]\']');
	get_page(url + '/search_purchase_barang', {
			name: name
		})
		.done((respon) => {
			const result = JSON.parse(respon);
			if (result.status === "success") {
				drug_id.val(result.id);
				barcode.val(result.barcode);
				drug_price.val(result.purchase_price);
			} else {
				alert("Data Tidak Ditemukan");
			}
		})
		.fail(() => {
			alert('Sorry system encountered error!');
		});
}

$(document).on('keydown', 'input[name=\'name[]\']', (even) => {
	let $this = $(even.currentTarget).parents('.name');
	let name = even.target.value;
	if (even.keyCode == 13) {
		even.preventDefault();
		search($this, name);
		$($this).siblings('.drug-quantity').find('input[name=\'drug_quantity[]\']').focus();
	}
});
