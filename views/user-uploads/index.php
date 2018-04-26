<div>
	<?php !empty($_SESSION['errors']) ? $errors = $_SESSION['errors'] : null ?>

	<?php echo (isset($_GET['upload']) && $_GET['upload'] == 'success' ? '<p class="bg-success">Uploaded successful!</p>' : '') ?>
    <?php echo (isset($_GET['upload']) && $_GET['upload'] == 'failed' ? '<p class="bg-danger">Upload failed!</p>' : '') ?>

	<form enctype="multipart/form-data" action="/user-uploads?action=add" method="post">
		<div class="form-group">
			<label>New Upload</label>
			<input name="file_upload" type="file">
		</div>
		<div class="form-group">
			<label>Text File</label>
			<textarea name="text_file" rows=5></textarea>
		</div>
		<p>
			<span class="help-block"><?php echo (isset($errors['file_upload']) ? $errors['file_upload'] : '') ?></span>
		</p>
		<div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
        </div>
	</form>
</div>

<div>
	<h2>User Uploads</h2>
	<ul>
		<?php 
			foreach($uploads as $upload) {
				echo '<li><a href="/user-uploads?download=true&filename=' . $upload['filename'] . '&user_id=' . $upload['user_id'] . '">' . $upload['filename'] . '</a> uploaded by ' . $upload['first_name'] . ' ' . $upload['last_name'] . ' at ' . $upload['uploaded_at'] . '</li>';
			}
		?>
	</ul>
</div>