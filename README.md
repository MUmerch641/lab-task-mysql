# Php-Mysql-Crud-System-updated

A simple web application built with PHP and HTML to manage student records efficiently. It allows users to add, view, edit, and delete student information quickly. The system uses a text file as a lightweight database, making it easy to demonstrate CRUD operations.

## 🛠 Features

### 1. Student Form
- Input fields: Name, Registration Number, Email, Course  
- Dropdown for course selection  
- Alerts: Success, Warning, and Danger  

### 2. View Students
- Displays all registered students in a table  
- Serial numbers automatically generated  
- Option to go back to the form  

### 3. Edit Student
- Update any student detail  
- Popup alert on successful update  

### 4. Delete Student
- Delete any student with confirmation  
- Popup alert on successful deletion  

### 5. Database Management
- Fresh database on every run (`students.txt` reset)  
- Easy demonstration without complicated setup

## Technologies Used
- PHP
- HTML & CSS
- Text Files (Lightweight Database)
- Laragon (Local Server)

## Project Files
| File | Description |
|------|-------------|
| `INDEX.php` | Student form to add new records |
| `VIEW.php` | Display all students in a table |
| `EDIT.php` | Edit/update student details |
| `DELETE.php` | Delete student records |
| `DB.php` | Database (text file) management |

## Requirements
- Laragon installed
- PHP 8.0 or above

## How to Run
1. Install [Laragon](https://laragon.org/download)
2. Place the project files in `C:\laragon\www\lab task 2\`
3. Start Apache in Laragon
4. Open browser and go to:
   ```
   localhost/lab%20task%202/INDEX.php
   ```

## 🎥 Project Demo Video

Watch the full project in action:  
https://drive.google.com/file/d/1LeyyvsLoXW8Uzjgx3Rin8CzI45ue_Uqj/view?usp=drive_link
