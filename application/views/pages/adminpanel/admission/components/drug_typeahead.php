<script>
    var Gudang = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        url: '<?php echo base_url('autocomplete/search_data'); ?>',
        remote: {
            url: '<?php echo base_url('autocomplete/search_data'); ?>',
            prepare: function(query, settings) {
                settings.type = 'GET';
                settings.contentType = 'application/json; charset=UTF-8';
                settings.data = {
                    'table': 'gudang',
                    'columns': 'name',
                    'values': query
                };

                return settings;
            },
            wildcard: '%QUERY'
        }
    });

    $('input[name=\'name[]\']').typeahead(null, {
        limit: 50,
        minLength: 1,
        name: 'gudang_search',
        display: 'name',
        valueKey: 'get_gudang',
        source: Gudang.ttAdapter()
    });

    $('.name').bind('typeahead:select', function(obj, selected) {
        $('input[name=\'drug_id[]\']').val(selected.id);
    });
</script>