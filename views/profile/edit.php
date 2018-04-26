<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2>Edit Profile</h2>
			</div>

			<div class="modal-body">
				<form enctype="multipart/form-data" action="/profile?action=edit" method="post">
					<div class="form-group">
						<label>New Profile Image:</label>
						<input name="profile_image" type="file" accept=".pdf, .txt">
						<span class="help-block"><?php echo (isset($errors['profile_image']) ? $errors['profile_image'] : '') ?></span>
					</div>
			        <div class="form-group">
			            <label>First Name</label>
			            <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name; ?>">
			            <span class="help-block"><?php echo (isset($errors['first_name']) ? $errors['first_name'] : '') ?></span>
			        </div>
			        <div class="form-group">
			            <label>Last Name</label>
			            <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name; ?>">
			            <span class="help-block"><?php echo (isset($errors['last_name']) ? $errors['last_name'] : '') ?></span>
			        </div>
			        <div class="form-group">
			            <label>Date of Birth</label>
			            <input type="date" name="date_of_birth" class="form-control" value="<?php echo $user->date_of_birth; ?>">
			            <span class="help-block"><?php echo (isset($errors['date_of_birth']) ? $errors['date_of_birth'] : '') ?></span>
			        </div>
			        <div class="form-group">
			            <label>Email</label>
			            <input type="email" name="email" class="form-control" value="<?php echo $user->email; ?>">
			            <span class="help-block"><?php echo (isset($errors['email']) ? $errors['email'] : '') ?></span>
			        </div>
			        <div class="form-group">
			            <label>Password</label>
			            <input type="password" name="password" class="form-control">
			            <span class="help-block"><?php echo (isset($errors['password']) ? $errors['password'] : '') ?></span>
			        </div>
			        <div class="form-group">
			            <input type="submit" class="btn btn-primary" value="Submit">
			        </div>
			    </form>
			</div>
		</div>
	</div>
</div>