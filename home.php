<?php

require "dbBroker.php";
require "model/tim.php";

session_start();

//nesto oko logout

$result = Tim::getAll($conn);
if(!$result){
    echo "Greska kod upita<br>";
    die();
}
if($result->num_rows == 0){
    echo "Nema timova";
    die();
}else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/logo.png"/>
    <title>Fudbalski timovi</title>
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <div>
        <h1>Dobrodosli na sajt!</h1>
    </div>
<div class ="row">
        <div class="nesto" style="width: 35%; float: left;  background-color:blue; padding-right:20px;">
            <h2>Pregled timova u ligi</h2>
            <button id="btn" onclick="prikazi()">Pregled</button>
        </div>
        <div class="nesto" style="width: 30%; float: left;  background-color:blue; padding-right:20px;">
            <h2>Dodaj novi tim</h2>
            <button id="btn-dodaj" >Dodaj</button>
        </div>
        <div class="nesto" style="width: 30%; float: left;  background-color:blue; padding-right:20px;">
            <h2>Pretraga timova</h2>
            <button id="btn-pretraga">Pretraga</button>
        </div>
</div>

<div id="pregled">
<table>
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Naziv tima</th>
        <th scope="col">Drzava</th>
        <th scope="col">Godina osnivanja</th>
        <th scope="col">Broj titula</th>
        <th scope="col">Izaberi tim</th>
    </tr>
    </thead>
    <tbody>
    <?php
        while($red= $result->fetch_array()){
            ?>
            <tr>
                <td><?php echo $red["timID"] ?></td>
                <td><?php echo $red["nazivTima"] ?></td>
                <td><?php echo $red["drzava"] ?></td>
                <td><?php echo $red["godinaOsnivanja"] ?></td>
                <td><?php echo $red["brojTitula"] ?></td>
                <td>
                    <label class = "radio-btn">
                    <input type="radio" name="checked-donut" value=<?php echo $red["timID"]?>>                    
                    <span class="checkmark"></span>
                    </label>
                </td>
                
            </tr>
        <?php
        }
    }
            ?>
    </tbody>
    </table>
    <div class="row">
        <div class="nesto">
            <button id="btn-izmeni">Izmeni</button>
            <button id="btn-izbrisi">Izbrisi</button>
        </div>
    </div>
</div>
    
<script src="js/main.js"></script>

</body>
</html>    

