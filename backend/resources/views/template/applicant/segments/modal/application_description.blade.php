<div class="modal fade bd-example-modal-lg" id="career_profile" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Application details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <center><div class="alert alert-danger" id="add_user_errors"></div></center>
                <div class="container-fluid">
                  <form id="add_user_form">
                    <div class="form-group">
                        
                        <div class="form-row">
                          <div class="col-md-12">
                                <label for="position">Position Applied for</label>
                                <select name="position" id="posiiton">
                                  
                                </select>
                          </div>
                        </div>
                        <br>
                        <div class="form-row">
                        <div class="col-md-12">
                                <label for="lname">Write something about yourself</label>
                                <textarea name="" id="" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                  </form>
                  
                </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary btn-block" id="AddAccountSubmit">Submit</button>
            </div>
        </div>
    </div>
</div>