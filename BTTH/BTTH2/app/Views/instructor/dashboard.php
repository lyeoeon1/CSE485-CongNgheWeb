<?php ob_start(); ?>

<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <h2>
                <i class="fas fa-tachometer-alt icon-primary"></i> Dashboard Giảng viên
            </h2>
            <p class="text-muted">Chào mừng <?= $_SESSION['user_name'] ?> đến với bảng điều khiển giảng viên</p>
        </div>
    </div>
    
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4><?= count($myCourses) ?></h4>
                            <p class="mb-0">Khóa học của tôi</p>
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
                            <h4>0</h4>
                            <p class="mb-0">Tổng học viên</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-users icon-2xl"></i>
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
                            <h4>0</h4>
                            <p class="mb-0">Bài học</p>
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
                            <h4>0</h4>
                            <p class="mb-0">Tài liệu</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-file icon-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-book icon-primary"></i> Khóa học của tôi
                    </h5>
                    <a href="<?= BASE_URL ?>/instructor/courses/create" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Tạo khóa học mới
                    </a>
                </div>
                <div class="card-body">
                    <?php if (!empty($myCourses)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tên khóa học</th>
                                        <th>Danh mục</th>
                                        <th>Giá</th>
                                        <th>Ngày tạo</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($myCourses as $course): ?>
                                        <tr>
                                            <td>
                                                <strong><?= htmlspecialchars($course['title']) ?></strong>
                                                <br><small class="text-muted"><?= substr(htmlspecialchars($course['description']), 0, 50) ?>...</small>
                                            </td>
                                            <td><?= htmlspecialchars($course['category_name'] ?? 'Chưa phân loại') ?></td>
                                            <td><?= $course['price'] > 0 ? number_format($course['price']) . ' VNĐ' : 'Miễn phí' ?></td>
                                            <td><?= date('d/m/Y', strtotime($course['created_at'])) ?></td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="<?= BASE_URL ?>/courses/<?= $course['id'] ?>" class="btn btn-outline-primary" title="Xem">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="<?= BASE_URL ?>/instructor/courses/<?= $course['id'] ?>/edit" class="btn btn-outline-warning" title="Sửa">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form method="POST" action="<?= BASE_URL ?>/instructor/courses/<?= $course['id'] ?>/delete" class="d-inline">
                                                        <button type="submit" class="btn btn-outline-danger" title="Xóa" 
                                                                onclick="return confirm('Bạn có chắc chắn muốn xóa khóa học này?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fas fa-book icon-3xl icon-muted mb-3"></i>
                            <h5>Chưa có khóa học nào</h5>
                            <p class="text-muted">Hãy tạo khóa học đầu tiên của bạn</p>
                            <a href="<?= BASE_URL ?>/instructor/courses/create" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tạo khóa học mới
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-bar icon-primary"></i> Thống kê nhanh
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <span>Khóa học hoạt động:</span>
                        <strong><?= count($myCourses) ?></strong>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Tổng học viên:</span>
                        <strong>0</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Đánh giá trung bình:</span>
                        <strong>
                            <i class="fas fa-star icon-warning"></i> 0.0
                        </strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean();
$title = 'Dashboard Giảng viên - ' . APP_NAME;
include 'app/Views/layouts/main.php';
?>