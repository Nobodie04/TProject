<?php
include 'config.php';
session_start();
$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
   header('location:login.php');
}
if (isset($_POST['update_order'])) {
   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');

   // Mengambil nomor dan mengarahkan ke halaman WhatsApp
   $select_order_number = mysqli_query($conn, "SELECT number FROM `orders` WHERE id = '$order_update_id'") or die('query failed');
   $order_number = mysqli_fetch_assoc($select_order_number)['number'];
   $message = urlencode("Pesanan telah selesai, terima kasih telah berbelanja di toko kami");
   $whatsapp_link = "https://wa.me/{$order_number}?text={$message}";
   header("location: $whatsapp_link");
   exit();
}
if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_orders.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

   <style>
      .btn-view {
      display: inline-block;
      margin-top: 5px;
      padding: 10px 20px;
      font-size: 14px;
      font-weight: bold;
      text-align: center;
      text-decoration: none;
      color: #fff;
      background-color: #007bff;
      border: none;
      border-radius: 4px;
      transition: background-color 0.3s ease;
      }

      .btn-view:hover {
      background-color: #0056b3;
      cursor: pointer;
      }

   </style>
</head>

<body>

   <?php include 'admin_header.php'; ?>

   <section class="orders">

      <h1 class="title">placed orders</h1>

      <div class="box-container">
         <?php
         if (isset($_POST['view'])) {
            $order_id = $_POST['order_id'];
            $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE id = '$order_id'") or die('query failed');
            if (mysqli_num_rows($select_orders) > 0) {
               $fetch_orders = mysqli_fetch_assoc($select_orders);
         ?>
               <div class="box">
                  <p> user id : <span><?php echo $fetch_orders['user_id']; ?></span> </p>
                  <p> placed on : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
                  <p> name : <span><?php echo $fetch_orders['name']; ?></span> </p>
                  <p> number : <span id="orderNumber"><?php echo $fetch_orders['number']; ?></span> </p>
                  <p> email : <span><?php echo $fetch_orders['email']; ?></span> </p>
                  <p> address : <span><?php echo $fetch_orders['address']; ?></span> </p>
                  <p> total products : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
                  <p> total price : <span>Rp. <?php echo $fetch_orders['total_price']; ?>/-</span> </p>
                  <p> payment method : <span><?php echo $fetch_orders['method']; ?></span> </p>
                  <form action="admin_orders.php" method="post" id="updateOrderForm">
                     <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                     <select name="update_payment" id="updatePayment">
                        <option value="" selected disabled><?php echo $fetch_orders['payment_status']; ?></option>
                        <option value="pending">pending</option>
                        <option value="completed">completed</option>
                     </select>
                     <input type="submit" value="update" name="update_order" class="option-btn">
                     <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('delete this order?');" class="delete-btn">delete</a>
                     <a href="admin_orders.php" class="btn-view">Back</a>
                  </form>
               </div>
            <?php
            } else {
               echo '<p class="empty">Order not found!</p>';
            }
         } else {
            echo '<p class="empty">No order selected!</p>';
            echo '<a href="admin_orders.php" class="btn-view">Back</a>';
         }
            ?>
      </div>
   </section>

   <!-- Bootstrap JS -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
   <!-- custom admin js file link  -->
   <script src="js/admin_script.js"></script>
   <script>
   document.addEventListener('DOMContentLoaded', function() {
      const updateOrderForm = document.getElementById('updateOrderForm');
      const updatePaymentSelect = document.getElementById('updatePayment');

      updateOrderForm.addEventListener('submit', function(event) {
         event.preventDefault();
         
         const orderID = updateOrderForm.order_id.value;
         const updatePayment = updatePaymentSelect.value;
         
         // Mengirim permintaan AJAX untuk memperbarui status pembayaran
         const xhr = new XMLHttpRequest();
         xhr.open('POST', 'update_orders.php', true);
         xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
         xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
               // Perbarui status berhasil
               const orderNumber = document.getElementById('orderNumber').innerText;
               const message = encodeURIComponent('Pesanan telah selesai, terimakasih telah berbelanja di toko kami');
               const whatsappLink = `https://wa.me/${orderNumber}?text=${message}`;
               window.location.href = whatsappLink;
            }
         };
         xhr.send(`order_id=${orderID}&update_payment=${updatePayment}`);
      });
   });
</script>


</body>

</html>
