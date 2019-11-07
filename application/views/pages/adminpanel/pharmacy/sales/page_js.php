<script>
    load_drug_form_purchase('<?php echo $id; ?>');

    $('#date_in').datetimepicker({
        'format': 'DD-MM-YYYY'
    });

    $(document).off('change', 'select[name=\'drug_id[]\']').on('change', 'select[name=\'drug_id[]\']', function() {
        let sell_price = $(this).find(':selected').data('sell-price');
        let price_el = $(this).parents('.drug-id').siblings('.drug-price').find('input[name=\'drug_price[]\']');
        price_el.val(sell_price);
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