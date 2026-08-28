<?php
    include"Element/navbar.php";
    if (isset($_SESSION['msg']) ) {
        echo "<script>alert('".$_SESSION['msg']."')</script>";
        unset($_SESSION['msg']);
    }
    if(isset($_POST) || isset($_SESSION['order'])){
        if(isset($_SESSION['order'])){
            $order=$_SESSION['order'];
        }else if(isset($_POST)){
            $order=$_POST['od_id'];
        }
        $cus=$_SESSION['Name'];
        $sql= mysqli_query($conn,"SELECT Od_payment from orders where od_id = {$order}"); 
        $Amount= mysqli_fetch_assoc($sql);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body >
    <main class="revew">
    <div class="payment-form">
        <h2>Payment Details</h2>
        <form id="paymentForm" action="cus_backend/payRegister.php" method="POST">
            <label for="customerName">Customer Name</label>
            <input type="text" id="customerName" name="customerName" value="<?php echo $_SESSION['Name'] ?>" readonly>

            <label for="orderId">Order ID</label>
            <input type="text" id="orderId" name="orderId" value="<?php echo $order ?>" readonly>

            <label for="paymentMethod">Payment Method</label>
            <select id="paymentMethod" name="paymentMethod" required>
                <option value="easypaisa">Easypaisa</option>
                <option value="jazzcash">JazzCash</option>
            </select>

            <label for="accountNumber">Account Number</label>
            <input type="tel" pattern='[0-9]{4}-[0-9]{7}' id="accountNumber" name="accountNumber" placeholder="03XX-XXXXXXX" required>

            <label for="amount">Amount</label>
            <input type="text" id="amount" name="amount" value="<?php echo $Amount['Od_payment'] ?>" placeholder="0000" readonly>

            <button type="submit">Pay Now</button>
        </form>
    </div>
</main>
<?php
}
?>
</body>
</html>
