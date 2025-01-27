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
                              <select class="form-select" name="faculty_id" id="faculty_id">
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
                              <label for="" class="form-label">Subject<span class="text-danger">*</span></label>
                              <select class="form-select" name="subject_id" id="subject_id">

                              </select>
                              <small id="type-error" class="text-danger warnmessage"></small>
                          </div>
                          <div class="form-check form-switch d-flex mx-auto mt-3 mb-3">
                              <input type="hidden" name="hasChapter" value="N">
                              <input class="form-check-input mr-4" type="checkbox" role="switch" id="hasChapter"
                                  name="hasChapter" value="N">
                              <label class="form-check-label ml-4" for="hasChapter"> Is subject has
                                  chapter?</label>
                          </div>
                          <div class="accordion mt-4 mb-4 d-none " id="accordionExample">
                              <div class="accordion-item">
                                  <h2 class="accordion-header">
                                      <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                          data-bs-target="#collapseOne" aria-expanded="true"
                                          aria-controls="collapseOne">
                                          Subject Chapter
                                      </button>
                                  </h2>
                                  <div id="collapseOne" class="accordion-collapse collapse p-2"
                                      data-bs-parent="#accordionExample">
                                      <div class="accordion-body appendSyllabusChapter mb-3">
                                          <div class="row">
                                              <div class="col-md-6">
                                                  <label for="" class="form-label">Chapter Name: <span
                                                          class="text-danger">*</span>
                                                  </label>
                                                  <input type="hidden" name="id" id="id">
                                                  <input type="text" name="chapter_name[]" id="chapter_name"
                                                      class="form-control chapter_name" placeholder=""
                                                      aria-describedby="helpId" />
                                                  <small id="title-error" class="text-danger warnmessage"></small>
                                              </div>

                                              <div class="col-md-6">
                                                  <label for="" class="form-label">Title: <span
                                                          class="text-danger">*</span>
                                                  </label>
                                                  <input type="hidden" name="id" id="id">
                                                  <input type="text" name="chapter_title[]" id="chapter_title"
                                                      class="form-control chapter_title" placeholder=""
                                                      aria-describedby="helpId" />
                                                  <small id="title-error" class="text-danger warnmessage"></small>
                                              </div>

                                              <div class="mb-3">
                                                  <label for="" class="form-label">Description<span
                                                          class="text-danger">*</span></label>
                                                  <textarea class="form-control chapter_description" name="chapter_description[]" id="chapter_description"
                                                      rows="3"></textarea>
                                                  <small id="description-error"
                                                      class="text-danger warnmessage"></small>
                                              </div>
                                              <div class="mb-3">
                                                  <a href="javascript:void(0);"
                                                      class="btn btn-primary float-right addMoreChapter">Add More</a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>


                          <div class="singleSyllabus">
                              <div class="mb-3">
                                  <label for="" class="form-label">Title <span class="text-danger">*</span>
                                  </label>
                                  <input type="hidden" name="id" id="id">
                                  <input type="text" name="title" id="title" class="form-control"
                                      placeholder="" aria-describedby="helpId" />
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
                                  <label for="" class="form-label">File</label>
                                  <input type="file" name="file" id="file" class="form-control"
                                      placeholder="" aria-describedby="helpId" />
                                  <small id="image-error" class="text-danger warnmessage"></small>
                              </div>
                              <div class="col-6 appendFile d-flex">

                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success " id="createSyllabusBtn">Create</button>
                      <button type="submit" class="btn btn-success " id="updateSyllabusBtn">Update</button>
                  </div>
              </form>
          </div>
      </div>
  </div>

  <div class="modal fade" id="viewSyllabusModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
          <div class="modal-content">
              <form>
                  <div class="modal-header">
                      <h5 class="modal-title" id="imageTitle">View Syllabus</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div class="container-fluid">
                          <div class="header-section">
                              <h4 class="text-center mt-4 mb-4">Syllabus Details</h4>
                          </div>
                          <table class="table table-bordered">
                              <tr>
                                  <th>Faculty</th>
                                  <td id="viewFaculty"></td>
                              </tr>
                              <tr>
                                  <th>Batch</th>
                                  <td id="viewBatch"></td>
                              </tr>
                              <tr>
                                  <th>Batch Type</th>
                                  <td id="viewBatchType"></td>
                              </tr>
                              <tr>
                                  <th>Semester</th>
                                  <td id="viewSemester"></td>
                              </tr>
                              <tr>
                                  <th>Subject</th>
                                  <td id="viewSubject"></td>
                              </tr>

                              <tr>
                                <th>File</th>
                                <td id="viewFile"></td>
                            </tr>
                          </table>

                          <table class="table table-bordered table-striped showSyllabusSubject">
                              <thead>
                                  <tr>
                                      <th>S.N</th>
                                      <th>Chapter Title</th>
                                      <th>Chapter Name</th>
                                      <th>Chapter Description</th>
                                  </tr>
                              </thead>
                              <tbody>

                              </tbody>
                          </table>

                          <div class="container showSubjectifN">
                            <div class="card text-start">
                                <div class="card-body">
                                    <h4 class="card-title text-center showTitle">Hello title</h4>
                                    <textarea name="" id="showDescription" class="showDescription" cols="30" rows="10"></textarea>
                                </div>
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
