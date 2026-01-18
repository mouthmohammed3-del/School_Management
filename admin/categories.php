
<?php
session_start();

$pageTitle = 'Categories';

?>

    <?php
if(isset($_SESSION['Username'])){
  include "init.php";


  $do = isset($_GET["do"]) ? $_GET["do"] : 'Manage';

  // ============================================================
  // قسم إدارة الفئات (عرض الفئات)
  // ============================================================
  if($do == 'Manage'){

    // جلب جميع الفئات من قاعدة البيانات
    $stmt = $db->prepare("SELECT * FROM categories ORDER BY category_id");
    $stmt->execute();
    $categories = $stmt->fetchAll();

    ?>
    
    
    <h1 class="text-center">Manage Categories </h1>
    <div class="dbtainer">
      <div class="table-responsive">
        <table class="main-table table table-bordered text-center">
           <tr class="table-dark"> 

                <th>#</th>
                <th>Categories Name</th>
                <th>Control</th>
                <th>Imgae</th>
              </tr>
          
          
            <?php
            if(empty($categories)){
              
              echo '<tr><th colspan="4">لا توجد فئات مضافة</th></tr>';
            } else {
              
              foreach($categories as $category){
                ?>

                <tr >
                  <td><?php echo $category['category_id']; ?></td>
                  <td><?php echo $category['category_name']; ?></td>
                  <td>
                    <a href="categories.php?do=Edit&category_id=<?php echo $category['category_id']; ?>" class="btn btn-warning btn-sm fa fa-edit">Edit</a>
                    <a href="categories.php?do=Delete&category_id=<?php echo $category['category_id']; ?>" class="btn btn-danger btn-sm dbfirm fa fa-trash">delete</a>
                  </td>
                  <td>
    <?php 
    if(!empty($category['category_image'])) {
        echo "<img src='uploads/categories/" . $category['category_image'] . "' alt='' style='width:50px; height:50px; border-radius:50%;'>";
    } else {
        echo "No Image";
    }
    ?>
</td>
                </tr>
                <?php
              }
            }
            ?>
          </tbody>
        </table>
      </div>
      <a href="categories.php?do=Add" class="btn btn-primary btn-lg">
        <i class="fa fa-plus"></i>Add categories  
      </a>
    </div>
    <?php
  }

  // ============================================================
  // قسم إضافة فئة جديدة
  // ============================================================
  elseif($do == 'Add'){

    ?>
    <!-- Simple Design -->
    <div class="container mt-4">
        <h1 class="text-center mb-4">Add New Category</h1>
        
        <form action="categories.php?do=Insert" method="POST" class="category-form" enctype="multipart/form-data">
            
            <!-- Category ID -->
            <div class="form-group">
                <label for="category_id" class="form-label">Category ID</label>
                <div class="input-container">
                    <i class="fas fa-hashtag input-icon"></i>
                    <input type="number" 
                           id="category_id" 
                           name="category_id" 
                           class="form-control" 
                           required 
                           min="1" 
                           max="127"
                           placeholder="Enter category ID">
                </div>
                <div class="form-text">Category ID must be between 1 and 127</div>
            </div>
            
            <!-- Category Name -->
            <div class="form-group">
                <label for="category_name" class="form-label">Category Name</label>
                <div class="input-container">
                    <i class="fas fa-tag input-icon"></i>
                    <input type="text" 
                           id="category_name" 
                           name="category_name" 
                           class="form-control" 
                           required 
                           maxlength="20"
                           placeholder="Enter category name">
                </div>
                <div class="form-text">Category name must not exceed 20 characters</div>
            </div>
            <div class="form-group">
    <label for="category_image" class="form-label">Category Image</label>
    <div class="input-container">
        <i class="fas fa-image input-icon"></i>
        <input type="file" id="category_image" name="category_image" class="form-control" required>
    </div>
    <div class="form-text">Allowed formats: JPG, PNG, GIF</div>
</div>
            
            <!-- Buttons -->
            <div class="form-actions">
                <a href="categories.php" class="btn btn-cancel">
                    <i class="fas fa-times"></i> Cancel
                </a>
                <button type="submit" class="btn btn-submit">
                    <i class="fas fa-plus-circle"></i> Add Category
                </button>
            </div>
            
        </form>
    </div>
    <!-- //////////////////// -->
    <style>
    /* start category */

    /* Professional CSS for Add Category Page */
    
    /* Page Container */
    .container.mt-4 {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        animation: fadeIn 0.5s ease-in;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* Page Title */
    .text-center.mb-4 {
        color: #2c3e50;
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 40px !important;
        padding-bottom: 15px;
        border-bottom: 3px solid #3498db;
        position: relative;
    }
    
    .text-center.mb-4::after {
        content: '';
        position: absolute;
        bottom: -3px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 3px;
        background: #2ecc71;
    }
    
    /* Form Styling */
    .category-form {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border-radius: 15px;
        padding: 40px !important;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        border: 1px solid #e1e5eb;
        transition: all 0.3s ease;
    }
    
    .category-form:hover {
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.12);
        transform: translateY(-5px);
    }
    
    /* Form Groups */
    .form-group {
        margin-bottom: 30px;
        position: relative;
    }
    
    .form-label {
        display: block;
        color: #2c3e50;
        font-weight: 600;
        margin-bottom: 10px;
        font-size: 1.1rem;
        transition: color 0.3s;
    }
    
    /* Input Container */
    .input-container {
        position: relative;
        display: flex;
        align-items: center;
    }
    
    .input-icon {
        position: absolute;
        left: 15px;
        color: #7f8c8d;
        font-size: 1.2rem;
        z-index: 2;
        transition: color 0.3s;
    }
    
    /* Form Controls */
    .form-control {
        width: 100%;
        padding: 14px 15px 14px 45px;
        border: 2px solid #e0e6ed;
        border-radius: 10px;
        font-size: 1rem;
        background: white;
        transition: all 0.3s ease;
        color: #2c3e50;
    }
    
    .form-control:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        outline: none;
        padding-left: 50px;
    }
    
    .form-control:focus + .input-icon {
        color: #3498db;
    }
    
    /* Form Text */
    .form-text {
        color: #7f8c8d;
        font-size: 0.9rem;
        margin-top: 8px;
        padding-left: 10px;
        font-style: italic;
        display: flex;
        align-items: center;
    }
    
    .form-text::before {
        content: '💡';
        margin-right: 8px;
        font-size: 1rem;
    }
    
    /* Form Actions */
    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 40px;
        padding-top: 25px;
        border-top: 1px solid #eaeaea;
    }
    
    /* Buttons */
    .btn {
        padding: 14px 30px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 1rem;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        min-width: 140px;
    }
    
    .btn-cancel {
        background: #f8f9fa;
        color: #6c757d;
        border: 2px solid #dee2e6;
    }
    
    .btn-cancel:hover {
        background: #e9ecef;
        color: #495057;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border-color: #adb5bd;
    }
    
    .btn-submit {
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        color: white;
        border: 2px solid #2980b9;
    }
    
    .btn-submit:hover {
        background: linear-gradient(135deg, #2980b9 0%, #1c6ea4 100%);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(52, 152, 219, 0.3);
    }
    
    .btn-submit:active {
        transform: translateY(-1px);
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .container.mt-4 {
            padding: 15px;
            margin: 30px auto;
        }
        
        .category-form {
            padding: 30px !important;
        }
        
        .text-center.mb-4 {
            font-size: 1.8rem;
        }
        
        .form-actions {
            flex-direction: column;
            gap: 15px;
        }
        
        .btn {
            width: 100%;
        }
    }
    
    @media (max-width: 576px) {
        .category-form {
            padding: 20px !important;
        }
        
        .text-center.mb-4 {
            font-size: 1.6rem;
        }
        
        .form-control {
            padding: 12px 15px 12px 40px;
        }
    }
    
    /* Focus State for Labels */
    .form-control:focus ~ .form-label {
        color: #3498db;
    }
    
    /* Validation Styles */
    .form-control:invalid {
        border-color: #e74c3c;
    }
    
    .form-control:invalid:focus {
        box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.2);
    }
    
    /* Success State */
    .form-control:valid {
        border-color: #2ecc71;
    }
    
    .form-control:valid:focus {
        box-shadow: 0 0 0 3px rgba(46, 204, 113, 0.2);
    }
    
    /* Number Input Spinner */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        opacity: 0.6;
        cursor: pointer;
    }
    
    /* Placeholder Styling */
    .form-control::placeholder {
        color: #adb5bd;
        opacity: 0.7;
    }
    
    /* Floating Label Effect (Optional) */
    .form-group.focused .form-label {
        color: #3498db;
        transform: translateY(-5px);
        font-size: 0.9rem;
    }
    

