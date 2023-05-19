<?php
// If the user is not logged in redirect to the login page...
if (isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
}

headerr('sign in', "login");

$test = ["a", "e", 9, 2];
if (in_array(1, $test)) {
    echo "a";
}
?>

<?php

if(isset($_POST['submit'])){  
    //ensure fields are not empty
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;
    
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);

    //Bind value.
    $stmt->bindValue(':username', $username);

    //Execute.
    $stmt->execute();
    
    //Fetch row.
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $id = $user["id"];
    $username = $user["username"];
    $enabled = $user["enabled"];

    //If $row is FALSE.
    if($user === false){
        echo '<script>alert("invalid username or password")</script>';
    }
    elseif ($enabled === false) {
        echo '<script>alert("User is disabled")</script>';
    }
    else{
        //Compare and decrypt passwords.
        $validPassword = password_verify($passwordAttempt, $user['password']);

        //If $validPassword is TRUE, the login has been successful.
        if($validPassword){
            
            //Provide the user with a login session.
            $_SESSION['loggedin'] = true;
            $_SESSION["id"] = $id;
            $_SESSION["username"] = $username;
            header('Location: index.php');
            exit;

        } else{
            //$validPassword was FALSE. Passwords do not match.
            echo '<script>alert("invalid username or password")</script>';
        }
    }
}

?>
<div class="content-wrapper-center">
    <div class="box">
        <h1>Log in</h1>
        <form action="" method="post">                          
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="password" placeholder="Password">
            <button name="submit" type="submit">sign in</button>
        </form>
    </div>
</div>

<?= template_footer() ?>