<div class="wrapper">
    <h2>Sign Up</h2>
    <p>Please fill out this form to create an account.</p>
    <form action="/register?action=register" method="post">
        <div class="form-group">
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control" value="<?php echo (isset($first_name) ? $first_name : ''); ?>" required>
            <span class="help-block"><?php echo (isset($errors['first_name']) ? $errors['first_name'] : '') ?></span>
        </div>
        <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="last_name" class="form-control" value="<?php echo (isset($last_name) ? $last_name : ''); ?>" required>
            <span class="help-block"><?php echo (isset($errors['last_name']) ? $errors['last_name'] : '') ?></span>
        </div>
        <div class="form-group">
            <label>Date of Birth</label>
            <input type="date" name="date_of_birth" class="form-control" value="<?php echo (isset($date_of_birth) ? $date_of_birth : ''); ?>" required>
            <span class="help-block"><?php echo (isset($errors['date_of_birth']) ? $errors['date_of_birth'] : '') ?></span>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo (isset($email) ? $email : ''); ?>" required>
            <span class="help-block"><?php echo (isset($errors['email']) ? $errors['email'] : '') ?></span>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
            <span class="help-block"><?php echo (isset($errors['password']) ? $errors['password'] : '') ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
        </div>
        <p>Already have an account? <a href="login">Login here</a>.</p>
    </form>
</div>