<?php
headerr('Borrow', "asset.borrow");
?>

<?php
    $date = date("Y-m-d H:i:s");

    $d=strtotime("next month");
    $dateMonth = date("Y-m-d h:i:s", $d);
    
    if (isset($_POST["out"])) {
        $sql = "SELECT count(id) AS num FROM asset_items WHERE code = :code AND siteId = :siteId AND removed = 0";
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':code', $_POST["code"]);
            $stmt->bindValue(':siteId', $_SESSION["siteId"]);

            //Execute.
            $stmt->execute();

            //Fetch row.
            $itemNum = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($itemNum["num"] > 0) {
            $sql = "SELECT id FROM asset_items WHERE code = :code AND siteId = :siteId AND removed = 0";
                $stmt = $pdo->prepare($sql);

                $stmt->bindValue(':code', $_POST["code"]);
                $stmt->bindValue(':siteId', $_SESSION["siteId"]);

                //Execute.
                $stmt->execute();

                //Fetch row.
                $item = $stmt->fetch(PDO::FETCH_ASSOC);

            $sql = "SELECT count(id) AS num FROM asset_user WHERE mail = :mail AND siteId = :siteId";
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':mail', $_POST["email"]);
            $stmt->bindValue(':siteId', $_SESSION["siteId"]);

            //Execute.
            $stmt->execute();
            
            //Fetch row.
            $userNum = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($userNum["num"] < 1) {
                $stmt = $pdo->prepare("INSERT INTO asset_user (mail, siteId)
                VALUES (:mail, :siteId)");
                
                $stmt->bindParam(':mail', $_POST["email"]);
                $stmt->bindValue(':siteId', $_SESSION["siteId"]);
                
                $stmt->execute();
            }

            $sql = "SELECT id FROM asset_user WHERE mail = :mail AND siteId = :siteId";
                $stmt = $pdo->prepare($sql);

                $stmt->bindValue(':mail', $_POST["email"]);
                $stmt->bindValue(':siteId', $_SESSION["siteId"]);

                //Execute.
                $stmt->execute();
                
                //Fetch row.
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt = $pdo->prepare("INSERT INTO asset_borrowed (itemId, userId, borrowedBy, dateStart, dateEnd, siteId)
            VALUES (:itemId, :userId, :borrowedBy, :dateStart, :dateEnd, :siteId)");
            
            $stmt->bindParam(':itemId', $item["id"]);
            $stmt->bindParam(':userId', $user["id"]);
            $stmt->bindParam(':borrowedBy', $_SESSION["id"]);
            $stmt->bindParam(':dateStart', $_POST["start"]);
            $stmt->bindParam(':dateEnd', $_POST["end"]);
            $stmt->bindValue(':siteId', $_SESSION["siteId"]);

            if($stmt->execute()){
                echo '<script>alert("New borrow registered.")</script>';
            }
        }
        else {
            echo '<script>alert("Item not found")</script>';
        }
    }

    if (isset($_POST["in"])) {
        $sql = "SELECT id FROM asset_items WHERE code = :code AND siteId = :siteId AND removed = 0";
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':code', $_POST["code"]);
            $stmt->bindValue(':siteId', $_SESSION["siteId"]);

            //Execute.
            $stmt->execute();

            //Fetch row.
            $item = $stmt->fetch(PDO::FETCH_ASSOC);

        $sql = "SELECT count(id) AS num FROM asset_borrowed WHERE `itemId` = :itemId AND `dateBack` IS NULL AND siteId = :siteId";
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':itemId', $item["id"]);
            $stmt->bindValue(':siteId', $_SESSION["siteId"]);

            //Execute.
            $stmt->execute();

            //Fetch row.
            $borrowCount = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($borrowCount["num"] > 0) {        
            $stmt = $pdo->prepare("UPDATE `asset_borrowed` SET `dateBack` = :dateBack WHERE `itemId` = :itemId AND `dateBack` IS NULL AND siteId = :siteId");
            
            $stmt->bindParam(':itemId', $item["id"]);
            $stmt->bindParam(':dateBack', $_POST["dateBack"]);
            $stmt->bindValue(':siteId', $_SESSION["siteId"]);

            if($stmt->execute()){
                echo '<script>alert("Item submitted.")</script>';
            }
        }
        else {
            echo '<script>alert("Borrow not registerd.")</script>';
        }
    }
?>

<div class="content-wrapper-center">
    <h1 class="head">Borrow</h1>
</div>
<div class="content-wrapper-center">
    <form action="" method="post">
        <h2>Out</h2>
        <table>
            <tr>
                <td><label for="code">Item code</label></td>
                <td><input type="text" id="code" name="code" placeholder="Code"></td>
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td><input type="email" id="email" name="email" placeholder="Email"></td>
            </tr>
            <tr>
                <td><label for="name">Start</label></td>
                <td><input type="datetime-local" id="start" name="start" placeholder="Start" value="<?= $date ?>"></td>
            </tr>
            <tr>
                <td><label for="name">End</label></td>
                <td><input type="datetime-local" id="end" name="end" placeholder="End" value="<?= $dateMonth ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" name="out">Submit</button></td>
            </tr>
        </table>
    </form>
    <form action="" method="post">
        <h2>In</h2>
        <table>
            <tr>
                <td><label for="code">Item code</label></td>
                <td><input type="text" id="code" name="code" placeholder="Code"></td>
            </tr>
            <tr>
                <td><label for="dateBack">Time</label></td>
                <td><input type="datetime-local" id="dateBack" name="dateBack" placeholder="Start" value="<?= $date ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" name="in">Submit</button></td>
            </tr>
        </table>
    </form>
</div>

<?= template_footer() ?>