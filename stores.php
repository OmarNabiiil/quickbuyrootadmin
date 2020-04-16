<?php
session_start();

if ( !isset( $_SESSION['user_id'] ) ) {
    header("Location: index.php");
}
include("connect.php");

$sql=mysqli_query($conn, "SELECT * FROM stores ");
 ?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Stores</title>
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
                  header('refresh:2;url=users.php');
              }elseif(isset($_GET['error'])){
                  echo'<div class="alert alert-danger" role="alert">Something went wrong, Please try again</div>';
                  header('refresh:2;url=users.php');
              }elseif(isset($_GET['blocked'])){
                  echo'<div class="alert alert-success" role="alert">Successfully blocked</div>';
                  header('refresh:2;url=users.php');
              }elseif(isset($_GET['blocked'])){
                  echo'<div class="alert alert-success" role="alert">Successfully unblocked</div>';
                  header('refresh:2;url=users.php');
              }
          ?>
          <hr>
      </div>

      <div id="addModal" class="modal fade">
        	<div class="modal-dialog">
        		<form method="get" id="add_form" enctype="multipart/form-data">
        			<div class="modal-content">
        				<div class="modal-header" dir="rtl">
        					<button type="button" class="close" data-dismiss="modal">&times;</button>
        					<h4 class="modal-title"> Add Store</h4>
        				</div>
        				<div class="modal-body">

                  <label for="name">Store Name</label>
                  <input type="text" id="name" name="name" class="form-control" placeholder="Enter name">

                  <br/>

                  <label for="description">Description</label>
                  <input class="form-control" maxlength="70" name="description" id="description" placeholder="Enter description">

        					<br />

                  <label for="mobile">Mobile</label>
                  <input class="form-control" name="mobile" id="mobile" placeholder="Enter mobile">

        					<br />

                  <label for="country">Country</label>
                  <input class="form-control" name="country" id="country" placeholder="Enter country">

        					<br />

                  <label for="city"> City</label>
                  <input class="form-control" name="city" id="city" placeholder="Enter city">

        					<br />

                  <label for="street">Street</label>
                  <input class="form-control" name="street" id="street" placeholder="Enter street">

        					<br />

                  <label for="building_no">Building number</label>
                  <input class="form-control" name="building_no" id="building_no" placeholder="Enter building number">

        					<br />

                  <label for="floor_no">Floor number</label>
                  <input class="form-control" name="floor_no" id="floor_no" placeholder="Enter floor number">

        					<br />

        				</div>
        				<div class="modal-footer">
        					<input type="hidden" name="user_id" id="user_id" />
                  <input type="hidden" name="push_type" value="topic"/>
        					<input type="submit" name="addAction" id="addAction" class="btn btn-success" value="Add" />
        					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        				</div>
        			</div>
        		</form>
        	</div>
        </div>

      <div id="storeProductssModal" class="modal fade">
          <div class="modal-dialog modal-lg">
              <form method="post" id="order_form" enctype="multipart/form-data">
                  <div class="modal-content">
                      <div class="modal-header" dir="rtl">
                          <button type="button" id="closeDetailsModal" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Products</h4>

                      </div>
                      <div class="modal-body">

                          <table id="products_table" class="table table-bordered">
                              <thead>
                              <tr>
                                  <th>Name</th>
                                  <th>Quantity</th>
                                  <th>Price</th>
                                  <th>Status</th>
                              </tr>
                              </thead>
                              <tbody>


                              </tbody>
                              <tfoot>
                              <tr>
                                  <th>Name</th>
                                  <th>Quantity</th>
                                  <th>Price</th>
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
                      <strong class="card-title">Stores</strong>
                      <div align="right">
                          <button class="btn btn-primary add" id="add" name="add" data-toggle="modal" data-target="#addModal" type="button">Add Store</button>
                      </div>
                  </div>
                  <div class="card-body">
                      <table id="bootstrap-data-table-export" class="table table-bordered">
                          <thead>
                              <tr>
                                  <th>Name</th>
                                  <th>E-mail</th>
                                  <th>Mobile</th>
                                  <th>Address</th>
                                  <th>View Products</th>
                                  <th>Delete</th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php
                                while ($stores = mysqli_fetch_assoc($sql)) {?>

                                  <tr>
                                    <td><?php echo $stores['store_name'];?></td>
                                    <td><?php echo $stores['email']; ?></td>
                                    <td><?php echo $stores['mobile']; ?></td>
                                    <td><?php echo $stores['building'].', '.$stores['street'].' - '.$stores['city'].' - '.$stores['country']; ?></td>
                                    <td> <button type="button" name="products" id="<?php echo $stores['id']; ?>" class="btn btn-info products">Products</button> </td>
                                    <td> <a href="delete_store.php?id=<?php echo $stores['id']; ?>" class="btn btn-danger">Delete</a> </td>
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
    <script src="vendor/jquery/jquery.dataTables.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--<script src="libraries/js/dataTables.bootstrap4.min.js"></script>-->
    <!--  <script src="js/front.js"></script> -->


    <script type="text/javascript">
        $(document).ready(function() {
          $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
          });
          $('#bootstrap-data-table-export').DataTable();

          $(document).on('click', '.products', function(){
        		var store_id = $(this).attr("id");
        		$.ajax({
        			url:"fetch_store_products.php",
        			method:"POST",
        			data:{store_id:store_id},
        			dataType:"json",
        			success:function(data)
        			{
        				$('#storeProductssModal').modal('show');
                var table = $('#products_table').DataTable({
                    "destroy": true,
                    "bAutoWidth" : false,
                    "aaData" : data,
                    "columns" : [ {
                        "data" : "name"
                    }, {
                        "data" : "available_quantity"
                    }, {
                        "data" : "price"
                    }, {
                        "data" : "status"
                    } ]
                })

        				//$('.modal-title').text("Order Details");
        			}
        		})
        	});

          $(document).on('submit', '#add_form', function(event){
        		event.preventDefault();
        		var name = $('#name').val();
        		var description = $('#description').val();
        		var mobile = $('#mobile').val();
        		var country = $('#country').val();
        		var city = $('#city').val();
        		var street = $('#street').val();
        		var floor_no = $('#floor_no').val();
        		var building_no = $('#building_no').val();

        		if(name != '' && description != '' && mobile != '' && country != '' && city != '' && street != '' && floor_no != '' && building_no != '')
        		{
              document.getElementById('addAction').style.visibility = 'hidden';
              //$('#action').modal('hide');
        			$.ajax({
        				url:"add_store.php",
        				method:'POST',
        				data:new FormData(this),
        				contentType:false,
        				processData:false,
        				success:function(data)
        				{
        					$('#add_form')[0].reset();
        					$('#add_form').modal('hide');

                  document.location.reload();
        				},
                error:function(result){
                  document.getElementById('addAction').style.visibility = 'visible';
                  alert("process failed!");
                }
        			});
        		}
        		else
        		{
        			alert("All Fields are Required");
        		}
        	});



      } );
  </script>


</body>
</html>
