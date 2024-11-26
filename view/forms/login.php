<div id="loginModal" class="modal">
  <div class="modal-content">
    <span onclick="closeLoginForm()" class="close">&times;</span>
    <p class="p-bt">Đăng nhập</p>
    <p>───────────────────────</p>
    <form method="POST" action="../controller/login.php?action=login">
    <!-- Email -->
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" class="form-control" required>
    </div>

    <!-- Mật khẩu -->
    <div class="form-group">
      <label for="password">Mật khẩu:</label>
      <input type="password" id="password" name="password" class="form-control" required>
    </div>

    <div class="btn-login-container">
      <button type="submit" class="btn-login" >Đăng nhập</button>
      <a class="btn-register-link" onclick="showRegisterForm(), closeLoginForm()">Đăng ký</a>
    </div>
    </form>

    <!-- Github -->
    <form method="POST" action="../controller/gitoauth.php">
      <p>- or -</p>
      <button class="btn-git">
        <img class="btn-git-img" src="../public/github.jpg">
        <span class="ct-w-git">Continue with Github</span>
      </button>
    </form>

    <!-- Google -->
    <form method="POST" action="../controller/ggoauth.php">
      <button class="btn-gg">
        <svg class="h-6 w-6 mr-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
          width="25px" height="25px" viewBox="-0.5 0 48 48" version="1.1">
          <title>Google-color</title>
          <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g id="Color-" transform="translate(-401.000000, -860.000000)">
              <g id="Google" transform="translate(401.000000, 860.000000)">
                <path d="M9.82727273,24 ... " id="Fill-1" fill="#FBBC05"></path>
                <path d="M23.7136364,10.1333333 ..." id="Fill-2" fill="#EB4335"></path>
                <path d="M23.7136364,37.8666667 ..." id="Fill-3" fill="#34A853"></path>
                <path d="M46.1454545,24 ..." id="Fill-4" fill="#4285F4"></path>
              </g>
            </g>
          </g>
        </svg>
        <span class="ct-w-gg">Continue with Google</span>
      </button>
    </form>
  </div>
</div>

<script>
  function showRegisterForm() {
    document.getElementById("registerModal").style.display = "block"; // Hiển thị form đăng ký
  }

  function closeRegisterForm() {
    document.getElementById("registerModal").style.display = "none"; // Đóng form đăng ký
  }
</script>