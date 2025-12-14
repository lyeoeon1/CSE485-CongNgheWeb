<?php ob_start(); ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">
                        <i class="fas fa-edit icon-primary"></i> Chỉnh sửa khóa học
                    </h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= BASE_URL ?>/instructor/courses/<?= $course['id'] ?>/edit">
                        <div class="mb-3">
                            <label for="title" class="form-label">
                                <i class="fas fa-heading icon-sm icon-primary"></i> Tên khóa học <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="title" name="title" required 
                                   value="<?= htmlspecialchars($course['title']) ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">
                                <i class="fas fa-align-left icon-sm icon-primary"></i> Mô tả khóa học <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" id="description" name="description" rows="5" required><?= htmlspecialchars($course['description']) ?></textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="category_id" class="form-label">
                                    <i class="fas fa-tag icon-sm icon-primary"></i> Danh mục
                                </label>
                                <select class="form-select" id="category_id" name="category_id">
                                    <option value="">Chọn danh mục</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category['id'] ?>" 
                                                <?= $course['category_id'] == $category['id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($category['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="level" class="form-label">
                                    <i class="fas fa-signal icon-sm icon-primary"></i> Cấp độ
                                </label>
                                <select class="form-select" id="level" name="level">
                                    <option value="Beginner" <?= $course['level'] == 'Beginner' ? 'selected' : '' ?>>
                                        Beginner (Cơ bản)
                                    </option>
                                    <option value="Intermediate" <?= $course['level'] == 'Intermediate' ? 'selected' : '' ?>>
                                        Intermediate (Trung cấp)
                                    </option>
                                    <option value="Advanced" <?= $course['level'] == 'Advanced' ? 'selected' : '' ?>>
                                        Advanced (Nâng cao)
                                    </option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">
                                    <i class="fas fa-dollar-sign icon-sm icon-primary"></i> Giá khóa học (VNĐ)
                                </label>
                                <input type="number" class="form-control" id="price" name="price" min="0" 
                                       value="<?= $course['price'] ?>">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="duration_weeks" class="form-label">
                                    <i class="fas fa-clock icon-sm icon-primary"></i> Thời lượng (tuần)
                                </label>
                                <input type="number" class="form-control" id="duration_weeks" name="duration_weeks" 
                                       min="1" value="<?= $course['duration_weeks'] ?>" required>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="image" class="form-label">
                                <i class="fas fa-image icon-sm icon-primary"></i> Hình ảnh khóa học
                            </label>
                            <?php if ($course['image']): ?>
                                <div class="mb-2">
                                    <img src="<?= BASE_URL ?>/<?= UPLOAD_PATH ?>courses/<?= $course['image'] ?>" 
                                         alt="Current image" class="img-thumbnail" style="max-height: 150px;">
                                    <p class="text-muted small">Hình ảnh hiện tại</p>
                                </div>
                            <?php endif; ?>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            <div class="form-text">Chọn hình ảnh mới để thay thế (tùy chọn)</div>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="<?= BASE_URL ?>/instructor/courses" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Quay lại
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Cập nhật khóa học
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean();
$title = 'Chỉnh sửa khóa học - ' . APP_NAME;
include 'app/Views/layouts/main.php';
?>