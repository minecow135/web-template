<?php
headerr('Permissions', "permissions");
?>

<?php
    $permissionName = "permissions.list.global";
    $global = ((in_array($permissionName, array_column($_SESSION["permissions"], 'permissionName'))) && $permissionName != "default");
    
    $permissionName = "permissions.list.all";
    $all = ((in_array($permissionName, array_column($_SESSION["permissions"], 'permissionName'))) && $permissionName != "default");

    $permissionName = "permissions.delete.userPerm";
    $deleteUserPerm = ((in_array($permissionName, array_column($_SESSION["permissions"], 'permissionName'))) && $permissionName != "default");

    $permissionName = "permissions.delete.groupPerm";
    $deletegroupPerm = ((in_array($permissionName, array_column($_SESSION["permissions"], 'permissionName'))) && $permissionName != "default");

    $permissionName = "permissions.delete.groupUser";
    $deleteGroupUser = ((in_array($permissionName, array_column($_SESSION["permissions"], 'permissionName'))) && $permissionName != "default");

    $sql = "SELECT id, username FROM `users`";
        $stmt = $pdo->prepare($sql);

       // $stmt->bindValue(':code', $_POST["code"]);
       // $stmt->bindValue(':siteId', $_SESSION["siteId"]);

        //Execute.
        $stmt->execute();

        //Fetch row.
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $sql = "SELECT id, siteName FROM `sites` WHERE (id = :siteId";
    if ($global) {
        $sql .= " OR id = '0'";
    }

    if ($all) {
        $sql .= " OR id LIKE '%'";
    }

    $sql .= ")";
        $stmt = $pdo->prepare($sql);

       // $stmt->bindValue(':code', $_POST["code"]);
        $stmt->bindValue(':siteId', $_SESSION["siteId"]);

        //Execute.
        $stmt->execute();

        //Fetch row.
        $site = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT group_groups.id, group_groups.groupName, sites.siteName FROM `group_groups` LEFT JOIN sites ON group_groups.siteId = sites.id WHERE (group_groups.siteId = :siteId";
    if ($global) {
        $sql .= " OR group_groups.siteId = '0'";
    }

    if ($all) {
        $sql .= " OR group_groups.siteId LIKE '%'";
    }

    $sql .= ")";

        $stmt = $pdo->prepare($sql);

       // $stmt->bindValue(':code', $_POST["code"]);
        $stmt->bindValue(':siteId', $_SESSION["siteId"]);

        //Execute.
        $stmt->execute();

        //Fetch row.
        $group = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT id, permissionName FROM `permission`";
        $stmt = $pdo->prepare($sql);

       // $stmt->bindValue(':code', $_POST["code"]);
       // $stmt->bindValue(':siteId', $_SESSION["siteId"]);

        //Execute.
        $stmt->execute();

        //Fetch row.
        $permission = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $date = date("Y-m-d H:i:s");
?>

<?php
    if ($_POST["user"]) {
        $sql = "SELECT group_userGroup.id, group_userGroup.userId, users.username, group_userGroup.groupId, group_userGroup.dateStart, group_userGroup.dateEnd, group_groups.groupName, group_groups.siteId, sites.siteName FROM `group_userGroup` LEFT JOIN users ON group_userGroup.userId = users.id LEFT JOIN group_groups ON group_userGroup.groupId = group_groups.id LEFT JOIN sites ON group_groups.siteId = sites.id WHERE users.id = :userId AND (group_groups.siteId = :siteId";
            
            if ($global) {
                $sql .= " OR group_groups.siteId = '0'";
            }

            if ($all) {
                $sql .= " OR group_groups.siteId LIKE '%'";
            }

            $sql .= ")";

            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':userId', $_POST["user"]);
            $stmt->bindValue(':siteId', $_SESSION["siteId"]);

            //Execute.
                $stmt->execute();

                //Fetch row.
                $userGroup = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sql = "SELECT userPermission.id, userPermission.userId, userPermission.siteId, userPermission.permissionId, userPermission.header, userPermission.dateStart, userPermission.dateEnd, users.username, sites.siteName, permission.permissionName, permission.page, permission.dropdown, permission.placement FROM userPermission LEFT JOIN users ON userPermission.userId = users.id LEFT JOIN sites ON userPermission.siteId = sites.id LEFT JOIN permission ON userPermission.permissionId = permission.id WHERE users.id = :userId AND (userPermission.siteId = :siteId";
        if ($global) {
            $sql .= " OR userPermission.siteId = '0'";
        }

        if ($all) {
            $sql .= " OR userPermission.siteId LIKE '%'";
        }

        $sql .= ")";
        
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':userId', $_POST["user"]);
            $stmt->bindValue(':siteId', $_SESSION["siteId"]);

            //Execute.
            $stmt->execute();

            //Fetch row.
            $userPermissions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    if ($_POST["group"]) {
        $sql = "SELECT group_userGroup.id, group_userGroup.userId, users.username, group_userGroup.groupId, group_userGroup.dateStart, group_userGroup.dateEnd, group_groups.groupName, group_groups.siteId, sites.siteName FROM `group_userGroup` LEFT JOIN users ON group_userGroup.userId = users.id LEFT JOIN group_groups ON group_userGroup.groupId = group_groups.id LEFT JOIN sites ON group_groups.siteId = sites.id WHERE group_groups.id = :groupId AND (group_groups.siteId = :siteId";
            
            if ($global) {
                $sql .= " OR group_groups.siteId = '0'";
            }

            if ($all) {
                $sql .= " OR group_groups.siteId LIKE '%'";
            }

            $sql .= ")";

            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':groupId', $_POST["group"]);
            $stmt->bindValue(':siteId', $_SESSION["siteId"]);

            //Execute.
                $stmt->execute();

                //Fetch row.
                $groupUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sql = "SELECT group_permissions.id, group_permissions.groupId, group_permissions.permissionId, group_permissions.header, group_groups.groupName, group_groups.siteId, permission.permissionName, permission.page, permission.dropdown, permission.placement, sites.siteName FROM group_permissions LEFT JOIN group_groups ON group_permissions.groupId = group_groups.id LEFT JOIN permission ON group_permissions.permissionId = permission.id LEFT JOIN sites ON group_groups.siteId = sites.id WHERE group_groups.id = :groupId AND (group_groups.siteId = :siteId";
        if ($global) {
            $sql .= " OR group_groups.siteId = '0'";
        }

        if ($all) {
            $sql .= " OR group_groups.siteId LIKE '%'";
        }

        $sql .= ")";
        
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':groupId', $_POST["group"]);
            $stmt->bindValue(':siteId', $_SESSION["siteId"]);

            //Execute.
            $stmt->execute();

            //Fetch row.
            $groupPermissions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
