<?php
require_once '../includes/head.php';
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
require_once '../includes/footer.php';
require_once '../includes/scripts.php';
require_once '../classes/productclass.php';



$products=$productobj->get_all_products();
?>




<div class="body-wrapper">
      <!--  Header Start -->
      
      <!--  Header End -->
      <div class="container-fluid">
      <div class="row">
            
            <div class="col-lg-12 d-flex align-items-stretch">
              <div class="card w-100">
                <div class="card-body p-4">
                  <h5 class="card-title fw-semibold mb-4">View Products</h5>
                  <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                      <thead class="text-dark fs-4">
                        <tr>
                          <th class="border-bottom-0">
                            <h6 class="fw-bold mb-0">Sr No.</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-bold mb-0">Image</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-bold mb-0">Product Name</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-bold mb-0">Rating</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-bold mb-0">Price</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-bold mb-0">Demand Number</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-bold mb-0">Action</h6>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                                    <?php if (!empty($products)): ?>
                                        <?php $sr_no = 1; ?>
                                        <?php foreach ($products as $product): ?>
                                            <tr>
                                                <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?php echo $sr_no++; ?></h6></td>
                                                <td class="border-bottom-0">
                                                    <img src="../assets/products/<?php echo htmlspecialchars($product['product_image']); ?>" class="rounded-2" width="60" alt="">
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-1"><?php echo htmlspecialchars($product['product_name']); ?></h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="mb-0 fw-semibold"><?php echo htmlspecialchars($product['product_rating']); ?></h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-1">$<?php echo htmlspecialchars($product['product_price']); ?></h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0 fs-4"><?php echo htmlspecialchars($product['product_number']); ?></h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <a href="edit-product.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">Edit</a>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <a href="delete-product.php?id=<?php echo $product['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="8" class="text-center">No products found</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>

    <script>
    // Auto-dismiss the alert after 5 seconds
    setTimeout(function () {
        const alert = document.querySelector('.alert');
        if (alert) {
            alert.classList.remove('show');
            alert.classList.add('fade');
        }
    }, 5000);  // 5000 ms = 5 seconds
</script>






