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
    <title>Sales Report - Admin Panel</title>

    <!-- Required stylesheets -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- jQuery + DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
</head>

<body id="page-top">
<div id="wrapper">

    <?php include("aside.php"); ?>

    <!-- Page Content -->
    <div style="margin-top: 100px; margin-left: 125px" class="container mb-5">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="h3 mb-0 text-gray-800 text-center">
                    <i class="fas fa-chart-bar mr-2 text-primary"></i>Sales Report
                </h2>
                <p class="text-muted text-center mt-2">Comprehensive sales analysis and revenue tracking</p>
            </div>
        </div>

        <!-- Sales Report Table -->
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-list mr-2"></i>Sales Summary Report
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="salesTable" class="table table-bordered table-striped table-hover">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th><i class="fas fa-box mr-2"></i>Product Name</th>
                                <th><i class="fas fa-cubes mr-2"></i>Qty Sold</th>
                                <th><i class="fas fa-dollar-sign mr-2"></i>Product Revenue</th>
                                <th><i class="fas fa-percentage mr-2"></i>Tax</th>
                                <th><i class="fas fa-shipping-fast mr-2"></i>Shipping</th>
                                <th><i class="fas fa-calculator mr-2"></i>Grand Total</th>
                                <th><i class="fas fa-calendar-check mr-2"></i>Last Completed</th>
                                <th><i class="fas fa-clock mr-2"></i>Report Generated</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM sales_reports ORDER BY total_quantity_sold DESC";
                            $result = mysqli_query($con, $query);

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td><strong class='text-primary'>" . htmlspecialchars($row['product_name']) . "</strong></td>";
                                echo "<td><span class='badge badge-info'>" . number_format($row['total_quantity_sold']) . "</span></td>";
                                echo "<td><span class='text-success font-weight-bold'>Rs. " . number_format($row['total_product_revenue']) . "</span></td>";
                                echo "<td>Rs. " . number_format($row['total_tax']) . "</td>";
                                echo "<td>Rs. " . number_format($row['total_shipping']) . "</td>";
                                echo "<td><span class='text-primary font-weight-bold'>Rs. " . number_format($row['grand_total']) . "</span></td>";
                                echo "<td>" . date("d-M-Y h:i A", strtotime($row['last_completed_at'])) . "</td>";
                                echo "<td>" . date("d-M-Y h:i A", strtotime($row['generated_at'])) . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php include("footer.php"); ?>
</div>

<!-- JS Scripts -->
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>

<script>
    $(document).ready(function () {
        $('#salesTable').DataTable({
            pageLength: 10,
            ordering: true,
            responsive: true
        });
    });
</script>

</body>
</html>
    