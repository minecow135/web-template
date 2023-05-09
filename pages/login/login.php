<?php
// If the user is not logged in redirect to the login page...
if (isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
}

headerr('Logg inn');
?>

<?php
// If the user is not logged in redirect to the login page...
if (isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
}

headerr('Logg inn');
?>

<?php
$stage = ($_GET['stage']);
$stageArr = ["", "Venligst fyll ut begge feltene", "Feil brukernavn og eller passord", "Registering fullført, du kan nå logge inn"];

if (isset($stage)) {
    $msg = $stageArr["$stage"];
} 
else {
    $msg = "";
}

?>
<div class="content-wrapper-center">
    <div class="box">
        <h1>Log in</h1>
        <form action="index.php?page=login/authlogin" method="post">
            <input type="text" name="username" placeholder="Username" id="username" required>
            <input type="password" name="password" placeholder="Password" id="password" required>
            <p><?= $msg ?></p>
            <input type="submit" value="Log in">
        </form>
    </div>
</div>

<?= template_footer() ?>