if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

function updateCart(value){
  $.ajax({
    type: "POST",
    url: "php/updatecart.php",
    data: {value:value},
    success:function(data){
      console.log(data); // changes to the page to be done here!!!
    }
  });
}
