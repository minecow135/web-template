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
    <?php
        foreach ($code as $i) {
            if ((($i["createdBy"] == $_SESSION["id"]) || $allcodes) && 0 < $i["totalUses"] && $date >= $i["start"] && $date <= $i["end"]) {
                $active[] = $i;
            }
            if ((($i["createdBy"] == $_SESSION["id"]) || $allcodes) && ((0 < $i["totalUses"] && $date >= $i["start"] && $date >= $i["end"] ) || 1 > $i["totalUses"])) {
                $used[] = $i;
            }
        }
    ?>
    </table>

<?php
    $num_on_page = 5;
    if (!empty($active)) {
        $active_g = count($active);
        echo "a";
        
        $active_p = isset($_GET['active']) && is_numeric($_GET['active']) ? $_GET['active'] : 1;
        
        $array_start = ($active_p - 1) * $num_on_page;
        
        $array_part = array_slice($active, $array_start, $num_on_page);
    }
?>

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
        print_r($array_part);
        foreach ($array_part as $i) {
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

    <div>
    <?php if (ceil($active_g / $num_on_page) > 0) { ?>
        <ul class="pagination">
            <?php if ($active_p > 1): ?>
                <li class="prev"><a href="index.php?page=adm/registerCodes/list&active=<?php echo $active_p-1 ?>">Prev</a></li>
            <?php endif; ?>

            <?php if ($active_p > 3): ?>
                <li class="start"><a href="index.php?page=adm/registerCodes/list&active=1">1</a></li>
                <li class="dots">...</li>
            <?php endif; ?>

            <?php if ($active_p-2 > 0): ?><li class="page"><a href="index.php?page=adm/registerCodes/list&active=<?php echo $active_p-2 ?>&used=<?= $_GET["used"] ?>"><?php echo $active_p-2 ?></a></li><?php endif; ?>
            <?php if ($active_p-1 > 0): ?><li class="page"><a href="index.php?page=adm/registerCodes/list&active=<?php echo $active_p-1 ?>&used=<?= $_GET["used"] ?>"><?php echo $active_p-1 ?></a></li><?php endif; ?>

            <li class="currentpage"><a href="index.php?page=adm/registerCodes/list&active=<?php echo $active_p ?>&used=<?= $_GET["used"] ?>"><?php echo $active_p ?></a></li>

            <?php if ($active_p+1 < ceil($active_g / $num_on_page)+1): ?><li class="page"><a href="index.php?page=adm/registerCodes/list&active=<?php echo $active_p+1 ?>&used=<?= $_GET["used"] ?>"><?php echo $active_p+1 ?></a></li><?php endif; ?>
            <?php if ($active_p+2 < ceil($active_g / $num_on_page)+1): ?><li class="page"><a href="index.php?page=adm/registerCodes/list&active=<?php echo $active_p+2 ?>&used=<?= $_GET["used"] ?>"><?php echo $active_p+2 ?></a></li><?php endif; ?>

            <?php if ($active_p < ceil($active_g / $num_on_page)-2): ?>
                <li class="dots">...</li>
                <li class="end"><a href="index.php?page=adm/registerCodes/list&active=<?php echo ceil($active_g / $num_on_page) ?>&used=<?= $_GET["used"] ?>"><?php echo ceil($active_g / $num_on_page) ?></a></li>
            <?php endif; ?>

            <?php if ($active_p < ceil($active_g / $num_on_page)): ?>
                <li class="next"><a href="index.php?page=adm/registerCodes/list&active=<?php echo $active_p+1 ?>&used=<?= $_GET["used"] ?>">Next</a></li>
            <?php endif; ?>
        </ul>
    <?php } ?>
</div>

    <?php
    if (!empty($used)) {
        $used_g = count($used);
        
        $used_p = isset($_GET['used']) && is_numeric($_GET['used']) ? $_GET['used'] : 1;
        
        $array_start = ($used_p - 1) * $num_on_page;
        
        $array_part = array_slice($used, $array_start, $num_on_page);
    }
?>

<h3>Outdated or used codes</h3>
    <table>
        <thead>
            <tr>
                <td>Id</td>
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
        foreach ($array_part as $i) {
            if ((($i["createdBy"] == $_SESSION["id"]) || $allcodes) && ((0 < $i["totalUses"] && $date >= $i["start"] && $date >= $i["end"] ) || 1 > $i["totalUses"])) {
                ?>
                <tr>
                    <td><?= $i["id"] ?></td>
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
                    <td><a href="index.php?page=adm/registerCodes/used&id=<?= $i["id"] ?>">view info</a></td>
                </tr>
                <?php
            }
        }
    ?>
    </table>
<div>
    <?php if (ceil($used_g / $num_on_page) > 0): ?>
        <ul class="pagination">
            <?php if ($used_p > 1): ?>
                <li class="prev"><a href="index.php?page=adm/registerCodes/list&active=<?= $_GET["active"] ?>&used=<?php echo $used_p-1 ?>">Prev</a></li>
            <?php endif; ?>

            <?php if ($used_p > 3): ?>
                <li class="start"><a href="index.php?page=adm/registerCodes/list&active=<?= $_GET["active"] ?>&used=1">1</a></li>
                <li class="dots">...</li>
            <?php endif; ?>

            <?php if ($used_p-2 > 0): ?><li class="page"><a href="index.php?page=adm/registerCodes/list&active=<?= $_GET["active"] ?>&used=<?php echo $used_p-2 ?>"><?php echo $used_p-2 ?></a></li><?php endif; ?>
            <?php if ($used_p-1 > 0): ?><li class="page"><a href="index.php?page=adm/registerCodes/list&active=<?= $_GET["active"] ?>&used=<?php echo $used_p-1 ?>"><?php echo $used_p-1 ?></a></li><?php endif; ?>

            <li class="currentpage"><a href="index.php?page=adm/registerCodes/list&active=<?= $_GET["active"] ?>&used=<?php echo $used_p ?>"><?php echo $used_p ?></a></li>

            <?php if ($used_p+1 < ceil($used_g / $num_on_page)+1): ?><li class="page"><a href="index.php?page=adm/registerCodes/list&active=<?= $_GET["active"] ?>&used=<?php echo $used_p+1 ?>"><?php echo $used_p+1 ?></a></li><?php endif; ?>
            <?php if ($used_p+2 < ceil($used_g / $num_on_page)+1): ?><li class="page"><a href="index.php?page=adm/registerCodes/list&active=<?= $_GET["active"] ?>&used=<?php echo $used_p+2 ?>"><?php echo $used_p+2 ?></a></li><?php endif; ?>

            <?php if ($used_p < ceil($used_g / $num_on_page)-2): ?>
                <li class="dots">...</li>
                <li class="end"><a href="index.php?page=adm/registerCodes/list&active=<?= $_GET["active"] ?>&used=<?php echo ceil($used_g / $num_on_page) ?>"><?php echo ceil($used_g / $num_on_page) ?></a></li>
            <?php endif; ?>

            <?php if ($used_p < ceil($used_g / $num_on_page)): ?>
                <li class="next"><a href="index.php?page=adm/registerCodes/list&active=<?= $_GET["active"] ?>&used=<?php echo $used_p+1 ?>">Next</a></li>
            <?php endif; ?>
        </ul>
    <?php endif; ?>
</div>
</div>

<?= template_footer() ?>