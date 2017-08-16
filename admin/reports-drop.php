<?php
$id = $_POST['id'];

if($id==1){
	echo '<div class="col-md-3">
                      <input type="date" id="dateRep" name ="dateRep" class="form-control" required/>
                    </div>';
}
else if($id==2){
echo '<div class="col-md-3">
<select id="frequency" style="height:40px;" class="form-control" data-placeholder="Choose Category" tabindex="1" name="frequency"> 
						<option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                      </select>
                      </div>
                      <div class="col-md-1">
                      <input type="text" name="year" class="form-control" placeholder="Year" required>
                      </div>';

                  }
else if($id==3){
	echo '<div class="col-md-1">
          <input type="text" name="year" class="form-control" placeholder="Year" required>
          </div>';
}

?>