if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

function notEmptyValid(val,id){
  var span_id=id+'_empty';
  if(val.trim()==='' || (id==='prod_price' && parseFloat(val.trim())<=0) || (id==='prod_image' && document.getElementById(id).files.length===0)){
    document.getElementById(span_id).style.display='inline';
  }
  else{
    document.getElementById(span_id).style.display='none';
  }
}

function displayImgPrev(input) {
  notEmptyValid('1',input.id);
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#prod_upload_image').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    document.getElementById('prod_upload_image').style.display='inline';
  }
}

function closeError(){
  $('#errordiv').css({"display":"none"});
}
