<?php
include_once("config.php");
$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Check if the form was submitted
    $myusername = trim($_POST['username']); // Sanitize input
    $mypassword = trim($_POST['password']);
    $type = trim($_POST['type']);

    // Validate inputs
    if (empty($myusername) || empty($mypassword) || $type === 'select type') {
        $erreur = 'All fields are required.';
    } else {
        // Check if username already exists
        $sql = "SELECT * FROM utilisateur WHERE login = '$myusername'";
        $result = mysqli_query($db, $sql);

        if (mysqli_num_rows($result) > 0) {
            $erreur = 'Your login is already taken';
        } else {
            // Insert new user
            $sql = "INSERT INTO utilisateur (login, pass, type) VALUES ('$myusername', '$mypassword', '$type')";
            $ins = mysqli_query($db, $sql);

            if ($ins) {
                echo "<p style='color: green; text-align: center;'>User successfully registered!</p>";
                header("Location:Login.php");
            } else {
                $erreur = "Error: " . mysqli_error($db);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <title>Document</title>
    <style>
        .login-container {
            margin-top: 5%;
            margin-bottom: 5%;
        }
        .login-form {
            padding: 5%;
            box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
        }
        .login-form h3 {
            text-align: center;
            color: #333;
        }
        .login-container form {
            padding: 10%;
        }
        .btnSubmit {
            width: 50%;
            border-radius: 1rem;
            padding: 3.5%;
            border: none;
            cursor: pointer;
            font-weight: 600;
            color: #fff;
            background-color: #0062cc;
        }
        .centerSubmit {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container login-container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 login-form">
                <h3>Se Connecter</h3>
                <form method="post">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Your Login *" />
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Your Password *" />
                    </div>
                    <div class="form-group">
                        <select class="custom-select custom-select-lg mb-3" name="type">
                            <option selected>select type</option>
                            <option value="administrateur">Administrateur</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="form-group centerSubmit">
                        <input type="submit" name="sub" class="btnSubmit" value="SignUp" />
                    </div>
                    <?php if (!empty($erreur)): ?>
                        <div class="form-group" style="color: red; text-align: center;">
                            <p><?php echo $erreur; ?></p>
                        </div>
                    <?php endif; ?>
                        i have an account ? <span class="font-weight-bold"><a href="Login.php">Login</a> </span>

                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</body>
</html>
