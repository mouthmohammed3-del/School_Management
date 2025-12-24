<?php
// نموذج إضافة/تعديل فئة
$isEditMode = isset($_GET['do']) && $_GET['do'] == 'Edit' && isset($_GET['id']);
$pageTitle = $isEditMode ? 'تعديل الفئة' : 'إضافة فئة جديدة';
?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas <?php echo $isEditMode ? 'fa-edit' : 'fa-plus-circle'; ?> me-2"></i><?php echo $pageTitle; ?></h4>
            </div>
            <div class="card-body">
                <form id="categoryForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="categoryName" class="form-label">اسم الفئة <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="categoryName" required 
                                   placeholder="أدخل اسم الفئة" 
                                   value="<?php echo $isEditMode ? 'المواد العلمية' : ''; ?>">
                            <div class="form-text">يجب أن يكون اسم الفئة فريداً وواضحاً.</div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="categoryParent" class="form-label">الفئة الرئيسية (اختياري)</label>
                            <select class="form-select" id="categoryParent">
                                <option value="">بدون فئة رئيسية</option>
                                <option value="1" <?php echo $isEditMode ? 'selected' : ''; ?>>المواد العلمية</option>
                                <option value="2">المواد الأدبية</option>
                                <option value="3">اللغات الأجنبية</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="categoryDescription" class="form-label">وصف الفئة</label>
                        <textarea class="form-control" id="categoryDescription" rows="4" 
                                  placeholder="أدخل وصفاً مختصراً للفئة..."><?php echo $isEditMode ? 'تضم مواد الرياضيات والفيزياء والكيمياء' : ''; ?></textarea>
                        <div class="form-text">يمكنك إضافة وصف مفصل يوضح محتوى هذه الفئة.</div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="categoryIcon" class="form-label">أيقونة الفئة (اختياري)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-icons"></i></span>
                                <input type="text" class="form-control" id="categoryIcon" 
                                       placeholder="مثال: fas fa-book"
                                       value="<?php echo $isEditMode ? 'fas fa-flask' : ''; ?>">
                            </div>
                            <div class="form-text">أدخل رمز FontAwesome مثل: fas fa-book</div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="categoryColor" class="form-label">لون الفئة (اختياري)</label>
                            <input type="color" class="form-control form-control-color" id="categoryColor" 
                                   value="#3498db" title="اختر لون الفئة">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="categoryStatus" class="form-label">حالة الفئة</label>
                            <select class="form-select" id="categoryStatus">
                                <option value="1" selected>نشط</option>
                                <option value="0">غير نشط</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="categoryOrder" class="form-label">ترتيب العرض</label>
                            <input type="number" class="form-control" id="categoryOrder" 
                                   min="1" max="100" value="1">
                            <div class="form-text">رقم يحدد ترتيب عرض الفئة في القوائم.</div>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <div class="d-flex justify-content-between">
                        <a href="categories.php" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-right me-2"></i>العودة للقائمة
                        </a>
                        
                        <div>
                            <button type="button" class="btn btn-outline-primary me-2" id="saveDraft">
                                <i class="fas fa-save me-2"></i>حفظ كمسودة
                            </button>
                            
                            <button type="submit" class="btn btn-primary">
                                <i class="fas <?php echo $isEditMode ? 'fa-sync' : 'fa-check-circle'; ?> me-2"></i>
                                <?php echo $isEditMode ? 'تحديث الفئة' : 'إضافة الفئة'; ?>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- معاينة الفئة -->
        <div class="card mt-4">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="fas fa-eye me-2"></i>معاينة الفئة</h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center p-3 border rounded" id="categoryPreview" style="background-color: #f8f9fa;">
                    <div class="me-3" id="previewIcon">
                        <i class="fas fa-flask fa-2x" style="color: #3498db;"></i>
                    </div>
                    <div>
                        <h5 id="previewName" class="mb-1">المواد العلمية</h5>
                        <p class="text-muted mb-0" id="previewDescription">تضم مواد الرياضيات والفيزياء والكيمياء</p>
                    </div>
                </div>
                <p class="text-muted mt-2 mb-0"><small>هذه معاينة لكيفية ظهور الفئة في النظام.</small></p>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // تحديث المعاينة عند تغيير المدخلات
        $('#categoryName').on('keyup', function() {
            $('#previewName').text($(this).val() || 'اسم الفئة');
        });
        
        $('#categoryDescription').on('keyup', function() {
            $('#previewDescription').text($(this).val() || 'وصف الفئة');
        });
        
        $('#categoryIcon').on('keyup', function() {
            const iconClass = $(this).val() || 'fas fa-folder';
            $('#previewIcon').html(`<i class="${iconClass} fa-2x" style="color: #3498db;"></i>`);
        });
        
        $('#categoryColor').on('change', function() {
            const color = $(this).val();
            $('#previewIcon i').css('color', color);
        });
        
        // إرسال النموذج
        $('#categoryForm').on('submit', function(e) {
            e.preventDefault();
            
            // جمع البيانات من النموذج
            const formData = {
                name: $('#categoryName').val(),
                parent: $('#categoryParent').val(),
                description: $('#categoryDescription').val(),
                icon: $('#categoryIcon').val(),
                color: $('#categoryColor').val(),
                status: $('#categoryStatus').val(),
                order: $('#categoryOrder').val()
            };
            
            // محاكاة إرسال البيانات إلى الخادم
            console.log('بيانات الفئة المرسلة:', formData);
            
            // عرض رسالة نجاح
            showAlert('تم حفظ الفئة بنجاح!', 'success');
            
            // إعادة التوجيه بعد 2 ثانية
            setTimeout(() => {
                window.location.href = 'categories.php';
            }, 2000);
        });
        
        // زر حفظ كمسودة
        $('#saveDraft').on('click', function() {
            showAlert('تم حفظ الفئة كمسودة', 'info');
        });
        
        // عرض رسالة تنبيه
        function showAlert(message, type = 'info') {
            const alertClass = type === 'success' ? 'alert-success' : 
                             type === 'warning' ? 'alert-warning' : 
                             type === 'danger' ? 'alert-danger' : 'alert-info';
            
            const alertHtml = `
                <div class="alert ${alertClass} alert-custom alert-dismissible fade show position-fixed top-0 end-0 m-4" style="z-index: 9999; max-width: 350px;" role="alert">
                    <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'warning' ? 'fa-exclamation-triangle' : type === 'danger' ? 'fa-times-circle' : 'fa-info-circle'} me-2"></i>
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            
            $('body').append(alertHtml);
            
            // إزالة التنبيه تلقائياً بعد 5 ثوان
            setTimeout(() => {
                $('.alert-custom').alert('close');
            }, 5000);
        }
    });
</script>