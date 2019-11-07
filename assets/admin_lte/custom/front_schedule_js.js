document.addEventListener('DOMContentLoaded', function () {
	var base_url = document.querySelector('input[name=\'base_url\']').value;
	var url = document.querySelector('input[name=\'url\']').value;
	var page = document.querySelector('input[name=\'page\']').value;
	var date_now = document.querySelector('input[name=\'date_now\']').value;
	var data = {
		'page': page
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
		eventLimit: true,
		eventSources: [
			load_schedule,
		],
		eventRender: function (event) {
			date_now = new Date(date_now);
			if (event.event.start.getTime() >= date_now.getTime()) {
				let element = event.el.firstChild;
				let span = document.createElement('span');
				let btn_booking = document.createElement('button');
				let icon_booking = document.createElement('i');

				btn_booking.setAttribute('title', 'Booking Checkup');
				btn_booking.setAttribute('class', 'btn btn-default btn-sm btn-remove-event');
				icon_booking.setAttribute('class', 'fa fa-external-link fa-lg');
				icon_booking.setAttribute('aria-hidden', 'true');
				span.setAttribute('class', 'pull-right')

				btn_booking.appendChild(icon_booking);
				span.appendChild(btn_booking);
				element.appendChild(span);
				btn_booking.addEventListener('click', function () {
					$('#scheduleModal').modal().promise().done(function () {
						load_book_form(event.event.id);
					});
				});
			}
		},
	});

	moveTo('.view-container');

	calendar.render();

	/* calendar.on('dateClick', function(info) {
	    console.log(info);
	});

	calendar.on('eventClick', function(info) {
	    console.log(info);
	}); */

	function load_schedule(event, successCallback, failureCallback) {
		let start = moment(event.start).format('YYYY-MM-DD');
		let end = moment(event.end).format('YYYY-MM-DD');
		$.ajax({
			type: 'GET',
			url: base_url + '/adminpanel/schedule/load_schedule',
			data: {
				'start': start,
				'end': end
			},
			success: function (response) {
				successCallback(response);
			},
			error: function (response) {
				failureCallback(response);
			}
		});
	}

	function load_book_form(id) {
		data.id = id;
		$('.modal-container').slideUp(function () {
			$('.modal-alert').slideUp(function () {
				$(this).html('');
				$('.modal-loader').slideDown(function () {
					get_page(url + '/load_form', data)
						.done(function (html) {
							$('.modal-container').html(html).promise().done(function () {
								$('.modal-loader').slideUp(function () {
									$('.modal-container').slideDown();
								});
							});
						})
						.fail(function () {
							alert('Sorry system encountered error!');
							// window.location.reload();
						});
				});
			});
		});
	}

	$(document).off('submit', '#formBooking').on('submit', '#formBooking', function (e) {
		e.preventDefault();
		let form = this;
		$('.modal-alert').slideUp(function () {
			$(this).html('').promise().done(function () {
				submit_form(url + '/submit_form', form)
					.done(function (data) {
						$('input[name=\'' + data.csrf_name + '\']').val(data.csrf_value);
						if (data.status == 'error') {
							$('.modal-alert').html(data.msg).promise().done(function () {
								$(this).slideDown();
							});
						} else if (data.status == 'success') {
							$('#scheduleModal').modal('hide');
							$('.box-alert').html(data.msg).promise().done(function () {
								$(this).slideDown();
								calendar.refetchEvents();
								$('.modal-container').html('');
							});
						}
					})
					.fail(function () {
						alert('Sorry system encountered error!');
						// window.location.reload();
					});
			});
		});
	});
});
