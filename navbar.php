<nav class="navbar navbar-expand-sm bg-warning navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <!-- <img src="smLogo.png"> -->
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="index.php"><i class="fa fa-home fa-lg" aria-hidden="true"></i> Home</a>
        </li>
        <?php
        if(isset($_SESSION['user_status']))
        {
        }
        ?>
    </ul>
    <ul class="navbar-nav ml-auto">
        <?php
        if(isset($_SESSION['user_name'])){?>
            <li class="nav-item">
                <a class="nav-link" href="#"><?php echo $_SESSION['user_name'];?></a>
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