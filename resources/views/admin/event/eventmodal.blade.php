<!-- Modal for Event -->
<div class="modal fade" id="eventModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="eventAdd" class="addForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Create Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3">
                            @csrf
                            <label for="" class="form-label">Event Name <span class="text-danger">*</span> </label>
                            <input type="hidden" name="id" id="event_id">
                            <input type="text" name="event_name" id="event_name" class="form-control" placeholder=""
                                aria-describedby="helpId" />
                            <small id="event-name-error" class="text-danger warnmessage"></small>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control description" name="description" id="event_description" rows="3"></textarea>
                            <small id="event-description-error" class="text-danger warnmessage"></small>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Event Type <span class="text-danger">*</span></label>
                            <select class="form-select" name="event_type" id="event_type">
                                <option value="">Select one</option>
                                <option value="seminar">Seminar</option>
                                <option value="workshop">Workshop</option>
                                <option value="conference">Conference</option>
                            </select>
                            <small id="event-type-error" class="text-danger warnmessage"></small>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Event Date <span class="text-danger">*</span></label>
                            <input type="date" name="event_date" id="event_date" class="form-control" placeholder="" />
                            <small id="event-date-error" class="text-danger warnmessage"></small>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Event Time <span class="text-danger">*</span></label>
                            <input type="time" name="event_time" id="event_time" class="form-control" placeholder="" />
                            <small id="event-time-error" class="text-danger warnmessage"></small>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Location <span class="text-danger">*</span></label>
                            <input type="text" name="event_location" id="event_location" class="form-control" placeholder="" />
                            <small id="event-location-error" class="text-danger warnmessage"></small>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Image</label>
                            <input type="file" name="event_images[]" id="event_images" multiple class="form-control" placeholder="" aria-describedby="helpId" />
                            <small id="event-image-error" class="text-danger warnmessage"></small>
                        </div>

                        <div class="col-6 appendEventImage d-flex"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="createEventBtn">Create</button>
                    <button type="submit" class="btn btn-success" id="updateEventBtn">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Event Image Carousel Modal -->
<div class="modal fade" id="eventImageCrousalModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="eventImageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title" id="eventImageTitle">View Event Images</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="eventCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <!-- Images will be dynamically added here -->
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#eventCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#eventCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
