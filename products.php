<?php
session_start();

if ( !isset( $_SESSION['user_id'] ) ) {
    header("Location: index.php");
}

include("connect.php");

$sql=mysqli_query($conn, "SELECT p.*, s.store_name_ar FROM products p INNER JOIN stores s ON p.store_id = s.id ");
 ?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Products</title>
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
            <a class="nav-link" href="logout.php">Log out</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="col-xs-12">
          <?php
              if(isset($_GET['success'])){
                  echo'<div class="alert alert-success" role="alert">Successfully removed</div>';
                  header('refresh:2;url=products.php');
              }elseif(isset($_GET['error'])){
                  echo'<div class="alert alert-danger" role="alert">Something went wrong, Please try again</div>';
                  header('refresh:2;url=products.php');
              }elseif(isset($_GET['blocked'])){
                  echo'<div class="alert alert-success" role="alert">Successfully blocked</div>';
                  header('refresh:2;url=products.php');
              }elseif(isset($_GET['blocked'])){
                  echo'<div class="alert alert-success" role="alert">Successfully unblocked</div>';
                  header('refresh:2;url=products.php');
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
        					<h4 class="modal-title"> Add Product</h4>
        				</div>
        				<div class="modal-body">

                  <label for="name">Product Name</label>
                  <input type="text" id="name" name="name" class="form-control" placeholder="Enter name">

                  <br/>

                  <label for="name">Product Name</label>
                  <input type="text" id="name" name="name" class="form-control" placeholder="Enter name">

                  <br/>

                  <label for="category">Description</label>
                  <input class="form-control" maxlength="70" name="description" id="description" placeholder="Enter description">

        					<br />

                  <label for="category">Description</label>
                  <input class="form-control" maxlength="70" name="description" id="description" placeholder="Enter description">

                  <br />

                  <label for="category">Category</label>
                  <input class="form-control" name="category" id="category" placeholder="Enter category">

        					<br />

                  <label for="category">Category</label>
                  <input class="form-control" name="category" id="category" placeholder="Enter category">

                  <br />

                  <label for="quantity">Quantity</label>
                  <input class="form-control" name="quantity" id="quantity" placeholder="Enter quantity">

        					<br />

                  <label for="quantity">Minimum Quantity</label>
                  <input class="form-control" name="minimum_quantity" id="minimum_quantity" placeholder="Enter min. quantity">

        					<br />

                  <label for="price">Price</label>
                  <input class="form-control" name="price" id="price" placeholder="Enter price">

        					<br />

                  <div class="row">
                    <div class="form-group col-md-6">
                        <label for="inputStore">Store</label>
                        <select id="inputStore" name="inputStore" class="form-control">
                            <option value="0">-Select-</option>
                        </select>
                    </div>

                </div></br>

                  <div class="form-group col-md-12">
                    <label class="btn btn-info" for="my-image-selector">
                        <input id="my-image-selector" name="my-image-selector" type="file" style="display:none"
                        onchange="$('#upload-image-info').html(this.files[0].name)">
                        Upload Product Image
                    </label>
                    <span class='label label-info' id="upload-image-info"></span>
                  </div></br>

                  <div class="form-group col-md-12">
                    <label class="btn btn-info" for="my-poster-selector">
                        <input id="my-poster-selector" name="my-poster-selector" type="file" style="display:none"
                        onchange="$('#upload-poster-info').html(this.files[0].name)">
                        Upload Product Poster
                    </label>
                    <span class='label label-info' id="upload-poster-info"></span>
                  </div></br>
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

    <div class="container-fluid">
      <div class="row">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      <strong class="card-title">Products</strong>
                      <div align="right">
                          <button class="btn btn-primary add" id="add" name="add" data-toggle="modal" data-target="#addModal" type="button">Add Product</button>
                      </div>
                  </div>
                  <div class="card-body">
                      <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                          <thead>
                              <tr>
                                  <th>Name</th>
                                  <th>Store</th>
                                  <th>Quantity</th>
                                  <th>Price</th>
                                  <th>Status</th>
                                  <th>Delete</th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php
                                while ($products = mysqli_fetch_assoc($sql)) {?>

                                  <tr>
                                    <td><?php echo $products['name'] ?></td>
                                    <td><?php echo $products['store_name']; ?></td>
                                    <td><?php echo $products['available_quantity']; ?></td>
                                    <td><?php echo $products['price']; ?></td>
                                    <td> <?php if ($products['available_quantity'] > $products['minimum_quantity']) {
                                          			echo '<span class="badge badge-success text-sm col-sm-6" style="margin: 8px;"> Updated </span>';
                                          		}else{
                                          			echo '<span class="badge badge-danger text-sm col-sm-6" style="margin: 8px;"> Not updated </span>';
                                          		}?> </td>
                                    <td> <a href="delete_product.php?id=<?php echo $products['id']; ?>" class="btn btn-danger">Delete</a> </td>
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
          getAllStores();
          $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
          });
          $('#bootstrap-data-table-export').DataTable();

          $(document).on('submit', '#add_form', function(event){
        		event.preventDefault();
        		var name = $('#name').val();
        		var category = $('#category').val();
        		var quantity = $('#quantity').val();
        		var price = $('#price').val();

        		if(name != '' && category != '' && quantity != '' && price != '')
        		{
              document.getElementById('addAction').style.visibility = 'hidden';
              //$('#action').modal('hide');
        			$.ajax({
        				url:"add_product.php",
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

      function getAllStores(){

          $.ajax({
              url:"getAllStores.php",
              method:'GET',
              contentType:false,
              processData:false,
              success:function(data)
              {
                  var dropdown = $('#inputStore');

                  var js = JSON.parse(data);
                  //alert(js.data);
                  //empty out the existing options
                  dropdown.empty();

                  dropdown.append( $('<option value="0">Select ...</option>') );
                  //append the values to the drop down
                  jQuery.each( js.data, function(i, v) {
                      dropdown.append( $('<option value="'+ v.id +'">'+ v.store_name +'</option>') );
                  });
              },
              error:function(result){
                  //document.getElementById('action').style.visibility = 'visible';
                  alert("process failed!");
              }
          });
      }
  </script>


</body>
</html>
