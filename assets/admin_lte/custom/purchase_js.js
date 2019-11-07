var url = $('input[name=\'url\']').val();
var base_url = $('input[name=\'base_url\']').val();

function drug_payment(id) {
	remove_box('.box-form');
	$('.table-alert').slideUp(function () {
		$(this).html('').promise().done(function () {
			get_page(url + '/drug_purchase_payment', {
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

$(document).off('click', '.btn-add-payment').on('click', '.btn-add-payment', function () {
	add_payment();
});

$(document).off('click', '.btn-remove-payment').on('click', '.btn-remove-payment', function () {
	$(this).parents('.drug-form-component').slideUp(function () {
		$(this).remove();
	});
});

$(document).off('keyup', 'input[name=\'drug_price[]\']').on('keyup', 'input[name=\'drug_price[]\']', function () {
	let price = $(this).val();
	let quantity = $(this).parents('.drug-price').siblings('.drug-quantity').find('input[name=\'drug_quantity[]\']').val();
	let subtotal = count_subtotal(price, quantity);
	$(this).parents('.drug-price').siblings('.drug-subtotal').find('input[name=\'drug_subtotal[]\']').val(subtotal);

	let total = 0;
	$('input[name=\'drug_subtotal[]\']').each(function () {
		total += parseInt($(this).val());
	});
	$('input[name=\'drug_bayar\']').val(total);
	$('#drug-payment').html(total);
});

$(document).off('keyup', 'input[name=\'drug_quantity[]\']').on('keyup', 'input[name=\'drug_quantity[]\']', function () {
	let price = $(this).parents('.drug-quantity').siblings('.drug-price').find('input[name=\'drug_price[]\']').val();
	let quantity = $(this).val();
	let subtotal = count_subtotal(price, quantity);
	$(this).parents('.drug-quantity').siblings('.drug-subtotal').find('input[name=\'drug_subtotal[]\']').val(subtotal);

	let total = 0;
	$('input[name=\'drug_subtotal[]\']').each(function () {
		total += parseInt($(this).val());
	});
	$('input[name=\'drug_bayar\']').val(total);
	$('#drug-payment').html(total);
});

function count_subtotal(price, quantity) {
	price = price == '' ? '0' : price;
	quantity = quantity == '' ? '1' : quantity;
	let subtotal = parseInt(price) * parseInt(quantity);

	return subtotal;
}

function add_payment() {
	get_page(base_url + '/adminpanel/pharmacy/add_form_purchase', {
			drug_view: 'add_payment'
		})
		.done(function (html) {
			$('.drug-form').append(html).promise().done(function () {
				$('.drug-form-component').slideDown();
			});
		})
		.fail(function () {
			alert('Sorry system encountered error!');
		});
}
