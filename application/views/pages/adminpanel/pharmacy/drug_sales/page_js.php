<script>
    load_drug_form('<?php echo $id; ?>');

    function load_drug_form(id) {
        $('.drug-form').slideUp(function() {
            $(this).html('').promise().done(function() {
                get_page('<?php echo base_url('adminpanel/admission/load_drug_form'); ?>', {id: id, drug_view: '<?php echo $drug_view; ?>'})
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