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
                    'table': 'supplier',
                    'columns': 'name',
                    'values': query
                };

                return settings;
            },
            wildcard: '%QUERY'
        }
    });

    $('#supplier_name').typeahead(null, {
        limit: 50,
        minLength: 1,
        name: 'supplier_search',
        display: 'name',
        valueKey: 'get_supplier',
        source: City.ttAdapter()
    });

    $('#supplier_name').bind('typeahead:select', function(obj, selected) {
        $('#code_supplier_id').val(selected.supplier_code);
        $('#supplier_id').val(selected.id);
    });
</script>