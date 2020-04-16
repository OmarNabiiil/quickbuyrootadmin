<?php
session_start();

if ( !isset( $_SESSION['user_id'] ) ) {
    header("Location: index.php");
}
include("connect.php");

$sql=mysqli_query($conn, "SELECT o.*, u.first_name, u.last_name, u.street, u.country, u.city, u.building, u.mobile FROM orders o INNER JOIN users u ON o.user_id = u.id ");
 ?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Orders</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,800">

    <link href="css/simple-sidebar.css" rel="stylesheet">

    <!--  <link rel="stylesheet" href="css/style.css" id="theme-stylesheet"> -->

    <!--  <link rel="stylesheet" href="css/orionicons.css"> -->

<!--    <link rel="stylesheet" type="text/css" href="libraries/css/dataTables.bootstrap4.min.css">-->
    <link rel="stylesheet" type="text/css" href="vendor/jquery/dataTables.bootstrap4.min.css">

</head>
<body>

  <div class="d-flex" id="wrapper">

  <!-- Sidebar -->
  <div class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading">Menu </div>
    <div class="list-group list-group-flush">
      <a href="users.php" class="list-group-item list-group-item-action bg-light">Users</a>
      <a href="stores.php" class="list-group-item list-group-item-action bg-light">Stores</a>
      <a href="orders.php" class="list-group-item list-group-item-action bg-light">Orders</a>
      <a href="products.php" class="list-group-item list-group-item-action bg-light">Products</a>
    </div>
  </div>
  <!-- /#sidebar-wrapper -->

  <!-- Page Content -->
  <div id="page-content-wrapper">

    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
      <a class="menu-icon fa fa-list-ol" id="menu-toggle"></a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Log out</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="col-xs-12">
          <?php
              if(isset($_GET['success'])){
                  echo'<div class="alert alert-success" role="alert">Successfully removed</div>';
                  header('refresh:2;url=orders.php');
              }elseif(isset($_GET['error'])){
                  echo'<div class="alert alert-danger" role="alert">Something went wrong, Please try again</div>';
                  header('refresh:2;url=orders.php');
              }elseif(isset($_GET['updated'])){
                  echo'<div class="alert alert-success" role="alert">Successfully updated</div>';
                  header('refresh:2;url=https://quickbuyadmin.azurewebsites.net/orders.php');
              }elseif(isset($_GET['unupdated'])){
                  echo'<div class="alert alert-success" role="alert">Something went wrong, Please try again</div>';
                  header('refresh:2;url=orders.php');
              }
          ?>
          <hr>
      </div>

    <div id="orderDetailsModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <form method="post" id="order_form" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header" dir="rtl">
                        <button type="button" id="closeDetailsModal" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Order Details</h4>
                    </div>
                    <div class="modal-body">

                        <table id="products_table" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Store</th>
                                <th>Quantity</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>


                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Product</th>
                                <th>Store</th>
                                <th>Quantity</th>
                                <th>Status</th>
                            </tr>
                            </tfoot>

                        </table>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="operation" id="operation" />
                        <button type="button" id="closeDetailsModalButton" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="container-fluid">
      <div class="row">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      <strong class="card-title">Orders</strong>
                  </div>
                  <div class="card-body">
                      <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                          <thead>
                              <tr>
                                <th>Order Number</th>
                                <th>Username</th>
                                <th>Mobile</th>
                                <th>Address</th>
                                <th>Order Status</th>
                                <th>Details</th>
                                <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php
                                while ($orders = mysqli_fetch_assoc($sql)) {?>

                                  <tr>
                                    <td><?php echo $orders['id']; ?></td>
                                    <td><?php echo $orders['first_name'] . ' ' . $orders['last_name']; ?></td>
                                    <td><?php echo $orders['mobile']; ?></td>
                                    <td><?php echo $orders['building'].', '.$orders['street'].' - '.$orders['city'].' - '.$orders['country']; ?></td>
                                    <td> <?php if ($orders['state'] == 1) {
                                            echo '<a href="update_status.php?id='.$orders['id'].'" class="btn btn-success">Receive</a>';
                                          }elseif ($orders['state'] == 2){
                                            echo '<a href="update_status.php?id='.$orders['id'].'" class="btn btn-success">Ship</a>';
                                          }elseif ($orders['state'] == 3){
                                            echo '<a href="update_status.php?id='.$orders['id'].'" class="btn btn-success">Deliver</a>';
                                          }elseif ($orders['state'] == 4){
                                            echo '<span class="badge badge-success text-sm col-sm-6" style="margin: 8px;"> Delivered </span>';
                                          }
                                          ?> </td>
                                    <td> <button type="button" name="details" id="<?php echo $orders['id']; ?>" class="btn btn-info details">Details</button> </td>
                                    <td> <a href="delete_user.php?id=<?php echo $orders['id']; ?>" class="btn btn-danger">Cancel</a> </td>

                                  </tr>

                              <?php  } ?>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </div>
  <!-- /#page-content-wrapper -->

</div>

    <script src="vendor/jquery/jquery.js"></script>
    <script src="vendor/jquery/jquery.validate.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery/jquery.dataTables.min.js"></script>
    <!--<script src="libraries/js/dataTables.bootstrap4.min.js"></script>-->
    <!--  <script src="js/front.js"></script> -->


    <script type="text/javascript">
        $(document).ready(function() {
          $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
          });
          $('#bootstrap-data-table-export').DataTable();

          $(document).on('click', '.details', function(){
        		var order_number = $(this).attr("id");
        		$.ajax({
        			url:"fetch_order.php",
        			method:"POST",
        			data:{order_number:order_number},
        			dataType:"json",
        			success:function(data)
        			{
        				$('#orderDetailsModal').modal('show');
                var table = $('#products_table').DataTable({
                    "destroy": true,
                    "bAutoWidth" : false,
                    "aaData" : data,
                    "columns" : [ {
                        "data" : "name"
                    }, {
                        "data" : "store_name"
                    }, {
                        "data" : "quantity"
                    }, {
                        "data" : "status"
                    } ]
                })

        				//$('.modal-title').text("Order Details");
        			}
        		})
        	});

      } );
  </script>


</body>
</html>
