<?php
headerr('Register codes', "registerCodes");
?>

<?php
$sql = "SELECT registerCodes.id, registerCodes.code, registerCodes.createdBy, users.username, registerCodes.usesLeft, registerCodes.start, registerCodes.end FROM registerCodes LEFT JOIN users ON registerCodes.createdBy = users.id";
        $stmt = $pdo->prepare($sql);

        //Execute.
        $stmt->execute();

        //Fetch row.
        $code = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $allcodes = in_array("registerCodes.all", array_column($_SESSION["permissions"], 'permissionName'));
$date = date("Y-m-d H:i:s");
?>

<div class="content-wrapper-center">
    <h1 class="head">Register codes list</h1>
    <div class="createCode">
        <form action="" method="post">
            <label for="uses">Uses: </label>
            <input type="number" name="uses" id="uses">
            <button type="submit">Create</button>
        </form>
    </div>
    <h3>Active codes</h3>
    <table>
        <thead>
            <tr>
                <td>Id</td>
                <td>Code</td>
                <td>Uses left</td>
                <td>Valid from</td>
                <td>Valid to</td>
                <?php
                if ($allcodes) {
                    ?>
                <td>created by</td>
            <?php
                }
            ?>
            </tr>
        </thead>
    <?php
        foreach ($code as $i) {
            if ((($i["createdBy"] == $_SESSION["id"]) || $allcodes) && 0 < $i["usesLeft"] && $date >= $i["start"] && $date <= $i["end"]) {
                ?>
                <tr>
                    <td><?= $i["id"] ?></td>
                    <td><?= $i["code"] ?></td>
                    <td><?= $i["usesLeft"] ?></td>
                    <td><?= $i["start"] ?></td>
                    <td><?= $i["end"] ?></td>
                    <?php
                if ($allcodes) {
                    ?>
                    <td><?= $i["username"] ?></td>
                    <?php
                }
                    ?>
                </tr>
                <?php
            }
        }
    ?>
 <!--   </table>
    <h3>Outdated codes</h3>
    <table>
        <thead>
            <tr>
                <td>Id</td>
                <td>Code</td>
                <td>Uses left</td>
                <td>Valid from</td>
                <td>Valid to</td>
                <?php
                if ($allcodes) {
                    ?>
                <td>created by</td>
            <?php
                }
            ?>
            </tr>
        </thead>-->
    <?php
        foreach ($code as $i) {
            if ((($i["createdBy"] == $_SESSION["id"]) || $allcodes) && 0 < $i["usesLeft"] && $date >= $i["start"] && $date >= $i["end"]) {
                ?>
                <tr>
                    <td><?= $i["id"] ?></td>
                    <td><?= $i["code"] ?></td>
                    <td><?= $i["usesLeft"] ?></td>
                    <td><?= $i["start"] ?></td>
                    <td><?= $i["end"] ?></td>
                    <?php
                if ($allcodes) {
                    ?>
                    <td><?= $i["username"] ?></td>
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

<?= template_footer() ?>