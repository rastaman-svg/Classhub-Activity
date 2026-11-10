<?php
/**
 * includes/header.php
 * Expects $pageTitle to be set before it is included.
 */
$pageTitle = $pageTitle ?? 'Employee Directory';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?> | Employee Directory</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header class="site-header">
        <div class="container">
            <h1><a href="index.php">👥 Employee Directory</a></h1>
            <p>Activity 9 – PHP Mini Information Management System</p>
        </div>
    </header>
    <main class="container">
