if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

function updateCart(value){
  $.ajax({
    type: "POST",
    url: "php/updatecart.php",
    data: {value:value,check:""},
    success:function(data){
      id=value.substring(0,value.length-1);
      div = document.getElementById('cartvalue_'+id);
      if(div!==null){
          div.innerHTML=data;
      }
    },
    async: false
  });
}

function update2Cart(value){
  id=value.substring(0,value.length-1);
  operation = value.substring(value.length-1);
  quant = document.getElementById('cartvalue_'+id).innerHTML.trim();
  if(operation==='-'){
    if(quant==='1'){
      document.getElementById('cartproductdiv_'+id).remove();
    }
    else{
      quantPrice = parseFloat(document.getElementById('pricevalue_'+id).innerHTML.trim().substring(2));
      price = quantPrice/parseFloat(quant);
      document.getElementById('pricevalue_'+id).innerHTML = "  &#8377; "+(quantPrice-price)+".00";
    }
  }
  else{
    quantPrice = parseFloat(document.getElementById('pricevalue_'+id).innerHTML.trim().substring(2));
    price = quantPrice/parseFloat(quant);
    document.getElementById('pricevalue_'+id).innerHTML = "  &#8377; "+(quantPrice+price)+".00";
  }

  updateCart(value);

  $.ajax({
    type: "POST",
    url: "php/updatetotal.php",
    data: {check:""},
    success: function(data)
    {
      arr=data.split("-");
      document.getElementById('carttotaldiv').innerHTML="  &#8377; "+arr[0];
      document.getElementById('cartquantdiv').innerHTML=arr[1];
    },
    async: false
  });


  cartdisplaydiv = document.getElementById('cartdisplaydiv');
  if(cartdisplaydiv.innerHTML.trim()===""){
    cartdisplaydiv.innerHTML = createNoCartDiv();
    document.getElementById('carttotaldiv').innerHTML="  &#8377; 0";
    document.getElementById('cartquantdiv').innerHTML="0";
  }
}

function createNoCartDiv(){
return '<div class="nocartdiv">'+
        '<span>Your cart is empty :( </span>'+
        '<span>You may go to Stop n Shop home page to explore more products ;)</span>'+
        '<button type="button" name="button" onclick="window.location.replace(\'home.php\')">Go to Home page</button>'+
       '</div>';
}

function pay(){
  amount = parseInt(document.getElementById('carttotaldiv').innerHTML.trim().substring(2))*100;
  if(amount===0) alert("Add items to cart before checking out.");
  else{
    // Razorpay code here ... update order history on success ... alert on failure
    var options = {
      "key": key,
      "amount": amount,
      "currency": "INR",
      "name": "Stop n Shop",
      "description": "Test Transaction",
      "image": "resources/icon.png",
      "handler": function (response){
        // success handler
      }
    }

    var rzp1 = new Razorpay(options);
    rzp1.on('payment.failed', function (response){
      alert("Payment Failed");
    });

    rzp1.open();
  }
}
