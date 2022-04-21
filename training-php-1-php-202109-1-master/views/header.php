<?php
require_once 'models/UserModel.php';
$userModel = new UserModel();
$id = '';
if(!empty($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $userModel->deleteUserById($id);
}

$keyword = '';
if(!empty($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
}

?>
<div class="container">
    <nav class="navbar navbar-icon-top navbar-default">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="list_users.php">App Web 1</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="form_user.php">Add new user</a></li>

                </ul>
                <form class="navbar-form navbar-left">
                    <div class="form-group">
                        <input type="text" name="keyword" class="form-control" placeholder="Search users"
                               value="<?php echo $keyword ?>"
                        >
                    </div>
                    <button type="submit" class="btn btn-default">Search</button>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user-circle-o"></i>
                            Sắp xếp <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="sortbyNameASC.php">Tên tăng dần</a></li>
                            <li><a href="sortbyNameDESC.php">Tên giảm dần</a></li>
                        </ul>
                    </li>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user-circle-o"></i>
                            Account <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="view_user.php?id=<?php echo $id ?>">Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="login.php">Login</a></li>
                            <li><a href="logout.php">Logout</a></li>
                            <?php foreach ($users as $user) {?>
                            <li><a href="delete_user.php?id=<?php echo $user['id'] ?>">Delete</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
    </nav>
    <?php if(!empty($_SESSION['message'])){ ?>
        <div class="alert alert-warning" role="alert">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
    <?php } ?>
</div>