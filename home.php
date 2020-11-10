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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="icon" href="image/logo.png"/>
    <link rel="text/css" href="css/home.css">
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
            <button id="btn-dodaj" data-toggle="modal" data-target="#myModal">Dodaj</button>
        </div>
        <div class="nesto" style="width: 30%; float: left;  background-color:blue; padding-right:20px;">
            <h2>Pretraga timova</h2>
            
            <input type="text" id="myInput" placeholder="Pretrazi timove" onkeyup="pretrazi()">
            
        </div>
</div>
<div id="pregled">
<table id="tabela">
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

<div class="modal fade" id="myModal" role="dialog" >
    <div class="modal-dialog">

        <!--Sadrzaj modala-->
        <div class="modal-content" style="border: 4px solid green;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container tim-form">
                    <form action="#" method="post" id="dodajForm">
                        <h3 id="naslov" style="color: black" text-align="center">Dodavanje tima</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" style="border: 1px solid black" name="nazivTima" class="form-control"
                                           placeholder="Naziv tima *" value="<?php echo $red["timID"] ?>"/>
                                </div>
                                <div class="form-group">
                                    <input type="text" style="border: 1px solid black" name="drzava" class="form-control" placeholder="Drzava  *"
                                           value=""/>
                                </div>
                                <div class="form-group">
                                    <input type="number" style="border: 1px solid black" name="godinaOsnivanja" class="form-control"
                                           placeholder="Godina osnivanja tima *" value=""/>
                                </div>
                                <div class="form-group">
                                    <input type="number" style="border: 1px solid black" name="brojTitula" class="form-control"
                                           placeholder="Broj titula *" value=""/>
                                </div>
                                <div class="form-group">
                                    <button id="btnDodaj" type="submit" class="btn btn-success btn-block"
                                            style="background-color: orange; border: 1px solid black;"><i
                                                class="glyphicon glyphicon-plus"></i> Dodaj tim
                                    </button>
                                </div>

                            </div>
                            

                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" style="color: white; background-color: orange; border: 1px solid white" data-dismiss="modal">Zatvori</button>
            </div>
        </div>

    </div>
</div>



<script src="js/main.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
 function pretrazi() {

var input, filter, table, tr, i, td1, td2, td3, td4, txtValue1, txtValue2, txtValue3, txtValue4;
input = document.getElementById("myInput");
filter = input.value.toUpperCase();
table = document.getElementById("tabela");
tr = table.getElementsByTagName("tr");

for (i = 0; i < tr.length; i++) {
    td1 = tr[i].getElementsByTagName("td")[1];
    td2 = tr[i].getElementsByTagName("td")[2];
    td3 = tr[i].getElementsByTagName("td")[3];
    td4 = tr[i].getElementsByTagName("td")[4];

    if (td1 || td2 || td3 || td4) {
        txtValue1 = td1.textContent || td1.innerText;
        txtValue2 = td2.textContent || td2.innerText;
        txtValue3 = td3.textContent || td3.innerText;
        txtValue4 = td4.textContent || td4.innerText;

        if (txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1
            || txtValue3.toUpperCase().indexOf(filter) > -1 || txtValue4.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
    }
}
}</script>
</body>
</html>    

