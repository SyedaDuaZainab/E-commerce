<?php 
    include"Element/navbar.php";
    
echo"<body>";
if(isset($_GET['id'])){
      $id = $_GET['id'];
$mysql = "SELECT * FROM product where cat_id=$id ";
if (mysqli_ping($conn)) {
    $newresult = mysqli_query($conn, $mysql);
} else {
    echo "Error: Connection is closed";
}
$cat = "SELECT Name FROM category where cat_id=$id";
  $newcat = mysqli_query($conn, $cat);
  if ($newcat) {
    $ctegory = mysqli_fetch_assoc($newcat);
    if ($ctegory) {
        echo "<div class='head'>
            <h1>{$ctegory['Name']}</h1>
        </div>
        <div class='cntain'>";
    } else {
        echo "No category found with ID $id";
    }
} else {
    echo "Error executing query: " . mysqli_error($conn);
}
  if (mysqli_num_rows($newresult) > 0) {
    while ($row = mysqli_fetch_assoc($newresult)) {
        echo "<div class='card' style='width:300px; text-align:center; margin:0 10px; border-radius:10px; overflow:hidden;'>
            <img src='admin_panel/image/{$row['pro_picture']}' class='card-img-top' alt='{$row['Name']}' style='min-height: 300px; width:100%;'>
            <div class='card-body'>
                <h5 class='card-title'>{$row['Name']}</h5>
                <p class='card-text'>{$row['Pro_price']}</p>

                <form action='cus_backend/addtoCart.php' method='POST'>
                <input type='text' value={$row['product_id']} hidden name='pro_id'>
                <button type='submit'>Add to cart</button>
                <button type='button'  onclick=showDetail({$row['product_id']})> View </button>
                </form>

            </div>
        </div>     
   
    <div class='product-detail' id='product-detail-{$row['product_id']}'>
        <div class='product-image'>
            <img src='admin_panel/image/{$row['pro_picture']}' alt='{$row['Name']}'>
        </div>
        <div class='product-info'>
            <i onclick=hideDetail({$row['product_id']}) class='closeLog bx bxs-x-circle'></i>
            <h1>{$row['Name']}</h1>
            <p class='categry'>{$ctegory['Name']}</p>
            <p class='price'><span class='current-price'>{$row['Pro_price']}</span></p>
            <p class='description'>
                {$row['Description']}
            </p>
            <p>
                <em>Note: All products are prepared on made to order process for which it cannot be exchanged or returned. Please choose your size and colors accordingly.</em>
            </p>
            
            <div class='product-options'>
                <div class='size-option'>
                    <label for='size'>Size</label>
                    <select id='size'>
                        <option>Large</option>
                        <option>Medium</option>
                        <option>Small</option>
                    </select>
                </div>
            </div>
            
           
            <div class='add-to-cart add'>
                <form action='cus_backend/addtoCart.php' method='POST'>
                <input type='text' value={$row['product_id']} name='pro_id' hidden>
                <button type='submit'>Add To Cart</button>
                </form>
            </div>
            
        </div>
    </div>";
    }
  } else {
    echo "<p>No Product found</p>";
  }
  echo"</div>";
}
  include"../Front-end/Element/footer.html";
  if (isset($_SESSION['msg'])) {
    echo "<script>alert('".$_SESSION['msg']."');</script>";
    unset($_SESSION['msg']);
}
?>
   <script>
        document.addEventListener('DOMContentLoaded', () => {
            const addToCartButton = document.querySelector('.add-to-cart button');
            addToCartButton.addEventListener('click', () => {
            alert('Item added to cart!');
            });
        });
        function showDetail(productId) {
            const productDetail = document.getElementById(`product-detail-${productId}`);
            productDetail.style.display = 'flex';
        }

        function hideDetail(productId) {
            const productDetail = document.getElementById(`product-detail-${productId}`);
            productDetail.style.display = 'none';
        }
</script>

</body>
</html>
 