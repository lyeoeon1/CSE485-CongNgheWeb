<?php ob_start(); ?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>
            <i class="fas fa-book-open icon-primary"></i> Khóa học của tôi
        </h2>
        <a href="<?= BASE_URL ?>/courses" class="btn btn-primary">
            <i class="fas fa-search"></i> Tìm khóa học mới
        </a>
    </div>
    
    <?php if (!empty($myCourses)): ?>
        <div class="row">
            <?php foreach ($myCourses as $course): ?>
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
                                <span><i class="fas fa-user icon-primary"></i> <?= htmlspecialchars($course['instructor_name']) ?></span>
                                <span><i class="fas fa-calendar icon-primary"></i> Đăng ký: <?= date('d/m/Y', strtotime($course['enrolled_date'])) ?></span>
                            </div>
                            
                            <div class="mb-3">
                                <div class="d-flex justify-content-between small mb-1">
                                    <span>Tiến độ học tập</span>
                                    <span><?= $course['progress'] ?>%</span>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-<?= $course['progress'] >= 100 ? 'success' : 'primary' ?>" 
                                         role="progressbar" style="width: <?= $course['progress'] ?>%"></div>
                                </div>
                            </div>
                            
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-<?= $course['status'] == 'active' ? 'success' : ($course['status'] == 'completed' ? 'primary' : 'secondary') ?>">
                                        <?php
                                        switch($course['status']) {
                                            case 'active': echo 'Đang học'; break;
                                            case 'completed': echo 'Hoàn thành'; break;
                                            case 'dropped': echo 'Đã dừng'; break;
                                            default: echo 'Không xác định';
                                        }
                                        ?>
                                    </span>
                                    
                                    <div>
                                        <a href="<?= BASE_URL ?>/courses/<?= $course['id'] ?>" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i> Chi tiết
                                        </a>
                                        <?php if ($course['status'] == 'active'): ?>
                                            <button class="btn btn-sm btn-primary">
                                                <i class="fas fa-play"></i> Tiếp tục học
                                            </button>
                                        <?php endif; ?>
                                    </div>
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
            <h4>Bạn chưa đăng ký khóa học nào</h4>
            <p class="text-muted mb-4">Hãy khám phá và đăng ký các khóa học thú vị để bắt đầu hành trình học tập của bạn</p>
            <a href="<?= BASE_URL ?>/courses" class="btn btn-primary btn-lg">
                <i class="fas fa-search"></i> Khám phá khóa học
            </a>
        </div>
    <?php endif; ?>
</div>

<?php 
$content = ob_get_clean();
$title = 'Khóa học của tôi - ' . APP_NAME;
include 'app/Views/layouts/main.php';
?>