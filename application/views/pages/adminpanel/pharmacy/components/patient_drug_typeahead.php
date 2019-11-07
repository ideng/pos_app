<script>
    var customer = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        url: '<?php echo base_url('autocomplete/search_data'); ?>',
        remote: {
            url: '<?php echo base_url('autocomplete/search_data'); ?>',
            prepare: function(query, settings) {
                settings.type = 'GET';
                settings.contentType = 'application/json; charset=UTF-8';
                settings.data = {
                    'table': 'customer',
                    'columns': 'name',
                    'values': query
                };

                return settings;
            },
            wildcard: '%QUERY'
        }
    });

    $('#patient_name').typeahead(null, {
        limit: 50,
        minLength: 1,
        name: 'customer_search',
        display: 'name',
        valueKey: 'get_customer',
        source: customer.ttAdapter()
    });

    $('#patient_name').bind('typeahead:select', function(obj, selected) {
        $('#patient_civilian_id').val(selected.civilian_id);
        $('#patient_id').val(selected.id);
    });
</script>