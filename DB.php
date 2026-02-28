<?php
// Text-file based database using students.txt
$db_file = __DIR__ . '/students.txt';

// Initialize the database file if it doesn't exist
if (!file_exists($db_file)) {
    file_put_contents($db_file, json_encode([]) . "\n");
}

// Get all students
function getAllStudents() {
    global $db_file;
    $content = file_get_contents($db_file);
    $students = json_decode($content, true);
    return $students ? $students : [];
}

// Add a new student
function addStudent($name, $registration_no, $email, $course) {
    global $db_file;
    $students = getAllStudents();
    
    // Generate next ID
    $nextId = 1;
    if (!empty($students)) {
        $nextId = max(array_column($students, 'id')) + 1;
    }
    
    // Add new student
    $students[] = [
        'id' => $nextId,
        'name' => $name,
        'registration_no' => $registration_no,
        'email' => $email,
        'course' => $course
    ];
    
    // Save to file
    file_put_contents($db_file, json_encode($students) . "\n");
    return $nextId;
}

// Get student by ID
function getStudent($id) {
    $students = getAllStudents();
    foreach ($students as $student) {
        if ($student['id'] == $id) {
            return $student;
        }
    }
    return null;
}

// Update student
function updateStudent($id, $name, $registration_no, $email, $course) {
    global $db_file;
    $students = getAllStudents();
    
    foreach ($students as &$student) {
        if ($student['id'] == $id) {
            $student['name'] = $name;
            $student['registration_no'] = $registration_no;
            $student['email'] = $email;
            $student['course'] = $course;
            break;
        }
    }
    
    // Save to file
    file_put_contents($db_file, json_encode($students) . "\n");
    return true;
}

// Delete student
function deleteStudent($id) {
    global $db_file;
    $students = getAllStudents();
    
    $students = array_filter($students, function($student) use ($id) {
        return $student['id'] != $id;
    });
    
    // Re-index array to remove gaps
    $students = array_values($students);
    
    // Save to file
    file_put_contents($db_file, json_encode($students) . "\n");
    return true;
}
?>