?>

<div class="content-wrapper-center">
    <h1 class="head">Permissions</h1>
</div>
<div class="content-wrapper-center">
    <div class="box">
        <form action="" method="post">
            <h4>Select user or group</h4>
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
                    foreach ($group as $g) {
                        echo "<option value=" . $g["id"] . ">" . $g["siteName"] . ", " . $g["groupName"] . "</option>";
                    }
                ?>
            </select>
            <input type="submit" value="Submit">
        </form>
    </div>
</div>
<div class="content-wrapper-center">
    <?php
        if ($_POST["user"]) {
            ?>
            
            <table>
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Username</td>
                        <td>Site</td>
                        <td>Group name</td>
                        <td>Start</td>
                        <td>End</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($userGroup as $a) {
                    ?>
                            <tr>
                                <td><?= $a['id'] ?></td>
                                <td><?= $a['username'] ?></td>
                                <td><?= $a['siteName'] ?></td>
                                <td><?= $a['groupName'] ?></td>
                                <td><?= $a['dateStart'] ?></td>
                                <td><?= $a['dateEnd'] ?></td>
                                <td class="actions">
                                    <?php
                                        if ($deleteGroupUser) {
                                    ?>
                                    <a href="index.php?page=adm/<?= basename(__DIR__) ?>/deleteGroup&id=<?= $a['id'] ?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                                    <?php
                                        }
                                    ?>
                                </td>
                            </tr>
                    <?php
                        }
                    ?>
                    <tr>
                        <form action="" method="post">
                            <td>Add new</td>
                            <td>
                                <?= $_POST["user"] ?>
                                <input type="hidden" name="user" value="<?= $_POST["user"] ?>">
                            </td>
                            <td>
                            </td>
                            <td>
                                <select name="group" id="">
                                    <option value="" selected disabled hidden>Group</option>
                                    <?php
                                        foreach ($group as $g) {
                                            echo "<option value=" . $g["id"] . ">" . $g["siteName"]. ", " . $g["groupName"] . "</option>";
                                        }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <input type="datetime-local" name="start" id="start" value="<?= $date ?>">
                            </td>
                            <td>
                                <input type="datetime-local" name="end" id="start">
                            </td>
                            <td>
                                <button type="submit" name="usergroupSubmit">Submit</button>
                            </td>
                        </form>
                    </tr>
                </tbody>
            </table>

            <table>
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Username</td>
                        <td>Site</td>
                        <td>Permission</td>
                        <td>Start</td>
                        <td>End</td>
                        <td>Header</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($userPermissions as $a) {
                            echo "<tr>";
                                echo "<td>". $a['id'] . "</td>";
                                echo "<td>". $a['username'] . "</td>";
                                echo "<td>". $a['siteName'] . "</td>";
                                echo "<td>". $a['permissionName'] . "</td>";
                                echo "<td>". $a['dateStart'] . "</td>";
                                echo "<td>". $a['dateEnd'] . "</td>";
                                if ($a['header'] == 1) {
                                    echo "<td>Yes</td>";
                                }
                                else {
                                    echo "<td></td>";
                                }
                    ?>
                                <td class="actions">
                                    <?php
                                        if ($deleteUserPerm) {
                                    ?>
                                    <a href="index.php?page=adm/<?= basename(__DIR__) ?>/deleteUserPerm&id=<?= $a['id'] ?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                                    <?php
                                        }
                                    ?>
                                </td>
                    <?php
                            echo "</tr>";
                        }
                    ?>
                    <tr>
                        <form action="" method="post">
                            <td>Add new</td>
                            <td>
                                <?= $_POST["user"] ?>
                                <input type="hidden" name="user" value="<?= $_POST["user"] ?>">
                            </td>
                            <td>
                                <select name="site" id="">
                                    <option value="" selected disabled hidden>Site</option>
                                    <?php
                                        foreach ($site as $s) {
                                            echo "<option value=" . $s["id"] . ">" . $s["siteName"] . "</option>";
                                        }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select name="permission" id="">
                                    <option value="" selected disabled hidden>Permission</option>
                                    <?php
                                        foreach ($permission as $p) {
                                            echo "<option value=" . $p["id"] . ">" . $p["permissionName"] . "</option>";
                                        }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <input type="datetime-local" name="start" id="start" value="<?= $date ?>">
                            </td>
                            <td>
                                <input type="datetime-local" name="end" id="start">
                            </td>
                            <td>
                                <div>
                                    <label class="switch">
                                    <input type="checkbox" name="header">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <button type="submit" name="userSubmit">Submit</button>
                            </td>
                        </form>
                    </tr>
                </tbody>
            </table>

            <?php
        }

        if ($_POST["group"]) {
            ?>
            <table>
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Site</td>
                        <td>Group</td>
                        <td>Permission</td>
                        <td>Header</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($groupPermissions as $a) {
                    ?>
                            <tr>
                                <td><?= $a['id'] ?></td>
                                <td><?= $a['siteName'] ?></td>
                                <td><?= $a['groupName'] ?></td>
                                <td><?= $a['permissionName'] ?></td>
                                <?php
                                    if ($a['header'] == 1) {
                                ?>
                                    <td>Yes</td>
                                <?php
                                    }
                                    else {
                                ?>
                                        <td></td>
                                <?php
                                    }
                                ?>
                                <td class="actions">
                                    <?php
                                        if ($deleteGroupUser) {
                                    ?>
                                    <a href="index.php?page=adm/<?= basename(__DIR__) ?>/deleteGroupPerm&id=<?= $a['id'] ?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                                    <?php
                                        }
                                    ?>
                                </td>
                            </tr>
                    <?php
                        }
                    ?>
                    <tr>
                        <form action="" method="post">
                            <td>Add new</td>
                            <td></td>
                            <td>
                                <?= $_POST["group"] ?>
                                <input type="hidden" name="group" value="<?= $_POST["group"] ?>">
                            </td>
                            <td>
                                <select name="permission" id="">
                                    <option value="" selected disabled hidden>Permission</option>
                                    <?php
                                        foreach ($permission as $p) {
                                            echo "<option value=" . $p["id"] . ">" . $p["permissionName"] . "</option>";
                                        }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <div>
                                    <label class="switch">
                                    <input type="checkbox" name="header">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <button type="submit" name="groupPermission">Submit</button>
                            </td>
                        </form>
                    </tr>
                </tbody>
            </table>

            <table>
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>group</td>
                        <td>Site</td>
                        <td>Username</td>
                        <td>Start</td>
                        <td>End</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($groupUsers as $a) {
                    ?>
                            <tr>
                                <td><?= $a['id'] ?></td>
                                <td><?= $a['groupName'] ?></td>
                                <td><?= $a['siteName'] ?></td>
                                <td><?= $a['username'] ?></td>
                                <td><?= $a['dateStart'] ?></td>
                                <td><?= $a['dateEnd'] ?></td>
                                <td class="actions">
                                    <?php
                                        if ($deleteGroupUser) {
                                    ?>
                                    <a href="index.php?page=adm/<?= basename(__DIR__) ?>/deleteGroup&id=<?= $a['id'] ?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                                    <?php
                                        }
                                    ?>
                                </td>
                            </tr>
                    <?php
                        }
                    ?>
                    <tr>
                        <form action="" method="post">
                            <td>Add new</td>
                            <td>
                                <?= $_POST["group"] ?>
                                <input type="hidden" name="group" value="<?= $_POST["group"] ?>">
                            </td>
                            <td>
                            </td>
                            <td>
                                <select name="user" id="">
                                    <option value="" selected disabled hidden>Username</option>
                                    <?php
                                        foreach ($user as $u) {
                                            echo "<option value=" . $u["id"] . ">" . $u["username"] . "</option>";
                                        }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <input type="datetime-local" name="start" id="start" value="<?= $date ?>">
                            </td>
                            <td>
                                <input type="datetime-local" name="end" id="start">
                            </td>
                            <td>
                                <button type="submit" name="usergroupSubmit">Submit</button>
                            </td>
                        </form>
                    </tr>
                </tbody>
            </table>

            <?php
        }

        if (isset($_POST["usergroupSubmit"])) {
            if (!isset($_POST["end"]) || $_POST["end"] == "") {
                $end = null;
            }
            else {
                $end = $_POST["end"];
            }
        
            $stmt = $pdo->prepare("INSERT INTO `group_userGroup`(`userId`, `groupId`, `dateStart`, `dateEnd`) VALUES (:userId, :groupId, :dateStart, :dateEnd)");
        
                $stmt->bindValue(':userId', $_POST["user"]);
                $stmt->bindValue(':groupId', $_POST["group"]);
                $stmt->bindValue(':dateStart', $_POST["start"]);
                $stmt->bindValue(':dateEnd', $end);
        
                if($stmt->execute()){
                    echo '<script>alert("Group added")</script>';
                    echo "<meta http-equiv='refresh' content='0'>";
                }
        }
        
        if (isset($_POST["userSubmit"])) {
            if (!isset($_POST["end"]) || $_POST["end"] == "") {
                $end = null;
            }
            else {
                $end = $_POST["end"];
            }
            
            if (!isset($_POST["header"]) || $_POST["header"] == "") {
                $header = 0;
            }
            else {
                $header = 1;
            }
        
            $stmt = $pdo->prepare("INSERT INTO `userPermission`(`userId`, `permissionId`, `siteId`, `header`, `dateStart`, `dateEnd`) VALUES (:userId, :permissionId, :siteId, :header, :dateStart, :dateEnd)");
        
                $stmt->bindValue(':userId', $_POST["user"]);
                $stmt->bindValue(':permissionId', $_POST["permission"]);
                $stmt->bindValue(':siteId', $_POST["site"]);
                $stmt->bindValue(':header', $header);
                $stmt->bindValue(':dateStart', $_POST["start"]);
                $stmt->bindValue(':dateEnd', $end);
     
                if($stmt->execute()){
                    echo '<script>alert("Permission added")</script>';
                    echo "<meta http-equiv='refresh' content='0'>";
                }
        }

        if (isset($_POST["groupPermission"])) {
            if (!isset($_POST["end"]) || $_POST["end"] == "") {
                $end = null;
            }
            else {
                $end = $_POST["end"];
            }
            
            if (!isset($_POST["header"]) || $_POST["header"] == "") {
                $header = 0;
            }
            else {
                $header = 1;
            }
        
            $stmt = $pdo->prepare("INSERT INTO `group_permissions`(`groupId`, `permissionId`, `header`) VALUES (:groupId, :permissionId, :header)");
        
                $stmt->bindValue(':groupId', $_POST["group"]);
                $stmt->bindValue(':permissionId', $_POST["permission"]);
                $stmt->bindValue(':header', $header);
     
                if($stmt->execute()){
                    echo '<script>alert("Permission added")</script>';
                    echo "<meta http-equiv='refresh' content='0'>";
                }
        }
    ?>
</div>

<?= template_footer() ?>