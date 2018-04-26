<div class="page-header">

	<?php !empty($_SESSION['errors']) ? $errors = $_SESSION['errors'] : null ?>

    <h1>Hi, <b><?php echo $user->first_name . ' ' . $user->last_name; ?></b>. You are logged on!</h1>

    <?php echo (isset($_GET['edit']) && $_GET['edit'] == 'success' ? '<p class="bg-success">Profile edit successful!</p>' : '') ?>
    <?php echo (isset($_GET['edit']) && $_GET['edit'] == 'failed' ? '<p class="bg-danger">Profile edit failed!</p>' : '') ?>

    <?php echo isset($user->profile_image) ? "<img src='./public/uploads/user_" . $_SESSION['user_id'] . "/profile/" . $user->profile_image . "' width=200 height=200 />" : ''; ?>
    <ul>
    	<p><li>Email: <?php echo $user->email; ?></li></p>
    	<p><li>Date of birth (YYYY-MM-DD): <?php echo $user->date_of_birth; ?></li></p>
    </ul>
    <div>
    	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Edit Info</button>
        <a href="/profile?action=logout" class="btn btn-danger">Sign Out of Your Account</a>
    </div>
</div>

<?php require_once('edit.php') ?>