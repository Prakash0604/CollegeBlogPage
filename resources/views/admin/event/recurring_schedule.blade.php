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
</div>
