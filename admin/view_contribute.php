<?php
    session_start();
    include('../database/connection.php');
    include('../database/database.php');
    require '../Dompdf/autoload.inc.php';

    use Dompdf\Dompdf;
    use Dompdf\Options;

    // Dompdf options
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $options->set('isFontSubsettingEnabled', true);
    $dompdf = new Dompdf($options);

    if (isset($_POST['generate_pdf'])) {

        // Ensure a valid connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Query based on session search
        if (isset($_SESSION['contribute_search']) && !empty($_SESSION['contribute_search'])) {
            $search = $_SESSION['contribute_search'];
            $sql = "SELECT * FROM contribute WHERE Username LIKE '%$search%' ORDER BY Contribute_Created_At DESC";
        } else {
            $sql = "SELECT * FROM contribute ORDER BY Contribute_Created_At DESC";
        }
        
        $result = mysqli_query($conn, $sql);

        // Prepare HTML content
        $html = '
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; font-size: 10px; }
                .header {
                    text-align: center;
                    margin-bottom: 20px;
                }
                .header h2 {
                    font-size: 16px;
                    color: #4CAF50;
                }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { padding: 5px; text-align: left; border: 1px solid #ddd; }
                th { background-color: #4CAF50; color: white; }
                td { font-size: 9px; }
            </style>
        </head>
        <body>
            <div class="header">
                <h2>Contributions Records</h2>
            </div>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Plant Name</th>
                    <th>Tag</th>
                    <th>Family</th>
                    <th>Genus</th>
                    <th>Species</th>
                    <th>Description</th>
                    <th>Date Submitted</th>
                </tr>';

        // Generate table rows
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $html .= "<tr>
                            <td>{$row['Contribute_ID']}</td>
                            <td>{$row['Username']}</td>
                            <td>{$row['Plant_Name']}</td>
                            <td>{$row['Tag']}</td>
                            <td>{$row['Plant_Family']}</td>
                            <td>{$row['Plant_Genus']}</td>
                            <td>{$row['Plant_Species']}</td>
                            <td>{$row['Description_Contribute']}</td>
                            <td>{$row['Contribute_Created_At']}</td>
                        </tr>";
            }
        } else {
            $html .= "<tr><td colspan='9'>No contributions records found</td></tr>";
        }

        $html .= '</table></body></html>';

        // Close the database connection
        mysqli_close($conn);

        // Load HTML into Dompdf
        $dompdf->loadHtml($html, 'UTF-8');

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the PDF
        $dompdf->render();

        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="Contributions_Report.pdf"');
        header('Cache-Control: private, max-age=0, must-revalidate');
        header('Pragma: public');

        // Output the generated PDF
        echo $dompdf->output();
        exit();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="View Plant's Notebook Contributions"/>
    <meta name="keywords" content="Plant's Notebook, Contributions, Admin View"/>
    <title>Plant's Notebook | View Contributions</title>
    <meta name="author" content=" Muhammad Faiz bin Halek"  />
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="icon" type="image/x-icon" href="../images/logo.png">
</head>

