<?php
session_start();
include("includes/db.php");
include("functions/functions.php");
if (isset($_GET['c_id'])) {
    $customer_id = $_GET['c_id'];
}

$ip_add = getUserIp();
$status = "En Attente";
$invoice_no = mt_rand();
$select_cart = "select * from cart where ip_add='$ip_add'";
$run_cart = mysqli_query($con, $select_cart);

$products = [];

while ($row_cart = mysqli_fetch_array($run_cart)) {
    $pro_id = $row_cart['p_id'];
    $size = $row_cart['size'];
    $qty = $row_cart['qty'];
    $get_product = "select * from products where product_id='$pro_id'";
    $run_pro = mysqli_query($con, $get_product);

    while ($row_pro = mysqli_fetch_array($run_pro)) {
        $product_name = $row_pro['product_title'];
        $product_price = $row_pro['product_price'];
        $sub_total = $product_price * $qty;
        $products[] = [
            'id' => $pro_id,
            'name' => $product_name,
            'price' => $product_price,
            'qty' => $qty,
            'size' => $size,
            'sub_total' => $sub_total
        ];
        $sub_total=$row_pro['product_price'] * $qty;
        $insert_customer_order="insert into customer_order (product_id, due_amount, invoice_no, qty, size, order_date, order_status) values ('$customer_id','$pro_id','$sub_total','$invoice_no','$qty','$size',NOW(),'$status')";
        $run_cust_order=mysqli_query($con, $insert_customer_order);
        
 
        $insert_pending_order="insert into pending_order (customer_id,invoice_no,product_id,qty,size,order_status) values ('$customer_id','$invoice_no','$pro_id','$qty','$size','$status')";
        $run_pending_order=mysqli_query($con, $insert_pending_order);
    
        
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paiement Mobile Money</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        #payment-form {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        #payment-form h2 {
            margin-bottom: 20px;
            color: #333;
        }
        #payment-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        #payment-form input[type="text"],
        #payment-form input[type="email"],
        #payment-form input[type="tel"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        #payment-form button {
            background: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        #payment-form button:hover {
            background: #218838;
        }
        #payment-status {
            margin-top: 20px;
            color: #555;
        }
    </style>
    <script>
        function processPayment() {
            document.getElementById('payment-status').innerText = "Paiement en cours...";
            setTimeout(function() {
                document.getElementById('payment-status').innerText = "Paiement effectué";
                document.getElementById('payment-form').submit();
            }, 3000);
        }
    </script>
</head>
<body>

<form id="payment-form" action="process_order.php" method="post">
    <h2>Paiement Mobile Money</h2>
    <label for="amount">Montant à payer :</label>
    <input type="text" id="amount" name="amount" value="<?php echo array_sum(array_column($products, 'sub_total')); ?>" readonly>
    <label for="email">Adresse e-mail :</label>
    <input type="email" id="email" name="email" required>
    <label for="phone">Numéro de téléphone :</label>
    <input type="tel" id="phone" name="phone" required>
    <button type="button" onclick="processPayment()">Payer</button>
    <p id="payment-status"></p>
</form>

</body>
</html>
