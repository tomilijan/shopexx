<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../assets/sign.css">
</head>

<body>

    <div class="container">

        <div class="form_box">

            <header>ShopEx</header>

            <form action="../functions/sign_function.php" method="POST">

                <div class="input_field">
                    <label for="first_name">Name</label>
                    <input type="text" id="first_name" name="first_name" required>
                </div>
                <div class="input_field">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" required>
                </div>
                <div class="input_field">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input_field">
                    <label for="contact">Contacts</label>
                    <input type="number" id="contact" name="contact" required>
                </div>
                <div class="input_field">
                    <label for="pass">Password</label>
                    <input type="password" id="pass" name="password" required>
                </div>
                <div class="input_field">
                    <label for="cnfrm_pass">Confirm Password</label>
                    <input type="password" id="cnfrm_pass" name="cnfrm_pass" required>
                    <span id="pass_match_msg" style="color: red;"></span>
                </div>
                <div class="submit_box">
                    <input type="submit" class="btn" value="Sign Up" name="submit">
                </div>
                <div class="create">
                    Already have an account? <a href="log.php">Login</a>
                </div>
            </form>
        </div>
    </div>
    <script>

    </script>
</body>

</html>