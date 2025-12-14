<?php ob_start(); ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow">
                <div class="card-body p-4">
                    <h3 class="card-title text-center mb-4">
                        <i class="fas fa-user-plus icon-primary"></i> Đăng ký tài khoản
                    </h3>
                    
                    <form method="POST" action="<?= BASE_URL ?>/register">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="username" class="form-label">
                                    <i class="fas fa-user icon-sm icon-primary"></i> Tên đăng nhập
                                </label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="fullname" class="form-label">
                                    <i class="fas fa-id-card icon-sm icon-primary"></i> Họ và tên
                                </label>
                                <input type="text" class="form-control" id="fullname" name="fullname" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope icon-sm icon-primary"></i> Email
                            </label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock icon-sm icon-primary"></i> Mật khẩu
                                </label>
                                <input type="password" class="form-control" id="password" name="password" required minlength="6">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="confirm_password" class="form-label">
                                    <i class="fas fa-lock icon-sm icon-primary"></i> Xác nhận mật khẩu
                                </label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="role" class="form-label">
                                <i class="fas fa-user-tag icon-sm icon-primary"></i> Vai trò
                            </label>
                            <select class="form-select" id="role" name="role">
                                <option value="0">Học viên</option>
                                <option value="1">Giảng viên</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-user-plus"></i> Đăng ký
                        </button>
                    </form>
                    
                    <div class="text-center mt-3">
                        <p>Đã có tài khoản? <a href="<?= BASE_URL ?>/login">Đăng nhập</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean();
$title = 'Đăng ký - ' . APP_NAME;
include 'app/Views/layouts/main.php';
?>