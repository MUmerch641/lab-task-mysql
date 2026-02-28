<?php
include 'DB.php';

$success_msg = '';
$error_msg = '';

if (isset($_POST['save'])) {
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
        addStudent($name, $registration_no, $email, $course);
        header("Location: VIEW.php?action=success&msg=Record+Added");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student - CRUD System</title>
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
        <h1>➕ Add Student</h1>
        
        <?php if ($error_msg): ?>
            <div style="background-color: #f8d7da; color: #721c24; padding: 12px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                ⚠️ <?php echo htmlspecialchars($error_msg); ?>
            </div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label>👤 Name</label>
                <input type="text" name="name" placeholder="Enter Student Name" required>
            </div>

            <div class="form-group">
                <label>📝 Registration Number</label>
                <input type="text" name="registration_no" placeholder="Enter Registration Number" required>
            </div>

            <div class="form-group">
                <label>📧 Email</label>
                <input type="email" name="email" placeholder="Enter Email Address" required>
            </div>

            <div class="form-group">
                <label>📚 Course</label>
                <select name="course" required style="width: 100%; padding: 12px 15px; border: 2px solid #ddd; border-radius: 10px; font-size: 16px; cursor: pointer;">
                    <option value="">-- Select Course --</option>
                    <option value="Computer Science">Computer Science</option>
                    <option value="Information Technology">Information Technology</option>
                    <option value="Software Engineering">Software Engineering</option>
                    <option value="Data Science">Data Science</option>
                    <option value="Artificial Intelligence">Artificial Intelligence</option>
                    <option value="Web Development">Web Development</option>
                </select>
            </div>

            <button type="submit" name="save">💾 Save Record</button>
        </form>

        <a href="VIEW.php" class="back-link">← Back to List</a>
    </div>
</body>
</html>