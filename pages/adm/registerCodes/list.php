<?php
headerr('Register codes', "registerCodes");
?>

<?php
$date = date("Y-m-d H:i:s");

$d=strtotime("+15 min");
$date15 = date("Y-m-d H:i:s", $d);

if (isset($_POST["disable"])) {
    $stmt = $pdo->prepare("UPDATE registerCodes SET totalUses = 0 WHERE id = :id");
        $stmt->bindParam(':id', $_POST["disable"]);

        if($stmt->execute()){
            echo '<script>alert("Code disabled.")</script>';
        }
}

$code = uniqid();

if ($_POST["uses"]) {
    $stmt = $pdo->prepare("INSERT INTO registerCodes (code, createdBy, totalUses, start, end)
        VALUES (:code, :createdBy, :totalUses, :start, :end)");
        $stmt->bindParam(':code', $code);
        $stmt->bindParam(':createdBy', $_SESSION["id"]);
        $stmt->bindParam(':totalUses', $_POST["uses"]);
        $stmt->bindParam(':start', $_POST["start"]);
        $stmt->bindParam(':end', $_POST["end"]);

        if($stmt->execute()){
            echo '<script>alert("New account created.")</script>';
        }
}

$sql = "SELECT registerCodes.id, registerCodes.code, registerCodes.createdBy, users.username, registerCodes.totalUses, registerCodes.start, registerCodes.end FROM registerCodes LEFT JOIN users ON registerCodes.createdBy = users.id ORDER BY `registerCodes`.`start` DESC";
    $stmt = $pdo->prepare($sql);

    //Execute.
    $stmt->execute();

    //Fetch row.
    $code = $stmt->fetchAll(PDO::FETCH_ASSOC);

$allcodes = in_array("registerCodes.all", array_column($_SESSION["permissions"], 'permissionName'));
?>

<div class="content-wrapper-center">
    <h1 class="head">Register codes list</h1>
</div>
<div class="content-wrapper2">
    <div class="createCode">
        <form action="" method="post">
            <table>
                <thead>
                    <tr>
                        <td><label for="uses">Uses: </label></td>
                        <td><label for="start">Start: </label></td>
                        <td><label for="end">End: </label></td>
                        <td></td>
                    </tr>
                </thead>
                <tr>
                    <td><input type="number" name="uses" id="uses" value="1" min="1"></td>
                    <td><input type="datetime-local" name="start" id="start" value="<?= $date ?>" min="<?= $date ?>"></td>
                    <td><input type="datetime-local" name="end" id="end" value="<?= $date15 ?>" min="<?= $date ?>"></td>
                    <td><button type="submit">Create</button></td>
                </tr>
            </table>
        </form>
    </div>
    <h3>Active codes</h3>
    <form action="" method="post">
        <table>
            <thead>
                <tr>
                    <td>Code</td>
                    <td>Total uses</td>
                    <td>Valid from</td>
                    <td>Valid to</td>
                    <?php
                if ($allcodes) {
                    ?>
                    <td>created by</td>
                <?php
                }
                ?>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
        <?php
        foreach ($code as $i) {
            if ((($i["createdBy"] == $_SESSION["id"]) || $allcodes) && 0 < $i["totalUses"] && $date >= $i["start"] && $date <= $i["end"]) {
                ?>
                <tr>
                    <td><?= $i["code"] ?></td>
                    <td><?= $i["totalUses"] ?></td>
                    <td><?= $i["start"] ?></td>
                    <td><?= $i["end"] ?></td>
                    <?php
                if ($allcodes) {
                    ?>
                    <td><?= $i["username"] ?></td>
                    <?php
                }
                    ?>
                    <td><button name="disable" value="<?= $i["id"] ?>" type="submit">Disable</button></td>
                    <td><a href="index.php?page=adm/registerCodes/used&id=<?= $i["id"] ?>">view info</a></td>
                </tr>
                <?php
            }
        }
        ?>
        </table>
    </form>
    <h3>Outdated or used codes</h3>
    <table>
        <thead>
            <tr>
                <td>Code</td>
                <td>Total uses</td>
                <td>Valid from</td>
                <td>Valid to</td>
                <?php
                if ($allcodes) {
                    ?>
                <td>created by</td>
            <?php
                }
            ?>
                <td></td>
            </tr>
        </thead>
    <?php
        foreach ($code as $i) {
            if ((($i["createdBy"] == $_SESSION["id"]) || $allcodes) && (0 < $i["totalUses"] && $date >= $i["start"] && $date >= $i["end"] ) || 1 > $i["totalUses"]) {
                ?>
                <tr>
                    <td><?= $i["code"] ?></td>
                    <td><?= $i["totalUses"] ?></td>
                    <td><?= $i["start"] ?></td>
                    <td><?= $i["end"] ?></td>
                    <?php
                if ($allcodes) {
                    ?>
                    <td><?= $i["username"] ?></td>
                    <td><a href="index.php?page=adm/registerCodes/used&id=<?= $i["id"] ?>">view info</a></td>
                    <?php
                }
                    ?>
                </tr>
                <?php
            }
        }
    ?>
    </table>
</div>

<?php
    $page = 2;
    $num_on_page = 5;

    $array_start = ($page - 1) * $num_on_page;

    $array_part = array_slice($code, $array_start, $num_on_page);
    foreach($array_part as $b) {
        echo "<br>" . $b["id"];
    }
?>

<?= template_footer() ?>