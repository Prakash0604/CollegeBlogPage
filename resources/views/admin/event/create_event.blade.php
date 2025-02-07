<!-- Event Creation Form -->
<div class="container mt-4">
    <h2>Create Event</h2>
    <form id="eventForm">
        @csrf
        <div class="mb-3">
            <label class="form-label">Event Name <span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description <span class="text-danger">*</span></label>
            <textarea name="description" class="form-control" rows="3" required></textarea>
        </div>

        <!-- Toggle Selection -->
        <div class="mb-3">
            <label class="form-label">Select Dates</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="date_selection" id="rangeToggle" value="range">
                <label class="form-check-label" for="rangeToggle">Select Date Range</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="date_selection" id="individualToggle" value="individual">
                <label class="form-check-label" for="individualToggle">Select Individual Dates</label>
            </div>
        </div>

        <!-- Date Range Selection -->
        <div id="dateRangeSection" class="mb-3 d-none">
            <label class="form-label">Start Date <span class="text-danger">*</span></label>
            <input type="date" name="start_date" class="form-control">
            <label class="form-label mt-2">End Date <span class="text-danger">*</span></label>
            <input type="date" name="end_date" class="form-control">
        </div>

        <!-- Individual Dates Selection -->
        <div id="individualDatesSection" class="mb-3 d-none">
            <button type="button" class="btn btn-primary" id="addDate">Add Date</button>
            <div id="selectedDates" class="mt-2"></div>
        </div>

        <button type="submit" class="btn btn-success">Save Event</button>
    </form>
</div>

<!-- Event Date Schedule Popup -->
<div class="modal fade" id="eventDateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Manage Event Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="eventScheduleForm">
                    <label class="form-label">Add Time Slot</label>
                    <div class="mb-3">
                        <input type="time" class="form-control" name="start_time" required>
                    </div>
                    <div class="mb-3">
                        <input type="time" class="form-control" name="end_time" required>
                    </div>
                    <button type="button" class="btn btn-success" id="addSchedule">Add Schedule</button>
                </form>
                <div id="scheduleList" class="mt-3"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@push('script-items')
<script>
    $(document).ready(function() {
        // Toggle date selection
        $('input[name="date_selection"]').change(function() {
            if ($('#rangeToggle').is(':checked')) {
                $('#dateRangeSection').removeClass('d-none');
                $('#individualDatesSection').addClass('d-none');
            } else {
                $('#dateRangeSection').addClass('d-none');
                $('#individualDatesSection').removeClass('d-none');
            }
        });

        // Add individual date selection
        $('#addDate').click(function() {
            let dateInput = $('<input>').attr({ type: 'date', class: 'form-control my-2' });
            let scheduleBtn = $('<button>').text('Manage Schedule').addClass('btn btn-sm btn-primary mx-2 openSchedule');
            let dateWrapper = $('<div>').addClass('d-flex align-items-center').append(dateInput, scheduleBtn);
            $('#selectedDates').append(dateWrapper);
        });

        // Open event schedule popup
        $(document).on('click', '.openSchedule', function() {
            $('#eventDateModal').modal('show');
        });

        // Add schedule time slot
        $('#addSchedule').click(function() {
            let startTime = $('input[name="start_time"]').val();
            let endTime = $('input[name="end_time"]').val();
            if (startTime && endTime) {
                let scheduleEntry = `<p>${startTime} - ${endTime}</p>`;
                $('#scheduleList').append(scheduleEntry);
            }
        });
    });
</script>
@endpush
