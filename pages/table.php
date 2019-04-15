<!--  -->
<?php 
include_once('include/login_check.php');
include_once('include/class_user.php');
include_once('include/class_residence.php');
$user = NEW User();
$res = NEW Residence();
$id = (int)($_SESSION['u_id']);
if (isset($_POST['submit'])) {
    $targetfolder = "pdf/contracts/";
    $targetfolder = $targetfolder . basename( $_FILES['file']['name']) ;
    $ok=1;
    $file_type=$_FILES['file']['type'];
    if ($file_type=="application/pdf") {
        if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder)) {
            echo "The file ". basename( $_FILES['file']['name']). " is uploaded";
        } else {
            echo "Problem uploading file";
        }
    } else {
        echo "You may only upload PDFs";
    }

    $res->insert_contract_name($_FILES['file']['name'], $_POST['submit']);

    header("Location: index.php?pg=table");
    exit();
}
?>

<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        margin: 15px;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>
<h1 class="main__headline" id="test_id">Rent out overview</h1>
<table style="width:95%">

    <tr>
        <!-- <th>Rental ID</th> -->
        <th>Renter</th>
        <th>Contact</th>
        <th>Rented from</th>
        <th>Rented to</th>
        <th>Contract</th>
        <th>Property</th>
        <th>Approve rental</th>
        <th>Accepted by renter</th>
    </tr>
    <?php
        $rows = $user->getInfoFromDBv3($id);
        foreach ($rows as $this_row) {
            // echo '<br>',var_dump($this_row);
            echo "<tr>";
            echo "<td>" .  $user->getRentersEmail((int)($this_row[1]))[0] .  "</td>";
            echo "<td>";
            ?>
                <form action="?pg=chat&chat_id=<?php echo $this_row['rental_rented_by']; ?>" method="post">
                    <button type="submit" name="residence_id" value="<?php echo $_GET['id'] ?>">Chat</button>
                </form>
            <?php
            echo "</td>";
            echo "<td>" . date("d-m-Y", strtotime($this_row[2])) .  "</td>";
            echo "<td>" . date("d-m-Y", strtotime($this_row[3])) .  "</td>";
                
            echo '<td>';
                if ($this_row[rental_contract] == NULL) {
                    // echo '<input type="file" name="" id="" onchange="upload_contract(this)">';
                    ?>
                        <form action="index.php?pg=table" method="post" enctype="multipart/form-data">
                                <input type="file" name="file" size="50" required />
                                <button type="submit" name="submit" value="<?php echo $this_row['rental_ID'] ?>">Upload</button>
                        </form>
                    <?php
                } else {
                    echo '<a href="pdf/contracts/',$this_row[rental_contract],'">View contract</a>';
                }
            echo '</td>'; 
            
            echo "<td>" . ucfirst($user->getRentedAddress($this_row[4])) .  "</td>";
            echo '<td id="accept_owner_',$this_row['rental_ID'],'"><input type="checkbox" value="',$this_row['rental_ID'],'" id="',$_SESSION['u_id'],'" name="accept_owner_',$this_row['rental_ID'],'"';
            if ($this_row[rental_approved_by] != NULL) {
                echo ' checked disabled';
            } else if ($this_row[rental_contract] == NULL) {
                echo ' disabled';
            } else {
                echo ' onchange="approve_rental(this)"';
            }
            echo '></td>';
            echo '<td><input type="checkbox" value="',$this_row['rental_ID'],'" id="accept_renter',$this_row['rental_ID'],'"';
                if ($this_row[rental_approved_by_user] != NULL) {
                    echo ' checked ';
                }
            echo 'disabled></td>';
            echo "</tr>";
        }
        ?>
    </tr>
</table>
<?php include_once('modules/main__footer__spacer.php'); 