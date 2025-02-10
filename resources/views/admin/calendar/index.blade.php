@extends('admin.layout.main')
@section('content')
    <div class="container-fluid mt-5">

        <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eventModalLabel">Event Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="eventDetails">

                    </div>
                </div>
            </div>
        </div>

        <h2 class="text-center">FullCalendar</h2>

        <div id="calendar"></div>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'en',
        events: function(fetchInfo, successCallback, failureCallback) {
            $.ajax({
                url: 'event/calendar/get',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status) {
                        let events = response.event.map(event => ({
                            id: event.id,
                            title: event.title,
                            start: event.start_date,
                            end: event.end_date ? event.end_date : event.start_date,
                            backgroundColor: event.color,
                            description: event.description,
                            scheduled: event.event_sheduled
                        }));
                        successCallback(events);
                    } else {
                        failureCallback(response.message);
                    }
                },
                error: function(xhr) {
                    console.error("Error fetching events:", xhr.responseText);
                    failureCallback(xhr.responseText);
                }
            });
        },
        eventClick: function(info) {
            let event = info.event;
            let modalContent = `
                <h5>${event.title}</h5>
                <p class="text-dark">Start: ${event.start.toISOString().substring(0, 10)}</p>
                ${event.end ? `<p>End: ${event.end.toISOString().substring(0, 10)}</p>` : ''}
                <p style="color: ${event.backgroundColor};">Color: ${event.backgroundColor}</p>
                <h6>Scheduled Times:</h6>
                <ul>
            `;

            if (event.extendedProps.scheduled && event.extendedProps.scheduled.length > 0) {
                event.extendedProps.scheduled.forEach(schedule => {
                    modalContent += `<li>${schedule.date} - ${schedule.start_time} to ${schedule.end_time}</li>`;
                });
            } else {
                modalContent += `<li>No specific schedules available</li>`;
            }

            modalContent += `</ul>`;

            $('#eventModal').modal('show');
            $('#eventDetails').html(modalContent);
        }
    });

    calendar.render();
});

    </script>
@endsection