<body>
    <?php
        if ($_SESSION['username'] != 'Admin') {
            header('Location: ../index.php'); 
            exit();
        }
    ?>

    <?php
    if (isset($_SESSION['message'])) {
        $messageClass = strpos($_SESSION['message'], 'Error') !== false ? 'error-message' : 'success-message';
        echo "<div class='admin-message {$messageClass}'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']);
    }
    ?>

    <input type='checkbox' id='logoutCheckbox'>
    <div class='logout-background'>
        <div class='logout-content'>
            <p>Are you sure you want to log out?</p>
            <a href='../logout.php' class='confirm-logout'>Yes</a>
            <label for='logoutCheckbox' class='cancel-logout'>No</label>
        </div>
    </div>

    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <p class="logo_admin">
            <a href="../index.php"><img src="../images/logo.png" alt="Plant\'s Notebook">
            <span class="admin_logo_text">Plant's Notebook</span></a>
        </p>

        <div class="sidebar-brand">
            <h2><span class="lab la-accusoft">Admin Control Panel</span></h2>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li><a href="view_register.php" class="admin-register-link"><div class="register-icon-text"><img src="../images/register_icon.png" alt="Register" class="register-sidebar-icon"><span>Register</span></div></a></li>
                <li><a href="view_login.php" class="admin-register-link"><div class="register-icon-text"><img src="../images/login_icon.png" alt="Login" class="login-sidebar-icon"><span>Login</span></div></a></li>
                <li><a href="view_contribute.php" class="active"><img src="../images/contribute_icon.png" alt="contribute" class="contribute-sidebar-icon-main"><span>Contribute</span></a></li>
                <li><a href="view_enquiry.php" class="admin-register-link"><div class="register-icon-text"><img src="../images/enquiry_icon.png" alt="enquiry" class="enquiry-sidebar-icon"><span>Enquiries</span></div></a></li>
                <li><a href="view_pre_contribute.php" class="admin-register-link"><div class="register-icon-text"><img src="../images/pre_contribute_icon.png" alt="pre-contribute" class="pre-contribute-sidebar-icon"><span>Pre-Contribute</span></div></a></li>
                <li><a href="view_comments.php" class="admin-register-link"><div class="register-icon-text"><img src="../images/comments_icon.png" alt="comments" class="comments-sidebar-icon"><span>Comments</span></div></a></li>
                <li><a href="view_feedback.php" class="admin-register-link"><div class="register-icon-text"><img src="../images/feedback_icon.png" alt="feedback" class="feedback-sidebar-icon"><span>Feedback</span></div></a></li>
                <label for='logoutCheckbox' class='admin-logout-button'>Logout</label>
                <label for='logoutCheckbox'><img src="../images/logout-icon.png" alt="Logout" class="admin-logout-icon"Logout></label>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <header class="admin-header">
            <h2 class="admin-header-text">
                Contributions 
            </h2>

            <div class="search-wrapper">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="admin-search-form">
                    <input type="search" name="search" placeholder="Search by username">
                    <button class="admin-search-button" id="admin-button-activate" type="submit">
                        <label for="admin-button-activate">
                            <img src="../images/search_icon.png" alt="Search" class="admin-search-icon">
                        </label>
                    </button>
                </form>
            </div>

            <div class="user-wrapper">
                <img src="../images/admin-icon.jpg" alt="admin profile picture">
                <div>
                    <h4>Admin</h4>
                    <small>Admin</small>
                </div>
            </div>
        </header>

        <main>
            <div class="recent-grid">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>Contributions Records</h3>
                                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <button class="admin-print-button" name="generate_pdf">Print</button>
                                </form>
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                    <button type="submit" name="refresh_table">Refresh</button>
                                </form>
                        </div>
                    
                        <div class="card-body">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Plant Name</th>
                                        <th>Plant Family</th>
                                        <th>Plant Genus</th>
                                        <th>Plant Species</th>
                                        <th>Leaf Image</th>
                                        <th>Herbarium Image</th>
                                        <th class="admin-delete-option">Action</th>
                                    </tr>
                                </thead>
                                <?php
                                $conn = mysqli_connect($servername, $username, $password, $dbname);

                                $_SESSION['contribute_search'] = ''; 
                                
                                $sql = "SELECT * FROM contribute";
                                
                                if (isset($_POST['search']) && !empty($_POST['search'])) {
                                    $search = mysqli_real_escape_string($conn, $_POST['search']);
                                    $sql .= " WHERE Username LIKE '%$search%'";
                                    $_SESSION['contribute_search'] = $search; 
                                }
                                $sql .= " ORDER BY Contribute_Created_At DESC";
                                
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                        <tr>
                                            <td><?php echo $row["Username"]; ?></td>
                                            <td><?php echo $row["Plant_Name"]; ?></td>
                                            <td><?php echo $row["Plant_Family"]; ?></td>
                                            <td><?php echo $row["Plant_Genus"]; ?></td>
                                            <td><?php echo $row["Plant_Species"]; ?></td>
                                            <td class='admin_leaf_photo'>        
                                                <?php 
                                                $contribution = $row["Plant_Leaf_Photo"];
                                                echo "<img src='../$contribution' alt='Leaf Photo'>";
                                                ?>
                                            </td>
                                            <td class='admin_herbarium_photo'>    
                                                <?php 
                                                $contribution = $row["Plant_Herbarium_Photo"];
                                                echo "<img src='../$contribution' alt='Herbarium Photo'>";
                                                ?>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="toggle-<?php echo $row['Contribute_ID']; ?>" class="toggle-checkbox">
                                                <label for="toggle-<?php echo $row['Contribute_ID']; ?>" class="kebab-menu-icon">
                                                    <img src="../images/kebab-menu.webp" alt="kebab menu" class="kebab-menu-icon">
                                                </label>
                                                <div class="menu-content">
                                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                                                        <input type="hidden" name="view_id" value="<?php echo $row['Contribute_ID']; ?>">
                                                        <button type="submit" class="admin-view-button menu-button">View</button>
                                                    </form>
                                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                                                        <input type="hidden" name="edit_id" value="<?php echo $row['Contribute_ID']; ?>">
                                                        <button type="submit" class="admin-edit-button menu-button">Edit</button>
                                                    </form>
                                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                                                        <input type="hidden" name="id" value="<?php echo $row['Contribute_ID']; ?>">
                                                        <button type="submit" class="admin-delete-button menu-button">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='8'>No contributions records found</td></tr>";
                                }
                                mysqli_close($conn);
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <?php
        include '../database/connection.php';
        include '../database/database.php';

        if (isset($_POST['confirm_delete'])) {
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            
            $id = $_POST['id'];
            
            $sql = "DELETE FROM contribute WHERE Contribute_ID = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $id);
            
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['message'] = 'Record deleted successfully';
                echo"<meta http-equiv='refresh' content='0 ;url=view_contribute.php'>";  
            } else {
                $_SESSION['message'] = 'Error deleting record: ' . mysqli_error($conn);
            }
            
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            ?>
            <div class="modal-overlay">
                <div class="confirmation-box">
                    <h2>Are you sure you want to delete this record?</h2>
                    <div class="button-group">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                            <input type="hidden" name="confirm_delete" value="1">
                            <button type="submit" class="confirm-button">Yes, Delete</button>
                        </form>
                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="cancel-button">Cancel</a>
                    </div>
                </div>
            </div>
            <?php
            exit(); 
        }
    ?>

