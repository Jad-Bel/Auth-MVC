<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="public/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <div class="container">
        <h2>Register</h2>
        <?php
        if (isset($_SESSION['error'])) {
            echo '<p class="error">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
            echo '<p class="success">' . $_SESSION['success'] . '</p>';
            unset($_SESSION['success']);
        }
        ?>
        <form id="registerForm" action="/AuthMVC/index.php" method="post">
            <input type="hidden" name="action" value="register">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password">
            </div>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="/AuthMVC/index.php?page=login">Login here</a></p>
    </div>
</body>
<script src="../AuthMVC/public/js/register.js"></script>


</html>