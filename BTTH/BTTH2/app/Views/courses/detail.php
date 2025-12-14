<?php ob_start(); ?>

<div class="container py-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <?php if ($course['image']): ?>
                    <img src="<?= BASE_URL ?>/<?= UPLOAD_PATH ?>courses/<?= $course['image'] ?>" 
                         class="card-img-top" alt="<?= htmlspecialchars($course['title']) ?>" style="height: 300px; object-fit: cover;">
                <?php else: ?>
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                        <i class="fas fa-book fa-5x text-muted"></i>
                    </div>
                <?php endif; ?>
                
                <div class="card-body">
                    <h1 class="card-title"><?= htmlspecialchars($course['title']) ?></h1>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-2">
                                <i class="fas fa-user icon-primary"></i> <strong>Giảng viên:</strong> <?= htmlspecialchars($course['instructor_name']) ?>
                            </p>
                            <?php if ($course['category_name']): ?>
                                <p class="text-muted mb-2">
                                    <i class="fas fa-tag icon-primary"></i> <strong>Danh mục:</strong> <?= htmlspecialchars($course['category_name']) ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-2">
                                <i class="fas fa-signal icon-primary"></i> <strong>Cấp độ:</strong> <?= htmlspecialchars($course['level']) ?>
                            </p>
                            <p class="text-muted mb-2">
                                <i class="fas fa-clock icon-primary"></i> <strong>Thời lượng:</strong> <?= $course['duration_weeks'] ?> tuần
                            </p>
                        </div>
                    </div>
                    
                    <h3>
                        <i class="fas fa-info-circle icon-primary"></i> Mô tả khóa học
                    </h3>
                    <div class="course-description">
                        <?= nl2br(htmlspecialchars($course['description'])) ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card sticky-top" style="top: 20px;">
                <div class="card-body text-center">
                    <h3 class="text-primary mb-3">
                        <?= $course['price'] > 0 ? number_format($course['price']) . ' VNĐ' : 'Miễn phí' ?>
                    </h3>
                    
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <?php if ($_SESSION['user_role'] == 0): // Student ?>
                            <?php if ($isEnrolled): ?>
                                <div class="alert alert-success">
                                    <i class="fas fa-check-circle"></i> Bạn đã đăng ký khóa học này
                                </div>
                                <a href="<?= BASE_URL ?>/student/courses" class="btn btn-primary w-100">
                                    <i class="fas fa-play"></i> Vào học
                                </a>
                            <?php else: ?>
                                <form method="POST" action="<?= BASE_URL ?>/student/enroll/<?= $course['id'] ?>">
                                    <button type="submit" class="btn btn-success btn-lg w-100">
                                        <i class="fas fa-plus"></i> Đăng ký khóa học
                                    </button>
                                </form>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="alert alert-info">
                                Chỉ học viên mới có thể đăng ký khóa học
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="alert alert-warning">
                            Vui lòng đăng nhập để đăng ký khóa học
                        </div>
                        <a href="<?= BASE_URL ?>/login" class="btn btn-primary w-100 mb-2">
                            <i class="fas fa-sign-in-alt"></i> Đăng nhập
                        </a>
                        <a href="<?= BASE_URL ?>/register" class="btn btn-outline-primary w-100">
                            <i class="fas fa-user-plus"></i> Đăng ký tài khoản
                        </a>
                    <?php endif; ?>
                    
                    <hr>
                    
                    <div class="course-info">
                        <div class="d-flex justify-content-between mb-2">
                            <span><i class="fas fa-calendar icon-primary"></i> Ngày tạo:</span>
                            <span><?= date('d/m/Y', strtotime($course['created_at'])) ?></span>
                        </div>
                        
                        <?php if ($course['updated_at'] != $course['created_at']): ?>
                            <div class="d-flex justify-content-between mb-2">
                                <span><i class="fas fa-edit icon-primary"></i> Cập nhật:</span>
                                <span><?= date('d/m/Y', strtotime($course['updated_at'])) ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean();
$title = htmlspecialchars($course['title']) . ' - ' . APP_NAME;
include 'app/Views/layouts/main.php';
?>