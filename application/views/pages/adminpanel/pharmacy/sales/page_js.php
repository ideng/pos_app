<script>
    load_drug_form_purchase('<?php echo $id; ?>');

    $('#date_in').datetimepicker({
        'format': 'DD-MM-YYYY'
    });

    $(document).off('change', 'select[name=\'select[]\']').on('change', 'select[name=\'select[]\']', function() {
        let sell_price = $(this).find(':selected').data('sell-price');
        let price_el = $(this).parents('.select').siblings('.drug-price').find('input[name=\'drug_price[]\']');
        price_el.val(sell_price);
        let barcode = $(this).find(':selected').data('barcode');
        let input_barcode = $(this).parents('.select').siblings('.barcode').find('input[name=\'barcode[]\']');
        input_barcode.val(barcode);
        let name = $(this).find(':selected').data('name');
        let input_name = $(this).parents('.select').siblings('.name').find('input[name=\'name[]\']');
        input_name.val(name);
        let id = $(this).find(':selected').data('id');
        let input_id = $(this).parents('.select').siblings('.name').find('input[name=\'drug_id[]\']');
        input_id.val(id);
        $(this).parents('.select').siblings('.drug-quantity').find('input[name=\'drug_quantity[]\']').focus();
    });

    $(document).off('click', '.btn-add-drug').on('click', '.btn-add-drug', function() {
        get_page('<?php echo base_url('adminpanel/pharmacy/add_drug_form_purchase'); ?>')
            .done(function(html) {
                $('.drug-form').append(html).promise().done(function() {
                    $('.drug-form-component').slideDown();
                });
            })
            .fail(function() {
                alert('Sorry system encountered error!');
            });
    });

    $(document).off('click', '.btn-remove-drug').on('click', '.btn-remove-drug', function() {
        $(this).parents('.drug-form-component').slideUp(function() {
            $(this).remove();
            let total = 0;
            $('input[name=\'drug_subtotal[]\']').each(function() {
                let subtotal = $(this).val();
                if (subtotal !== '') {
                    total += parseInt($(this).val());
                }
            });
            $('input[name=\'drug_bayar\']').val(total);
            $('#drug-payment').html(total);
        });
    });

    function load_drug_form_purchase(id) {
        $('.drug-form').slideUp(function() {
            $(this).html('').promise().done(function() {
                get_page('<?php echo base_url('adminpanel/pharmacy/load_drug_form_purchase'); ?>', {
                        id: id,
                        drug_view: '<?php echo $drug_view; ?>'
                    })
                    .done(function(html) {
                        $('.drug-form').html(html).promise().done(function() {
                            $(this).slideDown(function() {
                                $('.drug-form-component').slideDown();
                            });
                        });
                    })
                    .fail(function() {
                        alert('Sorry system encountered error!');
                    });
            });
        });
    }
</script>