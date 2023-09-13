<?php

    // connect to database PDO
    function pdo_connect_mysql() {
        require "include/db.php";
        try {
        	return new PDO("mysql:host=" . $DATABASE_HOST . ";dbname=" . $DATABASE_NAME . ";charset=utf8", $DATABASE_USER, $DATABASE_PASS);
        } catch (PDOException $exception) {
        	// If there is an error with the connection, stop the script and display the error.
        	echo "Failed to connect to database!";
            exit("Failed to connect to database!");
        }
    }

    // Header
    function headerr($title, $permissionName)
    {
        // chose name. 1 = custom, 2 = domain
        $namechoice = 2;
        $namearr["1"] = "Template";

        $namearr["2"] = $_SERVER["HTTP_HOST"];
        $name = $namearr["$namechoice"];

        $pdo = pdo_connect_mysql();

        $root = $_SERVER['WEB_ROOT'] = str_replace("index.php",'',$_SERVER['SCRIPT_NAME']);

        $siteLink = str_replace($root,"",str_replace("/index.php",'',$_SERVER['REDIRECT_URL']));

        if (isset($siteLink) && $siteLink != "") {
            $sql = 'SELECT id, siteName, link FROM sites WHERE link = :link';

                $statement = $pdo->prepare($sql);
                $statement->bindValue(':link', $siteLink);

                $statement->execute();

                $siteArr = $statement->fetch(PDO::FETCH_ASSOC);
            if ($siteArr) {
                $_SESSION["siteId"] = $siteArr["id"];
            }
            else {
                $_SESSION["siteId"] = 1;
            }
        }
        else {
            $_SESSION["siteId"] = 1;
        }

        $token = filter_input(INPUT_COOKIE, 'remember_me', FILTER_SANITIZE_STRING);
        if ($token) {

            $parts = explode(':', $token);

            $selector = $parts[0];
            $validator = $parts[1];
            
            $sql = 'SELECT user_tokens.id, user_tokens.selector, user_tokens.hashed_validator, user_tokens.user_id, user_tokens.expiry, users.username
                FROM user_tokens LEFT JOIN users ON user_tokens.user_id = users.id
                WHERE user_tokens.selector = :selector AND
                    user_tokens.expiry >= now()
                LIMIT 1';

                $statement = $pdo->prepare($sql);
                $statement->bindValue(':selector', $selector);

                $statement->execute();

                $tokens = $statement->fetch(PDO::FETCH_ASSOC);

            if (password_verify($validator, $tokens['hashed_validator'])) {
                if ($token) {
                    if (session_regenerate_id()) {
                        // set username & id in the session
                        $_SESSION['username'] = $tokens['username'];
                        $_SESSION['id'] = $tokens['user_id'];
                        $_SESSION['loggedin'] = true;
                    }
                }
            }
        }

        $sql = "(SELECT userPermission.userId, users.username, userPermission.permissionId, permission.permissionName, permission.page, permission.dropdown, permission.placement, userPermission.header, userPermission.siteId, sites.siteName FROM userPermission LEFT JOIN users ON userPermission.userId = users.id LEFT JOIN sites ON userPermission.siteId = sites.id LEFT JOIN permission ON userPermission.permissionId = permission.id WHERE userPermission.userId = :userId AND dateStart < :date AND (dateEnd > :date OR dateEnd IS NULL) AND (siteId = :siteId OR siteId = 0)) UNION (SELECT group_userGroup.userId, users.username, group_permissions.permissionId, permission.permissionName, permission.page, permission.dropdown, permission.placement, group_permissions.header, group_groups.siteId, sites.siteName FROM `group_userGroup` LEFT JOIN users ON group_userGroup.userId = users.id LEFT JOIN group_groups ON group_userGroup.groupId = group_groups.id INNER JOIN group_permissions ON group_userGroup.groupId = group_permissions.groupId LEFT JOIN permission ON group_permissions.permissionId = permission.id LEFT JOIN sites ON group_groups.siteId = sites.id WHERE group_userGroup.userId = :userId AND dateStart < :date AND (dateEnd > :date OR dateEnd IS NULL) AND (siteId = :siteId OR siteId = 0)) ORDER BY `placement`";
        $stmt = $pdo->prepare($sql);

        $date = date("Y-m-d H:i:s");

        //Bind value.
        if ($_SESSION["id"]) {
            $userId = $_SESSION["id"];
        }
        else {
            $userId = 0;
        }
        $stmt->bindValue(':userId', $userId);
        $stmt->bindValue(':date', $date);
        $stmt->bindValue(':siteId', $_SESSION["siteId"]);

        //Execute.
        $stmt->execute();

        //Fetch row.
        $permissions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $_SESSION["permissions"] = $permissions;

    if (false === ((in_array($permissionName, array_column($permissions, 'permissionName')))) && $permissionName != "default") {
        header('Location: index.php');
    }

        // Get the amount of items in the shopping cart
        $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
        echo '
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="utf-8">
                <title>' . $title . '</title>
                <link href="' . $root . 'css/import.css" rel="stylesheet" type="text/css">
                <link rel="shortcut icon" href="img/logo.png" />
            </head>
            <body>
                <header>
                    <div class="content-wrapper">
                            <a href="index.php">
                                <img src="img/logo.png" height="70px" alt="">
                                <h1>' . $name . '</h1>
                            </a>
                            <nav>
                        ';
                        foreach ($permissions as $i) {
                            if ($i["header"] == true) {
                                ?>
                                <a href="index.php?page=<?=$i['page']?>"><?=$i['permissionName']?></a>
                                <?php
                            }
                        }
        echo '
                    </nav>
                </div>
            </header>
            <main>
    ';
    }

    // Footer
    function template_footer() {
        echo '
                </main>
                <footer>
                    <div class="content-wrapper">
                        <!-- Footer -->

                        <a href="https://github.com/minecow135">mine_cow135</a>

                        <!-- Footer -->
                    </div>
                </footer>
            </body>
        </html>
        ';
    }

?>