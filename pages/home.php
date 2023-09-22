<?php
headerr('Home', "default");
?>
<?php
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
    print_r($site);
?>
<div class="content-wrapper-center">
    <h1 class="head">Template</h1>
</div>

<?= template_footer() ?>