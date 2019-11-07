document.addEventListener('DOMContentLoaded', function() {
    var page_url = document.getElementsByName('page_url')[0].value;
    var page = document.getElementsByName('page')[0].value;
    var url = document.getElementsByName('url')[0].value;
    var get_param = '?page_url=' + page_url + '&page=' + page;
    var data = {'page_url': page_url, 'page': page};
    var param = {
        headers: {'content-type': 'application/json; charset=utf-8'},
    };

    var date = new Date();
    var day = date.getDate(),
        month = date.getMonth(),
        year = date.getFullYear();
    var initialLocaleCode = 'in';
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
        header: {
            left: 'prev,next, today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        buttonText: {
            prev: 'Sebelumnya',
            next: 'Selanjutnya',
            today: 'Sekarang',
            dayGridMonth: 'Bulanan',
            timeGridWeek: 'Mingguan',
            timeGridDay: 'Harian',
            listMonth: 'List Jadwal',
        },
        defaultDate: new Date(year, month, day),
        locale: initialLocaleCode,
        buttonIcons: false,
        weekNumbers: false,
        navLinks: true,
        editable: true,
        eventLimit: true,
        eventSources: [
            load_schedule,
        ],
        eventRender: function(event) {
            let element = event.el.firstChild;
            let span = document.createElement('span');
            let btn_delete = document.createElement('button');
            let icon_delete = document.createElement('i');
            let btn_update = document.createElement('button');
            let icon_update = document.createElement('i');

            btn_delete.setAttribute('title', 'Delete Schedule');
            btn_delete.setAttribute('class', 'btn btn-box-tool btn-remove-event pull-right');
            icon_delete.setAttribute('class', 'fa fa-times fa-lg text-danger');
            btn_update.setAttribute('title', 'Update Schedule');
            btn_update.setAttribute('class', 'btn btn-box-tool btn-update-event');
            icon_update.setAttribute('class', 'fa fa-pencil fa-lg text-warning');
            span.setAttribute('class', 'pull-right')

            btn_delete.appendChild(icon_delete);
            btn_update.appendChild(icon_update);
            span.appendChild(btn_delete);
            span.appendChild(btn_update);
            element.appendChild(span);
            btn_delete.addEventListener('click', function() {
                delete_schedule(event.event.id);
                event.event.remove();
            });
            btn_update.addEventListener('click', function() {
                $('#scheduleModal').modal().promise().done(function() {
                    load_schedule_form(event.event.id);
                });
            });
        },
        eventDrop: function(event) {
            let date = moment(event.event.start).format('YYYY-MM-DD');
            let start_at = moment(event.event.start).format('HH:mm:ss');
            let end_at = moment(event.event.end).format('HH:mm:ss');
            $('.box-alert').slideUp(function() {
                $.ajax({
                    url: url + '/update_daily_schedule',
                    type: 'GET',
                    data: {'id': event.event.id, 'date': date, 'start_at': start_at, 'end_at': end_at},
                    success: function(data) {
                        $('.box-alert').html(data.msg).promise().done(function() {
                            $(this).slideDown();
                            moveTo('.view-container');
                        });
                    }
                });
            });
        },
    });

    moveTo('.view-container');

    calendar.render();

    /* calendar.on('dateClick', function(info) {
        console.log(info);
    });

    calendar.on('eventClick', function(info) {
        $('#scheduleModal').modal().promise().done(function() {
            load_schedule_form(info.event.id);
        });
    }); */

    function delete_schedule(id) {
        data.id = id;
        $('.box-alert').slideUp(function() {
            get_page(url + '/delete_schedule', data)
                .done(function(data) {
                    $('.box-alert').html(data.msg).promise().done(function() {
                        $(this).slideDown();
                        moveTo('.view-container');
                    });
                })
                .fail(function() {
                    alert('Sorry system encountered error!');
                    // window.location.reload();
                });
        });
    }

    function load_schedule(event, successCallback, failureCallback) {
        let start = moment(event.start).format('YYYY-MM-DD');
        let end = moment(event.end).format('YYYY-MM-DD');
        $.ajax({
            type: 'GET',
            url: url + '/load_schedule',
            data: {'start': start, 'end': end},
            success: function(response) {
                successCallback(response);
            },
            error: function(response) {
                failureCallback(response);
            }
        });
    }

    $(document).off('click', '.btn-set-fixed-schedule').on('click', '.btn-set-fixed-schedule', function() {
        load_fixed_schedule_form();
    });

    $(document).off('click', '.btn-add-data').on('click', '.btn-add-data', function() {
        let day_number = $(this).parents('.row').find('input[name="day_of_week[]"]').val();
        add_fixed_schedule(this, day_number);
    });

    $(document).off('click', '.btn-remove-data').on('click', '.btn-remove-data', function() {
        $(this).parents('.form-group').slideUp(function() {
            $(this).remove();
        });
    });

    $(document).off('submit', '#formSubmit').on('submit', '#formSubmit', function(e) {
        e.preventDefault();
        let form = this;
        $('.form-alert').slideUp(function() {
            $(this).html('').promise().done(function() {
                $('.form-overlay').show().promise().done(function() {
                    submit_form(url + '/submit_fixed_schedule', form)
                        .done(function(data) {
                            $('input[name="csrf_token_sim_klinik"]').val(data.csrf_val);
                            $('.form-overlay').hide().promise().done(function() {
                                if (data.status == 'error') {
                                    $('.form-alert').html(data.msg).promise().done(function() {
                                        $(this).slideDown();
                                    });
                                } else if (data.status == 'success') {
                                    remove_box('.box-fixed-schedule-form');
                                    $('.box-alert').html(data.msg).promise().done(function() {
                                        $(this).slideDown();
                                        calendar.refetchEvents();
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

    $(document).off('click', '.show-form-schedule').on('click', '.show-form-schedule', function() {
        load_schedule_form('');
    });

    $(document).off('click', '.close-schedule-modal').on('click', '.close-schedule-modal', function() {
        $('.modal-container').slideUp(function() {
            $('.modal-loader').slideDown(function() {
                $('.modal-alert').slideUp();
            });
        });
    });

    function load_schedule_form(id) {
        data.id = id;
        $('.modal-container').slideUp(function() {
            $('.modal-alert').slideUp(function() {
                $(this).html('');
                $('.modal-loader').slideDown(function() {
                    get_page(url + '/load_schedule_form', data)
                        .done(function(html) {
                            $('.modal-container').html(html).promise().done(function() {
                                $('.modal-loader').slideUp(function() {
                                    $('.modal-container').slideDown();
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
    }

    $(document).off('submit', '#formSchedule').on('submit', '#formSchedule', function(e) {
        e.preventDefault();
        let form = this;
        $('.modal-alert').slideUp(function() {
            $(this).html('').promise().done(function() {
                submit_form(url + '/submit_schedule', form)
                    .done(function(data) {
                        $('input[name="csrf_token_sim_klinik"]').val(data.csrf_val);
                        if (data.status == 'error') {
                            $('.modal-alert').html(data.msg).promise().done(function() {
                                $(this).slideDown();
                            });
                        } else if (data.status == 'success') {
                            $('#scheduleModal').modal('hide');
                            $('.box-alert').html(data.msg).promise().done(function() {
                                $(this).slideDown();
                                calendar.refetchEvents();
                                $('.modal-container').html('');
                            });
                        }
                    })
                    .fail(function() {
                        alert('Sorry system encountered error!');
                        // window.location.reload();
                    });
            });
        });
    });

    function load_fixed_schedule_form() {
        remove_box('.box-fixed-schedule-form');
        $('.box-alert').slideUp(function() {
            $(this).html('').promise().done(function() {
                get_page(url + '/load_fixed_schedule_form', data)
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

    function add_fixed_schedule(element, day_number) {
        data.day_number = day_number;
        get_page(url + '/add_fixed_schedule', data)
            .done(function(html) {
                $(element).parents('.form-fixed-schedule').append(html).promise().done(function() {
                    $(element).parents('.form-fixed-schedule').find('.form-group').slideDown();
                });
            })
            .fail(function() {
                alert('Sorry system encountered error!');
                // window.location.reload();
            });
    }
});