  <!-- Modal -->
  <div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
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
              <input
                type="text"
                name="title"
                id=""
                class="form-control"
                placeholder=""
                aria-describedby="helpId"
              />
              <small id="title-error" class="text-danger warnmessage"></small>
            </div>

            <div class="mb-3">
              <label for="" class="form-label">Description<span class="text-danger">*</span></label>
              <textarea class="form-control description" name="description" id="" rows="3"></textarea>
              <small id="description-error" class="text-danger warnmessage"></small>
            </div>

            <div class="mb-3">
              <label for="" class="form-label">Type<span class="text-danger">*</span></label>
              <select
                class="form-select"
                name="type"
                id=""
              >
                <option value="">Select one</option>
                <option value="article">Article</option>
                <option value="question">Question</option>
                <option value="note">Note</option>
              </select>
              <small id="type-error" class="text-danger warnmessage"></small>
            </div>

            <div class="mb-3">
              <label for="" class="form-label">Visibility</label>
              <select
                class="form-select form-select-lg"
                name="visibility"
                id=""
              >
                <option value="">Select one</option>
                <option value="private">Private</option>
                <option selected value="public">Public</option>
              </select>
              <small id="visibility-error" class="text-danger warnmessage"></small>
            </div>

            <div class="mb-3">
              <label for="" class="form-label">Image</label>
              <input
                type="file"
                name="images[]"
                id=""
                multiple
                class="form-control"
                placeholder=""
                aria-describedby="helpId"
              />
              <small id="image-error" class="text-danger warnmessage"></small>
            </div>
            
            
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success createPostBtn">Create</button>
          <button type="submit" class="btn btn-success updatePostBtn">Update</button>
        </div>
      </form>
      </div>
    </div>
  </div>