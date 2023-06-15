<?php
/* Discord Oauth v.4.1
 * Demo Login Script
 * @author : MarkisDev
 * @copyright : https://markis.dev
 */

# Initializing all the required values for the script to work
init($redirect_url, $client_id, $secret_id, $bot_token);

# Fetching user details | (identify scope)
get_user(true);

# Adding user to guild | (guilds.join scope)
// join_guild('SERVER_ID_HERE');

$sql = "SELECT count(id) AS num FROM users WHERE discordId = :discordId";
    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':discordId', $_SESSION["discord_user_id"]);

    //Execute.
    $stmt->execute();

    //Fetch row.
    $discordNum = $stmt->fetch(PDO::FETCH_ASSOC);

if ($discordNum["num"] < 1) {    
    $stmt = $pdo->prepare("INSERT INTO `users`(`username`, `email`, `discordId`) VALUES (:username, :email, :discordId)");

        $stmt->bindValue(':username', $_SESSION["discord_username"]);
        $stmt->bindValue(':email', $_SESSION["discord_email"]);
        $stmt->bindValue(':discordId', $_SESSION["discord_user_id"]);

        $stmt->execute();
}

$sql = "SELECT * FROM users WHERE discordId = :discordId";
    $stmt = $pdo->prepare($sql);

    //Bind value.
    $stmt->bindValue(':discordId', $_SESSION["discord_user_id"]);

    //Execute.
    $stmt->execute();
    
    //Fetch row.
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

$id = $user["id"];
$email = $user["email"];
$enabled = $user["enabled"];

//If $row is FALSE.
if($user === false){
    echo '<script>alert("error")</script>';
}
elseif ($enabled === false) {
    echo '<script>alert("User is disabled")</script>';
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

# Redirecting to home page once all data has been fetched
header('Location: index.php');
exit;

?>