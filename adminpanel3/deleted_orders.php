<?php
// Start session and check admin login
session_start();
if(isset($_SESSION['admin_username'])==null){
    echo "<script>location.assign('login.php')</script>";
}

include('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Deleted Orders - Admin Panel</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
</head>

<body id="page-top">
<div id="wrapper">

    <?php include("aside.php"); ?>

    <div style="margin-top: 100px; margin-left: 125px" class="container mb-5">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="h3 mb-0 text-gray-800 text-center">
                    <i class="fas fa-trash mr-2 text-danger"></i>Deleted Orders
                </h2>
                <p class="text-muted text-center mt-2">View and manage all cancelled and deleted orders</p>
            </div>
        </div>

        <!-- Deleted Orders Table -->
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-danger">
                    <i class="fas fa-list mr-2"></i>Deleted Orders List
                </h6>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                    <table id="deletedOrdersTable" class="table table-bordered table-striped table-hover">
                    <thead style="background-color: #dc3545;" class="text-white">
                    <tr>
                            <th><i class="fas fa-box mr-2"></i>Product</th>
                            <th><i class="fas fa-image mr-2"></i>Image</th>
                            <th><i class="fas fa-cubes mr-2"></i>Qty</th>
                            <th><i class="fas fa-dollar-sign mr-2"></i>Price</th>
                            <th><i class="fas fa-palette mr-2"></i>Color</th>
                            <th><i class="fas fa-ruler mr-2"></i>Size</th>
                            <th><i class="fas fa-tshirt mr-2"></i>Shirt Type</th>
                            <th><i class="fas fa-user mr-2"></i>Customer</th>
                            <th><i class="fas fa-envelope mr-2"></i>Email</th>
                            <th><i class="fas fa-phone mr-2"></i>Work Phone</th>
                            <th><i class="fas fa-home mr-2"></i>Home Phone</th>
                            <th><i class="fas fa-map-marker mr-2"></i>Area</th>
                            <th><i class="fas fa-map mr-2"></i>Address</th>
                            <th><i class="fas fa-city mr-2"></i>City</th>
                            <th><i class="fas fa-flag mr-2"></i>Country</th>
                            <th><i class="fas fa-mailbox mr-2"></i>Postal Code</th>
                            <th><i class="fas fa-shipping-fast mr-2"></i>Shipping</th>
                            <th><i class="fas fa-percentage mr-2"></i>Tax</th>
                            <th><i class="fas fa-calculator mr-2"></i>Total</th>
                            <th><i class="fas fa-barcode mr-2"></i>Tracking #</th>
                            <th><i class="fas fa-comment mr-2"></i>Cancel Reason</th>
                            <th><i class="fas fa-exclamation-triangle mr-2"></i>Status</th>
                            <th><i class="fas fa-clock mr-2"></i>Order At</th>
                            <th><i class="fas fa-calendar-times mr-2"></i>Deleted At</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $q = mysqli_query($con, "
                        SELECT b.*, p.name AS product_name 
                        FROM all_orders_backup b
                        LEFT JOIN products p ON b.product_id = p.id
                        ORDER BY b.deleted_at DESC
                    ");

                    while ($data = mysqli_fetch_array($q)) {
                    ?>
                    <tr>
                            <td><strong class="text-primary"><?= $data['product_name'] ?? 'N/A'; ?></strong></td>
                            <td><img src="../adminpanel3/img/<?= htmlspecialchars($data['product_img']); ?>" width="60" height="70" class="rounded img-thumbnail"></td>
                            <td><span class="badge badge-info"><?= $data['proqty']; ?></span></td>
                            <td><span class="text-success font-weight-bold"><?= $data['proprice']; ?> PKR</span></td>
                        <td><?= $data['selected_color'] ?? '-'; ?></td>
                        <td><?= $data['selected_size'] ?? '-'; ?></td>
                        <td><?= $data['shirt_type'] ?? '-'; ?></td>
                            <td><strong class="text-primary"><?= $data['uname']; ?></strong></td>
                        <td><?= $data['email']; ?></td>
                        <td><?= $data['work_phone']; ?></td>
                        <td><?= $data['home_phone'] ?? '-'; ?></td>
                        <td><?= $data['delivery_area'] ?? '-'; ?></td>
                        <td><small><?= $data['address']; ?></small></td>
                        <td><?= $data['city'] ?? '-'; ?></td>
                        <td><?= $data['country'] ?? '-'; ?></td>
                        <td><?= $data['postal_code'] ?? '-'; ?></td>
                        <td><?= $data['shipping_charges'] ?? '0'; ?> PKR</td>
                        <td><?= $data['item_tax'] ?? '0'; ?> PKR</td>
                            <td><span class="text-primary font-weight-bold"><?= $data['total_amount'] ?? '0'; ?> PKR</span></td>
                        <td><span class="badge badge-info"><?= $data['tracking_number'] ?? 'N/A'; ?></span></td>
                        <td><?= $data['cancel_reason'] ?? '-'; ?></td>
                        <td><span class="badge badge-danger">Cancelled</span></td>
                        <td><?= date('d M Y, h:i A', strtotime($data['order_time'])); ?></td>
                        <td><?= date('d M Y, h:i A', strtotime($data['deleted_at'])); ?></td>
                    </tr>
                    <?php } ?>

                    </tbody>
                </table>
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
    $(document).ready(function () {
        $('#deletedOrdersTable').DataTable({
            pageLength: 10,
            ordering: true,
            responsive: true
        });
    });
</script>
</body>
</html>