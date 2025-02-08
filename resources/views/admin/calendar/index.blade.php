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
                events: 'event/calendar/get',
                eventClick: function(info) {
                    $('#eventModal').modal('show');
                    $('#eventDetails').html(`
                <h5>${info.event.title}</h5>
                <p class="text-dark">Start: ${info.event.start.toISOString().substring(0, 10)}</p>
                ${info.event.end ? `<p>End: ${info.event.end.toISOString().substring(0, 10)}</p>` : ''}
                <p style="color: ${info.event.backgroundColor};">Color: ${info.event.backgroundColor}</p>
            `);
                },
                dateClick: function(info) {
                    var eventsOnDay = calendar.getEvents().filter(event => {
                        return (
                            new Date(info.dateStr) >= event.start &&
                            (!event.end || new Date(info.dateStr) <= event.end)
                        );
                    });

                    if (eventsOnDay.length > 0) {
                        let modalContent = '';
                        eventsOnDay.forEach(event => {
                            modalContent += `
                        <div>
                            <h5>${event.title}</h5>
                            <p>Start: ${event.start.toISOString().substring(0, 10)}</p>
                            ${event.end ? `<p>End: ${event.end.toISOString().substring(0, 10)}</p>` : ''}
                            <p style="color: ${event.backgroundColor};">Color: ${event.backgroundColor}</p>
                        </div>
                        <hr />
                    `;
                        });

                        $('#eventModal').modal('show');
                        $('#eventDetails').html(modalContent);
                    }
                }
            });

            calendar.render();
        });
    </script>
@endsection
