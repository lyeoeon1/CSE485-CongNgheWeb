<?php ob_start(); ?>

<div class="container py-4">
    <div class="row">
        <div class="col-lg-3">
            <!-- Search and Filter Sidebar -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-filter icon-primary"></i> Tìm kiếm & Lọc
                    </h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="<?= BASE_URL ?>/courses">
                        <div class="mb-3">
                            <label for="search" class="form-label">
                                <i class="fas fa-search icon-sm icon-primary"></i> Từ khóa
                            </label>
                            <input type="text" class="form-control" id="search" name="search" 
                                   value="<?= htmlspecialchars($keyword) ?>" placeholder="Tìm kiếm khóa học...">
                        </div>
                        
                        <div class="mb-3">
                            <label for="category" class="form-label">
                                <i class="fas fa-tag icon-sm icon-primary"></i> Danh mục
                            </label>
                            <select class="form-select" id="category" name="category">
                                <option value="">Tất cả danh mục</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['id'] ?>" 
                                            <?= $selectedCategory == $category['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($category['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search"></i> Tìm kiếm
                        </button>
                        <a href="<?= BASE_URL ?>/courses" class="btn btn-outline-secondary w-100 mt-2">
                            <i class="fas fa-times"></i> Xóa bộ lọc
                        </a>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>
                    <i class="fas fa-book icon-primary"></i> Danh sách khóa học
                </h2>
                <span class="text-muted">
                    <i class="fas fa-list"></i> <?= count($courses) ?> khóa học
                </span>
            </div>
            
            <div class="row">
                <?php if (!empty($courses)): ?>
                    <?php foreach ($courses as $course): ?>
                        <div class="col-lg-6 col-xl-4 mb-4">
                            <div class="card h-100 shadow-sm">
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
                                        <?php if ($course['category_name']): ?>
                                            <span><i class="fas fa-tag icon-primary"></i> <?= htmlspecialchars($course['category_name']) ?></span>
                                        <?php endif; ?>
                                        <span><i class="fas fa-signal icon-primary"></i> <?= htmlspecialchars($course['level']) ?></span>
                                        <span><i class="fas fa-clock icon-primary"></i> <?= $course['duration_weeks'] ?> tuần</span>
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
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="fas fa-search icon-3xl icon-muted mb-3"></i>
                            <h4>Không tìm thấy khóa học nào</h4>
                            <p class="text-muted">Thử thay đổi từ khóa tìm kiếm hoặc bộ lọc</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean();
$title = 'Danh sách khóa học - ' . APP_NAME;
include 'app/Views/layouts/main.php';
?>