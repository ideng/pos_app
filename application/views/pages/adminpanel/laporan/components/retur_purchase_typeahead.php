<script>
    var City = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        url: '<?php echo base_url('autocomplete/search_data'); ?>',
        remote: {
            url: '<?php echo base_url('autocomplete/search_data'); ?>',
            prepare: function(query, settings) {
                settings.type = 'GET';
                settings.contentType = 'application/json; charset=UTF-8';
                settings.data = {
                    'table': 'purchase_return',
                    'columns': 'no_retur',
                    'values': query
                };

                return settings;
            },
            wildcard: '%QUERY'
        }
    });

    $('#no_retur').typeahead(null, {
        limit: 50,
        minLength: 1,
        name: 'purchase_return_search',
        display: 'no_retur',
        valueKey: 'get_retur',
        source: City.ttAdapter()
    });

    $('#no_retur').bind('typeahead:select', function(obj, selected) {
        $('#no_retur_id').val(selected.id);
    });
</script>