if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

function updateCart(value){
  $.ajax({
    type: "POST",
    url: "php/updatecart.php",
    data: {value:value},
    success:function(data){
      id=value.substring(0,value.length-1);
      document.getElementById('cartvalue_'+id).innerHTML=data;
    }
  });
}

function update2Cart(value){
  updateCart(value);
  // rest of the function
  id=value.substring(0,value.length-1);
  var quant = document.getElementById('cartvalue_'+id).innerHTML.trim();
  console.log(quant); // check why data not updating
  if(quant===0){
    var temp = document.getElementById('cartproductdiv_'+id);
    temp.remove();
  }
}
