<?php ob_start(); ?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>
            <i class="fas fa-cog icon-primary"></i> Quản lý khóa học
        </h2>
        <a href="<?= BASE_URL ?>/instructor/courses/create" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tạo khóa học mới
        </a>
    </div>
    
    <?php if (!empty($courses)): ?>
        <div class="row">
            <?php foreach ($courses as $course): ?>
                <div class="col-lg-6 col-xl-4 mb-4">
                    <div class="card h-100">
                        <?php if ($course['image']): ?>
                            <img src="<?= BASE_URL ?>/<?= UPLOAD_PATH ?>courses/<?= $course['image'] ?>" 
                                 class="card-img-top" alt="<?= htmlspecialchars($course['title']) ?>" style="height: 200px; object-fit: cover;">
                        <?php else: ?>
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="fas fa-book fa-3x text-muted"></i>
                            </div>
                        <?php endif; ?>
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= htmlspecialchars($course['title']) ?></h5>
                            
                            <div class="course-meta mb-2">
                                <?php if ($course['category_name']): ?>
                                    <span><i class="fas fa-tag icon-primary"></i> <?= htmlspecialchars($course['category_name']) ?></span>
                                <?php endif; ?>
                                <span><i class="fas fa-signal icon-primary"></i> <?= htmlspecialchars($course['level']) ?></span>
                                <span><i class="fas fa-clock icon-primary"></i> <?= $course['duration_weeks'] ?> tuần</span>
                                <span><i class="fas fa-calendar icon-primary"></i> <?= date('d/m/Y', strtotime($course['created_at'])) ?></span>
                            </div>
                            
                            <p class="card-text"><?= substr(htmlspecialchars($course['description']), 0, 100) ?>...</p>
                            
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="h6 text-primary mb-0">
                                        <?= $course['price'] > 0 ? number_format($course['price']) . ' VNĐ' : 'Miễn phí' ?>
                                    </span>
                                    <span class="badge bg-success">0 học viên</span>
                                </div>
                                
                                <div class="btn-group w-100">
                                    <a href="<?= BASE_URL ?>/courses/<?= $course['id'] ?>" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-eye"></i> Xem
                                    </a>
                                    <a href="<?= BASE_URL ?>/instructor/courses/<?= $course['id'] ?>/edit" class="btn btn-outline-warning btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <form method="POST" action="<?= BASE_URL ?>/instructor/courses/<?= $course['id'] ?>/delete" class="d-inline">
                                        <button type="submit" class="btn btn-outline-danger btn-sm" 
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa khóa học này?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="text-center py-5">
            <i class="fas fa-book icon-3xl icon-muted mb-4"></i>
            <h4>Chưa có khóa học nào</h4>
            <p class="text-muted mb-4">Hãy tạo khóa học đầu tiên của bạn để bắt đầu chia sẻ kiến thức</p>
            <a href="<?= BASE_URL ?>/instructor/courses/create" class="btn btn-primary btn-lg">
                <i class="fas fa-plus"></i> Tạo khóa học mới
            </a>
        </div>
    <?php endif; ?>
</div>

<?php 
$content = ob_get_clean();
$title = 'Quản lý khóa học - ' . APP_NAME;
include 'app/Views/layouts/main.php';
?>