/* end categoty */

    </style>
    <script>
    // Add focus effect to form groups
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('.form-control');
        
        inputs.forEach(input => {
            const formGroup = input.closest('.form-group');
            
            input.addEventListener('focus', function() {
                formGroup.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                if (!this.value) {
                    formGroup.classList.remove('focused');
                }
            });
            
            // Check on page load
            if (input.value) {
                formGroup.classList.add('focused');
            }
        });
    });
    </script>
    <!-- //////////////////// -->
    <?php
}

  // ============================================================
  // قسم معالجة إضافة فئة جديدة
  // ============================================================
  elseif($do == 'Insert'){

    // التحقق من أن الطريقة POST
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

      echo '<h1 class="text-center">إضافة فئة جديدة</h1>'; 

      // جلب البيانات من النموذج
      $category_id = $_POST['category_id'];
      $category_name = $_POST['category_name'];
      // جلب بيانات الصورة
      $imageName = $_FILES['category_image']['name'];
      $imageSize = $_FILES['category_image']['size'];
      $imageTmp  = $_FILES['category_image']['tmp_name'];
      $imageType = $_FILES['category_image']['type'];
      
      // قائمة بالامتدادات المسموحة
      $imageAllowedExtension = array("jpeg", "jpg", "png", "gif");
      
      // الحصول على امتداد الصورة المرفوعة
      $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
      
      // التحقق من الأخطاء
      if (!empty($imageName) && !in_array($imageExtension, $imageAllowedExtension)) {
          $errors[] = 'هذا الامتداد غير مسموح به';
      }
      if ($imageSize > 4194304) { // 4MB
          $errors[] = 'حجم الصورة لا يجب أن يزيد عن 4 ميجا';
      }
      
      // إذا لم توجد أخطاء
      if (empty($errors)) {
          // إنشاء اسم عشوائي للصورة لتجنب التكرار
          $finalImage = rand(0, 1000000) . '_' . $imageName;
          
          // تأكد من إنشاء مجلد uploads/categories في مشروعك
          move_uploaded_file($imageTmp, "uploads/categories/" . $finalImage);
      
          // تعديل جملة الـ INSERT
          $stmt = $db->prepare("INSERT INTO categories (category_id, category_name, category_image) VALUES (?, ?, ?)");
          $stmt->execute(array($category_id, $category_name, $finalImage));
          
          // ... باقي الكود (رسالة النجاح)
      }
      // التحقق من عدم وجود أخطاء
      $errors = array();

      // التحقق من أن رقم الفئة غير موجود مسبقاً
      $stmt = $db->prepare("SELECT * FROM categories WHERE category_id = ?");
      $stmt->execute(array($category_id));
      if($stmt->rowCount() > 0){
        $errors[] = 'رقم الفئة موجود مسبقاً';
      }

      // التحقق من أن اسم الفئة غير موجود مسبقاً
      $stmt = $db->prepare("SELECT * FROM categories WHERE category_name = ?");
      $stmt->execute(array($category_name));
      if($stmt->rowCount() > 0){
        $errors[] = 'اسم الفئة موجود مسبقاً';
      }

      // إذا لم توجد أخطاء، قم بإدخال الفئة
      if(empty($errors)){

        $stmt = $db->prepare("INSERT INTO categories (category_id, category_name) VALUES (?, ?)");
        $stmt->execute(array($category_id, $category_name));

        if($stmt->rowCount() > 0){
          $msg = '<div class="alert alert-success">تم إضافة الفئة بنجاح</div>';
          redirectHome($msg, 'categories.php');
        } else {
          $msg = '<div class="alert alert-danger">فشل إضافة الفئة</div>';
          redirectHome($msg, 'categories.php');
        }

      } else {
        // عرض الأخطاء
        foreach($errors as $error){
          echo '<div class="alert alert-danger">' . $error . '</div>';
        }
        echo '<a href="categories.php?do=Add" class="btn btn-primary">العودة إلى صفحة الإضافة</a>';
      }

    } else {
      $msg = '<div class="alert alert-danger">عذراً، لا يمكنك الوصول إلى هذه الصفحة مباشرة</div>';
      redirectHome($msg, 'categories.php');
    }
  }

  // ============================================================
  // قسم تعديل الفئة
  // ============================================================
  
  elseif($do == 'Edit'){

    // التحقق من وجود معرف الفئة في الرابط وأنه رقم
    $category_id = isset($_GET['category_id']) && is_numeric($_GET['category_id']) ? intval($_GET['category_id']) : 0;

    // جلب بيانات الفئة من قاعدة البيانات
    $stmt = $db->prepare("SELECT * FROM categories WHERE category_id = ?");
    $stmt->execute(array($category_id));
    $category = $stmt->fetch();

    // إذا كان الرقم موجوداً، عرض نموذج التعديل
    if($stmt->rowCount() > 0){

      $stmt = $db->prepare("SELECT * FROM categories WHERE category_id = ?");
    $stmt->execute(array($category_id));

    if($stmt->rowCount() > 0){


      
    }      
      ?>
      <h1 class="text-center"> Modify The Category </h1>
      <div class="dbtainer">
        <form class="form-horizontal" action="categories.php?do=Update" method="POST">
          <!-- حقل رقم الفئة (غير قابل للتعديل) -->
          <div class="form-group form-group-lg">
            <label class="col-sm-3 dbtrol-label"> Category ID </label>
            <div class="col-sm-10 col-md-6">
              <input type="text" name="category_id" value="<?php echo $category['category_id']; ?>" class="form-dbtrol" readonly />
            </div>
          </div>
          <!-- حقل اسم الفئة -->
          <div class="form-group form-group-lg">
            <label class="col-sm-4 dbtrol-label">Category Name</label>
            <div class="col-sm-10 col-md-6">
              <input type="text" name="category_name" value="<?php echo $category['category_name']; ?>" class="form-dbtrol" required="required" maxlength="20" />
            </div>
          </div>
          <!-- زر التحديث -->
          <div class="form-group form-group-lg">
            <div class="col-sm-offset-2 col-sm-10">
              <input type="submit" value="Save Edit" class="btn btn-primary btn-lg" />
            </div>
          </div>
        </form>
      </div>
      <!-- //////////Style/////////// -->
<style>
/* Modern Edit Category Page Design */

/* Fix typo in container */
.dbtainer {
    max-width: 600px;
    margin: 40px auto;
    padding: 20px;
}

/* Page Title */
h1.text-center {
    color: #2c3e50;
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 40px;
    text-align: center;
    padding-bottom: 15px;
    border-bottom: 3px solid #f39c12;
    position: relative;
}

h1.text-center::after {
    content: '';
    position: absolute;
    bottom: -3px;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 3px;
    background: #3498db;
}

/* Form Container */
.form-horizontal {
    background: white;
    border-radius: 15px;
    padding: 40px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    border: 1px solid #e1e5eb;
}

/* Form Groups */
.form-group {
    margin-bottom: 30px;
}

.form-group-lg {
    margin-bottom: 35px;
}

/* Labels */
.dbtrol-label {
    display: block;
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 10px;
    font-size: 1.1rem;
}

/* Input Fields */
.form-dbtrol {
    width: 100%;
    padding: 14px 20px;
    border: 2px solid #e0e6ed;
    border-radius: 10px;
    font-size: 1rem;
    background: white;
    transition: all 0.3s ease;
    color: #2c3e50;
}

.form-dbtrol:focus {
    border-color: #f39c12;
    box-shadow: 0 0 0 3px rgba(243, 156, 18, 0.2);
    outline: none;
}

.form-dbtrol[readonly] {
    background: #f8f9fa;
    border-color: #d1d9e6;
    color: #6c757d;
    cursor: not-allowed;
}

.form-dbtrol[readonly]:focus {
    border-color: #d1d9e6;
    box-shadow: none;
}

/* Input Wrapper */
.col-sm-10.col-md-6 {
    width: 100%;
}

/* Button Container */
.col-sm-offset-2.col-sm-10 {
    margin-top: 30px;
    text-align: center;
}

/* Submit Button */
.btn-primary {
    background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
    color: white;
    padding: 15px 40px;
    font-size: 1.1rem;
    font-weight: 600;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(243, 156, 18, 0.3);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #e67e22 0%, #d35400 100%);
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(243, 156, 18, 0.4);
}

.btn-primary:active {
    transform: translateY(-1px);
}

.btn-lg {
    padding: 15px 40px;
    font-size: 1.2rem;
}

/* Alert Message */
.alert {
    padding: 15px 20px;
    border-radius: 8px;
    margin: 20px auto;
    max-width: 600px;
    border: none;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.alert-danger {
    background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
    color: white;
}

/* Responsive Design */
@media (max-width: 768px) {
    .dbtainer {
        padding: 15px;
        margin: 20px auto;
    }
    
    .form-horizontal {
        padding: 30px;
    }
    
    h1.text-center {
        font-size: 1.8rem;
        margin-bottom: 30px;
    }
    
    .form-group-lg {
        margin-bottom: 25px;
    }
}

@media (max-width: 576px) {
    .form-horizontal {
        padding: 20px;
    }
    
    h1.text-center {
        font-size: 1.6rem;
    }
    
    .btn-primary {
        width: 100%;
    }
}

/* Grid System for Form */
.col-sm-2 {
    margin-bottom: 8px;
}

/* Focus Effects for Labels */
.form-dbtrol:focus ~ .dbtrol-label {
    color: #f39c12;
}

/* Optional: Add Icons to Inputs */
.input-with-icon {
    position: relative;
}

.input-with-icon .form-dbtrol {
    padding-left: 45px;
}

.input-with-icon::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    color: #7f8c8d;
    z-index: 2;
}

.input-with-icon.id::before {
    content: "\f292"; /* hashtag icon */
}

.input-with-icon.name::before {
    content: "\f02b"; /* tag icon */
}

/* Animation for Form */
@keyframes slideInForm {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.form-horizontal {
    animation: slideInForm 0.5s ease-out;
}

/* Success State for Input */
.form-dbtrol.valid {
    border-color: #2ecc71;
}

/* Error State for Input */
.form-dbtrol.invalid {
    border-color: #e74c3c;
}

/* Helper Text */
.help-block {
    color: #7f8c8d;
    font-size: 0.9rem;
    margin-top: 8px;
    padding-left: 5px;
    font-style: italic;
}
</style>
      <!-- //////////Style/////////// -->

      <?php
    } else {
      $msg = '<div class="alert alert-danger">هذه الفئة غير موجودة</div>';
      redirectHome($msg, 'categories.php');
    }
  }

  // ============================================================
  // قسم معالجة تعديل الفئة
  // ============================================================
    elseif($do == 'Update'){

      // التحقق من أن الطريقة POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){

        echo '<h1 class="text-center">تعديل الفئة</h1>';

        // جلب البيانات من النموذج
        $category_id = $_POST['category_id'];
        $category_name = $_POST['category_name'];

        // التحقق من أن اسم الفئة غير موجود مسبقاً (باستثناء الفئة الحالية)
        $stmt = $db->prepare("SELECT * FROM categories WHERE category_name = ? AND category_id != ?");
        $stmt->execute(array($category_name, $category_id));
        if($stmt->rowCount() > 0){
          $msg = '<div class="alert alert-danger">اسم الفئة موجود مسبقاً</div>';
          redirectHome($msg, 'categories.php');
        } else {
          // تحديث البيانات
          $stmt = $db->prepare("UPDATE categories SET category_name = ? WHERE category_id = ?");
          $stmt->execute(array($category_name, $category_id));

          if($stmt->rowCount() > 0){
            $msg = '<div class="alert alert-success">تم تحديث الفئة بنجاح</div>';
            redirectHome($msg, 'categories.php');
          } else {
            $msg = '<div class="alert alert-warning">لم يتم تحديث أي شيء</div>';
            redirectHome($msg, 'categories.php');
          }
        }

      } else {
        $msg = '<div class="alert alert-danger">عذراً، لا يمكنك الوصول إلى هذه الصفحة مباشرة</div>';
        redirectHome($msg, 'categories.php');
      }
    }

    // ============================================================
    // قسم حذف الفئة
    // ============================================================
    elseif($do == 'Delete'){

      // التحقق من وجود معرف الفئة في الرابط وأنه رقم
      $category_id = isset($_GET['category_id']) && is_numeric($_GET['category_id']) ? intval($_GET['category_id']) : 0;

      // التحقق من وجود الفئة
      $stmt = $db->prepare("SELECT * FROM categories WHERE category_id = ?");
      $stmt->execute(array($category_id));

      if($stmt->rowCount() > 0){

        // حذف الفئة
        $stmt = $db->prepare("DELETE FROM categories WHERE category_id = ?");
        $stmt->execute(array($category_id));

        if($stmt->rowCount() > 0){
          $msg = '<div class="alert alert-success">تم حذف الفئة بنجاح</div>';
          redirectHome($msg, 'categories.php');
        } else {
          $msg = '<div class="alert alert-danger">فشل حذف الفئة</div>';
          redirectHome($msg, 'categories.php');
        }

      } else {
        $msg = '<div class="alert alert-danger">هذه الفئة غير موجودة</div>';
        redirectHome($msg, 'categories.php');
      }
    }

  include $tpl . "footer.php";

} else {
  header('Location: index.php');
  exit();
}

ob_end_flush();
?>