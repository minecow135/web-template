<?php
headerr('Permissions', "permissions");
?>

<?php
    $sql = "SELECT userPermission.id, userPermission.userId, userPermission.siteId, userPermission.permissionId, userPermission.header, userPermission.dateStart, userPermission.dateEnd, users.username, sites.siteName, permission.permissionName, permission.page, permission.dropdown, permission.placement FROM userPermission LEFT JOIN users ON userPermission.userId = users.id LEFT JOIN sites ON userPermission.siteId = sites.id LEFT JOIN permission ON userPermission.permissionId = permission.id";
        $stmt = $pdo->prepare($sql);

       // $stmt->bindValue(':code', $_POST["code"]);
       // $stmt->bindValue(':siteId', $_SESSION["siteId"]);

        //Execute.
        $stmt->execute();

        //Fetch row.
        $userPermissions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT group_userGroup.id, group_userGroup.userId, users.username, group_userGroup.groupId, group_userGroup.dateStart, group_userGroup.dateEnd, group_groups.groupName, group_userGroup.siteId, sites.siteName FROM `group_userGroup` LEFT JOIN users ON group_userGroup.userId = users.id LEFT JOIN group_groups ON group_userGroup.groupId = group_groups.id LEFT JOIN sites ON group_userGroup.siteId = sites.id";
        $stmt = $pdo->prepare($sql);

       // $stmt->bindValue(':code', $_POST["code"]);
       // $stmt->bindValue(':siteId', $_SESSION["siteId"]);

        //Execute.
        $stmt->execute();

        //Fetch row.
        $userGroup = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT group_permissions.id, group_permissions.groupId, group_groups.groupName, group_groups.description, group_permissions.permissionId, permission.permissionName, permission.permissionCategory, permission.page, permission.dropdown, permission.placement, permission.permissionDescription, group_permissions.header FROM `group_permissions` LEFT JOIN group_groups ON group_permissions.groupId = group_groups.id LEFT JOIN permission ON group_permissions.permissionId = permission.id";
        $stmt = $pdo->prepare($sql);

       // $stmt->bindValue(':code', $_POST["code"]);
       // $stmt->bindValue(':siteId', $_SESSION["siteId"]);

        //Execute.
        $stmt->execute();

        //Fetch row.
        $groupPermissions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="content-wrapper-center">
    <h1 class="head">Permissions</h1>
    <table>
        <thead>
            <tr>
                <td>Id</td>
                <td>Username</td>
                <td>Site</td>
                <td>Permission</td>
                <td>Header</td>
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
                        if ($a['header'] == 1) {
                            echo "<td>Yes</td>";
                        }
                        else {
                            echo "<td>No</td>";

                        }
                        // echo "<td>". $a['header'] . "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <td>Id</td>
                <td>Username</td>
                <td>Site</td>
                <td>Group name</td>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($userGroup as $a) {
                    echo "<tr>";
                        echo "<td>". $a['id'] . "</td>";
                        echo "<td>". $a['username'] . "</td>";
                        echo "<td>". $a['siteName'] . "</td>";
                        echo "<td>". $a['groupName'] . "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <td>Id</td>
                <td>Group</td>
                <td>Permission</td>
                <td>Header</td>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($groupPermissions as $a) {
                    echo "<tr>";
                        echo "<td>". $a['id'] . "</td>";
                        echo "<td>". $a['groupName'] . "</td>";
                        echo "<td>". $a['permissionName'] . "</td>";
                        if ($a['header'] == 1) {
                            echo "<td>Yes</td>";
                        }
                        else {
                            echo "<td>No</td>";

                        }
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>

<?= template_footer() ?>