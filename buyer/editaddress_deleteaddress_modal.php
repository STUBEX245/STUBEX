<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Edit Address</h4></center>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="edit_address.php">
				<input type="hidden" class="form-control" name="id" value="<?php echo $row['id']; ?>">
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Home Address:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="home_address" value="<?php echo $row['home_address']; ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Zip:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="zip" value="<?php echo $row['zip']; ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">State:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="state" value="<?php echo $row['state']; ?>">
					</div>
				</div>
                <div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Area:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="area" value="<?php echo $row['area']; ?>">
					</div>
				</div>
                <div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Phone Number:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="phone_number" value="<?php echo $row['phone_number']; ?>">
					</div>
				</div>
            </div> 
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel</button>
                <button type="submit" name="edit" class="btn btn-warning"> Update</a>
			</form>
            </div>

        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete_<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Delete Address</h4></center>
            </div>
            <div class="modal-body">	
				<h2 class="text-center">Are you sure you want to Delete?</h2>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel</button>
                <a href="delete_address.php?id=<?php echo $row['id']; ?>" class="btn btn-danger"> Yes</a>
            </div>

        </div>
    </div>
</div>