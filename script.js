function loading(){

}
function removeProduct(evt){
  var product = evt.currentTarget.parentElement;
  product.style.display = "none";
}
function addProduct(){
  
}
function showProducts(){
  var product = document.getElementById('addToCart');
  product.style.display = "block";
}
function hideProducts(){

}
function storeProducts(){
  
}
function getAllProducts(){
  
}

function refresh(evt){
var product = evt.currentTarget.id.split('_')[1];
if (document.getElementById('hidden').value)
  document.getElementById('hidden').value += ("," + product);
else
  document.getElementById('hidden').value += product;
var text = document.getElementById('hidden').value;
var data = text.split(",");
var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log('data sent' + text);
      alert(this.responseText);
    }
  };
  
  xhttp.open("POST","index.php", true);
  xhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  //var tx = JSON.parse("data=" + data);
  xhttp.send("data=" + data);
 
}
function reloadCart(){
  
}