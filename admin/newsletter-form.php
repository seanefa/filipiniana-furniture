<?php
session_start();
if(isset($GET['id'])){
  $jsID = $_GET['id']; 
}  
$jsID=$_GET['id'];

$_SESSION['varname'] = $jsID;
include 'dbconnect.php';
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>
<!-- New Framework Material Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="newNewsletterModal" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content" id="new">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="modalNewsletter">New Letter</h3>
      </div>
      <form action="newsletter-add.php" method="post">
        <div class="modal-body">
          <div class="descriptions">
            <div class="form-body">

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label">Date</label><span id="x" style="color:red"> *</span>
					  <input type="date" class="form-control" name="news_date" value="" required>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="control-label">Content</label><span id="x" style="color:red"> *</span>
					  <textarea type="text" id="materialName" class="form-control" name="news_content" required></textarea>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <div class="modal-footer"><span id="notif" style="color:red"></span>
          <button type="submit" class="btn btn-success waves-effect text-left" id="saveBtn"><i class="fa fa-send"></i> Send</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        </div>                
      </form>
    </div>
  </div>
</div>
<!-- /.modal 