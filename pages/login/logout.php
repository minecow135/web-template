<?php
$token = filter_input(INPUT_COOKIE, 'remember_me', FILTER_SANITIZE_STRING);
if ($token) {

    $parts = explode(':', $token);

    $selector = $parts[0];
    $validator = $parts[1];

    // delete the user token
    $sql = 'DELETE FROM user_tokens WHERE user_id = :user_id AND selector = :selector';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':user_id', $_SESSION["id"]);
    $statement->bindValue(':selector', $selector);

    $statement->execute();
}



// remove the remember_me cookie
if (isset($_COOKIE['remember_me'])) {
    unset($_COOKIE['remember_me']);
    setcookie('remember_user', null, -1);
}

session_destroy();

// Redirect to the login page:
header('Location: index.php');
