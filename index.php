<?php 
require_once __DIR__.'/config/rec.php';

$users = $controller->read();

$action = isset( $_GET['action'] ) ? $_GET['action'] : '';

switch ( $action ) {
    case 'create':
        include __DIR__ . '/view/student-view/form.php';
        break;

    case 'update':
        if (isset($_GET['id'])) {
            $user = $controller->get_user($_GET['id']);
            include __DIR__ . '/view/student-view/form.php';
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $controller->delete($_GET['id']);
            header("Location: /view/student-view/form.php"); // Redirect back to read.php
            exit;
        }
        break;

    default:
        include __DIR__ . '/view/student-view/table.php';
        break;
}

 require_once __DIR__."/view/layout/footer.php"; 
  ?>