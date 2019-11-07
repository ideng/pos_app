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
                    'table': 'sales',
                    'columns': 'no_faktur',
                    'values': query
                };

                return settings;
            },
            wildcard: '%QUERY'
        }
    });

    $('#no_faktur').typeahead(null, {
        limit: 50,
        minLength: 1,
        name: 'sales_search',
        display: 'no_faktur',
        valueKey: 'get_faktur',
        source: City.ttAdapter()
    });

    $('#no_faktur').bind('typeahead:select', function(obj, selected) {
        $('#no_faktur_id').val(selected.id);
    });
</script>