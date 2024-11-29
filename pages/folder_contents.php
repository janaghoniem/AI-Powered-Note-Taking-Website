<?php
ob_start();

include_once '../includes/session.php';

//set current page to update sidebar status
$current_page = 'Folder Content';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Folders</title>
    <link rel="stylesheet" href="../assets/css/user_style.css">
    <link rel="stylesheet" href="../assets/css/folders.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/now-ui-dashboard.css" rel="stylesheet" />
    <link href="../assets/css/demo.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .note,
        .folder {
            height: 12.5em !important;
        }

        button:disabled {
            background-color: #e0e0e0;
            color: #777;
            cursor: not-allowed;
            opacity: 0.6;
            border: none;
        }

        .popover-btn:disabled {
            background-color: #e0e0e0;
            color: #888;
        }

        .black-placeholder::placeholder {
            color: black !important;
            opacity: 1;
        }

        button:disabled {
            background-color: #e0e0e0;
            color: #777;
            cursor: not-allowed;
            opacity: 0.6;
            border: none;
        }

        .popover-btn:disabled {
            background-color: #e0e0e0;
            color: #888;
        }

        .black-placeholder::placeholder {
            color: black !important;
            opacity: 1;
        }

        .note {
            position: relative;
        }

        .popover {
            position: absolute;
            top: 0;
            width: 8em;
            right: 100%;
            margin-left: 10px;
            display: none;
            background: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 300000;
        }

        .note:hover .popover {
            display: block;
        }

        .filter-buttons button.active {
            background-color: #f1f1f1;
            color: #555;
            border-radius: 5px;
            border-bottom: 1px solid black;

        }
        .filter-buttons {
            display: flex;
            gap: 10px;
        }


        /* Dropdown container */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        /* Dropdown button */
        .dropbtn {
            padding: 8px 12px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .dropbtn:hover {
            background-color: #0056b3;
        }

        /* Dropdown content */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 4px;
            overflow: hidden;
        }

        /* Links inside dropdown */
        .dropdown-content a {
            color: black;
            padding: 10px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        /* Show the dropdown on hover */
        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>


</head>

<body>
    <div class="wrapper">
        <?php include '../includes/sidebar.php'; ?>
        <div class="main-panel" id="main-panel">
            <?php include '../includes/user_navbar.php' ?>
            <main class="content">
                <section class="bordered-content">
                    <h3 style="margin-bottom: 15px;">
                        <?php
                        $current_folder_id = $_GET['folder_id'] ?? 1;
                        $current_folder = new folder($current_folder_id);
                        echo htmlspecialchars($current_folder->name);
                        ?>
                    </h3>
                    <section class="recent-folders">
                    <div class="filter-buttons">
                            <button class="filter-btn" data-filter="today">Today</button>
                            <button class="filter-btn" data-filter="this week">This Week</button>
                            <button class="filter-btn" data-filter="this month">This Month</button>
                            <div class="dropdown">
                                <button class="dropbtn">Sort by</button>
                                <div class="dropdown-content">
                                    <a href="#" data-sort="name">Name</a>
                                    <a href="#" data-sort="created">Date Created</a>
                                    <a href="#" data-sort="modified">Last Modified</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="folders">
                            <?php
                            include_once '../includes/folder_class.php';
                            include_once '../includes/session.php';
                            $user_id = $_SESSION['UserID'];
                            $current_folder_id = $_GET['folder_id'] ?? 1;

                            $obj = folder::readByParent($user_id,$current_folder_id);
                            $colors = ['blue', 'yellow', 'red'];
                            if ($obj) {
                                for ($j = 0; $j < count($obj); $j++) {
                                    $color = $colors[$j % count($colors)];
                                    $folderId = $obj[$j]['ID'];
                                    $folderName = strtolower($obj[$j]['name']);
                                    $isGeneral = ($folderId == 1 && $folderName == 'general');
                                    ?>
                                    <div class="folder <?php echo $color; ?>"
                                        data-created-at="<?php echo htmlspecialchars($obj[$j]['created_at']); ?>">
                                        <a href="folder_contents.php?folder_id=<?php echo $folderId; ?>" class="folder-link">
                                            <i class="fa-solid fa-folder fold"></i>
                                            <p><?php echo htmlspecialchars($obj[$j]['name']); ?></p>
                                        </a>
                                        <span><?php echo htmlspecialchars($obj[$j]['created_at']); ?></span>
                                        <i class="fa-solid fa-ellipsis ellipsis"></i>
                                        <div class="popover" style="z-index: 300000;">
                                            <!-- Rename Button -->
                                            <button class="popover-btn rename" data-folder-id="<?php echo $folderId; ?>">
                                                Rename
                                            </button>
                                            <button class="popover-btn move" data-folder-id="<?php echo $folderId; ?>">
                                                Move
                                            </button>
                                            <!-- Delete Button -->
                                            <button class="popover-btn delete" data-item-id="<?php echo $folderId; ?>"
                                                data-item-type="folder">
                                                Delete
                                            </button>
                                        </div>
                                    </div>

                                    <?php
                                }
                            }
                            ?>
                        </div>

                        <br>
                        <div class="notes">
                        
                            <?php
                            $user_id = $_SESSION['UserID'];
                            $folder_id = isset($_GET['folder_id']) ? $_GET['folder_id'] : null;
                            $files = file::readAll($user_id, $folder_id);
                            ?>

                            <?php if ($files): ?>
                                <?php foreach ($files as $index => $file): ?>
                                    <div class="note <?php echo $colors[$index % 3]; ?>"
                                        data-note-id="<?php echo $file['id']; ?>"
                                        data-created-at="<?php echo $file['created_at']; ?>">
                                        <!-- Add data attribute for created_at -->
                                        <span><?php echo date('d/m/Y', strtotime($file['created_at'])); ?></span>
                                        <h3 class="note-name">
                                            <?php echo htmlspecialchars($file['name'], ENT_QUOTES, 'UTF-8'); ?>
                                            <i class="fa-solid fa-ellipsis ellipsis"></i>

                                            <div class="popover" style="z-index: 300000;">
                                                <button class="popover-btn rename"
                                                    data-note-id="<?php echo $file['id']; ?>">Rename</button>
                                                <button class="popover-btn move"
                                                    data-folder-id="<?php echo $folder_id; ?>">Move</button>
                                                <button class="popover-btn delete" data-item-id="<?php echo $file['id']; ?>"
                                                    data-item-type="file">Delete</button>
                                            </div>
                                        </h3>
                                        <hr>
                                        <p><?php echo strlen($file['content']) > 100 ? substr($file['content'], 0, 100) . '...' : $file['content']; ?>
                                        </p>
                                        <span
                                            class="bottom"><?php echo "⏱️ " . date('h:i A, l', strtotime($file['created_at'])); ?></span>
                                    </div>

                                <?php endforeach; ?>
                            <?php else: ?>
                            <?php endif; ?>
                        </div>
                        <div id="no-results" style="display: none; text-align: center; color: gray;">
                                        No results found.
                                    </div>
                    </section>
                </section>
            </main>
        </div>
        <script src="../assets/js/sidebar.js"></script>
        <!--   Core JS Files   -->
        <script src="../assets/js/core/jquery.min.js"></script>
        <script src="../assets/js/core/popper.min.js"></script>
        <script src="../assets/js/core/bootstrap.min.js"></script>
        <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
        <!-- Chart JS -->
        <script src="../assets/js/plugins/chartjs.min.js"></script>
        <!--  Notifications Plugin    -->
        <script src="../assets/js/plugins/bootstrap-notify.js"></script>
        <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script>

        <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filterButtons = document.querySelectorAll('.filter-buttons .filter-btn');
            const sortLinks = document.querySelectorAll('.dropdown-content a');
            const folders = document.querySelectorAll('.folder');
            const notes = document.querySelectorAll('.note');

            function sortElements(elements, sortBy) {
                let sortedElements = Array.from(elements);
                sortedElements.sort((a, b) => {
                    if (sortBy === 'name') {
                        return a.querySelector('p').textContent.localeCompare(b.querySelector('p').textContent);
                    } else if (sortBy === 'created') {
                        return new Date(a.getAttribute('data-created-at')) - new Date(b.getAttribute('data-created-at'));
                    } else if (sortBy === 'modified') {
                        // Assuming data-modified-at attribute is present
                        return new Date(a.getAttribute('data-modified-at')) - new Date(b.getAttribute('data-modified-at'));
                    }
                });
                return sortedElements;
            }

            function applyFilterAndSort(filter = null, sortBy = null) {
                const today = new Date();
                let startDate;

                if (filter === 'today') {
                    startDate = new Date(today.setHours(0, 0, 0, 0));
                } else if (filter === 'this week') {
                    const firstDayOfWeek = today.getDate() - today.getDay();
                    startDate = new Date(today.setDate(firstDayOfWeek));
                    startDate.setHours(0, 0, 0, 0);
                } else if (filter === 'this month') {
                    startDate = new Date(today.getFullYear(), today.getMonth(), 1);
                    startDate.setHours(0, 0, 0, 0);
                }

                let filteredFolders = Array.from(folders);
                let filteredNotes = Array.from(notes);

                if (filter) {
                    filteredFolders = filteredFolders.filter(folder => new Date(folder.getAttribute('data-created-at')) >= startDate);
                    filteredNotes = filteredNotes.filter(note => new Date(note.getAttribute('data-created-at')) >= startDate);
                }

                if (sortBy) {
                    filteredFolders = sortElements(filteredFolders, sortBy);
                    filteredNotes = sortElements(filteredNotes, sortBy);
                }

                document.querySelector('.folders').innerHTML = '';
                document.querySelector('.notes').innerHTML = '';

                filteredFolders.forEach(folder => document.querySelector('.folders').appendChild(folder));
                filteredNotes.forEach(note => document.querySelector('.notes').appendChild(note));
            }

            filterButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const isActive = this.classList.contains('active');

                    // Remove active class from all buttons
                    filterButtons.forEach(btn => btn.classList.remove('active'));

                    if (isActive) {
                        applyFilterAndSort();
                    } else {
                        this.classList.add('active');
                        applyFilterAndSort(this.getAttribute('data-filter'));
                    }
                });
            });

            sortLinks.forEach(link => {
                link.addEventListener('click', function (event) {
                    event.preventDefault();
                    applyFilterAndSort(null, this.getAttribute('data-sort'));
                });
            });
        });



        

        document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.querySelector('.input-group .form-control');
    const clearSearchButton = document.getElementById('clear-search');
    const clearFiltersButton = document.getElementById('clear-filters');
    const folders = document.querySelectorAll('.folder');
    const notes = document.querySelectorAll('.note');
    const filterButtons = document.querySelectorAll('.filter-buttons .filter-btn');

    // Search functionality
    searchInput.addEventListener('input', function () {
        const query = searchInput.value.toLowerCase();
        let hasResults = false;

        // Toggle clear search button visibility
        clearSearchButton.style.display = query ? 'inline' : 'none';

        // Filter folders
        folders.forEach(folder => {
            const folderName = folder.querySelector('p').textContent.toLowerCase();
            if (folderName.includes(query)) {
                folder.style.display = '';
                hasResults = true;
            } else {
                folder.style.display = 'none';
            }
        });

        // Filter notes
        notes.forEach(note => {
            const noteName = note.querySelector('.note-name').textContent.toLowerCase();
            const noteContent = note.querySelector('p').textContent.toLowerCase();
            if (noteName.includes(query) || noteContent.includes(query)) {
                note.style.display = '';
                hasResults = true;
            } else {
                note.style.display = 'none';
            }
        });

        // Handle "No Results" message
        document.getElementById('no-results').style.display = hasResults ? 'none' : '';
    });

    // Clear search functionality
    clearSearchButton.addEventListener('click', function () {
        searchInput.value = ''; // Clear the input
        searchInput.dispatchEvent(new Event('input')); // Trigger the input event to reset results
    });

    // Clear filters functionality
    clearFiltersButton.addEventListener('click', function () {
        // Reset filter buttons
        filterButtons.forEach(button => button.classList.remove('active'));

        // Show all folders and notes
        folders.forEach(folder => (folder.style.display = ''));
        notes.forEach(note => (note.style.display = ''));

        // Reset search input
        searchInput.value = '';
        searchInput.dispatchEvent(new Event('input')); // Trigger the input event

        // Hide "No Results" message
        document.getElementById('no-results').style.display = 'none';
    });
});
    </script>




</body>

</html>
<?php
ob_end_flush();
?>
