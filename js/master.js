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
      div = document.getElementById('cartvalue_'+id);
      if(div!==null){
          div.innerHTML=data;
      }
    }
  });
}

function update2Cart(value){
  id=value.substring(0,value.length-1);
  operation = value.substring(value.length-1);
  quant = document.getElementById('cartvalue_'+id).innerHTML.trim();
  if(quant==='1' && operation==='-'){
    document.getElementById('cartproductdiv_'+id).remove();
  }

  updateCart(value);

  // enter price ajax function here

  cartdisplaydiv = document.getElementById('cartdisplaydiv');
  if(cartdisplaydiv.innerHTML.trim()===""){
    cartdisplaydiv.innerHTML = createNoCartDiv();
  }
}

function createNoCartDiv(){
return '<div class="nocartdiv">'+
        '<span>Your cart is empty :( </span>'+
        '<span>You may go to Stop n Shop home page to explore more products ;)</span>'+
        '<button type="button" name="button" onclick="window.location.replace(\'home.php\')">Home page</button>'+
       '</div>';
}
