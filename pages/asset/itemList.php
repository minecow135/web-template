<?php
headerr('Item list', "asset.itemList");
?>

<?php
    $sql = "SELECT id, name, category, code FROM asset_items WHERE siteId = :siteId";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':siteId', $_SESSION["siteId"]);

        //Execute.
        $stmt->execute();

        //Fetch row.
        $item = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT asset_borrowed.id, asset_borrowed.itemId, asset_borrowed.userId, asset_user.name FROM asset_borrowed LEFT JOIN asset_user ON asset_borrowed.userId = asset_user.id WHERE `dateBack` IS NULL AND asset_borrowed.siteId = :siteId";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':siteId', $_SESSION["siteId"]);

        //Execute.
        $stmt->execute();

        //Fetch row.
        $borrow = $stmt->fetchAll(PDO::FETCH_ASSOC);


        if (isset($_GET["delete"])) {
            $stmt = $pdo->prepare("DELETE FROM asset_items WHERE id = :id AND siteId = :siteId");
        
                $stmt->bindParam(':id', $_GET["delete"]);
                $stmt->bindValue(':siteId', $_SESSION["siteId"]);

                if($stmt->execute()){
                    echo '<script>alert("Item deleted.")</script>';
                }
            header("location: index.php?page=asset/itemList");
            exit;
        }
?>

<div class="content-wrapper-center">
    <h1 class="head">Item list</h1>
    <div>
        <a href="index.php?page=asset/borrow"><h3>Register borrow</h3></a>
        <a href="index.php?page=asset/import"><h3>Add items</h3>
        </a>
    </div>
    <table>
        <thead>
            <tr>
                <td>Id</td>
                <td>Category</td>
                <td>Name</td>
                <td>Code</td>
                <td>Borrowed by</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($item as $i) {
                    unset($found_key);
                    if (in_array($i["id"],array_column($borrow, "itemId"))) {
                        $found_key = array_search($i["id"],array_column($borrow, "itemId"));
                    }
            ?>
                    <tr>
                        <td><?= $i["id"] ?></td>
                        <td><?= $i["category"] ?></td>
                        <td><?= $i["name"] ?></td>
                        <td><?= $i["code"] ?></td>
                        <td><?= $borrow[$found_key]["name"] ?></td>
                        <td><a href="index.php?page=asset/itemList&delete=<?= $i["id"] ?>" onclick="return confirm('Are you sure?');">Delete</a></td>
                    </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</div>

<?= template_footer() ?>