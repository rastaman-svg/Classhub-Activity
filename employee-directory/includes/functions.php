<?php
/**
 * includes/functions.php
 * All reusable functions for the Employee Directory.
 */

/* ---------- DATA ---------- */

// Returns the employees array from the data file.
function getEmployees(): array
{
    return require __DIR__ . '/../data/employees.php';
}

// Finds one employee by id. Returns null when not found.
function findEmployeeById(array $employees, int $id): ?array
{
    foreach ($employees as $employee) {
        if ($employee['id'] === $id) {
            return $employee;
        }
    }
    return null;
}

// Returns a sorted list of unique department names.
function getDepartments(array $employees): array
{
    $departments = array_unique(array_column($employees, 'department'));
    sort($departments);
    return $departments;
}

/* ---------- STRING HELPERS ---------- */

// Escapes output so user input can't inject HTML (XSS protection).
function e(string $text): string
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

// "Maria" + "Santos" => "Maria Santos"
function getFullName(array $employee): string
{
    return ucwords(trim($employee['first_name'] . ' ' . $employee['last_name']));
}

// "Maria Santos" => "MS" (first letter of first and last name, uppercase)
function getInitials(array $employee): string
{
    return strtoupper(substr($employee['first_name'], 0, 1) . substr($employee['last_name'], 0, 1));
}

// 55000 => "₱55,000.00"
function formatSalary(float $amount): string
{
    return '₱' . number_format($amount, 2);
}

// Emails are stored in mixed case in the data, so normalize to lowercase.
function formatEmail(string $email): string
{
    return strtolower(trim($email));
}

// "0917-123-4501" => "0917-***-4501" (hides the middle part)
function maskPhone(string $phone): string
{
    return substr($phone, 0, 4) . '-***-' . substr($phone, -4);
}

// "2018-03-12" => "Mar 12, 2018"
function formatDate(string $date): string
{
    return date('M d, Y', strtotime($date));
}

// Employee ID padded with zeros: 7 => "EMP-0007"
function formatEmployeeId(int $id): string
{
    return 'EMP-' . str_pad((string) $id, 4, '0', STR_PAD_LEFT);
}

// Turns a skills array into text: ['PHP','Git'] => "PHP, Git"
function skillsToText(array $skills): string
{
    return implode(', ', $skills);
}

/**
 * Escapes $text and wraps every match of $keyword in <mark>.
 * We split the RAW text first, then escape each piece, so it stays safe.
 */
function highlightKeyword(string $text, string $keyword): string
{
    if ($keyword === '') {
        return e($text);
    }

    $parts = preg_split('/(' . preg_quote($keyword, '/') . ')/i', $text, -1, PREG_SPLIT_DELIM_CAPTURE);
    $result = '';

    foreach ($parts as $index => $part) {
        // Odd positions are the captured keyword matches.
        $result .= ($index % 2 === 1) ? '<mark>' . e($part) . '</mark>' : e($part);
    }
    return $result;
}

/* ---------- PROCESSING ---------- */

// Keeps employees whose name OR position contains the keyword (case-insensitive).
function searchEmployees(array $employees, string $keyword): array
{
    $keyword = strtolower(trim($keyword));
    if ($keyword === '') {
        return $employees;
    }

    $results = [];
    foreach ($employees as $employee) {
        $name     = strtolower(getFullName($employee));
        $position = strtolower($employee['position']);

        if (str_contains($name, $keyword) || str_contains($position, $keyword)) {
            $results[] = $employee;
        }
    }
    return $results;
}

// Keeps only employees in the chosen department ('' means all).
function filterByDepartment(array $employees, string $department): array
{
    if ($department === '') {
        return $employees;
    }

    return array_values(array_filter(
        $employees,
        fn($employee) => $employee['department'] === $department
    ));
}

// Returns e.g. ['IT' => 4, 'Finance' => 2, ...]
function countByDepartment(array $employees): array
{
    $counts = [];
    foreach ($employees as $employee) {
        $dept = $employee['department'];
        $counts[$dept] = ($counts[$dept] ?? 0) + 1;
    }
    ksort($counts);
    return $counts;
}

// Sorts by "name" (last name, then first name) or "date_hired".
function sortEmployees(array $employees, string $sortBy, string $direction): array
{
    usort($employees, function ($a, $b) use ($sortBy) {
        if ($sortBy === 'date_hired') {
            return strtotime($a['date_hired']) <=> strtotime($b['date_hired']);
        }
        return strcasecmp($a['last_name'] . $a['first_name'], $b['last_name'] . $b['first_name']);
    });

    return $direction === 'desc' ? array_reverse($employees) : $employees;
}

/* ---------- RENDERING ---------- */

// Builds the HTML for one employee card. Everything is escaped.
function renderEmployeeCard(array $employee, string $keyword = ''): string
{
    $skillTags = '';
    foreach ($employee['skills'] as $skill) {
        $skillTags .= '<span class="tag">' . e($skill) . '</span>';
    }

    return sprintf(
        '<article class="card">
            <div class="avatar">%s</div>
            <h3>%s</h3>
            <p class="position">%s</p>
            <p class="dept">%s</p>
            <ul class="details">
                <li>✉ %s</li>
                <li>☎ %s</li>
                <li>📅 Hired: %s</li>
                <li>💰 %s</li>
            </ul>
            <div class="tags">%s</div>
            <a class="btn" href="employee.php?id=%d">View Profile</a>
        </article>',
        e(getInitials($employee)),
        highlightKeyword(getFullName($employee), $keyword),
        highlightKeyword($employee['position'], $keyword),
        e($employee['department']),
        e(formatEmail($employee['email'])),
        e(maskPhone($employee['phone'])),
        e(formatDate($employee['date_hired'])),
        e(formatSalary($employee['salary'])),
        $skillTags,
        $employee['id']
    );
}
