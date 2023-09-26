<?php
headerr('Permissions', "permissions.addGroup");
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

    $permissionName = "permissions.addGroup";
    $addGroup = ((in_array($permissionName, array_column($_SESSION["permissions"], 'permissionName'))) && $permissionName != "default");

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
        $sql .= " OR group_groups.siteId = '1'";
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
?>

<div class="content-wrapper-center">
    <a href="index.php?page=adm/permissions/index">
        <h1 class="head">Permissions</h1>
    </a>
</div>
<div class="content-wrapper-center">
    <table>
        <thead>
            <tr>
                <td>Id</td>
                <td>Group name</td>
                <td>Site</td>
                <td>Description</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($group as $a) {
            ?>
                    <tr>
                        <td><?= $a['id'] ?></td>
                        <td><?= $a['groupName'] ?></td>
                        <td><?= $a['siteName'] ?></td>
                        <td><?= $a['description'] ?></td>
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
                <form action="" method="POST">
                <td>Add new</td>
                <td>
                    <input type="text" name=groupName placeholder="Group name">
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
                        <input type="text" name="description" placeholder="Description">
                    <td>
                        <button type="submit" name="newGroup" value="newGroup">Submit</button>
                    </td>
                </form>
            </tr>
        </tbody>
    </table>

    <?php
        if ($_POST["newGroup"]) {
            $stmt = $pdo->prepare("INSERT INTO `group_groups`(`groupName`, `siteId`) VALUES (:groupName, :siteId)");
        
                $stmt->bindValue(':groupName', $_POST["groupName"]);
                $stmt->bindValue(':siteId', $_POST["site"]);
     
                if($stmt->execute()){
                    echo '<script>alert("group added")</script>';
                    echo "<meta http-equiv='refresh' content='0'>";
                }
        }
    ?>

<?= template_footer() ?>