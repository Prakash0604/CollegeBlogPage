  <!-- Modal -->
  <div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog ">
          <div class="modal-content">
              <form id="postAdd" class="addForm">
                  <div class="modal-header">
                      <h5 class="modal-title" id="staticBackdropLabel">Create Post</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div class="row">
                          <div class="mb-3">
                              @csrf
                              <label for="" class="form-label">Title <span class="text-danger">*</span> </label>
                              <input type="hidden" name="id" id="id">
                              <input type="text" name="title" id="title" class="form-control" placeholder=""
                                  aria-describedby="helpId" />
                              <small id="title-error" class="text-danger warnmessage"></small>
                          </div>
                          <div class="mb-3">
                              <label for="" class="form-label">Icon <span class="text-danger">*</span> </label>
                              <input type="text" name="icon" id="icon" class="form-control" placeholder=""
                                  aria-describedby="helpId" />
                              <small id="title-error" class="text-danger warnmessage"></small>
                          </div>
                           <div class="mb-3">
                              <label for="" class="form-label">Redirect <span class="text-danger">*</span> </label>
                              <input type="text" name="redirect" id="redirect" class="form-control" placeholder=""
                                  aria-describedby="helpId" />
                              <small id="redirect-error" class="text-danger warnmessage"></small>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success " id="createMenuBtn">Create</button>
                      <button type="submit" class="btn btn-success " id="updateMenuBtn">Update</button>
                  </div>
              </form>
          </div>
      </div>
  </div>

