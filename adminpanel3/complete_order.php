<?php
// Start session and check admin login
session_start();
if(isset($_SESSION['admin_username'])==null){
    echo "<script>location.assign('login.php')</script>";
}

include('connection.php');
require 'PHPMailer.php';
require 'Exception.php';
require 'SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['update_tracking'])) {
    $order_id = mysqli_real_escape_string($con, $_POST['order_id']);
    $order_status = mysqli_real_escape_string($con, $_POST['order_status']);
    $tracking_number = mysqli_real_escape_string($con, $_POST['tracking_number']);

    $update_query = "UPDATE completed_orders SET order_status = '$order_status', tracking_number = '$tracking_number' WHERE id = '$order_id'";
    mysqli_query($con, $update_query);

    // Fetch user data
    $order_query = mysqli_query($con, "SELECT * FROM completed_orders WHERE id = '$order_id'");
    if (mysqli_num_rows($order_query) > 0) {
        $order = mysqli_fetch_assoc($order_query);

        $to = $order['email'];
        $subject = "Your Order has been Updated - Tracking Info Included";
        $message = "<h3>Hi " . $order['uname'] . ",</h3>";
        $message .= "<p>Your order placed on <strong>Zufe.com</strong> has been updated. The current status is: <strong>" . $order_status . "</strong>.</p>";
        $message .= "<p><strong>Tracking Number:</strong> " . $tracking_number . "</p>";
        $message .= "<p>You can <a href='https://yourdomain.com/track_order.php'>track your order</a> using your tracking number.</p>";
        $message .= "<p>Thank you for shopping with us!</p>";

        // Send email via SMTP
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'jawadulbahar@gmail.com'; // Your Gmail
            $mail->Password   = 'delwgxougwyvdpzi'; // App password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('jawadulbahar@gmail.com', 'ZUFÉ');
            $mail->addAddress($to, $order['uname']);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
        } catch (Exception $e) {
            error_log("Email could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    }

    echo "<script>location.href = location.href;</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Completed Orders - Admin Panel</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
</head>

<body>
<div id="wrapper">

    <?php include("aside.php"); ?>

    <div style="margin-top: 100px; margin-left: 125px;" class="container mb-5">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="h3 mb-0 text-gray-800 text-center">
                    <i class="fas fa-check-circle mr-2 text-success"></i>Completed Orders
                </h2>
                <p class="text-muted text-center mt-2">View and manage all completed orders</p>
            </div>
        </div>

        <!-- Completed Orders Table -->
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">
                    <i class="fas fa-list mr-2"></i>Completed Orders List
                </h6>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                    <table id="completedOrdersTable" class="table table-bordered table-striped table-hover">
                    <thead style="background-color: #28a745;" class="text-white">
                        <tr>
                                <th><i class="fas fa-image mr-2"></i>Image</th>
                                <th><i class="fas fa-hashtag mr-2"></i>Prod_ID</th>
                                <th><i class="fas fa-box mr-2"></i>Prod_Name</th>
                                <th><i class="fas fa-cubes mr-2"></i>Qty</th>
                                <th><i class="fas fa-dollar-sign mr-2"></i>Price</th>
                                <th><i class="fas fa-palette mr-2"></i>Color</th>
                                <th><i class="fas fa-ruler mr-2"></i>Size</th>
                                <th><i class="fas fa-tshirt mr-2"></i>Shirt Type</th>
                                <th><i class="fas fa-user mr-2"></i>Customer</th>
                                <th><i class="fas fa-envelope mr-2"></i>Email</th>
                                <th><i class="fas fa-phone mr-2"></i>Work Phone</th>
                                <th><i class="fas fa-home mr-2"></i>Home Phone</th>
                                <th><i class="fas fa-map-marker-alt mr-2"></i>Area</th>
                                <th><i class="fas fa-address-card mr-2"></i>Address</th>
                                <th><i class="fas fa-city mr-2"></i>City</th>
                                <th><i class="fas fa-flag mr-2"></i>Country</th>
                                <th><i class="fas fa-map-pin mr-2"></i>Postal Code</th>
                                <th><i class="fas fa-shipping-fast mr-2"></i>Shipping</th>
                                <th><i class="fas fa-percent mr-2"></i>Tax</th>
                                <th><i class="fas fa-dollar-sign mr-2"></i>Total</th>
                                <th><i class="fas fa-calculator mr-2"></i>Subtotal</th>
                                <th><i class="fas fa-truck mr-2"></i>Tracking #</th>
                                <th><i class="fas fa-sync-alt mr-2"></i>Status</th>
                                <th><i class="fas fa-calendar-alt mr-2"></i>Completed At</th>
                                <th><i class="fas fa-tools mr-2"></i>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $completedQ = mysqli_query($con, "
                            SELECT c.*, p.name AS product_name
                            FROM completed_orders c
                            JOIN products p ON c.product_id = p.id
                            ORDER BY c.tracking_number, c.completed_at DESC
                        ");
                        $completedGrouped = [];
                        while ($row = mysqli_fetch_assoc($completedQ)) {
                            $tracking = $row['tracking_number'];
                            if (!isset($completedGrouped[$tracking])) {
                                $completedGrouped[$tracking] = [];
                            }
                            $completedGrouped[$tracking][] = $row;
                        }

                            $first = true;

                            foreach ($completedGrouped as $tracking => $orders) {
                            $first = $orders[0]; // shared info
                            $productHTML = $imageHTML = $qtyHTML = $priceHTML = $colorHTML = $sizeHTML = $typeHTML = $taxHTML = $totalHTML = '';

                            foreach ($orders as $order) {
                                $productHTML .= "<div><strong>{$order['proname']}</strong></div>";
                                $imageHTML .= "<img src='../adminpanel3/img/".htmlspecialchars($order['product_img'])."' width='60' height='70' class='rounded mr-1 mb-1'><br>";
                                $qtyHTML .= "<div>{$order['proqty']}</div>";
                                $priceHTML .= "<div>{$order['proprice']} PKR</div>";
                                $colorHTML .= "<div>{$order['selected_color']}</div>";
                                $sizeHTML .= "<div>{$order['selected_size']}</div>";
                                $typeHTML .= "<div>{$order['shirt_type']}</div>";
                                $taxHTML .= "<div>{$order['item_tax']} PKR</div>";
                                $totalHTML .= "<div>{$order['total_amount']} PKR</div>";
                            }

                            // Subtotal calculation
                            $subtotal = 0;
                            foreach ($orders as $o) {
                                $subtotal += $o['total_amount'];
                            }
                        ?>
                            <tr>
                                <td><?= $imageHTML; ?></td>
                                <td><?= implode('<hr>', array_column($orders, 'product_id')); ?></td>
                                <td><?= $productHTML; ?></td>
                                <td><?= $qtyHTML; ?></td>
                                <td><?= $priceHTML; ?></td>
                                <td><?= $colorHTML; ?></td>
                                <td><?= $sizeHTML; ?></td>
                                <td><?= $typeHTML; ?></td>

                                <td><?= $first['uname']; ?></td>
                                <td><?= $first['email']; ?></td>
                                <td><?= $first['work_phone']; ?></td>
                                <td><?= $first['home_phone'] ?? '-'; ?></td>
                                <td><?= $first['delivery_area'] ?? '-'; ?></td>
                                <td><small><?= $first['address']; ?></small></td>
                                <td><?= $first['city'] ?? '-'; ?></td>
                                <td><?= $first['country'] ?? '-'; ?></td>
                                <td><?= $first['postal_code'] ?? '-'; ?></td>
                                <td><?= $first['shipping_charges'] ?? '0'; ?> PKR</td>
                                <td><?= $taxHTML; ?></td>
                                <td><?= $totalHTML; ?></td>
                                <td><strong><?= number_format($subtotal); ?> PKR</strong></td>
                                <td><span class="badge badge-success"><?= $tracking; ?></span></td>
                                <td><?= $first['order_status']; ?></td>
                                <td><?= date('d M Y, h:i A', strtotime($first['completed_at'])); ?></td>
                                <td>
                                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#statusModal<?= $first['id']; ?>">
                                            <i class="fas fa-edit mr-1"></i>Update
                                        </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="statusModal<?= $first['id']; ?>" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <form method="post">
                                                <input type="hidden" name="order_id" value="<?= $first['id']; ?>">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Update Order</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Order Status:</label>
                                                            <select class="form-control" name="order_status" required>
                                                                <option value="Processing" <?= $first['order_status'] == 'Processing' ? 'selected' : '' ?>>Processing</option>
                                                                <option value="Shipped" <?= $first['order_status'] == 'Shipped' ? 'selected' : '' ?>>Shipped</option>
                                                                <option value="Out for Delivery" <?= $first['order_status'] == 'Out for Delivery' ? 'selected' : '' ?>>Out for Delivery</option>
                                                                <option value="Delivered" <?= $first['order_status'] == 'Delivered' ? 'selected' : '' ?>>Delivered</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tracking Number:</label>
                                                            <input type="text" name="tracking_number" class="form-control" value="<?= $tracking; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                            <button type="submit" name="update_tracking" class="btn btn-success">
                                                                <i class="fas fa-save mr-1"></i>Save
                                                            </button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                <i class="fas fa-times mr-1"></i>Cancel
                                                            </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                            <?php
                                $first = false;
                            ?>
                        </tbody>
                </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include("footer.php"); ?>

</div>

<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#completedOrdersTable').DataTable({
            pageLength: 10,
            ordering: true,
            responsive: true
        });
    });
</script>

</body>
</html>