<?php
headerr('Permissions', "default");
?>

<?php
    $sql = "SELECT userPermission.id, userPermission.userId, userPermission.siteId, userPermission.permissionId, userPermission.header, userPermission.dateStart, userPermission.dateEnd, users.username, sites.siteName, permission.permissionName, permission.page, permission.dropdown, permission.placement FROM userPermission LEFT JOIN users ON userPermission.userId = users.id LEFT JOIN sites ON userPermission.siteId = sites.id LEFT JOIN permission ON userPermission.permissionId = permission.id";
        $stmt = $pdo->prepare($sql);

       // $stmt->bindValue(':code', $_POST["code"]);
       // $stmt->bindValue(':siteId', $_SESSION["siteId"]);

        //Execute.
        $stmt->execute();

        //Fetch row.
        $groupPermissions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT id, username FROM `users`";
        $stmt = $pdo->prepare($sql);

       // $stmt->bindValue(':code', $_POST["code"]);
       // $stmt->bindValue(':siteId', $_SESSION["siteId"]);

        //Execute.
        $stmt->execute();

        //Fetch row.
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT id, groupName, description FROM `group_groups`";
        $stmt = $pdo->prepare($sql);

       // $stmt->bindValue(':code', $_POST["code"]);
       // $stmt->bindValue(':siteId', $_SESSION["siteId"]);

        //Execute.
        $stmt->execute();

        //Fetch row.
        $groups = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT id, siteName, siteDescription FROM `sites`";
        $stmt = $pdo->prepare($sql);

       // $stmt->bindValue(':code', $_POST["code"]);
       // $stmt->bindValue(':siteId', $_SESSION["siteId"]);

        //Execute.
        $stmt->execute();

        //Fetch row.
        $site = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_POST["submit"])) {
        if (!isset($_POST["end"]) || $_POST["end"] == "") {
            $end = null;
        }
        else {
            $end = $_POST["end"];
        }

        $stmt = $pdo->prepare("INSERT INTO `group_userGroup`(`userId`, `groupId`, `siteId`, `dateStart`, `dateEnd`) VALUES (:userId, :groupId, :siteId, :dateStart, :dateEnd)");

            $stmt->bindValue(':userId', $_POST["user"]);
            $stmt->bindValue(':groupId', $_POST["group"]);
            $stmt->bindValue(':siteId', $_POST["site"]);
            $stmt->bindValue(':dateStart', $_POST["start"]);
            $stmt->bindValue(':dateEnd', $end);

            if($stmt->execute()){
                echo '<script>alert("New borrow registered.")</script>';
            }
    }

    $date = date("Y-m-d H:i:s");
?>
<div class="content-wrapper-center">
    <h1 class="head">Permissions</h1>
</div>
<div class="content-wrapper-center">
    <div class="box">
        <form action="" method="post">
            <select name="user" id="">
                <option value="" selected disabled hidden>User</option>
                <?php
                    foreach ($user as $u) {
                        echo "<option value=" . $u["id"] . ">" . $u["username"] . "</option>";
                    }
                ?>
            </select>
            <select name="group" id="">
                <option value="" selected disabled hidden>Group</option>
                <?php
                    foreach ($groups as $u) {
                        echo "<option value=" . $u["id"] . ">" . $u["groupName"] . "</option>";
                    }
                ?>
            </select>
            <select name="site" id="">
                <option value="" selected disabled hidden>Site</option>
                <?php
                    foreach ($site as $u) {
                        echo "<option value=" . $u["id"] . ">" . $u["siteName"] . "</option>";
                    }
                ?>
            </select>
            <div>
                <label for="start">Start</label>
                <input type="datetime-local" name="start" id="start" value="<?= $date ?>">
            </div>
            <div>
                <label for="end">End</label>
                <input type="datetime-local" name="end" id="end">
            </div>
            <button name="submit" type="submit">Add permission group</button>
        </form>
    </div>

    <!--<table>
        <thead>
            <tr>
                <td>Id</td>
                <td>Username</td>
                <td>siteName</td>
                <td>permissionName</td>
                <td>header</td>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($groupPermissions as $a) {
                    echo "<tr>";
                        echo "<td>". $a['id'] . "</td>";
                        echo "<td>". $a['username'] . "</td>";
                        echo "<td>". $a['siteName'] . "</td>";
                        echo "<td>". $a['permissionName'] . "</td>";
                        echo "<td>". $a['header'] . "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>-->
</div>

<?= template_footer() ?>