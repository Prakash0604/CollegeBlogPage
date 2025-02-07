{{-- <!-- Modal for Adding Schedule -->
<div id="scheduleModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Manage Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Start Time (HH:MM)</label>
                    <input type="time" class="form-control" id="startTime">
                </div>
                <div class="mb-3">
                    <label class="form-label">End Time (HH:MM)</label>
                    <input type="time" class="form-control" id="endTime">
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" id="scheduleDescription"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveScheduleBtn">Save Schedule</button>
            </div>
        </div>
    </div>
</div>

@push('script-items')
<script>
    $(document).ready(function () {
    let selectedDateForSchedule = ""; // Store selected date for schedule

    // Open schedule section for a selected date
    function openScheduleSection(date) {
        selectedDateForSchedule = date; // Store the selected date for schedule
        $('#scheduleModal').modal('show');
    }

    // Save schedule when the save button is clicked
    $('#saveScheduleBtn').click(function () {
        let startTime = $('#startTime').val();
        let endTime = $('#endTime').val();
        let description = $('#scheduleDescription').val();

        if (startTime && endTime && description) {
            // Ensure the schedule section is visible
            $('#scheduleSection').removeClass('d-none');
            // Adding view and remove icons to the schedule entry
            $('#scheduleList').append(`
                <div class="schedule-item">
                    <p>${selectedDateForSchedule}: ${startTime} - ${endTime}, Description: ${description}
                        <i class="fas fa-eye mx-2 viewSchedule" style="cursor:pointer;" data-desc="${description}"></i>
                        <i class="fas fa-trash mx-2 removeSchedule" style="cursor:pointer;" data-date="${selectedDateForSchedule}"></i>
                    </p>
                </div>
            `);
            $('#scheduleModal').modal('hide');
        } else {
            alert('Please fill all the fields!');
        }
    });

    // View Schedule Popup
    $(document).on('click', '.viewSchedule', function () {
        let description = $(this).data('desc');
        alert(`Description: ${description}`);
    });

    // Remove Schedule
    $(document).on('click', '.removeSchedule', function () {
        let date = $(this).data('date');
        $(this).closest('.schedule-item').remove();
        alert(`Schedule for ${date} has been removed.`);
    });
});

</script>

@endpush --}}
not in use right now
