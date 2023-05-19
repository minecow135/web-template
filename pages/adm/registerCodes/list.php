<?php
headerr('Register codes', "registerCodes");
?>

<?php
$sql = "SELECT registerCodes.id, registerCodes.code, registerCodes.createdBy, users.username, registerCodes.start, registerCodes.end FROM registerCodes LEFT JOIN users ON registerCodes.createdBy = users.id";
        $stmt = $pdo->prepare($sql);

        //Execute.
        $stmt->execute();

        //Fetch row.
        $code = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="content-wrapper-center">
    <h1 class="head">Register codes list</h1>
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Code</th>
            <th>Valid from</th>
            <th>Valid to</th>
            <th>created by</th>
        </tr>
    <?php
        foreach ($code as $i) {
            if (($i["createdBy"] == $_SESSION["id"]) || (in_array("registerCodes.all", array_column($_SESSION["permissions"], 'permissionName')))) {
                ?>
                <tr>
                    <td><?= $i["id"] ?></td>
                    <td><?= $i["code"] ?></td>
                    <td><?= $i["start"] ?></td>
                    <td><?= $i["end"] ?></td>
                    <td><?= $i["username"] ?></td>
                </tr>
                <?php
            }
        }
    ?>
    </table>
</div>

<?= template_footer() ?>