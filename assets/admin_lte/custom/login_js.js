if (typeof jQuery === 'undefined') {
    throw new Error('My Login Function requires jQuery')
}

$(document).off('submit', '#formLogin').on('submit', '#formLogin', function(e) {
    e.preventDefault();
    let url = $('input[name="url"]').val();
    submit_form(url, this)
        .done(function(data) {
            $('.form-alert').slideUp().promise().done(function() {
                $(this).html('').promise().done(function() {
                    $(this).html(data.msg).promise().done(function() {
                        $(this).slideDown();
                    });
                });
            });
            $('input[name="csrf_token_sim_klinik"]').val(data.csrf_val);
            if (data.status == 'success') {
                location.assign(data.redirect);
            }
        })
        .fail(function () {
            alert('Sorry system encountered error!');
            // window.location.reload();
        });
});
