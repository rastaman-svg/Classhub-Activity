<?php
/**
 * employee.php – Profile page for a single employee (employee.php?id=3).
 */
require_once __DIR__ . '/includes/functions.php';

$id       = (int) ($_GET['id'] ?? 0);   // (int) makes sure we only get a number
$employee = findEmployeeById(getEmployees(), $id);

if ($employee === null) {
    http_response_code(404);            // must be sent before any HTML output
}

$pageTitle = $employee ? getFullName($employee) : 'Not Found';
require __DIR__ . '/includes/header.php';
?>

<?php if ($employee === null): ?>
    <div class="empty">
        <h2>Employee not found</h2>
        <a class="btn" href="index.php">← Back to directory</a>
    </div>
<?php else: ?>
    <section class="profile">
        <div class="avatar big"><?= e(getInitials($employee)) ?></div>
        <h2><?= e(getFullName($employee)) ?></h2>
        <p class="position"><?= e($employee['position']) ?> &middot; <?= e($employee['department']) ?></p>

        <table class="profile-table">
            <tr><th>Employee ID</th><td><?= e(formatEmployeeId($employee['id'])) ?></td></tr>
            <tr><th>Email</th><td><?= e(formatEmail($employee['email'])) ?></td></tr>
            <tr><th>Phone</th><td><?= e(maskPhone($employee['phone'])) ?></td></tr>
            <tr><th>Date Hired</th><td><?= e(formatDate($employee['date_hired'])) ?></td></tr>
            <tr><th>Salary</th><td><?= e(formatSalary($employee['salary'])) ?></td></tr>
            <tr><th>Skills</th><td><?= e(skillsToText($employee['skills'])) ?></td></tr>
        </table>

        <a class="btn" href="index.php">← Back to directory</a>
    </section>
<?php endif; ?>

<?php require __DIR__ . '/includes/footer.php'; ?>
