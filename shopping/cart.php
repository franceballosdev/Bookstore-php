<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php

  if(!isset($_SESSION['username'])) {
    header('location: '.APPURL. "");
  }

  $products = $conn->query("SELECT * FROM cart WHERE user_id = '{$_SESSION['user_id']}'");
  $products->execute();

  $allProducts = $products->fetchAll(PDO::FETCH_OBJ);


  if(isset($_POST['submit'])) {
    
    $price = $_POST['price'];

    $_SESSION['price'] = $price;

    header('location: checkout.php');
  }

?>

<div class="container d-flex " style="font-family: 'Fira Sans', sans-serif">
  <div class="col-md-11">
    <div class="rounded-4 shadow mb-5 mt-5" style="background-color: white">
      <div class="card-body">
        <div class="row g-0" >
          <div class="col-lg-20">
            <div class="p-5 mb-5 ">
              <div class="d-flex justify-content-between align-items-center mb-5 ">
                <h1 class="fw-bold text-black">Shopping Cart</h1>
                <h6 class="mb-0 text-muted justify-content-end"><?php echo $getNumber->num_products; ?> items</h6>
              </div>
              <?php if(!empty($allProducts)): ?>
              <table class="table table-light table-hover" height="100">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Individual price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($allProducts as $product): ?>
                  <tr class="mb-4">
                    <th scope="row"><?php echo $product->prod_id; ?></th>
                    <td><img width="100" height="100" src="../images/<?php echo $product->prod_image; ?>" class="img-fluid rounded-3" alt="Cotton T-shirt"></td>
                    <td><?php echo $product->prod_name; ?></td>
                    <td class="price">
                      <span class="prod_price"><?php echo $product->prod_price; ?></span>
                      <span class="currency">$</span>
                    </td>
                    <td><input id="form1"       
                    min="1" 
                    name="quantity"
                    value="<?php echo $product->prod_amount; ?>" 
                    type="number" class="form-control form-control-sm prod_amount" 
                    onchange="updateAmount(this, '<?php echo $product->id; ?>', '<?php echo $_SESSION['user_id']; ?>')" />
                  </td>
                    <td class="total_price"><?php echo $product->prod_price * $product->prod_amount; ?>$</td>
                    <td>
                      <!-- Button to trigger modal -->
                      <button type="button" 
                      class="btn btn-danger text-white btn-delete-item" 
                      data-bs-toggle="modal" 
                      data-bs-target="#deleteModal<?php echo $product->id; ?>">
                        <i class="fa-solid fa-trash"></i>
                      </button>

                      <!-- Modal -->
                      <div class="modal fade" 
                      id="deleteModal<?php echo $product->id; ?>" 
                      tabindex="-1" 
                      aria-labelledby="deleteModalLabel" 
                      aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" 
                              id="deleteModalLabel">Delete Confirmation</h5>
                              <button type="button" 
                              class="btn-close" 
                              data-bs-dismiss="modal" 
                              aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              Are you sure you want to delete this item?
                            </div>
                            <div class="modal-footer">
                              <button type="button" 
                              class="btn btn-secondary" 
                              data-bs-dismiss="modal">Close</button>
                              <button type="button" 
                              value="<?php echo $product->id; ?>" 
                              class="btn btn-danger text-white btn-delete ">
                                Delete
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
              <?php else: ?>
              <div class="text-center p-5 fw-bold">
                <h1><i class="fas fa-shopping-cart"></i></h1>
                <h3>Cart is empty</h3>
              </div>
              <?php endif ?>
            </div>
            <div class=" d-flex justify-content-between">
                <a href="<?php echo APPURL; ?>" 
                class="btn btn-light text-white rounded-pill"  
                style="background-color: #384E77; padding: 10px; margin-left: 20px; margin-top: 20px; margin-bottom: 20px; margin-right: 20px;"><i 
                class="fas fa-arrow-left"></i> Continue Shopping</a>
                <button 
                class="delete-all delete-all-items btn btn-danger rounded-pill"
                style="padding: 10px; margin-left: 20px; margin-top: 20px; margin-bottom: 20px; margin-right: 20px;">Clear cart</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3 d-none d-md-block mt-5" style="margin-left: 50px; text-align: center;">
    <div class="p-1" style="margin: auto; margin-top: 50px;">
      <div class="card rounded-4 shadow mb-5 mt-5" style="text-align: center;">
        <div class="card-body" style="text-align: center;">
          <h2 class="fw-bold mb-5 mt-2 pt-1" style="text-align: center;">Summary</h2>
          <hr class="my-4" style="text-align: center;">
          <form method="POST" action="cart.php" style="text-align: center;">
            <div class="summary" style="text-align: center;">
              <div class="justify-content-between mb-5" style="text-align: center;">
                <h3 class="text-uppercase fw-bold justify-content-" style="text-align: center;">Total price</h3>
                <input class="input_price" type="hidden" name="price" style="text-align: center;">
              </div>
              <div style="text-align: center;">
                <span class="full_price fw-bold mb-5 d-flex justify-content-center h1" style="text-align: center;"></span>
              </div>
              <div style="text-align: center;">
                <button type="submit" name="submit" class="btn btn-dark btn-block btn-lg checkout rounded-pill" style="background-color: #0D0630; data-mdb-ripple-color="dark"; text-align: center;" >Checkout</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>


