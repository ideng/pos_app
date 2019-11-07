var url = $('input[name=\'url\']').val();
var page = $('input[name=\'page\']').val();

load_view();

$(document).off('click', '.btn-update').on('click', '.btn-update', function() {
    load_form();
});

$(document).off('click', '.btn-back').on('click', '.btn-back', function() {
    load_view();
});

$(document).off('change', 'select[name=\'code_part[]\']').on('change', 'select[name=\'code_part[]\']', function() {
    let value = $(this).val();
    let code_unique_form = $(this).parents('.code-part-option').siblings('.code-unique').find('.code-unique-form');
    if (value == 'urutan_angka' || value == 'kode_huruf') {
        code_unique_form.fadeIn();
    } else {
        code_unique_form.fadeOut();
    }
});

$(document).off('click', '.btn-add-code-part').on('click', '.btn-add-code-part', function() {
    get_page(url + '/add_code_format_form')
        .done(function(html) {
            $('.code-parts-form').append(html).promise().done(function() {
                $('.row').slideDown();
            });
        })
        .fail(function() {
            alert('Sorry system encountered error!');
        });
});

$(document).off('click', '.btn-remove-code-part').on('click', '.btn-remove-code-part', function() {
    $(this).parents('.code-part-form').slideUp(function() {
        $(this).remove();
    });
});

$(document).off('submit', '#formSubmit').on('submit', '#formSubmit', function(e) {
    e.preventDefault();
    let url = $('input[name="url"]').val();
    let form = this;
    $('.box-alert').slideUp(function() {
        $(this).html('').promise().done(function() {
            $('.box-overlay').show().promise().done(function() {
                submit_form(url + '/submit_form', form)
                    .done(function(data) {
                        $('input[name="csrf_token_sim_klinik"]').val(data.csrf_val);
                        $('.box-overlay').hide().promise().done(function() {
                            $('.box-alert').html(data.msg).promise().done(function() {
                                $(this).slideDown();
                            });
                            if (data.status == 'success') {
                                load_view();
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
    
function load_view() {
    $('.form-code-generator').slideUp(function() {
        $('.box-loader').fadeIn(function() {
            get_page(url + '/load_view', {page: page})
                .done(function(html) {
                    $('.form-code-generator').html(html).promise().done(function() {
                        $('.box-loader').fadeOut(function() {
                            $('.form-code-generator').slideDown();
                            moveTo('.view-container');
                        });
                    });
                })
                .fail(function() {
                    alert('Sorry system encountered error!');
                });
        });
    });
}

function load_form() {
    $('.form-code-generator').slideUp(function() {
        $('.box-loader').fadeIn(function() {
            get_page(url + '/load_form', {page: page})
                .done(function(html) {
                    $('.form-code-generator').html(html).promise().done(function() {
                        $('.box-loader').fadeOut(function() {
                            $('.form-code-generator').slideDown().promise().done(function() {
                                load_code_part_form();
                                moveTo('.view-container');
                            });
                        });
                    });
                })
                .fail(function() {
                    alert('Sorry system encountered error!');
                });
        });
    });
}

function load_code_part_form() {
    $('.code-parts-form').slideUp(function() {
        get_page(url + '/load_code_part_form', {page: page})
            .done(function(html) {
                $('.code-parts-form').html(html).promise().done(function() {
                    $(this).slideDown().promise().done(function() {
                        $('.row').slideDown();
                    });
                });
            })
            .fail(function() {
                alert('Sorry system encountered error!');
            });
    });
}
