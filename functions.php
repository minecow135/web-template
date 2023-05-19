<?php

    // connect to database PDO
    function pdo_connect_mysql() {
        $DATABASE_HOST = "172.21.20.52";
        $DATABASE_USER = "webTest";
        $DATABASE_PASS = "awdfthdwa";
        $DATABASE_NAME = "webTemplate";
        try {
        	return new PDO("mysql:host=" . $DATABASE_HOST . ";dbname=" . $DATABASE_NAME . ";charset=utf8", $DATABASE_USER, $DATABASE_PASS);
        } catch (PDOException $exception) {
        	// If there is an error with the connection, stop the script and display the error.
        	exit("Failed to connect to database!");
        }
    }

    // Header
    function headerr($title, $permissionName)
    {
        $namechoice = 2;

        $namearr["1"] = "Template";

        $namearr["2"] = $_SERVER["HTTP_HOST"];
        $name = $namearr["$namechoice"];
        
        $pdo = pdo_connect_mysql();
        
        $sql = "SELECT userPermission.id, userPermission.userId, userPermission.siteId, userPermission.permissionId, userPermission.header, userPermission.dateStart, userPermission.dateEnd, users.username, sites.siteName, permission.permissionName, permission.page, permission.dropdown, permission.placement FROM userPermission LEFT JOIN users ON userPermission.userId = users.id LEFT JOIN sites ON userPermission.siteId = sites.id LEFT JOIN permission ON userPermission.permissionId = permission.id WHERE userPermission.userId = :userId AND dateStart < :date AND (dateEnd > :date OR dateEnd IS NULL) ORDER BY permission.placement";
        $stmt = $pdo->prepare($sql);
        
        $date = date("Y-m-d H:i:s");
        //echo $date;

        //Bind value.
        if ($_SESSION["id"]) {
            $userId = $_SESSION["id"];
        } 
        else {
            $userId = 0;
        }
        $stmt->bindValue(':userId', $userId);
        $stmt->bindValue(':date', $date);

        //Execute.
        $stmt->execute();
        
        //Fetch row.
        $permissions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        /*if (array_search($title, array_column($permission, "page")) !== false) {
            echo "a";
        }*/

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
                <link href="css/import.css" rel="stylesheet" type="text/css">
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