<?php
if (isset($_GET['view_id'])) {
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $id = mysqli_real_escape_string($conn, $_GET['view_id']);
    $sql = "SELECT * FROM contribute WHERE Contribute_ID = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if ($row) {
        ?>
        <div class="view-modal-overlay">
            <div class="view-modal-content">
                <div class="view-modal-header">
                    <h2>Contribution Details</h2>
                </div>
                <div class="detail-row">
                    <strong>ID:</strong> <?php echo htmlspecialchars($row['Contribute_ID']); ?>
                </div>
                <div class="detail-row">
                    <strong>Username:</strong> <?php echo htmlspecialchars($row['Username']); ?>
                </div>
                <div class="detail-row">
                    <strong>Plant Name:</strong> <?php echo htmlspecialchars($row['Plant_Name']); ?>
                </div>
                <div class="detail-row">
                    <strong>Tag:</strong> <?php echo htmlspecialchars($row['Tag']); ?>
                </div>
                <div class="detail-row">
                    <strong>Picture Option:</strong> <?php echo htmlspecialchars($row['Picture_Option']); ?>
                </div>
                <div class="detail-row">
                    <strong>Plant Family:</strong> <?php echo htmlspecialchars($row['Plant_Family']); ?>
                </div>
                <div class="detail-row">
                    <strong>Plant Genus:</strong> <?php echo htmlspecialchars($row['Plant_Genus']); ?>
                </div>
                <div class="detail-row">
                    <strong>Plant Species:</strong> <?php echo htmlspecialchars($row['Plant_Species']); ?>
                </div>
                <div class="detail-row">
                    <strong>Description:</strong> <?php echo htmlspecialchars($row['Description_Contribute']); ?>
                </div>
                <div class="detail-row admin_leaf_photo">
                    <strong>Leaf Image:</strong> <?php $contribution = $row["Plant_Leaf_Photo"];
                    echo "<img src='../$contribution' alt='Leaf Photo'>";
                     ?>
                </div>
                <div class="detail-row admin_herbarium_photo">
                    <strong>Herbarium Image:</strong> <?php $contribution = $row["Plant_Herbarium_Photo"];
                    echo "<img src='../$contribution' alt='Herbarium Photo'>";
                     ?>
                </div>
                <div class="detail-row">
                    <strong>Date Submitted:</strong> <?php echo htmlspecialchars($row['Contribute_Created_At']); ?>
                </div>
                <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="close-view-button">Close</a>
            </div>
        </div>
        <?php
    }
    mysqli_close($conn);
}
?>

