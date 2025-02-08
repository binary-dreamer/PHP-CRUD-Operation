<?php
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'create':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Handle file upload
                $photo = $_FILES['photo']['name'];
                $target = "assets/images/" . basename($photo);

                if (move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
                    $controller->create($_POST['name'], $_POST['email'], $_POST['password'], $_POST['gender'], $photo);
                    header("Location: index.php");
                    exit;
                }
            }
            break;

        case 'update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Handle file upload if a new photo is provided
                $photo = $_FILES['photo']['name'];
                $target = "assets/images/" . basename($photo);

                if (!empty($photo) && move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
                    // Update with new photo
                    $controller->update($_POST['id'], $_POST['name'], $_POST['email'], $_POST['gender'], $photo);
                } else {
                    // Update without changing the photo
                    $controller->update($_POST['id'], $_POST['name'], $_POST['email'], $_POST['gender'], null);
                }

                header("Location: index.php");
                exit;
            }
            break;

        case 'delete':
            if (isset($_GET['id'])) {
                $controller->delete($_GET['id']);
                header("Location: index.php");
                exit;
            }
            break;
    }
}













