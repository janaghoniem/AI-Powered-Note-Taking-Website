<?php

include '../includes/folder_class.php';

// Create folder function
if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $type = $_POST['dropdown'];
    $parent_folder_id = 1; 

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    if ($type == "option2") {
        if (folder::create($name, $parent_folder_id)) {
            header("Location: ../pages/folder_contents.php");
            exit();
        } else {
            echo "ERROR!";
        }
    } else {
        echo "Invalid folder type!";
    }
}
//delete function
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    echo "Received Folder ID: " . $id . "<br>";
    if ($id) {
        $folder = new folder($id);
        echo "Folder ID: " . $folder->ID . "<br>"; // Debugging statement
        if (folder::delete($folder)) {
            header("Location: ../pages/Folders.php");
            exit();
        } else {
            echo "Error deleting folder.";
        }
    } else {
        echo "No folder ID provided.";
    }
}



?> 


<aside class="sidebar" id="sidebar">
    <div class="logo">
        <h2>SmartNotes</h2>
    </div>
    <button class="add-new">
        <div class="add-icon">+</div> New
        <div class="color-options">
            <span class="dot yellow"></span>
            <span class="dot green"></span>
            <span class="dot red"></span>
        </div>
    </button>

    <ul class="menu">

        <ul class="menu">
            <a href="./UserDashboard.php">
                <li>
                    <span class="icon"><i class="fa-solid fa-house" style="font-size:20px;"></i></span> Home
                </li>
            </a>
            <a href="./trash.php">
                <li>
                    <span class="icon">🗑️</span> Trash
                </li>
            </a>

            <a href="./Folders.php">
                <li>
                    <span class="icon">🗂️</span> Folders
                </li>
            </a>
            <a href="./.php">
                <li>
                    <span class="icon">🎤</span> Speech to Text
                </li>
            </a>
            <a href="./uploads.php">
                <li>
                    <span class="icon"><i class="fa-solid fa-upload" style="font-size:20px;"></i></span> Upload
                </li>
            </a>

        </ul>
    </ul>
    <div class="pro-upgrade">
        <img src="../assets/images/medal.jpg" alt="Upgrade icon">
        <p>Every day is a new badge waiting for you!</p>
    </div>
</aside>
<main class="main-content">
    <header class="header">
        <div class="search-profile">
            <div class="toggle-sidebar">
                <i class="fa-solid fa-bars" id="hamburger-icon"></i>
                <i class="fa-solid fa-xmark" id="close-icon" style="display: none;"></i>
            </div>
        </div>
    </header>
</main>
<div class="pop-up">
    <div class="content">
        <div class="container">
            <div class="dots">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
            <span class="close"><i class="fa-solid fa-xmark"></i></span>
            <!-- <div class="title">
                <h1>Add</h1>
            </div> -->
            <div class="add-item">

                <form action="" method="post">
                    <h1>What's on Your Mind?💡</h1>
                    <div class="form-row">
                        <img src="../assets/images/flower.png" alt="Upgrade icon" width="100px">
                        <div class="input-data">
                            <input type="text" id="name" name="name" required>
                            <div class="underline"></div>
                            <label for="">Name</label>
                            <select id="dropdown" name="dropdown">
                                <option value="option1">Choose..</option>
                                <option value="option2">Folder</option>
                                <option value="option3">File</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="input-data textarea">
                            <br />
                            <div class="underline"></div>
                            <br />
                            <div class="form-row submit-btn">
                                <div class="input-data">
                                    <div class="inner"></div>
                                    <input type="submit" value="submit" name="submit">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="deleteModal" class="modal" style="display:none;">
    <div class="modal-content">
        <p>Are you sure you want to delete this folder?</p><br><br>
        <form id="deleteForm" method="post" action="">
            <input type="hidden" id="folder_id" name="id">
            <button type="submit" class="btn-confirm">Yes, delete</button>
            <button type="button" class="btn-cancel" onclick="closeModal()">Cancel</button>
        </form>
    </div>
</div>



