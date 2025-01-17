<?php include "header.php";
if ($admin != 1) {
    header("location:index.php");
}
if (isset($_POST['add_user'])) {
    $username = mysqli_real_escape_string($config, $_POST['username']);
    $email = mysqli_real_escape_string($config, $_POST['email']);
    $pass = mysqli_real_escape_string($config, sha1($_POST['password']));
    $c_pass = mysqli_real_escape_string($config, sha1($_POST['c_pass']));
    $role = mysqli_real_escape_string($config, $_POST['role']);
    if (strlen($username) < 4 || strlen($username) > 100) {
        $error = "Username should have minimum 4 characters and not greater than 100";
    } elseif (strlen($pass) < 4) {
        $error = "Password should be atleast of 4 character";
    } elseif ($pass != $c_pass) {
        $error = "Please rewrite the password does not match";
    } else {
        $sql = "SELECT * FROM user WHERE email='$email'";
        $query = mysqli_query($config, $sql);
        $row = mysqli_num_rows($query);
        if ($row >= 1) {
            $error = "The email is already existed";
        } else {
            // echo "User added successfully";
            $sql2 = "INSERT INTO user (username, email, password, role) VALUES('$username', '$email', '$pass', '$role' )";
            $query2 = mysqli_query($config, $sql2);
            if ($query2) {
                $msg = ['User has been added successfully', 'alert-success'];
                $_SESSION['msg'] = $msg;
                header("location:users.php");
            } else {
                $error = "Failed, please try again";
            }
        }
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-5 m-auto bg-info p-4">
            <?php
            if (!empty($error)) {
                echo "<p class='bg-danger text-white p-2'>" . $error . "</p>";
            }
            ?>
            <form action="" method="POST">
                <p class="text-center">Add a new User</p>
                <div class="mb-3">
                    <input type="text" name="username" placeholder="Username" class="form-control" required value="<?= (!empty($error)) ? $username : ''; ?>">
                </div>
                <div class="mb-3">
                    <input type="email" name="email" placeholder="Email" class="form-control" required value="<?= (!empty($error)) ? $email : ''; ?>">
                </div>
                <div class="mb-3">
                    <input type="password" name="password" placeholder="Password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="c_pass" placeholder="Confirm Password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <select class="form-control" name="role" id="" required>
                        <option value="">Select Role</option>
                        <option value="1">Admin</option>
                        <option value="0">Co Admin</option>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="submit" name="add_user" class="btn btn-primary" value="Create">

                </div>
            </form>
        </div>
    </div>
</div>
<?php include "footer.php" ?>