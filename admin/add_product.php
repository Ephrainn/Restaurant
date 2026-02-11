<?php
// admin/add_product.php
session_start();
require_once '../includes/db_connect.php';

// Auth Check
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$error = '';
$success = '';
$edit_mode = false;
$product = [
    'name' => '',
    'description' => '',
    'price' => '',
    'category_id' => '',
    'image_url' => ''
];

// Fetch Categories for Dropdown
$cat_stmt = $pdo->query("SELECT * FROM categories");
$categories = $cat_stmt->fetchAll();

// Check for Edit Mode
if (isset($_GET['edit'])) {
    $edit_mode = true;
    $id = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $fetched_product = $stmt->fetch();
    if ($fetched_product) {
        $product = $fetched_product;
    }
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $image_url = $product['image_url']; // Default to existing

    // Handle File Upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $target_dir = "../assets/images/uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
        $new_filename = uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $new_filename;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_url = "assets/images/uploads/" . $new_filename;
        }
        else {
            $error = "Failed to upload image.";
        }
    }
    elseif (isset($_POST['image_url_text']) && !empty($_POST['image_url_text'])) {
        // Allow external URL if no file uploaded
        $image_url = $_POST['image_url_text'];
    }

    if (!$error) {
        if ($edit_mode) {
            $stmt = $pdo->prepare("UPDATE products SET name=?, description=?, price=?, category_id=?, image_url=? WHERE id=?");
            $stmt->execute([$name, $description, $price, $category_id, $image_url, $id]);
            $success = "Product updated successfully!";
            // Update local variable to reflect changes
            $product = ['id' => $id, 'name' => $name, 'description' => $description, 'price' => $price, 'category_id' => $category_id, 'image_url' => $image_url];
        }
        else {
            $stmt = $pdo->prepare("INSERT INTO products (name, description, price, category_id, image_url) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $description, $price, $category_id, $image_url]);
            $success = "Product added successfully!";
            // Reset form
            $product = ['name' => '', 'description' => '', 'price' => '', 'category_id' => '', 'image_url' => ''];
        }
    }
}

// Get username
$username = $_SESSION['username'];
$user_initial = strtoupper(substr($username, 0, 1));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $edit_mode ? 'Edit' : 'Add'; ?> Product - Bite Hive Admin</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="admin-body">

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Sidebar Navigation -->
<aside class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <i class="fas fa-utensils"></i>
            <h2>Bite Hive</h2>
        </div>
    </div>
    
    <nav class="sidebar-nav">
        <ul>
            <li>
                <a href="dashboard.php">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="add_product.php" class="active">
                    <i class="fas fa-plus-circle"></i>
                    <span>Add Product</span>
                </a>
            </li>
            <li>
                <a href="../menu.php" target="_blank">
                    <i class="fas fa-eye"></i>
                    <span>View Website</span>
                </a>
            </li>
            <li>
                <a href="logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </nav>
    
    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="sidebar-user-avatar"><?php echo $user_initial; ?></div>
            <div class="sidebar-user-info">
                <h4><?php echo htmlspecialchars($username); ?></h4>
                <p>Administrator</p>
            </div>
        </div>
    </div>
</aside>

<!-- Main Content -->
<main class="admin-main">
    <!-- Header -->
    <header class="admin-header">
        <div style="display: flex; align-items: center; gap: 1rem;">
            <button class="mobile-menu-toggle" id="mobileMenuToggle">
                <i class="fas fa-bars"></i>
            </button>
            <h1><?php echo $edit_mode ? 'Edit' : 'Add New'; ?> Product</h1>
        </div>
        <div class="admin-header-actions">
            <a href="dashboard.php" class="btn-primary-admin">
                <i class="fas fa-arrow-left"></i>
                Back to Dashboard
            </a>
        </div>
    </header>
    
    <!-- Content -->
    <div class="admin-content">
        <div class="content-card" style="max-width: 800px; margin: 0 auto;">
            <div class="content-card-body">
                <?php if ($success): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <span><?php echo $success; ?></span>
                    </div>
                <?php
endif; ?>
                
                <?php if ($error): ?>
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        <span><?php echo $error; ?></span>
                    </div>
                <?php
endif; ?>

                <form method="POST" enctype="multipart/form-data" class="admin-form">
                    
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-signature"></i>
                            Product Name
                        </label>
                        <input type="text" 
                               name="name" 
                               class="form-input"
                               value="<?php echo htmlspecialchars($product['name']); ?>" 
                               placeholder="Enter product name"
                               required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-tag"></i>
                            Category
                        </label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Select Category</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>" <?php echo $product['category_id'] == $cat['id'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($cat['name']); ?>
                                </option>
                            <?php
endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-dollar-sign"></i>
                            Price
                        </label>
                        <input type="number" 
                               step="0.01" 
                               name="price" 
                               class="form-input"
                               value="<?php echo htmlspecialchars($product['price']); ?>" 
                               placeholder="0.00"
                               required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-align-left"></i>
                            Description
                        </label>
                        <textarea name="description" 
                                  class="form-textarea"
                                  placeholder="Enter product description"><?php echo htmlspecialchars($product['description']); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-image"></i>
                            Product Image
                        </label>
                        
                        <div style="margin-bottom: 1rem;">
                            <label for="imageFile" class="form-file-label">
                                <i class="fas fa-upload"></i>
                                Upload Image File
                            </label>
                            <input type="file" 
                                   name="image" 
                                   id="imageFile"
                                   accept="image/*" 
                                   style="display: none;"
                                   onchange="previewImage(event)">
                        </div>
                        
                        <div class="form-divider">OR</div>
                        
                        <input type="text" 
                               name="image_url_text" 
                               class="form-input"
                               value="<?php echo htmlspecialchars($product['image_url']); ?>" 
                               placeholder="https://example.com/image.jpg"
                               onchange="previewImageURL(this.value)">
                        
                        <?php if (!empty($product['image_url'])): ?>
                        <div class="image-preview" id="imagePreview">
                            <img src="../<?php echo htmlspecialchars($product['image_url']); ?>" 
                                 alt="Preview"
                                 id="previewImg">
                        </div>
                        <?php
else: ?>
                        <div class="image-preview" id="imagePreview" style="display: none;">
                            <img src="" alt="Preview" id="previewImg">
                        </div>
                        <?php
endif; ?>
                    </div>

                    <button type="submit" class="btn-primary-admin" style="width: 100%; padding: 1rem; font-size: 1rem;">
                        <i class="fas fa-<?php echo $edit_mode ? 'save' : 'plus'; ?>"></i>
                        <?php echo $edit_mode ? 'Update Product' : 'Add Product'; ?>
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
// Mobile menu toggle
const mobileMenuToggle = document.getElementById('mobileMenuToggle');
const adminSidebar = document.getElementById('adminSidebar');
const sidebarOverlay = document.getElementById('sidebarOverlay');

if (mobileMenuToggle) {
    mobileMenuToggle.addEventListener('click', function() {
        adminSidebar.classList.toggle('active');
        sidebarOverlay.classList.toggle('active');
    });
}

if (sidebarOverlay) {
    sidebarOverlay.addEventListener('click', function() {
        adminSidebar.classList.remove('active');
        sidebarOverlay.classList.remove('active');
    });
}

// Image preview functionality
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('imagePreview');
            const previewImg = document.getElementById('previewImg');
            previewImg.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}

function previewImageURL(url) {
    if (url) {
        const preview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        previewImg.src = url.startsWith('http') ? url : '../' + url;
        preview.style.display = 'block';
    }
}
</script>

</body>
</html>
