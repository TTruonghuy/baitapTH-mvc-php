<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Index - OnePage Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">

  <script>
    function showLoginForm() {
      document.getElementById("loginModal").style.display = "block"; // Hiển thị form login
    }
    function closeLoginForm() {
      document.getElementById("loginModal").style.display = "none"; // Đóng form login
    }
    function showRegisterForm() {
      document.getElementById("registerModal").style.display = "block"; // Hiển thị form đăng ký
    }

    function closeRegisterForm() {
      document.getElementById("registerModal").style.display = "none"; // Đóng form đăng ký
    }
  </script>

</head>

<body class="index-page">
  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <h1 class="sitename">Bài tập</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#bomon" class="active" onclick="showBoMon()">Bộ môn<br></a></li>
          <li><a href="#lop">Lớp</a></li>
          <li><a href="#giaovien">Giáo viên</a></li>
          <li><a href="#sinhvien">Sinh viên</a></li>
          <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Dropdown 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i
                    class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">Deep Dropdown 1</a></li>
                  <li><a href="#">Deep Dropdown 2</a></li>
                  <li><a href="#">Deep Dropdown 3</a></li>
                  <li><a href="#">Deep Dropdown 4</a></li>
                  <li><a href="#">Deep Dropdown 5</a></li>
                </ul>
              </li>
              <li><a href="#">Dropdown 2</a></li>
              <li><a href="#">Dropdown 3</a></li>
              <li><a href="#">Dropdown 4</a></li>
            </ul>
          </li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      <?php
      session_start();
      ?>
      <?php if (
        (isset($_SESSION['google_loggedin']) && $_SESSION['google_loggedin']) ||
        (isset($_SESSION['user_loggedin']) && $_SESSION['user_loggedin'])
      ): ?>
        <!-- Hiển thị avatar và tên -->
        <div class="user-info">
          <img
            src="../public/avt_user/<?= isset($_SESSION['google_picture']) ? htmlspecialchars($_SESSION['google_picture']) : htmlspecialchars($picture); ?>"
            alt="Avatar" class="avatar" style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;">
          <span class="user-name">
            <?= isset($_SESSION['google_name']) ? htmlspecialchars($_SESSION['google_name']) : htmlspecialchars($_SESSION['user_name']); ?>
          </span>
          <a href="../controller/logout.php" class="btn-logout">Đăng xuất</a>
        </div>
      <?php else: ?>
        <!-- Hiển thị nút đăng nhập -->
        <button onclick="showRegisterForm()" class="btn-registered" href="../Controller/registered.php">Đăng ký</button>
        <button onclick="showLoginForm()" class="btn-getstarted" href="../Controller/ggoauth.php">Đăng nhập</button>
      <?php endif; ?>
    </div>

  </header>

  <?php include 'forms/login.php'; ?>
  <?php include 'forms/register.php'; ?>

  <?php
  require_once 'components/bomon.php';
  require_once 'components/lop.php';
  require_once 'components/giaovien.php';
  require_once 'components/sinhvien.php';
  //require_once 'body.php';
  require_once 'footer.php';
  ?>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>