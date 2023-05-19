<?php
// If the user is not logged in redirect to the login page...
if (isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
}

headerr('Register', "register");
?>

<?php
$sql = "SELECT id, name, active FROM settings WHERE name = 'registerCode'";
$stmt = $pdo->prepare($sql);

//Execute.
$stmt->execute();

//Fetch row.
$settings = $stmt->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['submit'])) {
    try {
        $user = $_POST['username'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $codeInput = $_POST['code'];

        //encrypt password
        $pass = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));

        //Check if username exists
        $sql = "SELECT COUNT(username) AS num FROM users WHERE username = :username";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':username', $user);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);


        $sql = "SELECT COUNT(code) AS num FROM registerCodes WHERE code = :code AND start < :date AND end > :date";
        $stmt = $pdo->prepare($sql);

        $date = date("Y-m-d H:i:s");

        //Bind value.
        $stmt->bindValue(':code', $codeInput);
        $stmt->bindValue(':date', $date);

        //Execute.
        $stmt->execute();

        //Fetch row.
        $code = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row['num'] > 0) {
            echo '<script>alert("Username already exists")</script>';
        }
        else if ($settings[0]["active"] && $code['num'] < 1) {
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
                //redirect to another page
                header("index.php");
            }
            else {
               echo '<script>alert("An error occurred")</script>';
            }
        }
    }catch(PDOException $e){
        $error = "Error: " . $e->getMessage();
        echo '<script type="text/javascript">alert("'.$error.'");</script>';
    }
}

?>
<div class="content-wrapper-center">
    <div class="box">
        <h1>Register</h1>
        <form action="" method="post">
            <input required="required" type="text" name="username" placeholder="Username">
            <input required="required" type="email" name="email" placeholder="Email">
            <input required="required" type="password" name="password" placeholder="Password">
            <?php if ($settings[0]["active"]) { ?>
                <input required="required" type="text" name="code" placeholder="Code from admin">
            <?php
                }
            ?>
            <button name="submit" type="submit">register</button>
        </form>
      </div>
</div>