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
                    'table': 'city',
                    'columns': 'name',
                    'values': query
                };

                return settings;
            },
            wildcard: '%QUERY'
        }
    });

    $('#city_name').typeahead(null, {
        limit: 50,
        minLength: 1,
        name: 'city_search',
        display: 'name',
        valueKey: 'get_city',
        source: City.ttAdapter()
    });

    $('#city_name').bind('typeahead:select', function(obj, selected) {
        $('#city_id').val(selected.id);
    });
</script>