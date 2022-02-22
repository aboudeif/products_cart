<html>
  <head>
    <title>PHP Test</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
  </head>
  <body>
  
  <?php 
  # defining constants
    const SHOP = 'Acme Electronics Store';
    const PRODUCT = array('TV','fridge','washing machine','vacuum cleaner');
    const PRICE = array(300,600,400,150);
    define ('PURCHEASES_DISCOUNT',0.10);
    define ('LOYALTY_CARD',0.05);
  // change HASLOYALITYCARD to false/true to add/remove LOYALTY CARD
    const HASLOYALITYCARD = true;

  while(isset($_POST)){
    $jsobj = json_encode($_POST);
    echo 'welcome!';
    $cart = array($_POST['data'][0]);
    //foreach($_POST['data'] as $itm)
      //array_push($cart,$itm);
    //echo $res;
    print_r($_POST['data']);
    echo "<br>";
    print_r($cart);
    bigFun($cart);
  }
  /*else{
  // change the array values to add/remove products
    $cart = array(1,2);
    bigFun($cart);
  }*/


  function bigFun($cart){
   
    function recipt($cart){
    if($cart){
      $result = 0;
      for($i = 0; $i < count($cart); $i++){
        $item = $cart[$i];
        $result += PRICE[$item];
      }
      return $result;
    }
    else
      return 0;
    }

    function calcDiscount($price)
    {
      $discount = 0.00;
      if(HASLOYALITYCARD)
        $discount += LOYALTY_CARD;
      if($price > 750)
        $discount += PURCHEASES_DISCOUNT;       
      $price -= ($price * $discount);
      return $price;
    }

    $orginalPrice = recipt($cart);
    $price = calcDiscount($orginalPrice);
    $discount = $orginalPrice - $price;

    function loadCart($cart){
    if($cart){
      $temp = "";
      $sign = "";
      foreach($cart as $item){
        $temp .= $sign . $item;
        $sign = ",";
      }
      return $temp;
    }
    else
      return "";
      }

    echo "<input type='hidden' id='hidden' value='".loadCart($cart)."'>";

    function setProducts($cart){
      $products = "";
      $i = 0;
      foreach(PRODUCT as $item)
        $products .= "<span class='product new' name='" . $item ."' id='_" . $i ."' onClick='refresh(event);'>" . $item ."<small class='price'> ".PRICE[$i++]."$ </small></span>";
        return $products;
    }

    function getProducts($cart){
    if($cart){
      $products = "";
      foreach($cart as $item)
        $products .= "<span class='product'>" . PRODUCT[$item] ."<small class='price'> ".PRICE[$item]."$ </small><small class='close' onClick='removeProduct(event);'> x</small></span>" ;
        return $products;
    }
    else
      return "";}

    function checkLoyalty(){
      $item = "";
      if(HASLOYALITYCARD)
        $item = "<span class='discount'>LOYALTY CARD</span>";
        return $item;
    }

    function checkDiscount($orginalPrice){
      $item = "";
      if($orginalPrice > 750)
        $item = "<span class='discount'>PURCHEASES DISCOUNT</span>";
        return $item;
    }

    
    echo "
    <p id='addToCart'><span>".setProducts($cart)."</span><small class='close window' onClick='removeProduct(event);'>x</small></p>
    <p>Cart: <span id='cart'>".getProducts($cart)."<span class='add new' onClick='showProducts();'>+</span></span></p>
    <p>Total price: <span class='totalPrice'>".$orginalPrice."<small>$</small></span></p>
    <p>Discount: <span class='discountAmount'>".$discount."<small>$</small> ".checkLoyalty()." ".checkDiscount($orginalPrice)."</span></p>
    <p>Price after discount: <span class='ADPrice'>".$price."<small>$</small></span></p>
    ";
  } 
  
  ?> 
  
  </body>
</html>
