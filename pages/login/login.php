<?php
// If the user is not logged in redirect to the login page...
if (isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
}

headerr('sign in');
?>

<?php

if(isset($_POST['submit'])){  
    //ensure fields are not empty
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;

    $sql = "SELECT id, username, password FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);

    //Bind value.
    $stmt->bindValue(':username', $username);

    //Execute.
    $stmt->execute();
    
    //Fetch row.
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    print_r($user);

    $id = $user["id"];
    $username = $user["username"];

    echo "<br><br>";
    echo $id;
    echo "<br>";
    echo $username;


    //If $row is FALSE.
    if($user === false){
        echo '<script>alert("invalid username or password")</script>';
    } else{
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