<?php require '../includes/footer.php'; ?>

<script>
            $(document).ready(function() {
              $(".prod_amount").mouseup(function () {
                  
                  var $el = $(this).closest('tr');        
                  var prod_amount = $el.find(".prod_amount").val();
                  var prod_price = $el.find(".prod_price").html();

                  var total = prod_amount * prod_price;
                  $el.find(".total_price").html("");        

                  $el.find(".total_price").append(total+'$');



                  //Update item
                    $(".btn-update").on('click', function(e) {
                      var id = $(this).val();
                      $.ajax({
                        type: "POST",
                        url: "update-item.php",
                        data: {
                          update: "update",
                          id: id,
                          prod_amount: prod_amount
                        },

                        success: function() {
                         // alert("done");
                          reload();
                        }
                      })
                    });                
           fetch();     
        });

                      //Delete item
                $(".btn-delete").on('click', function(e) {
                  var id = $(this).val();
                  $.ajax({
                    type: "POST",
                    url: "delete-item.php",
                    data: {
                      delete: "delete",
                      id: id
                    },
                    success: function() {
                      reload();
                    }
                  })
                });


                $(".delete-all").on('click', function(e) {

                  $.ajax({
                    type: "POST",
                    url: "delete-all-item.php",
                    data: {
                      delete: "delete"
                    },
                    success: function() {
                      alert("All products deleted successfully");
                      reload();
                    }
                  })
                });
      fetch();

      function fetch() {

        setInterval(function () {
                  var sum = 0.0;
                  $('.total_price').each(function()
                  {
                      sum += parseFloat($(this).text());
                  });
                  $(".full_price").html(sum+" $");
                  $(".input_price").val(sum);

                  if($(".input_price").val() > 0) {
                    $(".checkout").show();
                  } else { 
                    $(".checkout").hide();
                  }

                  if($(".prod_amount").val() > 0){
                    $(".delete-all-items").show();
                  } else { 
                    $(".delete-all-items").hide();
                  }
              
        }, );
      } 
      
                  function reload() {      
                        $("body").load("cart.php")    
                  }
                  });

                function updateAmount(element, id, user_id) {
                  var prod_amount = element.value;
                  var xhr = new XMLHttpRequest();
                  xhr.open("POST", "update-item.php", true);
                  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                  xhr.onreadystatechange = function() {
                    if(xhr.readyState === 4 && xhr.status === 200) {
                      //alert(xhr.responseText);
                      reload();
                    }
                  };
                  xhr.send("update=update&id="+id+"&user_id="+user_id+"&prod_amount="+prod_amount);
                }
                function reload() {      
                  $("body").load("cart.php")    
                }
</script>
