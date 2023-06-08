<?php
// If the user is not logged in redirect to the login page...
if (isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
}

headerr('sign in', "login");
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
        echo '<script>alert("Invalid username or password")</script>';
    }
    elseif ($enabled === false) {
        echo '<script>alert("Invalid username or password")</script>';
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

            if ($_POST["remember"]) {
                
                $selector = bin2hex(random_bytes(16));
                $validator = bin2hex(random_bytes(32));
                
                $token = $selector . ':' . $validator;
                
                // set expiration date
                $day = 30;
                $expired_seconds = time() + 60 * 60 * 24 * $day;

                // insert a token to the database
                $hashed_validator = password_hash($validator, PASSWORD_DEFAULT);
                $expiry = date('Y-m-d H:i:s', $expired_seconds);

                $sql = 'INSERT INTO user_tokens(user_id, selector, hashed_validator, expiry)
                    VALUES(:user_id, :selector, :hashed_validator, :expiry)';

                    $statement = $pdo->prepare($sql);
                    $statement->bindValue(':user_id', $id);
                    $statement->bindValue(':selector', $selector);
                    $statement->bindValue(':hashed_validator', $hashed_validator);
                    $statement->bindValue(':expiry', $expiry);

                    if ($statement->execute()) {
                        setcookie('remember_me', $token, $expired_seconds);
                    }
            }
            
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
            <label class="switch">
                <input type="checkbox" name="remember">
                <span class="slider round"></span>
            </label>
            <label for="remember">Remember me</label>
            <button name="submit" type="submit">sign in</button>
        </form>
    </div>
</div>

<?= template_footer() ?>