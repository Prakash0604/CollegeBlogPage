  <!-- Modal -->
  <div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
          <div class="modal-content">
              <form id="postAdd" class="addForm">
                  <div class="modal-header">
                      <h5 class="modal-title" id="staticBackdropLabel">Create Post</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div class="row">
                          @csrf
                          <div class="col-md-3">
                              <label for="" class="form-label">Faculty<span class="text-danger">*</span></label>
                              <select class="form-select" name="type" id="faculty_id">
                                  <option value="">Select one</option>
                                  @foreach ($faculties as $degree)
                                  <option value="{{ $degree->id }}">{{ $degree->title }}</option>
                                  @endforeach
                              </select>
                              <small id="type-error" class="text-danger warnmessage"></small>
                          </div>

                          <div class="col-md-2">
                            <label for="" class="form-label">Batch<span class="text-danger">*</span></label>
                            <select class="form-select" name="batch_id" id="batch_id">

                            </select>
                            <small id="type-error" class="text-danger warnmessage"></small>
                        </div>

                          <div class="col-md-2">
                              <label for="" class="form-label">Type<span class="text-danger">*</span></label>
                              <select class="form-select" name="batch_type_id" id="batch_type_id">
                                <option value="">Select One</option>
                                @foreach ($yearSemesters as $type)
                                <option value="{{ $type->id }}">{{ $type->title }}</option>
                                @endforeach
                              </select>
                              <small id="type-error" class="text-danger warnmessage"></small>
                          </div>

                          <div class="col-md-3">
                              <label for="" class="form-label">Year/Semester<span
                                      class="text-danger">*</span></label>
                              <select class="form-select" name="semester_id" id="semester_id">

                              </select>
                              <small id="type-error" class="text-danger warnmessage"></small>
                          </div>

                          <div class="col-md-2">
                            <label for="" class="form-label">Subject<span
                                    class="text-danger">*</span></label>
                            <select class="form-select" name="subject_id" id="subject_id">

                            </select>
                            <small id="type-error" class="text-danger warnmessage"></small>
                        </div>

                          <div class="mb-3">
                              <label for="" class="form-label">Title <span class="text-danger">*</span> </label>
                              <input type="hidden" name="id" id="id">
                              <input type="text" name="title" id="title" class="form-control" placeholder=""
                                  aria-describedby="helpId" />
                              <small id="title-error" class="text-danger warnmessage"></small>
                          </div>

                          <div class="mb-3">
                              <label for="" class="form-label">Description<span
                                      class="text-danger">*</span></label>
                              <textarea class="form-control description" name="description" id="description" rows="3"></textarea>
                              <small id="description-error" class="text-danger warnmessage"></small>
                          </div>

                          <div class="mb-3">
                              <label for="" class="form-label">Visibility</label>
                              <select class="form-select form-select-lg" name="visibility" id="visibility">
                                  <option value="">Select one</option>
                                  <option value="private">Private</option>
                                  <option selected value="public">Public</option>
                              </select>
                              <small id="visibility-error" class="text-danger warnmessage"></small>
                          </div>

                          <div class="mb-3">
                              <label for="" class="form-label">Image</label>
                              <input type="file" name="images[]" id="images" multiple class="form-control"
                                  placeholder="" aria-describedby="helpId" />
                              <small id="image-error" class="text-danger warnmessage"></small>
                          </div>
                          <div class="col-6 appendImage d-flex">

                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success " id="createPostBtn">Create</button>
                      <button type="submit" class="btn btn-success " id="updatePostBtn">Update</button>
                  </div>
              </form>
          </div>
      </div>
  </div>

  <div class="modal fade" id="imageCrousalModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <form>
                  <div class="modal-header">
                      <h5 class="modal-title" id="imageTitle">View Images</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                          <div class="carousel-inner">

                          </div>
                          <button class="carousel-control-prev" type="button"
                              data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Previous</span>
                          </button>
                          <button class="carousel-control-next" type="button"
                              data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
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
