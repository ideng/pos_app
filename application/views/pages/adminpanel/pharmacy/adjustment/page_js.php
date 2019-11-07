<?php
defined('BASEPATH') or exit('No direct script access allowed!');
?>
<script>
    $(document).off('change', 'select[name=\'drug_id\']').on('change', 'select[name=\'drug_id\']', function() {
        let purchase_price = $(this).find(':selected').data('purchase-price');
        let price_el = $(this).parents('.drug-id').siblings('.drug-price').find('input[name=\'drug_price\']');
        price_el.val(purchase_price);
    });
</script>