<?php ob_start(); ?>

<!-- Hero Section -->
<div class="hero-section bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold">Học trực tuyến cùng chuyên gia</h1>
                <p class="lead">Khám phá hàng nghìn khóa học chất lượng cao từ các giảng viên hàng đầu</p>
                <a href="<?= BASE_URL ?>/courses" class="btn btn-light btn-lg">
                    <i class="fas fa-search"></i> Khám phá khóa học
                </a>
            </div>
            <div class="col-lg-6">
                <img src="<?= BASE_URL ?>/public/assets/images/hero-image.jpg" alt="Online Learning" class="img-fluid rounded">
            </div>
        </div>
    </div>
</div>

<!-- Featured Courses -->
<div class="container py-5">
    <h2 class="text-center mb-5">Khóa học nổi bật</h2>
    
    <div class="row">
        <?php if (!empty($courses)): ?>
            <?php foreach ($courses as $course): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <?php if ($course['image']): ?>
                            <img src="<?= BASE_URL ?>/<?= UPLOAD_PATH ?>courses/<?= $course['image'] ?>" class="card-img-top" alt="<?= htmlspecialchars($course['title']) ?>">
                        <?php else: ?>
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="fas fa-book fa-3x text-muted"></i>
                            </div>
                        <?php endif; ?>
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= htmlspecialchars($course['title']) ?></h5>
                            <div class="course-meta mb-2">
                                <span><i class="fas fa-user icon-primary"></i> <?= htmlspecialchars($course['instructor_name']) ?></span>
                                <?php if ($course['category_name']): ?>
                                    <span><i class="fas fa-tag icon-primary"></i> <?= htmlspecialchars($course['category_name']) ?></span>
                                <?php endif; ?>
                            </div>
                            <p class="card-text"><?= substr(htmlspecialchars($course['description']), 0, 100) ?>...</p>
                            
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="h5 text-primary mb-0">
                                        <?= $course['price'] > 0 ? number_format($course['price']) . ' VNĐ' : 'Miễn phí' ?>
                                    </span>
                                    <a href="<?= BASE_URL ?>/courses/<?= $course['id'] ?>" class="btn btn-primary">
                                        <i class="fas fa-eye"></i> Xem chi tiết
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <p class="text-muted">Chưa có khóa học nào.</p>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="text-center mt-4">
        <a href="<?= BASE_URL ?>/courses" class="btn btn-outline-primary btn-lg">
            <i class="fas fa-list"></i> Xem tất cả khóa học
        </a>
    </div>
</div>

<!-- Categories -->
<?php if (!empty($categories)): ?>
<div class="bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-5">Danh mục khóa học</h2>
        <div class="row">
            <?php foreach ($categories as $category): ?>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <i class="fas fa-folder icon-3xl icon-primary mb-3"></i>
                            <h5 class="card-title"><?= htmlspecialchars($category['name']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($category['description']) ?></p>
                            <a href="<?= BASE_URL ?>/courses?category=<?= $category['id'] ?>" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-right"></i> Xem khóa học
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php 
$content = ob_get_clean();
$title = 'Trang chủ - ' . APP_NAME;
include 'app/Views/layouts/main.php';
?>