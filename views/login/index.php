<div class="wrapper">
    <h2>Login</h2>
    <p class="bg-success"><?php echo (!empty($_GET['reg']) ? 'Registration successful!' : '') ?></p>
    <p>Please fill in your credentials to login.</p>
    <form action="/login?action=login" method="post">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
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
        <p>Don't have an account? <a href="register">Register here</a>.</p>
    </form>
</div>