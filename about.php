<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Tentang Kami</h3>
   <p> <a href="home.php">Home</a> / About </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about-img.png" alt="">
      </div>

      <div class="content">
         <h3>Mengapa Pilih Kami?</h3>
         <p>Kami adalah penyedia langganan premium murah yang menjadi pilihan terbaik untuk kebutuhan Anda. Kami menawarkan berbagai alasan mengapa Anda harus memilih kami sebagai mitra langganan premium Anda</p>
         <p>Kami menyediakan berbagai pilihan langganan premium yang sesuai dengan kebutuhan dan minat Anda. Dari layanan streaming hingga aplikasi produktivitas.</p>
         <a href="contact.php" class="btn">Hubungi Kami</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">Ulasan Pelanggan</h1>

   <div class="box-container">

      <div class="box">
         <h3>Budi</h3>
      <p>Langganan premium dari Home Prem's Store benar-benar mengubah cara saya menikmati konten online. Harganya terjangkau dan fitur yang ditawarkan sangat luar biasa!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
      </div>

      <div class="box">
         <h3>Rina</h3>
      <p>Saya sangat senang menemukan Home Prem's Store. Mereka menawarkan langganan premium dengan harga yang jauh lebih murah daripada yang saya temui di tempat lain. Terima kasih!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
      </div>

      <div class="box">
         <h3>Rizky</h3>
      <p>Saya sangat terkesan dengan pilihan yang luas dari langganan premium yang ditawarkan oleh Home Prem's Store. Saya bisa menyesuaikan langganan saya dengan kebutuhan dan minat saya sendiri.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
      </div>

      <div class="box">
         <h3>Sarah</h3>
      <p>Pelayanan dari tim Home Prem's Store sangat ramah dan responsif. Mereka membantu saya dengan cepat dalam memilih langganan yang tepat dan menjawab semua pertanyaan saya dengan jelas.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
      </div>

      <div class="box">
         <h3>Andre</h3>
      <p>Home Prem's Store memberikan pengalaman langganan premium yang berkualitas tanpa harus membayar harga yang mahal. Saya sangat merekomendasikan mereka kepada semua orang yang mencari langganan premium yang terjangkau.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
      </div>

      <div class="box">
         <h3>Maya</h3>
      <p>Home Prem's Store memberikan solusi yang sempurna untuk kebutuhan langganan premium saya. Harga yang terjangkau dan kualitas yang tidak kompromi membuat saya merasa nilainya sangat berarti.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
      </div>

   </div>

</section>
S
</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>