<?php
session_start();
include './db/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (!isset($conn)) {
            throw new Exception("Database connection failed.");
        }

        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        
        if ($password != $confirm_password) {
            throw new Exception("Passwords do not match.");
        }

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        if ($stmt === false) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("ss", $username, $hashed_password);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Registration successful. Please log in.";
            header("Location: login.php");
            exit();
        } else {
            throw new Exception("Error: " . $stmt->error);
        }
    } catch (Throwable $th) {
        $_SESSION['message'] = $th->getMessage();
        header("Location: register.php");
        exit();
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        if (isset($conn)) {
            $conn->close();
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <section class="ftco-section">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-user-o"></span>
                        </div>
                        <?php if (isset($_SESSION['message'])) : ?>
                            <p class="message"><?php echo $_SESSION['message'];
                                                unset($_SESSION['message']); ?></p>
                        <?php endif; ?>
                        <h3 class="text-center mb-4">Register an account?</h3>
                        <form action="register.php" method="post" class="login-form">
                            <div class="form-group">
                                <input type="text" class="form-control rounded-left" placeholder="Username" name="username" required>
                            </div>
                            <div class="form-group d-flex">
                                <input type="password" class="form-control rounded-left" placeholder="Password" name="password" required>
                            </div>

                            <div class="form-group d-flex">
                                <input type="password" class="form-control rounded-left" placeholder="Confirm Password" name="confirm_password" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary rounded submit p-3 px-5">Get Started</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>