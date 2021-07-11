if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

function updateCart(value){
  $.ajax({
    type: "POST",
    url: "php/updatecart.php",
    data: {value:value},
    success:function(data){
      //console.log(data); // changes to the page to be done here!!!
      id=value.substring(0,value.length-1);
      console.log(id);
      document.getElementById('cartvalue_'+id).innerHTML=data;
    }
  });
}
