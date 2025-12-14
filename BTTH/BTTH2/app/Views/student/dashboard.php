<?php ob_start(); ?>

<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <h2>
                <i class="fas fa-tachometer-alt icon-primary"></i> Dashboard Học viên
            </h2>
            <p class="text-muted">Chào mừng <?= $_SESSION['user_name'] ?> đến với hệ thống học trực tuyến</p>
        </div>
    </div>
    
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4><?= count($myCourses) ?></h4>
                            <p class="mb-0">Khóa học đã đăng ký</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-book icon-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <?php 
                            $completedCourses = array_filter($myCourses, function($course) {
                                return $course['status'] == 'completed';
                            });
                            ?>
                            <h4><?= count($completedCourses) ?></h4>
                            <p class="mb-0">Khóa học hoàn thành</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-check-circle icon-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <?php 
                            $activeCourses = array_filter($myCourses, function($course) {
                                return $course['status'] == 'active';
                            });
                            ?>
                            <h4><?= count($activeCourses) ?></h4>
                            <p class="mb-0">Đang học</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-play-circle icon-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <?php 
                            $avgProgress = !empty($myCourses) ? 
                                array_sum(array_column($myCourses, 'progress')) / count($myCourses) : 0;
                            ?>
                            <h4><?= round($avgProgress) ?>%</h4>
                            <p class="mb-0">Tiến độ trung bình</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-chart-line icon-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-clock icon-primary"></i> Khóa học gần đây
                    </h5>
                    <a href="<?= BASE_URL ?>/student/courses" class="btn btn-sm btn-primary">
                        <i class="fas fa-list"></i> Xem tất cả
                    </a>
                </div>
                <div class="card-body">
                    <?php if (!empty($myCourses)): ?>
                        <div class="row">
                            <?php foreach (array_slice($myCourses, 0, 3) as $course): ?>
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title"><?= htmlspecialchars($course['title']) ?></h6>
                                            <p class="card-text text-muted small">
                                                <i class="fas fa-user icon-primary"></i> <?= htmlspecialchars($course['instructor_name']) ?>
                                            </p>
                                            
                                            <div class="mb-2">
                                                <div class="d-flex justify-content-between small">
                                                    <span>Tiến độ</span>
                                                    <span><?= $course['progress'] ?>%</span>
                                                </div>
                                                <div class="progress" style="height: 5px;">
                                                    <div class="progress-bar" role="progressbar" 
                                                         style="width: <?= $course['progress'] ?>%"></div>
                                                </div>
                                            </div>
                                            
                                            <span class="badge bg-<?= $course['status'] == 'active' ? 'success' : ($course['status'] == 'completed' ? 'primary' : 'secondary') ?>">
                                                <?= $course['status'] == 'active' ? 'Đang học' : ($course['status'] == 'completed' ? 'Hoàn thành' : 'Tạm dừng') ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fas fa-book icon-3xl icon-muted mb-3"></i>
                            <h5>Chưa có khóa học nào</h5>
                            <p class="text-muted">Hãy khám phá và đăng ký các khóa học thú vị</p>
                            <a href="<?= BASE_URL ?>/courses" class="btn btn-primary">
                                <i class="fas fa-search"></i> Khám phá khóa học
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean();
$title = 'Dashboard Học viên - ' . APP_NAME;
include 'app/Views/layouts/main.php';
?>