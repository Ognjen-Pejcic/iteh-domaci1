function prikazi() {
    var x = document.getElementById("pregled");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  } 


$('#btn-izbrisi').click( function(){
  const checked = $('input[type=radio]:checked');
  request = $.ajax({
    url:'handler/delete.php',
    type: 'post',
    data: {'timID': checked.val()}
  });
  request.done(function (response, textStatus, jqXHR) {
    if (response === 'Success') {
      checked.closest("tr").remove();
        console.log('Tim je obrisan ');
        alert('Tim je obrisan');
        //$('#izmeniForm').reset;
    }
    else {
      console.log('Tim nije obrisan ' + response);
      alert('Tim nije obrisan');
    }
});
});
  

  $('#btnDodaj').submit(function(){
    $('myModal').modal('toggle');
    return false;
  });


  $('#dodajForm').submit(function () {
    event.preventDefault();
    console.log("Ovde");
    const $form = $(this);
    const $inputs = $form.find('input, select, button');
    const serializedData = $form.serialize();
    console.log(serializedData);
    $inputs.prop('disabled', true);

    request = $.ajax({
        url: 'handler/add.php',
        type: 'post',
        data: serializedData
    });

    request.done(function (response, textStatus, jqXHR) {
        if (response === 'Success') {
            alert('Tim je dodat');
            console.log('EVO');
            location.reload(true);
        }
        else console.log('Tim nije dodat ' + response);
        console.log(response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('The following error occurred: ' + textStatus, errorThrown);
    });
});
  