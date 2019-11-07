var url = $('input[name=\'url\']').val();
var base_url = $('input[name=\'base_url\']').val();

function drug_payment(id) {
	remove_box('.box-form');
	$('.table-alert').slideUp(function () {
		$(this).html('').promise().done(function () {
			get_page(url + '/drug_payment', {
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

$(document).off('keyup', 'input[name=\'payment_price[]\']').on('keyup', 'input[name=\'payment_price[]\']', function () {
	let price = $(this).val();
	let quantity = $(this).parents('.payment-price').siblings('.payment-quantity').find('input[name=\'payment_quantity[]\']').val();
	let subtotal = count_subtotal(price, quantity);
	$(this).parents('.payment-price').siblings('.payment-subtotal').find('.payment-subtotal-text').html(subtotal);
	$(this).parents('.payment-price').siblings('.payment-subtotal').find('input[name=\'payment_subtotal[]\']').val(subtotal);

	let total = 0;
	$('input[name=\'payment_subtotal[]\']').each(function () {
		total += parseInt($(this).val());
	});
	$('input[name=\'total_price\']').val(total);
	$('#total-payment').html(total);
});

$(document).off('keyup', 'input[name=\'payment_quantity[]\']').on('keyup', 'input[name=\'payment_quantity[]\']', function () {
	let price = $(this).parents('.payment-quantity').siblings('.payment-price').find('input[name=\'payment_price[]\']').val();
	let quantity = $(this).val();
	let subtotal = count_subtotal(price, quantity);
	$(this).parents('.payment-quantity').siblings('.payment-subtotal').find('.payment-subtotal-text').html(subtotal);
	$(this).parents('.payment-quantity').siblings('.payment-subtotal').find('input[name=\'payment_subtotal[]\']').val(subtotal);

	let total = 0;
	$('input[name=\'payment_subtotal[]\']').each(function () {
		total += parseInt($(this).val());
	});
	$('input[name=\'total_price\']').val(total);
	$('#total-payment').html(total);
});

function count_subtotal(price, quantity) {
	price = price == '' ? '0' : price;
	quantity = quantity == '' ? '1' : quantity;
	let subtotal = parseInt(price) * parseInt(quantity);

	return subtotal;
}

function add_payment() {
	get_page(base_url + '/adminpanel/admission/add_drug_form', {
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

$(document).off('submit', '#formPayment').on('submit', '#formPayment', function (e) {
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
									window.open(base_url + '/adminpanel/admission/print_payment/' + data.master_key);
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
