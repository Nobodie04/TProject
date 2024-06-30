<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $orderID = $_POST['order_id'];
   $updatePayment = $_POST['update_payment'];

   // Lakukan validasi dan sanitasi data input jika diperlukan
   
   // Lakukan pembaruan status pembayaran dalam database
   $updateQuery = "UPDATE `orders` SET payment_status = '$updatePayment' WHERE id = '$orderID'";
   $result = mysqli_query($conn, $updateQuery);

   if ($result) {
      // Pembaruan berhasil
      echo "success";
   } else {
      // Pembaruan gagal
      echo "error";
   }
}
?>
