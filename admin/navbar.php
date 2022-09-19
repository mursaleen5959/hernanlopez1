<nav class="navbar navbar-expand-sm bg-warning navbar-light">
    <ul class="navbar-nav">
        
        <?php
        if(isset($_SESSION['admin_status']))
        {?>
            <li class="nav-item">
                <a class="nav-link" href="home.php"><i class="fa fa-home fa-lg" aria-hidden="true"></i> Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="add_user.php"><i class="fa fa-user-plus fa-lg" aria-hidden="true"></i> Add User</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="edit_users.php"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i> Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="add_entry.php"><i class="fa fa-plus fa-lg" aria-hidden="true"></i> Add Graph</a>
            </li>
            <?php
        }
        else{
            echo '<li class="nav-item active">
                    <a class="nav-link" href="index.php"><i class="fa fa-home fa-lg" aria-hidden="true"></i> Home</a>
                </li>';
        }
        ?>
    </ul>
    <ul class="navbar-nav ml-auto">
        <?php
        if(isset($_SESSION['admin_status'])){?>
            <li class="nav-item">
                <a class="nav-link" href="#"><?php echo $_SESSION['admin_name'];?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php"><i class="fa fa-sign-out fa-lg" aria-hidden="true"></i></a>
            </li>
            <?php
            }
            else{

            }
        ?>
    </ul>

</nav>