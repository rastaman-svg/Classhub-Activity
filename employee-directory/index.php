<?php
/**
 * index.php – Home page: summary, search/filter/sort form, employee cards.
 */
require_once __DIR__ . '/includes/functions.php';

// 1. Load data
$allEmployees = getEmployees();
$departments  = getDepartments($allEmployees);

// 2. Read GET values (trim removes accidental spaces)
$keyword    = trim($_GET['q'] ?? '');
$department = trim($_GET['department'] ?? '');
$sortBy     = $_GET['sort'] ?? 'name';
$direction  = $_GET['order'] ?? 'asc';

// 3. Whitelist values so odd input can't break anything
if (!in_array($sortBy, ['name', 'date_hired'], true)) { $sortBy = 'name'; }
if (!in_array($direction, ['asc', 'desc'], true))     { $direction = 'asc'; }
if ($department !== '' && !in_array($department, $departments, true)) { $department = ''; }

// 4. Process: search -> filter -> sort
$results = searchEmployees($allEmployees, $keyword);
$results = filterByDepartment($results, $department);
$results = sortEmployees($results, $sortBy, $direction);

// 5. Summary numbers (always based on ALL employees)
$totalEmployees = count($allEmployees);
$deptCounts     = countByDepartment($allEmployees);

$pageTitle = 'Home';
require __DIR__ . '/includes/header.php';
?>

<!-- SUMMARY -->
<section class="summary">
    <div class="summary-box total">
        <span class="number"><?= $totalEmployees ?></span>
        <span class="label">Total Employees</span>
    </div>
    <?php foreach ($deptCounts as $deptName => $count): ?>
        <div class="summary-box">
            <span class="number"><?= $count ?></span>
            <span class="label"><?= e($deptName) ?></span>
        </div>
    <?php endforeach; ?>
</section>

<!-- SEARCH / FILTER / SORT (GET form) -->
<form class="filter-form" method="get" action="index.php">
    <input type="text" name="q" placeholder="Search by name or position..." value="<?= e($keyword) ?>">

    <select name="department">
        <option value="">All Departments</option>
        <?php foreach ($departments as $dept): ?>
            <option value="<?= e($dept) ?>" <?= $dept === $department ? 'selected' : '' ?>>
                <?= e($dept) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <select name="sort">
        <option value="name"       <?= $sortBy === 'name' ? 'selected' : '' ?>>Sort: Name</option>
        <option value="date_hired" <?= $sortBy === 'date_hired' ? 'selected' : '' ?>>Sort: Date Hired</option>
    </select>

    <select name="order">
        <option value="asc"  <?= $direction === 'asc' ? 'selected' : '' ?>>Ascending</option>
        <option value="desc" <?= $direction === 'desc' ? 'selected' : '' ?>>Descending</option>
    </select>

    <button type="submit">Apply</button>
    <a class="reset" href="index.php">Reset</a>
</form>

<p class="result-count">
    Showing <strong><?= count($results) ?></strong> of <?= $totalEmployees ?> employees
    <?php if ($keyword !== ''): ?> matching "<strong><?= e($keyword) ?></strong>"<?php endif; ?>
    <?php if ($department !== ''): ?> in <strong><?= e($department) ?></strong><?php endif; ?>
</p>

<!-- RESULTS -->
<?php if (count($results) > 0): ?>
    <section class="grid">
        <?php foreach ($results as $employee): ?>
            <?= renderEmployeeCard($employee, $keyword) ?>
        <?php endforeach; ?>
    </section>
<?php else: ?>
    <div class="empty">
        <h2>😕 No records found</h2>
        <p>Try a different keyword or choose another department.</p>
        <a class="btn" href="index.php">Show all employees</a>
    </div>
<?php endif; ?>

<?php require __DIR__ . '/includes/footer.php'; ?>
