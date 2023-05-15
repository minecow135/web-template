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
    function headerr($title)
    {
        $namechoice = 2;
        
        $pdo = pdo_connect_mysql();
        
        $sql = "SELECT * FROM userPermission LEFT JOIN users ON userPermission.userId = users.id LEFT JOIN sites ON userPermission.siteId = sites.id LEFT JOIN permission ON userPermission.permissionId = permission.id";
        $stmt = $pdo->prepare($sql);

        //Bind value.
        //$stmt->bindValue(':username', $username);

        //Execute.
        $stmt->execute();
        
        //Fetch row.
        $permissions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        print_r($permissions);

        echo "<br><br>";

        foreach ($permissions as $i) {
            print_r($i);
            echo "<br><br>";
            echo $i["permissionName"];
            echo "<br><br>";
        }


        //$permissions = ["test1", "test2", "test3", "test4"];

        $namearr["1"] = "Template";

        $namearr["2"] = $_SERVER["HTTP_HOST"];
        $name = $namearr["$namechoice"];

        // Get the amount of items in the shopping cart
        $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
        $permission["Gallery"] = true;
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

        /*foreach ($permissions as $permission) {
            echo "<a>$permission</a>";
        }*/
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