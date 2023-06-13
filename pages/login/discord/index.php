<?php

    headerr("discord login", "default");

    # Including all the required scripts
    require "discord.php";
    require "config.php";

    $auth_url = url($client_id, $redirect_url, $scopes);

    if (isset($_SESSION['discord_user'])) {
        echo '<a href="index.php?page=login/logout"><button class="log-in">LOGOUT</button></a>';
    } else {
        echo "<a href='$auth_url'><button class='log-in'>LOGIN</button></a>";
    }

?>

<h2> User Details :</h2>
<p> Name : <?php echo $_SESSION['discord_username'] . ' #' . $_SESSION['discord_discrim']; ?></p>
<p> ID : <?php echo $_SESSION['discord_user_id']; ?></p>
<?php
    if (isset($_SESSION['discord_email'])) {
        echo '<p> Email: ' . $_SESSION['discord_email'] . '</p>';
    }
?>

<?php
    echo $_SESSION['discord_user_banner'] . "adw";
    echo "<br>";

    $avatar_url = "https://cdn.discordapp.com/avatars/".$_SESSION['discord_user_id']."/".$_SESSION['discord_user_avatar'].is_animated($_SESSION['discord_user_avatar']);
	if(isset($_SESSION['discord_user_banner'])) $banner_url = "https://cdn.discordapp.com/banners/".$_SESSION['discord_user_id']."/".$_SESSION['discord_user_banner'].is_animated($_SESSION['discord_user_banner']);
        echo "<br>";
        echo "<br>";

    foreach ($_SESSION as $a => $b) {
        echo "<h5>" . $a . "</h5>";
        echo "<br>";
        print_r($b);
        echo "<br>";
        echo "<br>";
    }
?>
<p> Profile Picture : 
    <img src="<?= $avatar_url ?>" />
    <img src="<?= $banner_url ?>" />
</p>

