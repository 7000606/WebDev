<?php include "template.php" ?>
<title>Order Form</title>
<body>

<div class="container-fluid">
    <h1 class="text-primary">Order Form</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="mb-3">
            <div class="row">
                <!--Customer Details-->

                <div class="col-md-6">
                    <h2>Customer Details</h2>
                    <p>Please enter your details:</p>
                    <label for="customerNameFirst" class="form-label">First Name</label>
                    <input class="form-control" id="customerNameFirst" name="customerNameFirst"
                           placeholder="...">
                    <label for="customerNameSecond" class="form-label">Second Name</label>
                    <input class="form-control" id="customerNameSecond" name="customerNameSecond"
                           placeholder="...">
                    <label for="customerAddress" class="form-label">Address</label>
                    <input class="form-control" id="customerAddress" name="customerAddress"
                           placeholder="...">
                    <label for="customerPhone" class="form-label">Phone Number</label>
                    <input class="form-control" id="customerPhone" name="customerPhone"
                           placeholder="...">
                    <label for="customerEmail" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="customerEmail" name="customerEmail"
                           placeholder="name@email.com">

                </div>
                <div class="col-md-6">
                    <h2>Products</h2>
                    <!--Product List-->
                    <p>Please enter the quantities of each product:</p>
                    <label for="orderProduct1" class="form-label">Product 1</label>
                    <input type="number" class="form-control" id="orderProduct1" name="orderProduct1"
                           value="0">
                    <label for="orderProduct2" class="form-label">Product 3</label>
                    <input type="number" class="form-control" id="orderProduct2" name="orderProduct2"
                           value="0">
                    <label for="orderProduct3" class="form-label">Product 3</label>
                    <input type="number" class="form-control" id="orderProduct3" name="orderProduct3"
                           value="0">
                    <label for="orderProduct4" class="form-label">Product 4</label>
                    <input type="number" class="form-control" id="orderProduct4" name="orderProduct4"
                           value="0">
                    <label for="orderProduct5" class="form-label">Product 5</label>
                    <input type="number" class="form-control" id="orderProduct5" name="orderProduct5"
                           value="0">

                </div>
            </div>
        </div>
        <input type="submit" name="formSubmit" value="Submit">
    </form>
<title>Order Form</title>
<?php include "template.php";
/**  @var $conn */
?>
<link rel="stylesheet" href="css/orderForm.css">

<h1 class="text-primary">Order Form</h1>

<?php
$status = "";
if (isset($_POST['Code']) && $_POST['Code'] != "") {
    $code = $_POST['Code'];
    $row = $conn->querySingle("SELECT * FROM products WHERE code='$code'", true);
    $name = $row['ProductName'];
    $price = $row['Price'];
    $image = $row['Image'];
    $id = $row['ProductID'];

    $cartArray = array(
        $code => array(
            'id' => $id,
            'productName' => $name,
            'code' => $code,
            'price' => $price,
            'quantity' => 1,
            'image' => $image)
    );

    // Debug Purposes
    // echo '<pre>'; print_r($cartArray); echo '</pre>';

    if (empty($_SESSION["ShoppingCart"])) {
        $_SESSION["ShoppingCart"] = $cartArray;
        $status = "<div class='box'>Product is added to your cart!</div>";
    } else {
        $array_keys = array_keys($_SESSION["ShoppingCart"]);
        if (in_array($code, $array_keys)) {
            $status = "<div class='box' style='color:red;'>Product is already added to your cart!</div>";
        } else {
            $_SESSION["ShoppingCart"] = array_merge(
                $_SESSION["ShoppingCart"], $cartArray
            );
            $status = "<div class='box'>Product is added to your cart!</div>";
        }
    }
}
?>

<div class="message_box" style="margin:10px 0px;">
    <?php echo $status; ?>
</div>

<?php

if (!empty($_SESSION["ShoppingCart"])) {
    $cart_count = count(array_keys($_SESSION["ShoppingCart"]));
    ?>
    <div class="cart_div">
        <a href="cart.php"><img src="images/cart-icon.png"/> Cart<span>
<?php echo $cart_count; ?></span></a>
    </div>
    <?php
}

$result = $conn->query("SELECT * FROM Products");
while ($row = $result->fetchArray()) {
    echo "<div class='product_wrapper'>
    <form method ='post' action =''>
    <input type='hidden' name='Code' value=" . $row['Code'] . " />
    <div class='image'><img src='images/productImages/" . $row['Image'] . "' width='100' height='100'/></div>
    <div class='name'>" . $row['ProductName'] . "</div>
    <div class='price'>$" . $row['Price'] . "</div>
    <button type='submit' class='buy'>Add to Cart</button>
    </form>
    </div>";
}

?>