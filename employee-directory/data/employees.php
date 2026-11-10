<?php
/**
 * data/employees.php
 * Returns an array of associative arrays (one per employee).
 * The "skills" key is a NESTED array (multidimensional data).
 */
return [
    ['id' => 1,  'first_name' => 'Maria',    'last_name' => 'Santos',    'position' => 'HR Manager',        'department' => 'Human Resources', 'email' => 'Maria.Santos@Company.com',  'phone' => '0917-123-4501', 'date_hired' => '2018-03-12', 'salary' => 55000, 'skills' => ['Recruitment', 'Payroll', 'Communication']],
    ['id' => 2,  'first_name' => 'Juan',     'last_name' => 'Dela Cruz', 'position' => 'Software Engineer', 'department' => 'IT',              'email' => 'juan.delacruz@company.com', 'phone' => '0917-123-4502', 'date_hired' => '2020-07-01', 'salary' => 62000, 'skills' => ['PHP', 'MySQL', 'Git']],
    ['id' => 3,  'first_name' => 'Ana',      'last_name' => 'Reyes',     'position' => 'Accountant',        'department' => 'Finance',         'email' => 'ana.reyes@company.com',     'phone' => '0917-123-4503', 'date_hired' => '2019-01-15', 'salary' => 48000, 'skills' => ['Bookkeeping', 'Excel', 'Auditing']],
    ['id' => 4,  'first_name' => 'Carlos',   'last_name' => 'Garcia',    'position' => 'Marketing Lead',    'department' => 'Marketing',       'email' => 'CARLOS.GARCIA@company.com', 'phone' => '0917-123-4504', 'date_hired' => '2017-09-20', 'salary' => 52000, 'skills' => ['SEO', 'Branding', 'Copywriting']],
    ['id' => 5,  'first_name' => 'Liza',     'last_name' => 'Mendoza',   'position' => 'UI/UX Designer',    'department' => 'IT',              'email' => 'liza.mendoza@company.com',  'phone' => '0917-123-4505', 'date_hired' => '2021-05-10', 'salary' => 50000, 'skills' => ['Figma', 'CSS', 'Prototyping']],
    ['id' => 6,  'first_name' => 'Pedro',    'last_name' => 'Bautista',  'position' => 'Sales Executive',   'department' => 'Sales',           'email' => 'pedro.bautista@company.com','phone' => '0917-123-4506', 'date_hired' => '2022-02-14', 'salary' => 38000, 'skills' => ['Negotiation', 'CRM', 'Presentations']],
    ['id' => 7,  'first_name' => 'Grace',    'last_name' => 'Villanueva','position' => 'Finance Director',  'department' => 'Finance',         'email' => 'grace.villanueva@company.com','phone' => '0917-123-4507','date_hired' => '2015-11-03', 'salary' => 85000, 'skills' => ['Budgeting', 'Forecasting', 'Leadership']],
    ['id' => 8,  'first_name' => 'Miguel',   'last_name' => 'Ramos',     'position' => 'Network Admin',     'department' => 'IT',              'email' => 'miguel.ramos@company.com',  'phone' => '0917-123-4508', 'date_hired' => '2016-06-27', 'salary' => 58000, 'skills' => ['Networking', 'Linux', 'Security']],
    ['id' => 9,  'first_name' => 'Sofia',    'last_name' => 'Torres',    'position' => 'Recruiter',         'department' => 'Human Resources', 'email' => 'sofia.torres@company.com',  'phone' => '0917-123-4509', 'date_hired' => '2023-01-09', 'salary' => 35000, 'skills' => ['Interviewing', 'Sourcing']],
    ['id' => 10, 'first_name' => 'Daniel',   'last_name' => 'Flores',    'position' => 'Sales Manager',     'department' => 'Sales',           'email' => 'daniel.flores@company.com', 'phone' => '0917-123-4510', 'date_hired' => '2014-08-18', 'salary' => 70000, 'skills' => ['Leadership', 'Strategy', 'CRM']],
    ['id' => 11, 'first_name' => 'Isabel',   'last_name' => 'Cruz',      'position' => 'Content Writer',    'department' => 'Marketing',       'email' => 'isabel.cruz@company.com',   'phone' => '0917-123-4511', 'date_hired' => '2022-10-24', 'salary' => 36000, 'skills' => ['Writing', 'Editing', 'Social Media']],
    ['id' => 12, 'first_name' => 'Rafael',   'last_name' => 'Aquino',    'position' => 'QA Tester',         'department' => 'IT',              'email' => 'rafael.aquino@company.com', 'phone' => '0917-123-4512', 'date_hired' => '2021-12-06', 'salary' => 45000, 'skills' => ['Testing', 'Bug Reporting', 'Selenium']],
];
