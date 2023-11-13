<?php
headerr('Borrow', "asset.borrow");
?>

<?php
    $date = date("Y-m-d H:i:s");

    $d=strtotime("next month");
    $dateMonth = date("Y-m-d h:i:s", $d);
    
    if (isset($_POST["out"]) && $_POST["email"] != "" && $_POST["code"] != "") {
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

    if (isset($_POST["in"]) && $_POST["code"] != "") {
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

<div class="content-wrapper">
    <div class="center">
        <h1 class="head">Borrow</h1>
        <div class="borrow">
            <form action="" method="post">
                <h2>Out</h2>
                <div class="row">
                    <label for="outEmail">Email</label>
                    <input type="email" id="outEmail" name="email" placeholder="Email">
                </div>
                <div class="row">
                    <label for="outStart">Start</label>
                    <input type="datetime-local" id="outStart" name="start" placeholder="Start" value="<?= $date ?>">
                </div>
                <div class="row">
                    <label for="outEnd">End</label>
                    <input type="datetime-local" id="outEnd" name="end" placeholder="End" value="<?= $dateMonth ?>">
                    
                </div>
                <div class="row">
                    <label for="outCode">Item code</label>
                    <input type="text" id="outCode" name="code" placeholder="Code">
                </div>
                <button type="submit" name="out">Submit</button>
            </form>
            <form action="" method="post">
                <h2>In</h2>
                <div class="row">
                        <label for="inCode">Item code</label>
                        <input type="text" id="inCode" name="code" placeholder="Code">
                </div>
                <div class="row">
                        <label for="dateBack">Time</label>
                        <input type="datetime-local" id="dateBack" name="dateBack" placeholder="Start" value="<?= $date ?>">
                </div>
                <div class="filler"></div>
                        <button type="submit" name="in">Submit</button>
            </form>
        </div>

        <div class="qr">
            <h3>Scan code</h3>
            <div id="reader" width="600px"></div>
        </div>

        <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            console.log(`Code matched = ${decodedText}`, decodedResult);
            document.getElementById("outCode").value = decodedText;
            document.getElementById("inCode").value = decodedText;
            }
    
            function onScanFailure(error) {
                // handle scan failure, usually better to ignore and keep scanning.
                // for example:
                // console.warn(`Code scan error = ${error}`);
            }
            
            let html5QrcodeScanner = new Html5QrcodeScanner(
                "reader",
                { fps: 10, qrbox: {width: 300, height: 300} },
                /* verbose= */ false
            );

            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        </script>
    </div>
</div>

<?= template_footer() ?>