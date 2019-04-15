<!--  -->
<?php 
include_once('include/class_user.php');
include_once('include/class_residence.php');
$user = NEW User();
$res = NEW Residence();
$resID = (int)$_GET['id'];
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
<h4 class="rating__stars">Oversikt til utleier til <?php echo ucfirst($user->getRentedAddress($resID)) ?></h4>
<table style="width:95%">

    <tr>
        <th>Renter</th>
        <th>Rented from</th>
        <th>Rented to</th>
        <th>Contract</th>
    </tr>
    <?php
    // Henter ut info til spesifik leilighet og skriver ut i tabel
        $count = count($user->getInfoFromDB2($resID));
        for($i = 0; $i < $count; $i++ ) {
            echo "<tr>";
            echo "<td>" .  $user->getRentersEmail((int)($user->getInfoFromDB2($resID)[$i][0]))[0] .  "</td>";
            echo "<td>" . date("d-m-Y", strtotime($user->getInfoFromDB2($resID)[$i][1])) .  "</td>";
            echo "<td>" . date("d-m-Y", strtotime($user->getInfoFromDB2($resID)[$i][2])) .  "</td>";
            echo "<td> pdf file </td>"; 
            echo "</tr>";
        }
        ?>

    <!--  -->

    </tr>
</table>