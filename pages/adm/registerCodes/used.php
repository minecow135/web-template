<?php
headerr('Codes used by', "registerCodes");
?>

<?php
   $sql = "SELECT registerCodes.id, registerCodes.code, registerCodes.createdBy, users.username, registerCodes.totalUses, registerCodes.start, registerCodes.end FROM registerCodes LEFT JOIN users ON registerCodes.createdBy = users.id WHERE registerCodes.id = :id ORDER BY `registerCodes`.`start` DESC";
   $stmt = $pdo->prepare($sql);

   $stmt->bindParam(':id', $_GET["id"]);

   //Execute.
   $stmt->execute();

   //Fetch row.
   $code = $stmt->fetch(PDO::FETCH_ASSOC); 

   $sql = "SELECT registerCodesUsed.id, registerCodes.code, users.username, registerCodesUsed.time FROM registerCodesUsed LEFT JOIN users ON registerCodesUsed.userId = users.id LEFT JOIN registerCodes ON registerCodesUsed.codeId = registerCodes.id WHERE registerCodesUsed.codeId = :id";
   $stmt = $pdo->prepare($sql);

   $stmt->bindParam(':id', $_GET["id"]);

   //Execute.
   $stmt->execute();

   //Fetch row.
   $uses = $stmt->fetchAll(PDO::FETCH_ASSOC); 
?>

<div class="content-wrapper-center">
    <h1 class="head">Template</h1>
    <table>
        <thead>
            <tr>
                <td>Name</td>
                <td>Value</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Id</td>
                <td><?= $code["id"] ?></td>
            </tr>
            <tr>
                <td>Code</td>
                <td><?= $code["code"] ?></td>
            </tr>
            <tr>
                <td>Created by</td>
                <td><?= $code["username"] ?></td>
            </tr>
            <tr>
                <td>Total uses</td>
                <td><?= $code["totalUses"] ?></td>
            </tr>
            <tr>
                <td>Start</td>
                <td><?= $code["start"] ?></td>
            </tr>
            <tr>
                <td>End</td>
                <td><?= $code["end"] ?></td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <td>Used by</td>
                <td>Time</td>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($uses as $i) {
            ?>
                    <tr>
                        <td><?= $i["username"] ?></td>
                        <td><?= $i["time"] ?></td>
                    </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</div>

<?= template_footer() ?>