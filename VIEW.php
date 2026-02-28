<?php
include 'DB.php';

$students = getAllStudents();
$action = $_GET['action'] ?? '';
$msg = $_GET['msg'] ?? '';

// Decode message
$msg = str_replace('+', ' ', urldecode($msg));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Students - CRUD System</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }

        h1 {
            color: #333;
            margin-bottom: 10px;
            text-align: center;
            font-size: 28px;
        }

        .header-info {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-icon {
            font-size: 20px;
        }

        .actions-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 15px;
            flex-wrap: wrap;
        }

        .add-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: 0.3s;
        }

        .add-btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .record-count {
            color: #666;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }

        table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
        }

        table tbody tr {
            transition: 0.2s;
        }

        table tbody tr:hover {
            background-color: #f9f9f9;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .edit-btn, .delete-btn {
            padding: 8px 15px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: 0.3s;
            display: inline-block;
        }

        .edit-btn {
            background-color: #ffc107;
            color: #333;
        }

        .edit-btn:hover {
            background-color: #ffb300;
            transform: translateY(-2px);
        }

        .delete-btn {
            background-color: #dc3545;
            color: white;
        }

        .delete-btn:hover {
            background-color: #c82333;
            transform: translateY(-2px);
        }

        .empty-message {
            text-align: center;
            padding: 40px;
            color: #666;
            font-size: 16px;
        }

        .no-records {
            color: #999;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>👥 Student Records</h1>
        <div class="header-info">Academic Records System - View All Students</div>

        <?php if ($action === 'success' && $msg): ?>
            <div class="alert alert-success">
                <span class="alert-icon">✅</span>
                <span><?php echo htmlspecialchars($msg); ?></span>
            </div>
        <?php endif; ?>

        <?php if ($action === 'danger' && $msg): ?>
            <div class="alert alert-danger">
                <span class="alert-icon">❌</span>
                <span><?php echo htmlspecialchars($msg); ?></span>
            </div>
        <?php endif; ?>

        <div class="actions-bar">
            <a href="INDEX.php" class="add-btn">➕ Add New Student</a>
            <div class="record-count">
                📊 Total Records: <strong><?php echo count($students); ?></strong>
            </div>
        </div>

        <?php if (empty($students)): ?>
            <div class="empty-message">
                <p>📭 No student records found.</p>
                <p style="margin-top: 10px; color: #bbb;">Click "Add New Student" to create your first record.</p>
            </div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th style="width: 50px;">Serial</th>
                        <th>Name</th>
                        <th>Registration No</th>
                        <th>Email</th>
                        <th>Course</th>
                        <th style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $index => $student): ?>
                        <tr>
                            <td><strong><?php echo $index + 1; ?></strong></td>
                            <td><?php echo htmlspecialchars($student['name']); ?></td>
                            <td><?php echo htmlspecialchars($student['registration_no']); ?></td>
                            <td><?php echo htmlspecialchars($student['email']); ?></td>
                            <td><?php echo htmlspecialchars($student['course']); ?></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="EDIT.php?id=<?php echo $student['id']; ?>" class="edit-btn">✏️ Edit</a>
                                    <a href="Delete.php?id=<?php echo $student['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this record?');">🗑️ Delete</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <script>
        // Auto-hide alert after 5 seconds
        const alert = document.querySelector('.alert');
        if (alert) {
            setTimeout(() => {
                alert.style.opacity = '0';
                alert.style.transition = 'opacity 0.5s ease';
                setTimeout(() => alert.remove(), 500);
            }, 5000);
        }
    </script>
</body>
</html>
