<div id="registerModal" class="modal">
  <div class="modal-content">
    <span onclick="closeRegisterForm()" class="close">&times;</span>
    <h2 class="p-bt">Đăng ký tài khoản</h2>
    <p>───────────────────────</p>
    <form method="POST" action="../controller/registered.php" enctype="multipart/form-data">
    
        <div class="form-group">
        <label for="name">Họ và tên:</label>
        <input type="text" id="name" name="name" class="form-control" required>
      </div>

      <!-- Tên người dùng -->
      <div class="form-group">
        <label for="username">Tên người dùng:</label>
        <input type="text" id="username" name="username" class="form-control" required>
      </div>

      <!-- Email -->
      <div class="form-group">
        <label for="email" >Email:</label>
        <input type="email" id="email" name="email" class="form-control" required>
      </div>

      <!-- Mật khẩu -->
      <div class="form-group">
        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" class="form-control" required>
      </div>

      <!-- Xác nhận mật khẩu -->
      <div class="form-group">
        <label for="confirm_password">Xác nhận mật khẩu:</label>
        <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
      </div>

      <!-- Ảnh đại diện -->
      <div class="form-group">
        <label for="picture">Ảnh đại diện:</label>
        <input type="file" id="picture" name="picture" class="form-control" accept="image/*" required>
      </div>

      <button type="submit" class="btn-register">Đăng ký</button>
    </form>
  </div>
</div>
