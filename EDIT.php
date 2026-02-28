<?php
include 'DB.php';
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: VIEW.php");
    exit;
}

$data = getStudent($id);
if (!$data) {
    header("Location: VIEW.php?action=danger&msg=Student+Not+Found");
    exit;
}

$error_msg = '';

if (isset($_POST['update'])) {
    $name = trim($_POST['name']);
    $registration_no = trim($_POST['registration_no']);
    $email = trim($_POST['email']);
    $course = trim($_POST['course']);
    
    // Validation
    if (empty($name) || empty($registration_no) || empty($email) || empty($course)) {
        $error_msg = "All fields are required!";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_msg = "Invalid email format!";
    } else {
        updateStudent($id, $name, $registration_no, $email, $course);
        header("Location: VIEW.php?action=success&msg=Record+Updated");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student - CRUD System</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #ff6a00 0%, #ee0979 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: #ffffff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 450px;
            transition: 0.3s;
        }

        .container:hover {
            transform: translateY(-5px);
        }

        h1 {
            color: #333;
            margin-bottom: 30px;
            text-align: center;
            font-size: 26px;
        }

        .form-group { margin-bottom: 20px; }

        label {
            display: block;
            margin-bottom: 8px;
            color: #444;
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 10px;
            font-size: 16px;
            transition: 0.3s;
        }

        input:focus {
            outline: none;
            border-color: #ee0979;
            box-shadow: 0 0 8px rgba(238, 9, 121, 0.3);
        }

        select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 10px;
            font-size: 16px;
            transition: 0.3s;
            cursor: pointer;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        select:focus {
            outline: none;
            border-color: #ee0979;
            box-shadow: 0 0 8px rgba(238, 9, 121, 0.3);
        }

        button {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #ff6a00 0%, #ee0979 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
            transition: 0.3s;
        }

        button:hover {
            opacity: 0.9;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #ee0979;
            text-decoration: none;
            font-weight: 600;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>✏️ Edit Student</h1>
        
        <?php if ($error_msg): ?>
            <div style="background-color: #f8d7da; color: #721c24; padding: 12px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                ⚠️ <?php echo htmlspecialchars($error_msg); ?>
            </div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label>👤 Name</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($data['name'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label>📝 Registration Number</label>
                <input type="text" name="registration_no" value="<?php echo htmlspecialchars($data['registration_no'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label>📧 Email</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($data['email'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label>📚 Course</label>
                <select name="course" required>
                    <option value="">-- Select Course --</option>
                    <option value="Computer Science" <?php echo ($data['course'] ?? '') === 'Computer Science' ? 'selected' : ''; ?>>Computer Science</option>
                    <option value="Information Technology" <?php echo ($data['course'] ?? '') === 'Information Technology' ? 'selected' : ''; ?>>Information Technology</option>
                    <option value="Software Engineering" <?php echo ($data['course'] ?? '') === 'Software Engineering' ? 'selected' : ''; ?>>Software Engineering</option>
                    <option value="Data Science" <?php echo ($data['course'] ?? '') === 'Data Science' ? 'selected' : ''; ?>>Data Science</option>
                    <option value="Artificial Intelligence" <?php echo ($data['course'] ?? '') === 'Artificial Intelligence' ? 'selected' : ''; ?>>Artificial Intelligence</option>
                    <option value="Web Development" <?php echo ($data['course'] ?? '') === 'Web Development' ? 'selected' : ''; ?>>Web Development</option>
                </select>
            </div>

            <button type="submit" name="update">💾 Update Record</button>
        </form>

        <a href="VIEW.php" class="back-link">← Back to List</a>
    </div>
</body>
</html>