<?php
// check if you are logged in
if (isset($_SESSION['loggedin'])) {
    // if yes, redirect to logged in
    header('Location: index.php');
    exit;
}
?>
<?php
/*// Connect to daatabase
$DATABASE_HOST = $_SESSION['DATABASE_HOST'];
$DATABASE_USER = $_SESSION['DATABASE_USER'];
$DATABASE_PASS = $_SESSION['DATABASE_PASS'];
$DATABASE_NAME = $_SESSION['DATABASE_NAME'];
// Try and connect using the info above.
//$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);*/
if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if (!isset($_POST['username'], $_POST['password'])) {
    // Could not get the data that should have been sent.
    echo 'Please fill both the username and password fields!';
    header('Location: index.php?page=login/login&stage=1');
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $mysqli->prepare('SELECT id, password, UserType FROM accounts WHERE username = ?')) {
    // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    // Store the result so we can check if the account exists in the database.
    $stmt->store_result();
    $a = $a + 1;
    echo $a;
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password, $userType);
        $stmt->fetch();
        $a = $a + 1;
        echo $a;
        // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        if (password_verify($_POST['password'], $password)) {
            // Verification success! User has logged-in!
            // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $a = $a + 1;
            echo $a;
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            echo $userType;
            if ($userType == 10) {
                $_SESSION['teacher'] = TRUE;
            }
            if ($userType == 99) {
                $_SESSION['adm'] = TRUE;
            }
            header('Location: index.php');
        } else {
            // Incorrect password
            echo 'Incorrect username and/or password!';
            header('Location: index.php?page=login/login&stage=2');
        }
    } else {
        // Incorrect username
        echo 'Incorrect username and/or password!';
        header('Location: index.php?page=login/login&stage=2');
    }

    $stmt->close();
}
?>