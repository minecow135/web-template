<?php
headerr('Register', "register");
?>

<?php
$permissionName = "register.code";
$useCode = in_array($permissionName, array_column($_SESSION["permissions"], 'permissionName'));

$permissionName = "login.discord";
$discord = in_array($permissionName, array_column($_SESSION["permissions"], 'permissionName'));

if(isset($_POST['submit'])) {
    try {
        $user = $_POST['username'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        if ($useCode) {
            $codeInput = $_POST['code'];
        }

        //encrypt password
        $pass = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));

        //Check if username exists
        $sql = "SELECT COUNT(username) AS num FROM users WHERE username = :username OR email = :email";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':username', $user);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($useCode) {
            $sql = "SELECT id, disabled, totalUses FROM registerCodes WHERE code = :code AND start < :date AND end > :date";
            
            $stmt = $pdo->prepare($sql);
            
            $date = date("Y-m-d H:i:s");
            
            //Bind value.
            $stmt->bindValue(':code', $codeInput);
            $stmt->bindValue(':date', $date);
            
            //Execute.
            $stmt->execute();
            
            //Fetch row.
            $code = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $sql = "SELECT count(id) AS num FROM registerCodesUsed WHERE codeId = :codeId";
            $stmt = $pdo->prepare($sql);
            
            $date = date("Y-m-d H:i:s");
            
            //Bind value.
            $stmt->bindValue(':codeId', $code["id"]);
            
            //Execute.
            $stmt->execute();
            
            //Fetch row.
            $codeUses = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        if($row['num'] > 0) {
            echo '<script>alert("Username or email already exists")</script>';
        }
        else if ($useCode && $codeUses["num"] >= $code["totalUses"]) {
            echo '<script>alert("Wrong code")</script>';
        }
        else {
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password)
            VALUES (:username, :email, :password)");
            $stmt->bindParam(':username', $user);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $pass);

            if($stmt->execute()){
                echo '<script>alert("New account created.")</script>';
                if ($useCode) {
                    // check Id of user
                    $sql = "SELECT id FROM users WHERE username = :username";
                    $stmt = $pdo->prepare($sql);

                    $stmt->bindValue(':username', $user);
                    $stmt->execute();
                    $userId = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    $stmt = $pdo->prepare("INSERT INTO registerCodesUsed (codeId, userId)
                    VALUES (:codeId, :userId)");
                    $stmt->bindParam(':codeId', $code["id"]);
                    $stmt->bindParam(':userId', $userId["id"]);
        
                    $stmt->execute();
                }

                //If $row is FALSE.
                if($user === false){
                    echo '<script>alert("Invalid username or password")</script>';
                }
                elseif ($enabled === false) {
                    echo '<script>alert("Invalid username or password")</script>';
                }
                else {
                    //Provide the user with a login session.
                    $_SESSION['loggedin'] = true;
                    $_SESSION["id"] = $id;
                    $_SESSION["email"] = $email;

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
                }

                //redirect to another page
                header("Location: index.php?page=login/login");
            }
            else {
               echo '<script>alert("An error occurred")</script>';
            }
        }
    } catch(PDOException $e){
        $error = "Error: " . $e->getMessage();
        echo '<script type="text/javascript">console.log("'.$error.'");</script>';
    }
}

$auth_url = url($client_id, $redirect_url, $scopes);

?>
<div class="content-wrapper center vCenter">
    <div class="loginBox">
        <h1>Register</h1>
        <form action="" method="post">
            <input required="required" type="text" name="username" placeholder="Username">
            <input required="required" type="email" name="email" placeholder="Email">
            <input required="required" type="password" name="password" placeholder="Password">
            <?php if ($useCode) { ?>
                <input required="required" type="text" name="code" placeholder="Code from admin">
            <?php
                }
            ?>
            
            <button name="submit" type="submit">register</button>
        </form>
        <?php
            if ($discord) {
                ?>
                    <a class=discordLogin href='<?= $auth_url ?>'>
                        <div >
                            <i class='fab fa-discord'></i> Continue with Discord
                        </div>
                    </a>
                    <?php
            }
            ?>
      </div>
</div>

<?= template_footer() ?>