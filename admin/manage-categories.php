<?php
// هذا الملف يحتوي على محتوى صفحة إدارة الفئات

// محاكاة بيانات الفئات من قاعدة البيانات
$categories = [
    ['id' => 1, 'name' => 'المواد العلمية', 'description' => 'تضم مواد الرياضيات والفيزياء والكيمياء', 'items_count' => 15, 'status' => 1, 'created_at' => '2023-01-15'],
    ['id' => 2, 'name' => 'المواد الأدبية', 'description' => 'تضم مواد اللغة العربية والاجتماعيات', 'items_count' => 12, 'status' => 1, 'created_at' => '2023-02-10'],
    ['id' => 3, 'name' => 'اللغات الأجنبية', 'description' => 'تضم مواد اللغة الإنجليزية والفرنسية', 'items_count' => 8, 'status' => 1, 'created_at' => '2023-03-05'],
    ['id' => 4, 'name' => 'الأنشطة الطلابية', 'description' => 'تشمل الأنشطة الرياضية والفنية', 'items_count' => 20, 'status' => 0, 'created_at' => '2023-03-20'],
    ['id' => 5, 'name' => 'الصفوف الدراسية', 'description' => 'تصنيف حسب المستوى الدراسي', 'items_count' => 10, 'status' => 1, 'created_at' => '2023-04-01'],
    ['id' => 6, 'name' => 'الامتحانات', 'description' => 'تصنيفات الامتحانات والتقييمات', 'items_count' => 5, 'status' => 1, 'created_at' => '2023-04-15'],
];
?>

<div class="row mb-4">
    <!-- بطاقات الإحصائيات -->
    <div class="col-md-3">
        <div class="card stat-card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">إجمالي الفئات</h5>
                        <h2 class="mb-0"><?php echo count($categories); ?></h2>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-sitemap"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card stat-card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">الفئات النشطة</h5>
                        <h2 class="mb-0"><?php echo count(array_filter($categories, fn($cat) => $cat['status'] == 1)); ?></h2>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card stat-card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">الفئات غير النشطة</h5>
                        <h2 class="mb-0"><?php echo count(array_filter($categories, fn($cat) => $cat['status'] == 0)); ?></h2>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-pause-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card stat-card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">إجمالي العناصر</h5>
                        <h2 class="mb-0"><?php echo array_sum(array_column($categories, 'items_count')); ?></h2>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-boxes"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-8">
        <div class="search-box">
            <input type="text" id="searchCategories" class="form-control" placeholder="ابحث عن فئة...">
            <i class="fas fa-search"></i>
        </div>
    </div>
    <div class="col-md-4 text-md-end">
        <div class="action-buttons">
            <a href="categories.php?do=Add" class="btn btn-primary">
                <i class="fas fa-plus-circle me-2"></i>إضافة فئة جديدة
            </a>
            <button class="btn btn-outline-secondary" id="refreshTable">
                <i class="fas fa-redo"></i>
            </button>
        </div>
    </div>
</div>

<div class="categories-table">
    <?php if (count($categories) > 0): ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th width="50">#</th>
                    <th class="sortable" data-column="name">
                        اسم الفئة <i class="fas fa-sort ms-1"></i>
                    </th>
                    <th>الوصف</th>
                    <th class="sortable" data-column="items">
                        عدد العناصر <i class="fas fa-sort ms-1"></i>
                    </th>
                    <th>الحالة</th>
                    <th class="sortable" data-column="date">
                        تاريخ الإضافة <i class="fas fa-sort ms-1"></i>
                    </th>
                    <th width="150">الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                    <tr class="category-row" data-category-id="<?php echo $category['id']; ?>">
                        <td><?php echo $category['id']; ?></td>
                        <td>
                            <strong><?php echo $category['name']; ?></strong>
                        </td>
                        <td>
                            <small class="text-muted"><?php echo $category['description']; ?></small>
                        </td>
                        <td>
                            <span class="badge bg-secondary"><?php echo $category['items_count']; ?></span>
                        </td>
                        <td>
                            <?php if ($category['status'] == 1): ?>
                                <span class="badge-status badge-active">
                                    <i class="fas fa-circle me-1" style="font-size: 8px;"></i>نشط
                                </span>
                            <?php else: ?>
                                <span class="badge-status badge-inactive">
                                    <i class="fas fa-circle me-1" style="font-size: 8px;"></i>غير نشط
                                </span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo $category['created_at']; ?></td>
                        <td>
                            <button class="btn btn-info btn-action toggle-status" 
                                    data-id="<?php echo $category['id']; ?>" 
                                    data-status="<?php echo $category['status']; ?>"
                                    title="<?php echo $category['status'] == 1 ? 'إيقاف' : 'تفعيل'; ?>">
                                <i class="fas <?php echo $category['status'] == 1 ? 'fa-pause' : 'fa-play'; ?>"></i>
                            </button>
                            
                            <a href="categories.php?do=Edit&id=<?php echo $category['id']; ?>" 
                               class="btn btn-warning btn-action" title="تعديل">
                                <i class="fas fa-edit"></i>
                            </a>
                            
                            <button class="btn btn-danger btn-action delete-category" 
                                    data-id="<?php echo $category['id']; ?>" 
                                    data-name="<?php echo $category['name']; ?>"
                                    title="حذف">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="empty-state">
            <i class="fas fa-sitemap"></i>
            <h4>لا توجد فئات مضافة بعد</h4>
            <p class="mb-4">يمكنك البدء بإضافة فئة جديدة للنظام</p>
            <a href="categories.php?do=Add" class="btn btn-primary btn-lg">
                <i class="fas fa-plus-circle me-2"></i>إضافة أول فئة
            </a>
        </div>
    <?php endif; ?>
</div>

<?php if (count($categories) > 0): ?>
<div class="row mt-4">
    <div class="col-md-6">
        <p class="text-muted">عرض <?php echo count($categories); ?> من <?php echo count($categories); ?> فئة</p>
    </div>
    <div class="col-md-6">
        <nav aria-label="تصفح الفئات" class="d-flex justify-content-end">
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">السابق</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">التالي</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
<?php endif; ?>