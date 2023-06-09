<?php
headerr('Import', "asset.create");
?>

<?php
    function incrementAlphanumeric($value) {
        preg_match('/^(.*?)(\d+)(\D*)$/', $value, $matches); // Extract the last set of numeric characters and the following non-numeric characters
        $prefix = $matches[1]; // Get the prefix
        $numericPart = $matches[2]; // Get the numeric part
        $alphabeticPart = $matches[3]; // Get the alphabetic part
        
        if ($numericPart !== '') {
            $nextNumeric = strval(intval($numericPart) + 1); // Increment the numeric part
            
            // Pad the incremented numeric part with leading zeros if necessary
            $paddedNumeric = str_pad($nextNumeric, strlen($numericPart), '0', STR_PAD_LEFT);
            
            return $prefix . $paddedNumeric . $alphabeticPart; // Combine the parts and return the result
        } else {
            return $value; // If there is no numeric part, return the original value
        }
    }

    if (isset($_POST["submit"])) {

        $value = $_POST["code"];

        for ($i=0; $i < $_POST["count"]; $i++) { 
            $data[$i]["name"] = $_POST["name"];
            $data[$i]["category"] = $_POST["category"];
            $data[$i]["code"] = $value;
            $data[$i]["siteId"] = $_SESSION["siteId"];
            $value = incrementAlphanumeric($value);
        }

            $data = $data;            
                $place_holder = '(' . implode(',', array_fill(0, count($data[0]), '?')) . ')';
                $place_hoders = implode(',', array_fill(0, count($data), $place_holder));
              
                $st = $pdo->prepare('INSERT INTO asset_items (name, category, code, siteId) VALUES' . $place_hoders);
              
                $flat = call_user_func_array('array_merge', array_map('array_values', $data));
                if ($st->execute( $flat )) {
                    echo '<script>alert("New item added.")</script>';
                }
              
              header("location: index.php?page=asset/import");
              exit;
    }
?>

<div class="content-wrapper-center">
    <h1 class="head">Import</h1>
</div>

<div class="content-wrapper-center">
    <form action="" method="post">
        <table>
            <tr>
                <td><label for="category">Category</label></td>
                <td><input type="text" name="category" placeholder="Category" id="category"></td>
            </tr>
            <tr>
                <td><label for="name"></label>Name</td>
                <td><input type="text" name="name" placeholder="Name" id="name"></td>
            </tr>
            <tr>
                <td><label for="count"></label>Count</td>
                <td><input type="number" name="count" placeholder="Count" id="count" min=1></td>
            </tr>
            <tr>
                <td><label for="code"></label>Code</td>
                <td><input type="text" name="code" placeholder="Code" id="code"></td>
            </tr>
            <tr>
                <td><button type="submit" name="submit">Submit</button></td>
                <td></td>
            </tr>

        </table>
    </form>
    
</div>



<?= template_footer() ?>