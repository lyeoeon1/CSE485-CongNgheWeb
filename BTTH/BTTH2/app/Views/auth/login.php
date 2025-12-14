<?php ob_start(); ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow">
                <div class="card-body p-4">
                    <h3 class="card-title text-center mb-4">
                        <i class="fas fa-sign-in-alt icon-primary"></i> Đăng nhập
                    </h3>
                    
                    <form method="POST" action="<?= BASE_URL ?>/login">
                        <div class="mb-3">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope icon-sm icon-primary"></i> Email
                            </label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock icon-sm icon-primary"></i> Mật khẩu
                            </label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-sign-in-alt"></i> Đăng nhập
                        </button>
                    </form>
                    
                    <div class="text-center mt-3">
                        <p>Chưa có tài khoản? <a href="<?= BASE_URL ?>/register">Đăng ký ngay</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean();
$title = 'Đăng nhập - ' . APP_NAME;
include 'app/Views/layouts/main.php';
?>