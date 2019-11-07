if (typeof jQuery === 'undefined') {
    throw new Error('My Login Function requires jQuery')
}

var url = $('input[name="url"]').val();
var page_url = $('input[name="page_url"]').val();
var page = $('input[name="page"]').val();

function verify_checkup(id) {
    data.id = id;
    remove_box('.box-form');
    $('.table-alert').slideUp(function() {
        $(this).html('').promise().done(function() {
            get_page(url + '/verify_checkup', {id: id})
                .done(function(data) {
                    $('.table-alert').html(data.msg).promise().done(function() {
                        $(this).slideDown();
                        load_table();
                    });
                })
                .fail(function() {
                    alert('Sorry system encountered error!');
                    // window.location.reload();
                });
        });
    });
}
