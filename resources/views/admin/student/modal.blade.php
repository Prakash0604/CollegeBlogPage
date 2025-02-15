  <!-- Modal -->
  <div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <form id="storeStudent" class="addForm" action=""{{ route('student.store') }}>
                  <div class="modal-header">
                      <h5 class="modal-title" id="staticBackdropLabel">Create Student</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div class="row">
                          @csrf
                          <div class="row mb-1 mt-1">
                              <div class="col-md-6">
                                  <input type="hidden" name="is_registered" value="approved">
                                  <label for="" class="form-label">Full Name<sup
                                          class="text-danger">*</sup></label>
                                  <input type="text" name="full_name" id="full_name" class="form-control"
                                      placeholder="" />
                                  <small id="full_name-error" class="text-danger error-message"></small>
                              </div>

                              <div class="col-md-6">
                                  <label for="" class="form-label">Email<sup class="text-danger">*</sup></label>
                                  <input type="email" name="email" id="email" class="form-control"
                                      placeholder="" />
                                  <small id="email-error" class="text-danger error-message"></small>
                              </div>

                          </div>


                          <div class="row mb-1 mt-1">


                              <div class="col-md-6">
                                  <label for="" class="form-label">Address<sup
                                          class="text-danger">*</sup></label>
                                  <input type="text" name="address" id="address" class="form-control"
                                      placeholder="" />
                                  <small id="address-error" class="text-danger error-message"></small>
                              </div>


                              <div class="col-md-6">
                                  <label for="" class="form-label">Contact Number<sup
                                          class="text-danger">*</sup></label>
                                  <input type="number" name="contact" id="contact" class="form-control"
                                      placeholder="" />
                                  <small id="contact-error" class="text-danger error-message"></small>
                              </div>
                          </div>

                          <div class="row mb-1 mt-1">



                              <div class="col-md-6">
                                  <label for="" class="form-label">Image</label>
                                  <input type="file" name="image" id="image" class="form-control"
                                      placeholder="" />
                                  <small id="image-error" class="text-danger error-message"></small>
                                  <div class="imageAppend">
                                  </div>
                              </div>

                              <div class="col-md-6">
                                  <label for="" class="form-label">Date of Birth<sup
                                          class="text-danger">*</sup></label>
                                  <input type="date" name="dob" id="dob" class="form-control"
                                      placeholder="" />
                                  <small id="dob-error" class="text-danger"></small>
                              </div>
                          </div>

                          <div class="row mb-1 mt-1">

                              <div class="col-md-6">
                                  <label for="" class="form-label">Gender<sup
                                          class="text-danger">*</sup></label>
                                  <select class="form-select" name="gender" id="gender">
                                      <option selected value="">Select one</option>
                                      <option value="male">Male</option>
                                      <option value="female">Female</option>
                                      <option value="others">Others</option>
                                  </select>
                                  <small id="gender-error" class="text-danger"></small>
                              </div>


                              <div class="col-md-6">
                                  <label for="" class="form-label">Batch</label>
                                  <select class="form-select" name="batch_id" id="batch_id">
                                      <option selected value="">Select one</option>
                                      @foreach ($batches as $batch)
                                          <option value="{{ $batch->id }}">{{ $batch->title }}</option>
                                      @endforeach
                                  </select>
                                  <small id="batch_id-error" class="text-danger"></small>
                              </div>
                          </div>

                          <div class="row mb-1 mt-1">


                              <div class="col-md-6">
                                  <label for="" class="form-label">Batch Type</label>
                                  <select class="form-select" name="batch_type_id" id="batch_type_id">
                                      <option selected value="">Select one</option>
                                      @foreach ($types as $type)
                                          <option value="{{ $type->id }}">{{ $type->title }}</option>
                                      @endforeach
                                  </select>
                                  <small id="batch_type_id-error" class="text-danger"></small>
                              </div>

                              <div class="col-md-6">
                                  <label for="" class="form-label">Year/Semester</label>
                                  <select class="form-select" name="year_semester_id" id="year_semester_id">

                                  </select>
                                  <small id="year_semester_id-error" class="text-danger"></small>
                              </div>
                          </div>

                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success " id="createStudentBtn">Create</button>
                      <button type="submit" class="btn btn-success " id="updateStudentBtn">Update</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
