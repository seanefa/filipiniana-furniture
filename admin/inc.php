
<!-- INCLUSIONS -->
<div role="tabpanel" class="tab-pane fade" id="inclusions">
  <div class="panel-wrapper collapse in" aria-expanded="true">
    <div class="panel-body">
      <form action="add-Incl.php" method="post">
        <div class="form-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">Product Name</label>
                <select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="iProdName" value=<?php echo $row['productID'] ?>>
                 <?php

                 $sql = "SELECT * FROM tblproduct;";
                 $result = mysqli_query($conn, $sql);

                 while ($row = mysqli_fetch_assoc($result))
                 {
                  if($row['prodStat'] == 'existing'){
                    echo('<option value='.$row['productID'].'>'.$row['productName'].'</option>');
                  }
                }

                ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">Quantity</label>
              <input type="text" class="form-control" placeholder="Quantity" name="qty" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required/>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">Description</label>
              <input type="text" class="form-control" placeholder="Description" name="iDesc">
            </div>
          </div>
        </div>
        <div class="form-actions">
          <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>Add</button>
          <button type="button" class="btn btn-default">Cancel</button>
        </div>
        <hr>
      </div>
    </form>
    <div class="table-responsive">
      <table class="table color-bordered-table muted-bordered-table">
        <thead>
          <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Description</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include 'dbconnect.php';
          $sql = "SELECT * from tblprod_inclusions WHERE productIncID = 1";
          $result = mysqli_query($conn,$sql);
          while($row = mysqli_fetch_assoc($result)){
            echo "<tr><td>" . $row['prodIncDesc'] ."</td>";
            echo "<td>" . $row['prodIncQuantity'] ."</td>";
            echo "<td>" . $row['prodIncDesc'] ."</td>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="clearfix"></div>
</div>

<!-- MODAL -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span> 
      <h2 id="modalProduct">PRODUCT ID:</h2>
    </div>  
    <div class="modal-body">
      <div class="pic">
        <img src="" alt="Unavailable">
      </div>
      <div class="descriptions">
        <p>Category:</p>
        <p>Product Name:</p>
        <p>Description:</p>
        <p>Price:</p>
      </div>
    </div>
    <div class="modal-footer">
      <h3>INCLUSIONS:</h3>
      <table class="tbl">
        <tr class="thead">
          <td class="col1">Quantity</td>
          <td class="col2">Description</td>
        </tr>
      </div>
    </div>
  </div>