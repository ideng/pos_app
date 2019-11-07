if (typeof jQuery === 'undefined') {
    throw new Error('My Login Function requires jQuery')
}

var url = $('input[name="url"]').val();
var base_url = $('input[name="base_url"]').val();

async function load_data_statistics() {
    await $('.qty').html('');
    await $('.statistic-loader').fadeIn();
    let response = await fetch(url + '/load_data_statistics');
    
    if (response.status == 502) {
        await load_data_statistics();
    } else if (response.status != 200) {
        await new Promise(resolve => setTimeout(resolve, 5000));
        await load_data_statistics();
    } else {
        await response.json().then(async function(data) {
            await $('.statistic-loader').fadeOut().promise().done(async function() {
                await $('.qty-doctors').html(data.doctors);
                await $('.qty-polies').html(data.polies);
                await $('.qty-patients').html(data.patients);
                await $('.qty-checkups').html(data.checkups);
            });
        });
        
        await new Promise(() => setTimeout(load_data_statistics, 5000));
    }
}
  
load_data_statistics();

var Patients = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    url: base_url + '/autocomplete/search_data',
    remote: {
        url: base_url + '/autocomplete/search_data',
        prepare: function (query, settings) {
            settings.type = 'GET';
            settings.contentType = 'application/json; charset=UTF-8';
            settings.data = {'table': 'patients', 'columns': ['name', 'civilian_id'], 'values': query};

            return settings;
        },
        wildcard: '%QUERY'
    }
});

$(document).off('keyup', 'input[name=\'patient_search_field\']').on('keyup', 'input[name=\'patient_search_field\']', function() {
    $('input[name=\'patient_search_id\']').val('');
});

$('input[name=\'patient_search_field\']').typeahead(null, {
    limit: 50,
    minLength: 1,
    name: 'patients_search',
    display: 'name',
    valueKey: 'get_patients',
    source: Patients.ttAdapter(),
    templates: {
        empty: [
            '<code>',
                'Tidak bisa menemukan data pasien yang cocok dengan pencarian!',
            '</code>'
        ].join('\n'),
        suggestion: Handlebars.compile('<div><strong>NIK :</strong> {{civilian_id}}<br><strong>Nama :</strong> {{name}}</div>')
    }
});

$('input[name=\'patient_search_field\']').bind('typeahead:select', function(obj, selected) {
    $('input[name=\'patient_search_id\']').val(selected.id);
});

$(document).off('click', '.btn-add-patient').on('click', '.btn-add-patient', function() {
    $('.btn-add-patient').slideUp();
    let data = {page_url: 'adminpanel/master/patients', page: 'patients'}
    remove_box('.box-form');
    $('.box-alert').slideUp(function() {
        $(this).html('').promise().done(function() {
            get_page(base_url + '/adminpanel/master/load_form', data)
                .done(function(html) {
                    $('.view-container').append(html).promise().done(function() {
                        $('.form-loader').slideUp(function() {
                            $('.form-container').slideDown();
                            moveTo('.view-container');
                        });
                    });
                })
                .fail(function() {
                    alert('Sorry system encountered error!');
                    // window.location.reload();
                });
        });
    });
});

$(document).off('click', '.btn-remove-form').on('click', '.btn-remove-form', function() {
    $('.btn-add-patient').slideDown().promise().done(function() {
        $('.box-form').remove();
    });
});

$(document).off('submit', '#formSubmit').on('submit', '#formSubmit', function(e) {
    e.preventDefault();
    let form = this;
    $('.form-alert').slideUp(function() {
        $(this).html('').promise().done(function() {
            $('.form-overlay').show().promise().done(function() {
                submit_form(base_url + '/adminpanel/master/submit_form', form)
                    .done(function(data) {
                        moveTo('.view-container');
                        $('input[name="csrf_token_sim_klinik"]').val(data.csrf_val);
                        $('.form-overlay').hide().promise().done(function() {
                            if (data.status == 'error') {
                                $('.form-alert').html(data.msg).promise().done(function() {
                                    $(this).slideDown();
                                });
                            } else if (data.status == 'success') {
                                remove_box('.box-form');
                                $('.box-alert').html(data.msg).promise().done(function() {
                                    $(this).slideDown();
                                    $('.btn-add-patient').slideDown();
                                });
                            }
                        });
                    })
                    .fail(function() {
                        alert('Sorry system encountered error!');
                        // window.location.reload();
                    });
            });
        });
    });
});

$(document).off('click', 'button[name=\'btn_view_detail\']').on('click', 'button[name=\'btn_view_detail\']', function() {
    let patient_id = $('input[name=\'patient_search_id\']').val();
    let alert_btn = $('<button type=\'button\' class=\'close\' data-dismiss=\'alert\' aria-label=\'Close\'><span aria-hidden="true">×</span></button>');
    let alert_icon = $('<strong><i class=\'ace-icon fa fa-exclamation-triangle\'></i> Peringatan!</strong>');
    let alert = $('<div class=\'alert alert-warning alert-dismissible fade in\' role=\'alert\'></div>');
    alert_btn.appendTo(alert);
    alert_icon.appendTo(alert);
    alert.append('<br> Kolom pencarian masih kosong, harap pilih dari hasil pencarian!');
    $('.box-alert').slideUp(function() {
        $(this).html('').promise().done(function() {
            if (patient_id == '') {
                $('.box-alert').html(alert).promise().done(function() {
                    $(this).slideDown();
                });
            } else {
                let data = {page_url: 'adminpanel/master/patients', page: 'patients', id: patient_id};
                remove_box('.box-form');
                $('.btn-add-patient').slideDown();
                $('.box-alert').slideUp(function() {
                    $(this).html('').promise().done(function() {
                        get_page(base_url + '/adminpanel/master/load_detail', data)
                            .done(function(html) {
                                $('.view-container').append(html).promise().done(function() {
                                    $('.form-loader').slideUp(function() {
                                        $('.form-container').slideDown();
                                        moveTo('.view-container');
                                    });
                                });
                            })
                            .fail(function() {
                                alert('Sorry system encountered error!');
                                // window.location.reload();
                            });
                    });
                });
            }
        });
    });
});
