<?php
session_start();
// redirect password
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <script defer src="js/script.js"></script>
</head>
<body>
<!-- SIDEBAR -->
    <?php include 'partials/app-sidebar.php'; ?>
    <div class="main">

        <!-- TOP NAVIGATION -->
        <div class="header">
            <h1>Dashboard</h1>
            <a href= "database/logout.php"><button class="logout">Logout</button></a>
        </div>

        <div class="content">
            <!-- Membership Overview -->
            <section id="membership-overview" class="active">
                <h2>Membership Overview</h2>
                <div id="members-list">
                    <?php if (isset($_SESSION['members'])): ?>
                        <ul>
                            <?php foreach ($_SESSION['members'] as $member): ?>
                                <li><?= $member['name'] ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>No members yet</p>
                    <?php endif; ?>
                </div>
            </section>

            <!-- Staff Overview -->
            <section id="staff-overview">
                <h2>Staff Overview</h2>
                <div id="staff-list">
                    <?php if (isset($_SESSION['staff'])): ?>
                        <ul>
                            <?php foreach ($_SESSION['staff'] as $staff): ?>
                                <li><?= $staff['name'] ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>No staff members yet</p>
                    <?php endif; ?>
                </div>
            </section>

            <!-- Add Member -->
            <section id="add-member">
                <h2>Add Member</h2>
                <form id="create-member-form">
                    <div class="form-row">
                        <label for="first-name">First Name</label>
                        <input type="text" id="first-name" required>
                    </div>
                    <div class="form-row">
                        <label for="last-name">Last Name</label>
                        <input type="text" id="last-name" required>
                    </div>
                    <div class="form-row">
                        <label for="gender">Gender</label>
                        <input type="text" id="gender" required>
                    </div>
                    <div class="form-row">
                        <label for="phone-number">Phone Number</label>
                        <input type="text" id="phone-number" required>
                    </div>
                    <div class="form-row">
                        <label for="email">Email</label>
                        <input type="email" id="email" required>
                    </div>
                    <button type="submit" class="submit-btn">Create Member</button>
                </form>
            </section>

            <!-- Sessions/Classes -->
            <section id="sessions-classes">
                <h2>Sessions/Classes</h2>
                <div id="sessions-list">
                    <?php if (isset($_SESSION['sessions'])): ?>
                        <ul>
                            <?php foreach ($_SESSION['sessions'] as $session): ?>
                                <li><?= $session['name'] ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>No sessions yet</p>
                    <?php endif; ?>
                </div>
            </section>

            <!-- Task -->
            <section id="task">
                <h2>Task</h2>
                <ul id="task-list">
                    <?php if (isset($_SESSION['tasks'])): ?>
                        <?php foreach ($_SESSION['tasks'] as $task): ?>
                            <li><?= $task['description'] ?></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>Task 1: Assign new classes for the next week.</li>
                        <li>Task 2: Review member progress for the month.</li>
                        <li>Task 3: Update sales report for the last quarter.</li>
                    <?php endif; ?>
                </ul>
            </section>

            <!-- Sales Report 
            <section id="sales-report">
                <h2>Sales Report</h2>
                <div id="sales-data">
                    <?php if (isset($_SESSION['sales'])): ?>
                        <p><?= $_SESSION['sales'] ?></p>
                    <?php else: ?>
                        <p>No sales report available yet.</p>
                    <?php endif; ?>
                </div>
            </section>
                    -->
        </div>
    </div>
    
</body>
</html>
```