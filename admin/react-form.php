<?php 

$jsID=$_GET['id'];
$rName = $_GET['rName'];

?>
<!DOCTYPE>
<html>
<body>

<div class="modal fade" tabindex="-1" role="dialog" id="deleteFabricPatternModal" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content" id="react">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h3 class="modal-title">Reactivate <?php echo $rName;?></h3>
            </div>
            <div class="modal-body">
              <h4>Are you sure you want to reactivate this <?php echo $rName;?>?</h4>
            </div>
            <div class="modal-footer">
              <a href="reactivate.php?rName=<?php echo $rName ?>&amp;id=<?php echo $jsID?>" type="button" role="button" class="btn btn-danger waves-effect text-left">Confirm</a>
              <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </body>
    </html>