<?php
if (isset($_GET['edit_id'])) {
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $id = mysqli_real_escape_string($conn, $_GET['edit_id']);
    $sql = "SELECT * FROM contribute WHERE Contribute_ID = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if ($row) {
        ?>
        <div class="view-modal-overlay">
            <div class="view-modal-content">
                <div class="view-modal-header">
                    <h2>Edit Contribution Details</h2>
                </div>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="edit-form">
                    <input type="hidden" name="edit_contribute_id" value="<?php echo htmlspecialchars($row['Contribute_ID']); ?>">
                    
                    <div class="detail-row">
                        <strong>ID:</strong> <?php echo htmlspecialchars($row['Contribute_ID']); ?>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Username:</strong>
                        <input type="text" name="edit_username" value="<?php echo htmlspecialchars($row['Username']); ?>" required>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Plant Name:</strong>
                        <input type="text" name="edit_plant_name" value="<?php echo htmlspecialchars($row['Plant_Name']); ?>" required>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Tag:</strong>
                        <input type="text" name="edit_tag" value="<?php echo htmlspecialchars($row['Tag']); ?>" required>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Picture Option:</strong>
                        <input type="text" name="edit_picture_option" value="<?php echo htmlspecialchars($row['Picture_Option']); ?>" required>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Plant Family:</strong>
                        <input type="text" name="edit_plant_family" value="<?php echo htmlspecialchars($row['Plant_Family']); ?>" required>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Plant Genus:</strong>
                        <input type="text" name="edit_plant_genus" value="<?php echo htmlspecialchars($row['Plant_Genus']); ?>" required>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Plant Species:</strong>
                        <input type="text" name="edit_plant_species" value="<?php echo htmlspecialchars($row['Plant_Species']); ?>" required>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Description:</strong>
                        <textarea name="edit_description_contribute" required><?php echo htmlspecialchars($row['Description_Contribute']); ?></textarea>
                    </div>

                    <div class="detail-row">
                        <strong>Plant Leaf Photo:</strong>
                        <input type="text" name="edit_plant_leaf_photo" value="<?php echo htmlspecialchars($row['Plant_Leaf_Photo']); ?>" required>
                    </div>

                    <div class="detail-row">
                        <strong>Plant Herbarium Photo:</strong>
                        <input type="text" name="edit_plant_herbarium_photo" value="<?php echo htmlspecialchars($row['Plant_Herbarium_Photo']); ?>" required>
                    </div>
                    
                    <div class="detail-row">
                        <strong>Date:</strong> <?php echo htmlspecialchars($row['Contribute_Created_At']); ?>
                    </div>
                    
                    <div class="button-group">
                        <button type="submit" name="update_contribute" class="save-button">Save Changes</button>
                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="cancel-button">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
        <?php
    }
    mysqli_close($conn);
}

// Update the form submission handler
if (isset($_POST['update_contribute'])) {
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    $id = mysqli_real_escape_string($conn, $_POST['edit_contribute_id']);
    $username = mysqli_real_escape_string($conn, $_POST['edit_username']);
    $plant_name = mysqli_real_escape_string($conn, $_POST['edit_plant_name']);
    $tag = mysqli_real_escape_string($conn, $_POST['edit_tag']);
    $picture_option = mysqli_real_escape_string($conn, $_POST['edit_picture_option']);
    $plant_family = mysqli_real_escape_string($conn, $_POST['edit_plant_family']);
    $plant_genus = mysqli_real_escape_string($conn, $_POST['edit_plant_genus']);
    $plant_species = mysqli_real_escape_string($conn, $_POST['edit_plant_species']);
    $description_contribute = mysqli_real_escape_string($conn, $_POST['edit_description_contribute']);
    $plant_leaf_photo = mysqli_real_escape_string($conn, $_POST['edit_plant_leaf_photo']);
    $plant_herbarium_photo = mysqli_real_escape_string($conn, $_POST['edit_plant_herbarium_photo']);
    
    $sql = "UPDATE contribute SET Username=?, Plant_Name=?, Tag=?, Picture_Option=?, Plant_Family=?, 
            Plant_Genus=?, Plant_Species=?, Description_Contribute=?, Plant_Leaf_Photo=?, Plant_Herbarium_Photo=? 
            WHERE Contribute_ID=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssssssi", $username, $plant_name, $tag, $picture_option, $plant_family, 
                          $plant_genus, $plant_species, $description_contribute, $plant_leaf_photo, $plant_herbarium_photo, $id);
    
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = 'Record updated successfully';
    } else {
        $_SESSION['message'] = 'Error updating record: ' . mysqli_error($conn);
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    
    echo "<meta http-equiv='refresh' content='0;url=view_contribute.php'>";
    exit();
}
?>
</body>
</html>