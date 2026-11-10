# Employee Directory – Activity 9: PHP Mini Information Management System

A beginner-friendly Employee Directory built with **plain PHP 8+** (no frameworks, no database).
Employee records are stored in PHP arrays and displayed as a responsive card grid with search, filter, and sort.

## Features
- Displays 12 employees as styled cards
- Search by name or position (keyword is highlighted in results)
- Filter by department
- Sort by name or date hired (ascending or descending)
- Summary section: total employees and employees per department
- Single employee profile page (`employee.php?id=1`)
- Friendly "No records found" message
- Responsive layout with an external CSS file
- All output escaped with `htmlspecialchars()`

## PHP Concepts Applied
| Concept | Where it is used |
|---|---|
| Arrays (indexed, associative, nested) | `data/employees.php` (each employee has a nested `skills` array) |
| Functions | `includes/functions.php` (`getEmployees`, `searchEmployees`, `filterByDepartment`, `countByDepartment`, `renderEmployeeCard`, ...) |
| String functions | `strtoupper`, `strtolower`, `ucwords`, `trim`, `substr`, `str_pad`, `str_contains`, `sprintf`, `number_format`, `implode`, `htmlspecialchars` |
| Includes | `require` / `require_once` for header, footer, and functions |
| GET forms | Search/filter/sort form in `index.php` using `$_GET` |
| Loops | `foreach` for rendering cards, counting, and building dropdowns |
| Conditionals | `if/else` for "No records found", input validation, selected options |

## Folder Structure
```
employee-directory/
├── index.php
├── employee.php
├── data/employees.php
├── includes/
│   ├── functions.php
│   ├── header.php
│   └── footer.php
├── assets/css/style.css
├── screenshots/
└── README.md
```

## How to Run Locally
**Option A: PHP built-in server**
```bash
cd employee-directory
php -S localhost:8000
```
Open http://localhost:8000

**Option B: XAMPP / Laragon**
Copy the `employee-directory` folder into `htdocs` (XAMPP) or `www` (Laragon),
start Apache, then open http://localhost/employee-directory/

## Screenshots
**Home page**

![Home](screenshots/home.png)

**Search result**

![Search](screenshots/search.png)

**Filtered view**

![Filter](screenshots/filter.png)

## Author
Your Name – Section – Subject
