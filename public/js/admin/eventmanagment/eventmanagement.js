$(document).ready(function () {
    // Initialize DataTable for event management
    $('#fetch-event-data').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/admin/eventmanagement', // Relative URL or replace with absolute URL
            type: 'GET'
        },
        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'image',
                name: 'image'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'description',
                name: 'description'
            },
            {
                data: 'type',
                name: 'type'
            },
            {
                data: 'location',
                name: 'location'
            },
            {
                data: 'visibility',
                name: 'visibility'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ]
    });

    // Add event modal logic
    $('#addEventBtn').on('click', function () {
        // Show the modal for adding a new event
        $('#eventModal').modal('show');
    });
});
