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

    $('#name_view').typeahead(null, {
        limit: 50,
        minLength: 1,
        name: 'customer_search',
        display: 'name',
        valueKey: 'get_customer',
        source: customer.ttAdapter()
    });

    $('#name_view').bind('typeahead:select', function(obj, selected) {
        $('#id_name').val(selected.id);
    });
</script>