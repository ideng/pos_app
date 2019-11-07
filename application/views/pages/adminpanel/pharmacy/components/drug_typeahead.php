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
                    'table': 'drugs',
                    'columns': 'name',
                    'values': query
                };

                return settings;
            },
            wildcard: '%QUERY'
        }
    });

    $('#drug_name').typeahead(null, {
        limit: 50,
        minLength: 1,
        name: 'drug_search',
        display: 'name',
        valueKey: 'get_drugs',
        source: City.ttAdapter()
    });

    $('#drug_name').bind('typeahead:select', function(obj, selected) {
        $('#drug_id').val(selected.id);
    });
</script>