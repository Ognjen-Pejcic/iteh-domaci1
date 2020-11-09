function prikazi() {
    var x = document.getElementById("pregled");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  } 

/*  function obrisi(){
    const checked = $('input[name=checked-donut]:checked');//skontaj ovo
    request = $.ajax({
        url:'handler/delete.php',
        type: 'post',
        data: {'id': checked.val()}
      });
     
    request.done(function(response, textStatus, jqXHR){
      if(response==='Success'){
        checked.closest('tr').remove();
        alert('Tim je obrisan');
        console.log('Obrisana');
      }else{
        console.log('Nije obrisan');
        alert('Tim nije obrisan');
      }
      console.log(response);
    });
    request.fail(function(jqXHR, textStatus, errorThrown){
      console.error('Error occured:' + textStatus, errorThrown);
    });     
}*/

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
  
  
  