<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/login.css">
    <title>Log In</title>

</head>

<body>

    <div class="container">
        <header>ShopEx</header>
        <form action="../functions/log_function.php" method="POST">

            <div class="input_field">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input_field">
                <label for="pass">Password</label>
                <input type="password" id="pass" name="password" required>
            </div>
            <div class="submit_box">
                <input type="submit" class="btn" value="Login" name="submit">
            </div>
            <div class="create">
                Don't have an account? <a href="sign.php">Sign Up</a><br>
                Become a Admin? <a href="../admin/adsign.php">Sign as Admin</a>
            </div>
            <div></div>

        </form>
    </div>

</body>

</html>