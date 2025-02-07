<!-- Event Creation Form -->
<div class="container mt-4">
    <h2 class="text-white">Create Event</h2>
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
        {{-- bulk action section --}}
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="triggerId" data-bs-toggle="dropdown" aria-expanded="false">
              Bulk Actions
            </button>
            <ul class="dropdown-menu" aria-labelledby="triggerId">
              <li><a class="dropdown-item" href="#">Select All</a></li>
              <li><a class="dropdown-item disabled" href="#">Delete All</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><h6 class="dropdown-header">Manage Schedule</h6></li>
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">After divider action</a></li>
            </ul>
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
            <button type="button" class="btn text-white btn-info mt-2" id="applyDateRange">Apply Range</button>



            <div id="dateListSection" class="mt-3"></div>
        </div>




        <!-- Individual Dates Selection -->
        <div id="individualDatesSection" class="mb-3 d-none">
            <button type="button" class="btn btn-primary" id="addDate">Add Date</button>
            <div id="selectedDates" class="mt-2"></div>
        </div>

        <button type="submit" class="btn btn-warning " style="margin-left:90%">Save Event</button>
    </form>
</div>



<!-- Modal for Adding Schedule -->
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
    <!-- Event Date Schedule -->
<!-- Event Date Schedule -->
<div id="scheduleSection" class="d-none mt-4 p-4 shadow-lg rounded bg-light">
    <h4 class="mb-4">Manage Event Schedule</h4>
    <div id="scheduleList">
        <!-- Example List Item -->

    </div>

</div>

</div>


@push('script-items')
<script>
    $(document).ready(function () {
        let selectedDates = new Set();
        let selectedRangeDates = []; // For managing selected range dates
        let selectedDateForSchedule = ""; // Store selected date for schedule

        // Toggle between range and individual date selection
        function updateDateSelectionVisibility() {
            if ($('#rangeToggle').is(':checked')) {
                $('#dateRangeSection').removeClass('d-none');
                $('#individualDatesSection').addClass('d-none');
            } else {
                $('#dateRangeSection').addClass('d-none');
                $('#individualDatesSection').removeClass('d-none');
            }
        }

        // Add a date input field and manage schedule button
        function addDateInput(dateVal) {
            let dateWrapper = $('<div>').addClass('d-flex align-items-center my-2');
            let dateInput = $('<input>').attr({ type: 'date', class: 'form-control date-picker' }).val(dateVal);
            let scheduleBtn = $('<button>').text('Manage Schedule').addClass('btn btn-sm btn-primary mx-2 openSchedule').data('date', dateVal);
            dateWrapper.append(dateInput, scheduleBtn);
            $('#selectedDates').append(dateWrapper);
        }

        // Show schedule section for each date
        function openScheduleSection(date) {
            selectedDateForSchedule = date; // Store the selected date for schedule
            $('#scheduleModal').modal('show');
        }

        // Validate and add a date
        function validateAndAddDate(dateVal) {
            if (!dateVal) return;
            if (selectedDates.has(dateVal)) {
                alert('This date is already selected!');
                return;
            }
            selectedDates.add(dateVal);
            addDateInput(dateVal);
        }

        // Save schedule
        $('#saveScheduleBtn').click(function () {
            let startTime = $('#startTime').val();
            let endTime = $('#endTime').val();
            let description = $('#scheduleDescription').val();

            if (startTime && endTime && description) {
    // Ensure the schedule section is visible
    $('#scheduleSection').removeClass('d-none');

    // Create the schedule row and append it to the table
    $('#scheduleList').append(`
        <table class=" dataTable table table-striped mt-3">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>${selectedDateForSchedule}</td>
                    <td>${startTime}</td>
                    <td>${endTime}</td>
                    <td>${description}</td>
                    <td>
                        <button class="btn btn-sm btn-info mx-1 viewSchedule" data-desc="${description}" style="cursor:pointer;">View</button>
                        <button class="btn btn-sm btn-warning mx-1 editSchedule" data-date="${selectedDateForSchedule}" data-start="${startTime}" data-end="${endTime}" data-desc="${description}" style="cursor:pointer;">Edit</button>
                        <button class="btn btn-sm btn-danger mx-1 removeSchedule" data-date="${selectedDateForSchedule}" style="cursor:pointer;">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    `);

    $('#scheduleModal').modal('hide');
}
 else {
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

        // Event listeners
        $('input[name="date_selection"]').change(updateDateSelectionVisibility);

        $('#addDate').click(function () {
            let dateVal = prompt('Enter date (YYYY-MM-DD):');
            validateAndAddDate(dateVal);
        });

        $(document).on('click', '.openSchedule', function () {
            let date = $(this).data('date');
            if (!date) {
                alert('Please select a date first!');
                return;
            }
            openScheduleSection(date);
        });

        // Apply Date Range
        $('#applyDateRange').click(function () {
            const startDate = $('[name="start_date"]').val();
            const endDate = $('[name="end_date"]').val();
            if (startDate && endDate) {
                const start = new Date(startDate);
                const end = new Date(endDate);
                const dateList = [];
                while (start <= end) {
                    dateList.push(new Date(start).toISOString().split('T')[0]);
                    start.setDate(start.getDate() + 1);
                }
                displayDateList(dateList);
            }
        });

        // Display the list of dates for the selected range
        function displayDateList(dates) {
            const dateListSection = $('#dateListSection');
            dateListSection.empty();
            dates.forEach(date => {
                const div = $('<div>').addClass('d-flex justify-content-between align-items-center mb-2');
                div.html(`
                    <span>${date}</span>
                    <button type="button" class="btn btn-info btn-sm openSchedule" data-date="${date}">Manage Schedule</button>
                `);
                dateListSection.append(div);
                selectedRangeDates.push(date); // Store the selected range dates
            });
        }
    });
</script>
@endpush


@push('style-items')
<style>
    /* Add golden bottom borders to the list items */
#scheduleList .list-group-item {
    border-bottom: 2px solid gold;
}

/* Additional style for the container */
#scheduleSection {
    background-color: #f8f9fa; /* Light background */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Soft shadow */
    border-radius: 8px; /* Rounded corners */
}

#scheduleSection h4 {
    font-weight: 600; /* Bold title */
    color: #333; /* Dark text for contrast */
}

#addScheduleBtn {
    margin-top: 15px;
}

</style>

@endpush
