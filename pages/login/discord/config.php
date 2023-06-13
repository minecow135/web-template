<?php
# CLIENT ID
# https://i.imgur.com/GHI2ts5.png (screenshot)
$client_id = "1113497187960238111";

# CLIENT SECRET
# https://i.imgur.com/r5dYANR.png (screenshot)
$secret_id = "olKaMqTo1EKWL5DTdBBIERBalu7uF_p0";

# SCOPES SEPARATED BY + SIGN
# example: identify+email+guilds+connections
$scopes = "identify+email";
# $scopes = "";

# REDIRECT URL
# example: https://mydomain.com/includes/login.php
# example: https://mydomain.com/test/includes/login.php
$redirect_url = "http://localhost/web-template/index.php?page=login/discord/login";

# IMPORTANT READ THIS:
# - Set the `$bot_token` to your bot token if you want to use guilds.join scope to add a member to your server
# - Check login.php for more detailed info on this.
# - Leave it as it is if you do not want to use 'guilds.join' scope.

# https://i.imgur.com/2tlOI4t.png (screenshot)
$bot_token = null;
