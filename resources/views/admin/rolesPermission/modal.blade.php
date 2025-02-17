  <!-- Modal -->
  <div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog ">
          <div class="modal-content">
              <form id="roleAdd" class="addForm">
                  <div class="modal-header">
                      <h5 class="modal-title" id="staticBackdropLabel">Create Role</h5>
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
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success " id="createRoleBtn">Create</button>
                      <button type="submit" class="btn btn-success " id="updateRoleBtn">Update</button>
                  </div>
              </form>
          </div>
      </div>
  </div>

    <!-- Modal -->
    <div class="modal fade" id="assignMenuModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <form id="roleAdd" class="addMenu">
               <div class="modal-header">
                   <h5 class="modal-title" id="modal-title">Assign Menu</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                   <div class="row">
                       @csrf
                       <input type="hidden" name="role_id" id="role_id" value="">
                       <div class="mb-3">
                           <label class="form-label">Menu</label>
                           <select class="form-select" name="menu_id[]" multiple id="menu_id">
                               {{-- @foreach ($menus as $menu)
                                   <option value="{{ $menu->id }}">{{ $menu->title }}</option>
                               @endforeach --}}
                           </select>
                       </div>
                   </div>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                   <button type="submit" class="btn btn-success" id="saveMenuBtn">Save</button>
               </div>
           </form>
       </div>
   </div>
</div>


<div class="modal fade" id="viewMenuModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
   <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="modal-title">View Menu</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
               <div class="row">
                   @csrf
                 <div
                    class="table-responsive"
                 >
                    <table
                        class="table table-primary"
                    >
                        <thead>
                            <tr>
                                <th scope="col">Menu</th>
                                <th scope="col">Remove</th>
                            </tr>
                        </thead>
                        <tbody id="appendMenus">
                        </tbody>
                    </table>
                 </div>

               </div>
           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
           </div>
   </div>
</div>
</div>



