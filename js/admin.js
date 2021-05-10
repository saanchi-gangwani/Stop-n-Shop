if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

function notEmptyValid(val,id){
  span_id=id+'_empty';
  if(val.trim()==='' || (id==='prod_price' && parseFloat(val.trim())<=0)){
    document.getElementById(span_id).style.display='inline';
  }
  else{
    document.getElementById(span_id).style.display='none';
  }
}
