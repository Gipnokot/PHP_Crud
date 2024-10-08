<?php 

include 'db.php';

function clean_input($data) {
    return htmlspecialchars(trim($data));
}

$name = isset($_POST['name']) ? clean_input($_POST['name']) : '';
$email = isset($_POST['email']) ? clean_input($_POST['email']) : '';

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

$errors = [];

// Add
if (isset($_POST['add'])) {
    if (empty($name)) {
        $errors[] = 'Name field is required.';
    }
    if (empty($email)) {
        $errors[] = 'Email field is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }
    if (empty($errors)) {
        try {
            $sql = "INSERT INTO users (name, email) VALUES (?, ?)";
            $query = $pdo->prepare($sql);
            $query->execute([$name, $email]);
            if ($query) {
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit;
            }
        } catch (PDOException $e) {
            $errors[] = "Error adding user: " . $e->getMessage();
        }
    }
}

// Read
try {
    $sql = $pdo->prepare("SELECT * FROM users WHERE flag = 0");
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    $errors[] = "Error fetching users: " . $e->getMessage();
}

// Update
if (isset($_POST['edit']) && $id !== null) {
    if (empty($name)) {
        $errors[] = 'Name field is required.';
    }
    if (empty($email)) {
        $errors[] = 'Email field is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }
    if (empty($errors)) {
        try {
            $sql = "UPDATE users SET name=?, email=? WHERE id = ?";
            $query = $pdo->prepare($sql);
            $query->execute([$name, $email, $id]);
            if ($query) {
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit;
            }
        } catch (PDOException $e) {
            $errors[] = "Error updating user: " . $e->getMessage();
        }
    }
}

// Delete
if (isset($_POST['delete']) && $id !== null) {
    try {
        $sql = "UPDATE users SET flag = 1 WHERE id = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$id]);
        if ($query) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }
    } catch (PDOException $e) {
        $errors[] = "Error deleting user: " . $e->getMessage();
    }
}

// Errors
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<div class='alert alert-danger'>$error</div>";
    }
}
