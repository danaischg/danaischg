<link rel="stylesheet" href="css/payment.css">

<div class="row ">
    <?php
    if (isset($_POST['btnCheckout']) && $_POST['btnCheckout'] == 'Checkout' || isset($_POST['btnPayment'])) :
        $c = new Connect();
        $dblink = $c->connectToPDO();

        $sql_cart = "SELECT * FROM `cart` c JOIN `user` u ON c.username = u.username
        JOIN `product` p ON c.pid = p.id WHERE c.username = ?";

        $user = $_SESSION['username'];
        $stmt = $dblink->prepare($sql_cart);
        $stmt->execute(array("$user"));

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $total = 0;
    ?>
        <div class="col-md-7">
            <div class="right border">
                <div class="header-payment fw-bold">Order Summary</div>
                <p><?= $stmt->rowCount() ?> items</p>
                <?php
                foreach ($row as $r) :
                ?>
                    <hr>
                    <div class="row item d-flex align-items-center">
                        <div class="col-4 align-self-center"><img class="img-fluid" src="images/<?= $r['image'] ?>"></div>
                        <div class="col-8">
                            <div class="pb-2"><b>$ <?= $r['price'] ?></b></div>
                            <div class=" text-muted"><?= $r['name'] ?></div>
                            <div class="">Quantity: <?= $r['pcount'] ?></div>
                        </div>
                    </div>
                <?php
                    $total += $r['price'] * $r['pcount'];
                endforeach;
                ?>
                <div class="pt-5">
                    <h6 class="mb-1"><a href="?page=shoppingcart" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Back</a></h6>
                </div>
            </div>
        </div>
        <form name="formAddSupplier" method="POST" class="col-md-5 p-0">
            <div class="left border">
                <div class="row">
                    <span class="header-payment fw-bold text-dark">Payment</span>
                </div>
                <span>Name:</span>
                <input type="text" name="name" value="<?= $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] ?>">
                <span>Phone number:</span>
                <input type="text" name="phone" value="<?= $_SESSION['telephone'] ?>">
                <span>Address:</span>
                <input type="text" name="address" value="<?= $_SESSION['address'] ?>">
            </div>
            <hr>
            <div class="row lower">
                <div class="col text-left">Subtotal</div>
                <div class="col text-right">$<?= $total ?></div>
            </div>
            <div class="row lower">
                <div class="col text-left">Delivery Standar</div>
                <div class="col text-right">$5.00</div>
            </div>
            <div class="row lower">
                <div class="col text-left"><b>Total to pay</b></div>
                <div class="col text-right"><b>$<?= $total + 5 ?></b></div>
                <input type="hidden" name="total" value="<?= $total + 5 ?>">
            </div>
            <div class="mt-3">
                <button class="btn-payment" name="btnPayment">Payment</button></button>
            </div>
        </form>
</div>
<?php
        if (isset($_POST['btnPayment'])) :
            $name = $_POST['name'];
            $telephone = $_POST['phone'];
            $address = $_POST['address'];
            $total = $_POST['total'];
            // Neu session thieu di mot thu se khong hoat dong duoc
            $user = $_SESSION['username'];
            $now = date("Y-m-d H:i:s");

            // Insert into Order
            $sql_order = "INSERT INTO `order`(`date`, `delivery_date`, `delivery_local`, `cust_name`, `cust_phone`, `total`, `status`, `username`) VALUES ( ?, ?, ?, ?, ?, ?, 0, ?)";
            $result = $dblink->prepare($sql_order);
            $check = $result->execute(array("$now", "$now", "$address", "$name", "$telephone", "$total", "$user"));

            $last_id = $dblink->lastInsertId();

            // Select cart to add into orderdetail
            $sql_selected = "SELECT cart_id, username, pcount, pid FROM `cart` WHERE username = ?";
            $result = $dblink->prepare($sql_selected);
            $check = $result->execute(array("$user"));

            $row = $result->fetchAll(PDO::FETCH_ASSOC);

            foreach ($row as $r) :
                $order_id = $r['order_id'];
                $pro_id = $r['pid'];
                $od_qty = $r['pcount'];

                // Insert into OrderDetail
                $sql_order = "INSERT INTO `orderdetail`(`order_id`, `pro_id`, `quantity`) VALUES (?, ?, ?)";
                $result = $dblink->prepare($sql_order);
                $check = $result->execute(array("$last_id", "$pro_id", "$od_qty"));

                // Update into Product
                $sql_order = "SELECT quantity FROM `product` WHERE `id`= ?";
                $result = $dblink->prepare($sql_order);
                $result->execute(array("$pro_id"));
                $row = $result->fetch(PDO::FETCH_ASSOC);
                $update_quantity = $row['quantity'] - $od_qty;

                $sql_order = "UPDATE `product` SET `quantity`= ? WHERE `id`= ?";
                $result = $dblink->prepare($sql_order);
                $check = $result->execute(array("$update_quantity", "$pro_id"));

            endforeach;

            // Delete into ShoppingCart
            $sql_order = "DELETE FROM `cart` WHERE username = ?";
            $result = $dblink->prepare($sql_order);
            $check = $result->execute(array("$user"));

            header("Location: ?page=successful");
        endif;
    else :
        header("Location: ?page=shoppingcart");
    endif;
?>