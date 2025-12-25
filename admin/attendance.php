<!-- page attendance -->


<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام الحضور - لوحة التحكم</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #4f46e5;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
        }
        
        body {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
            padding: 20px;
            font-family: 'Segoe UI', sans-serif;
        }
        
        .dashboard-header {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-bottom: 25px;
            border-right: 5px solid var(--primary);
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            margin-bottom: 15px;
            border-top: 4px solid;
            transition: transform 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-present { border-color: var(--success); }
        .stat-absent { border-color: var(--danger); }
        .stat-late { border-color: var(--warning); }
        .stat-total { border-color: var(--primary); }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin-left: 15px;
        }
        
        .icon-present { background: var(--success); }
        .icon-absent { background: var(--danger); }
        .icon-late { background: var(--warning); }
        .icon-total { background: var(--primary); }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            color: #1e293b;
        }
        
        .status-badge {
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: 600;
        }
        
        .badge-present { background: rgba(16, 185, 129, 0.2); color: var(--success); }
        .badge-absent { background: rgba(239, 68, 68, 0.2); color: var(--danger); }
        .badge-late { background: rgba(245, 158, 11, 0.2); color: var(--warning); }
        
        .action-btn {
            min-width: 80px;
            margin: 2px;
            font-size: 0.85rem;
        }
        
        .table th {
            background: #f1f5f9;
            font-weight: 600;
            color: #475569;
        }
        
        .search-box {
            max-width: 300px;
        }
        
        @media (max-width: 768px) {
            .action-btn {
                min-width: 60px;
                font-size: 0.75rem;
                padding: 5px 8px;
            }
            
            .stat-number {
                font-size: 1.5rem;
            }
        }

        
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="dashboard-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="text-primary mb-1">
                        <i class="fas fa-user-check"></i> حضور اليوم
                    </h1>
                    <p class="text-muted mb-0">لوحة إدارة وتسجيل الحضور اليومي</p>
                </div>
                <div class="bg-primary text-white p-3 rounded">
                    <i class="far fa-calendar-alt"></i>
                    <span id="currentDate"></span>
                </div>
            </div>
        </div>
        
        <!-- Statistics Row -->
        <div class="row mb-4" id="statsContainer">
            <div class="col-md-3 col-6">
                <div class="stat-card stat-total">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon icon-total">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <div class="stat-number" id="totalCount">0</div>
                            <div>إجمالي الطلاب</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card stat-present">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon icon-present">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div>
                            <div class="stat-number" id="presentCount">0</div>
                            <div>حاضر</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card stat-absent">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon icon-absent">
                            <i class="fas fa-user-times"></i>
                        </div>
                        <div>
                            <div class="stat-number" id="absentCount">0</div>
                            <div>غائب</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card stat-late">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon icon-late">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <div class="stat-number" id="lateCount">0</div>
                            <div>متأخر</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <!-- Controls -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div class="search-box">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" id="searchInput" placeholder="ابحث عن طالب...">
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button class="btn btn-primary" onclick="markAllPresent()">
                            <i class="fas fa-check-double"></i> حضور الكل
                        </button>
                        <button class="btn btn-danger" onclick="resetAll()">
                            <i class="fas fa-redo"></i> إعادة تعيين
                        </button>
                        <button class="btn btn-success" onclick="exportReport()">
                            <i class="fas fa-download"></i> تصدير
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Attendance Table -->
        <div class="card shadow">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-list"></i> قائمة الطلاب</h5>
                <small id="lastUpdate">آخر تحديث: الآن</small>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="30%">اسم الطالب</th>
                                <th width="15%">الصف</th>
                                <th width="15%">الحالة</th>
                                <th width="35%">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody id="attendanceTable">
                            <!-- سيتم ملؤها بواسطة JavaScript -->
                            <tr id="loadingRow">
                                <td colspan="5" class="text-center py-4">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">جاري التحميل...</span>
                                    </div>
                                    <p class="mt-2 text-muted">جاري تحميل بيانات الطلاب...</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Summary -->
        <div class="card shadow mt-4 bg-primary text-white">
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4">
                        <h3 id="attendanceRate">0%</h3>
                        <p>نسبة الحضور</p>
                    </div>
                    <div class="col-md-4">
                        <h3 id="presentRate">0%</h3>
                        <p>نسبة الحضور في الوقت</p>
                    </div>
                    <div class="col-md-4">
                        <h3 id="absentRate">0%</h3>
                        <p>نسبة الغياب</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- JavaScript -->
    <script>
        let allStudents = [];
        let todayAttendance = [];
        
        // جلب جميع الطلاب
        async function fetchStudents() {
            try {
                const response = await fetch('get_students.php');
                const data = await response.json();
                allStudents = data;
                return data;
            } catch (error) {
                console.error('خطأ في جلب الطلاب:', error);
                showToast('خطأ في تحميل بيانات الطلاب', 'error');
                return [];
            }
        }
        
        // جلب حضور اليوم
        async function fetchTodayAttendance() {
            try {
                const response = await fetch('get_today_attendance.php');
                const data = await response.json();
                todayAttendance = data;
                return data;
            } catch (error) {
                console.error('خطأ في جلب الحضور:', error);
                return [];
            }
        }
        
        // تحديث الجدول
        function updateTable() {
            const table = document.getElementById('attendanceTable');
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            
            if (allStudents.length === 0) {
                table.innerHTML = `
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            <i class="fas fa-users-slash fa-2x text-muted mb-3"></i>
                            <p>لا توجد بيانات طلاب</p>
                        </td>
                    </tr>
                `;
                return;
            }
            
            let filteredStudents = allStudents;
            
            if (searchTerm) {
                filteredStudents = allStudents.filter(student => 
                    student.fullname.toLowerCase().includes(searchTerm) ||
                    student.username.toLowerCase().includes(searchTerm)
                );
            }
            
            let html = '';
            
            filteredStudents.forEach((student, index) => {
                const attendance = todayAttendance.find(a => a.user_id == student.userID);
                const status = attendance ? attendance.status : 'absent';
                
                html += `
                <tr>
                    <td>${index + 1}</td>
                    <td>
                        <strong>${student.fullname}</strong><br>
                        <small class="text-muted">${student.username}</small>
                    </td>
                    <td>${student.grade || 'غير محدد'}</td>
                    <td>
                        <span class="status-badge badge-${status}" id="statusBadge${student.userID}">
                            <i class="fas fa-${getStatusIcon(status)}"></i>
                            ${getStatusText(status)}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex flex-wrap gap-2">
                            <button class="btn btn-sm btn-success action-btn ${status == 'present' ? 'active' : ''}" 
                                    onclick="updateStatus(${student.userID}, 'present')"
                                    id="btnPresent${student.userID}">
                                <i class="fas fa-check"></i> حاضر
                            </button>
                            <button class="btn btn-sm btn-danger action-btn ${status == 'absent' ? 'active' : ''}" 
                                    onclick="updateStatus(${student.userID}, 'absent')"
                                    id="btnAbsent${student.userID}">
                                <i class="fas fa-times"></i> غائب
                            </button>
                            <button class="btn btn-sm btn-warning action-btn ${status == 'late' ? 'active' : ''}" 
                                    onclick="updateStatus(${student.userID}, 'late')"
                                    id="btnLate${student.userID}">
                                <i class="fas fa-clock"></i> متأخر
                            </button>
                        </div>
                    </td>
                </tr>
                `;
            });
            
            table.innerHTML = html;
            updateStats();
        }
        
        // تحديث الإحصائيات
        function updateStats() {
            const total = allStudents.length;
            const present = todayAttendance.filter(a => a.status == 'present').length;
            const absent = todayAttendance.filter(a => a.status == 'absent').length;
            const late = todayAttendance.filter(a => a.status == 'late').length;
            
            // تحديث الأرقام
            document.getElementById('totalCount').textContent = total;
            
            document.getElementById('presentCount').textContent = present;

            document.getElementById('absentCount').textContent = absent;

            document.getElementById('lateCount').textContent = late;

            // تحديث النسب
            document.getElementById('attendanceRate').textContent = 
                total > 0 ? Math.round(((present + late) / total) * 100) + '%' : '0%';
            document.getElementById('presentRate').textContent = 
                total > 0 ? Math.round((present / total) * 100) + '%' : '0%';
            document.getElementById('absentRate').textContent = 
                total > 0 ? Math.round((absent / total) * 100) + '%' : '0%';
            
            // تحديث وقت التحديث
            const now = new Date();
            document.getElementById('lastUpdate').textContent = 
                `آخر تحديث: ${now.getHours()}:${now.getMinutes().toString().padStart(2, '0')}`;


              
            // const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            };
            document.getElementById('currentDate').textContent = 
                now.toLocaleDateString('ar-SA', options);
        
        }
        
        // تحديث حالة الحضور
        async function updateStatus(userId, status) {
            try {
                const response = await fetch('attendance_api.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        action: 'update_attendance',
                        user_id: userId,
                        status: status
                    })
                });
                
                const result = await response.json();
                
                if (result.success) {
                    // تحديث البيانات المحلية
                    const existingIndex = todayAttendance.findIndex(a => a.user_id == userId);
                    if (existingIndex >= 0) {
                        todayAttendance[existingIndex].status = status;
                    } else {
                        todayAttendance.push({ user_id: userId, status: status });
                    }
                    
                    // تحديث الواجهة
                    updateTable();
                    
                    // إظهار رسالة النجاح
                    const student = allStudents.find(s => s.userID == userId);
                    showToast(`تم تحديث حالة ${student.fullname} إلى ${getStatusText(status)}`, 'success');
                } else {
                    showToast('خطأ في تحديث الحضور', 'error');
                }
            } catch (error) {
                console.error('خطأ:', error);
                showToast('خطأ في الاتصال بالخادم', 'error');
            }
        }
        
        // تسجيل حضور جميع الطلاب
        async function markAllPresent() {
            if (!confirm('هل تريد تسجيل حضور جميع الطلاب؟')) return;
            
            showToast('جاري تسجيل حضور جميع الطلاب...', 'info');
            
            for (const student of allStudents) {
                await updateStatus(student.userID, 'present');
            }
            
            showToast('تم تسجيل حضور جميع الطلاب', 'success');
        }
        
        // إعادة تعيين جميع السجلات
        async function resetAll() {
            if (!confirm('هل تريد إعادة تعيين جميع سجلات الحضور؟')) return;
            
            showToast('جاري إعادة التعيين...', 'info');
            
            for (const student of allStudents) {
                await updateStatus(student.userID, 'absent');
            }
            
            showToast('تم إعادة تعيين الحضور', 'warning');
        }
        
        // تصدير التقرير
        function exportReport() {
            const data = {
                date: new Date().toLocaleDateString('ar-SA'),
                total: allStudents.length,
                present: todayAttendance.filter(a => a.status == 'present').length,
                absent: todayAttendance.filter(a => a.status == 'absent').length,
                late: todayAttendance.filter(a => a.status == 'late').length,
                students: allStudents.map(student => {
                    const attendance = todayAttendance.find(a => a.user_id == student.userID);
                    return {
                        name: student.fullname,
                        grade: student.grade,
                        status: attendance ? getStatusText(attendance.status) : 'غائب'
                    };
                })
            };
            
            const blob = new Blob([JSON.stringify(data, null, 2)], { type: 'application/json' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `تقرير-حضور-${new Date().toISOString().split('T')[0]}.json`;
            a.click();
            
            showToast('تم تحميل التقرير', 'success');
        }
        
        // وظائف مساعدة
        function getStatusIcon(status) {
            return {
                'present': 'check',
                'absent': 'times',
                'late': 'clock'
            }[status] || 'times';
        }
        
        function getStatusText(status) {
            return {
                'present': 'حاضر',
                'absent': 'غائب',
                'late': 'متأخر'
            }[status] || 'غائب';
        }
        
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `position-fixed top-0 end-0 m-3 p-3 rounded text-white bg-${type === 'success' ? 'success' : type === 'error' ? 'danger' : 'info'}`;
            toast.style.zIndex = '9999';
            toast.innerHTML = `
                <div class="d-flex align-items-center">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-triangle' : 'info-circle'} me-2"></i>
                    <span>${message}</span>
                </div>
            `;
            
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transition = 'opacity 0.5s';
                setTimeout(() => {
                    if (toast.parentNode) {
                        document.body.removeChild(toast);
                    }
                }, 500);
            }, 3000);
        }
        
        // البحث أثناء الكتابة
        document.getElementById('searchInput').addEventListener('input', updateTable);
        
        // تحميل البيانات الأولية
        async function loadInitialData() {
            await Promise.all([fetchStudents(), fetchTodayAttendance()]);
            updateTable();
        }
        
        // تحديث تلقائي كل 30 ثانية
        setInterval(async () => {
            await fetchTodayAttendance();
            updateTable();
        }, 30000);
        
        // بدء التحميل
        loadInitialData();
    </script>
</body>
</html>
<?php
    


  
?>