<?php
    headerr('Delete permission', 'permissions.delete.userPerm');
?>

<?php
$msg = '';
$delete = "permission";

// Check that the contact ID exists
if (isset($_GET['id'])) {
    // Select the record that is going to be deleted
    $sql = "SELECT id FROM userPermission WHERE id = :id";
        $stmt = $pdo->prepare($sql);

       # $stmt->bindValue(':table', $_GET["table"]);
        $stmt->bindValue(':id', $_GET["id"]);

        //Execute.
        $stmt->execute();

        //Fetch row.
        $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit($delete . ' doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM userPermission WHERE id = :id');
            
            $stmt->bindValue(':id', $_GET["id"]);

            //Execute.
            if ($stmt->execute()) {
                $msg = 'You have deleted the ' . $delete . '!';
            }
        } else {
            // User clicked the "No" button, redirect them back to the read page
            exit("confirm value wrong");
        }
    }
} else {
    exit('No ID specified!');
}
?>

<div class="content-wrapper vCenter">
    <div class="center">
        <div class="permissionDelete">
            <h2>Delete <?= $delete ?> #<?= $contact['id'] ?></h2>
            <?php if ($msg) : ?>
                <p><?= $msg ?></p>
                <div class="yesno">
                    <a class="no" href="index.php?page=adm/<?= basename(__DIR__) ?>/index">Go back</a>
                </div>
            <?php else : ?>
                <p>Are you sure you want to delete <?= $delete ?> #<?= $contact['id'] ?>?</p>
                <div class="yesno">
                    <a class="yes" href="index.php?page=adm/<?= basename(__DIR__) ?>/deleteUserPerm&id=<?= $contact['id'] ?>&confirm=yes">Yes</a>
                    <a class="no" href="index.php?page=adm/<?= basename(__DIR__) ?>/index">No</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= template_footer() ?>