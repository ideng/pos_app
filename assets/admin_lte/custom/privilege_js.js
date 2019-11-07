if (typeof jQuery === 'undefined') {
    throw new Error('My Login Function requires jQuery')
}

var url = $('input[name="url"]').val();

function load_form_menu(id) {
    remove_box('.box-form');
    $('.table-alert').slideUp(function() {
        $(this).html('').promise().done(function() {
            get_page(url + '/load_form_menu', {id: id})
                .done(function(html) {
                    $('.view-container').prepend(html).promise().done(function() {
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
