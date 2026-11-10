<?php
include("database.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>Welcome to C_room</h2>
        username:<br>
        <input type="text" name="username" placeholder="type username" required><br>
        password:<br>
        <input type="password" name="password" placeholder="type password" required><br>
        <input type="submit" name="submit" value="register"><br>
    </form>
</body>

</html>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username =  filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $password =  filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($username)) {
        echo "Username is required";
    } elseif (empty($password)) {
        echo "Password is required";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (user, password) VALUES ('$username', '$hash')";

        try {
            mysqli_query($conn, $sql);
            echo "New record created successfully";
        } catch (mysqli_sql_exception) {
            echo "Username already exists";
        }
    }
}
mysqli_close($conn);
?>