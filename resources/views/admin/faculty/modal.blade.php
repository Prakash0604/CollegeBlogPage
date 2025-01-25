  <!-- Modal -->
  <div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <form id="postAdd" class="addForm">
                  <div class="modal-header">
                      <h5 class="modal-title" id="staticBackdropLabel">Create Post</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div class="row">
                          @csrf
                          <div class="mb-3">
                              <label for="" class="form-label">Title <span class="text-danger">*</span> </label>
                              <input type="hidden" name="id" id="id">
                              <input type="text" name="title" id="title" class="form-control" placeholder=""
                                  aria-describedby="helpId" />
                              <small id="title-error" class="text-danger warnmessage"></small>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success " id="createDegreeBtn">Create</button>
                      <button type="submit" class="btn btn-success " id="updateDegreeBtn">Update</button>
                  </div>
              </form>
          </div>
      </div>
  </div>

  <div class="modal fade" id="assignSubjectformModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <form id="postAdd" class="addForm">
                  <div class="modal-header">
                      <h5 class="modal-title" id="assignSubjectTitle">Create Subject</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div class="row">
                          @csrf
                          <input type="hidden" name="degree_id" id="degree_id">
                          <div class="col-md-4">
                              <label for="" class="form-label">Batch<span class="text-danger">*</span></label>
                              <select class="form-select" name="batch_id" id="batch_id">
                                  <option value="">Select one</option>
                                  @foreach ($batches as $id => $batch)
                                      <option value="{{ $id }}">{{ $batch }}</option>
                                  @endforeach
                              </select>
                          </div>

                          <div class="col-md-4">
                              <label for="" class="form-label">Type<span class="text-danger">*</span></label>
                              <select class="form-select" name="batch_type_id" id="batch_type_id">
                                  <option value="">Select one</option>
                                  @foreach ($types as $id => $type)
                                      <option value="{{ $id }}">{{ $type }}</option>
                                  @endforeach
                              </select>
                          </div>

                          <div class="col-md-4">
                              <label for="" class="form-label">Semester<span class="text-danger">*</span></label>
                              <select class="form-select" name="semester_id" id="semester_id">

                              </select>
                          </div>

                          <div class="mt-3 appendMoreRow">
                            <div class="row">
                              <div class="col-md-8">
                                  <label for="" class="form-label">Subject<span class="text-danger">*</span></label>
                                  <select class="form-select subjects" name="subject_id[]" id="">
                                      <option value="">Select one</option>
                                      @foreach ($subjects as  $sub)
                                          <option value="{{ $sub->id }}">{{ $sub->title }}</option>
                                      @endforeach
                                  </select>
                              </div>
                              <div class="col-md-4 mt-4">
                                  <button type="button" class="btn btn-primary addMoreBtn">Add More</button>
                                  &nbsp;<button type="button" class="btn btn-danger">Remove</button>
                              </div>
                            </div>
                          </div>


                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success " id="assignCreateSubjectBtn">Create</button>
                      <button type="submit" class="btn btn-success " id="assignUpdateSubjectBtn">Update</button>
                  </div>
              </form>
          </div>
      </div>
  </div>

  <div class="modal fade" id="viewSubjectformModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <form id="postAdd" class="addForm">
              <div class="modal-header">
                  <h5 class="modal-title" id="viewSubjectTitle">View Subject</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div class="row">
                      @csrf
                      <input type="hidden" name="degree_id" id="view_degree_id">
                      <div class="col-md-4">
                          <label for="" class="form-label">Batch<span class="text-danger">*</span></label>
                          <select class="form-select" name="batch_id" id="view_batch_id">
                              <option value="">Select one</option>
                              @foreach ($batches as $id => $batch)
                                  <option value="{{ $id }}">{{ $batch }}</option>
                              @endforeach
                          </select>
                      </div>

                      <div class="col-md-4">
                          <label for="" class="form-label">Type<span class="text-danger">*</span></label>
                          <select class="form-select" name="batch_type_id" id="view_batch_type_id">
                              <option value="">Select one</option>
                              @foreach ($types as $id => $type)
                                  <option value="{{ $id }}">{{ $type }}</option>
                              @endforeach
                          </select>
                      </div>

                      <div class="col-md-4">
                          <label for="" class="form-label">Semester<span class="text-danger">*</span></label>
                          <select class="form-select" name="semester_id" id="view_semester_id">

                          </select>
                      </div>

                      <div class="mt-3 appendMoreRow">
                        <div
                            class="table-responsive"
                        >
                            <table
                                class="table table-bordered table-hover"
                                id="view_degree_subject"
                            >
                                <thead>
                                    <tr>
                                        <th scope="col">S.N</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>

                      </div>


                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
          </form>
      </div>
  </div>
</div>
