<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="<?= BASE_URL ?>">
            <i class="fas fa-graduation-cap"></i> <?= APP_NAME ?>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>">
                        <i class="fas fa-home"></i> Trang chủ
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>/courses">
                        <i class="fas fa-book"></i> Khóa học
                    </a>
                </li>
            </ul>
            
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i> <?= $_SESSION['user_name'] ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <?php if ($_SESSION['user_role'] == 0): ?>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>/student/dashboard">
                                    <i class="fas fa-tachometer-alt"></i> Dashboard
                                </a></li>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>/student/courses">
                                    <i class="fas fa-book-open"></i> Khóa học của tôi
                                </a></li>
                            <?php elseif ($_SESSION['user_role'] == 1): ?>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>/instructor/dashboard">
                                    <i class="fas fa-tachometer-alt"></i> Dashboard
                                </a></li>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>/instructor/courses">
                                    <i class="fas fa-cog"></i> Quản lý khóa học
                                </a></li>
                            <?php endif; ?>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= BASE_URL ?>/logout">
                                <i class="fas fa-sign-out-alt"></i> Đăng xuất
                            </a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/login">
                            <i class="fas fa-sign-in-alt"></i> Đăng nhập
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/register">
                            <i class="fas fa-user-plus"></i> Đăng ký
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>