f<?php
    include"Element/navbar.php";
    if(isset($_POST)){
        $item =$_POST['Quantity'];
        $amount =$_POST['Amount'];
    
?>
<body>
    <div class="container">
        <div class="shopping-cart">
            <h2>Shopping Cart</h2>
            <div class="cart-items">
        <?php
            $query="SELECT c.pro_id, product_quantity, Name, Pro_price, Description, pro_picture from cart_product as c join product as p ON c.pro_id = p.product_id WHERE cart_id ='".$_SESSION['cart']."'";
            $run_query = mysqli_query($conn, $query);
            while ($product = mysqli_fetch_assoc($run_query)){
                echo" <div class='cart-item'>
                    <img src='images/{$product['pro_picture']}' alt='{$product['Name']}'>
                    <div class='item-details'>
                        <h5>{$product['Name']}</h5>
                        <div class='item-actions'>
                            <span class='quantity'>Quantity: {$product['product_quantity']}</span>
                        </div>
                        <p class='price'>{$product['Pro_price']}</p>
                    </div>
                        <button class='remove' onclick='showAlert()'>Edit</button>
                </div>";
            }
        }
        ?>
       </div>
            <a href="index.php" class="back-to-shop">← Back to shop</a>
        </div>
        <div class="summary">
            <h2>Summary</h2>
            <p>ITEMS <span class="items-count"><?php echo $item ?></span></p>
            <form action='cus_backend/addOrder.php' method='POST'>
            <p>SHIPPING 
                <select name="pStatus">
                    <option >Cash on Delivery</option>
                    <option >Online_payment</option>
                </select>
            </p>
            <p>TOTAL PRICE <span class="total-price"><?php echo $amount ?></span></p>
            
            <input type="text" name="pay" value='<?php echo $amount ?>' hidden>
            <button class="checkout">PLACE ORDER</button>
            </form>
        </div>
    </div>

<script>
function showAlert() {
    alert("To Edit Product please go back to your cart!");
}
</script>
    
</body>
</html>
