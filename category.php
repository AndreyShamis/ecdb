<?php
	require_once('include/Class_DB.php');
    require_once('include/login/auth.php');
	require_once('include/debug.php');
?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="include/style.css" media="screen"/>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="apple-touch-icon" href="img/apple.png" />
    <title>Category - ecDB</title>
    <?php include_once("include/analytics.php") ?>
</head>
<body>
    <div id="wrapper">
        <!-- Header -->
        <?php include 'include/header.php'; ?>
        <!-- END -->
        <!-- Main menu -->
        <?php include 'include/menu.php'; ?>
        <!-- END -->
        <!-- Main content -->
        <div id="content">
            <div class="subMenu">
                <ul>
                <?php
                include('include/include_category_head.php');

                $Head = new NameHead;
                $Head->Head();
                ?>
                </ul>
            </div>
            <div class="subSubMenu">
                <ul>
                <?php
                include('include/include_category_sub.php');
                $Sub = new NameSub;
                $Sub->Sub();
                ?>
                </ul>
            </div>

            <table class="globalTables" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th></th>
                        <th><a href="?
                            <?php
                            if(isset($_REQUEST['subcat'])) {
                                echo 'subcat';
                            }
                            else {
                                echo 'cat';
                            }
                            ?>
                            =
                            <?php
                            if(isset($_REQUEST['cat'])) {
                                echo $_REQUEST['cat'];
                            }
                            if(isset($_REQUEST['subcat'])) {
                                echo $_REQUEST['subcat'];
                            }
                            ?>
                            &by=name&order=
                            <?php
                            if(isset($_REQUEST['order'])) {
                                $order = $_REQUEST['order'];
                                if ($order == 'asc') {
                                    echo 'desc';
                                }
                                else {
                                    echo 'asc';
                                }
                            }
                            else {
                                echo 'desc';
                            }
                            ?>
                            ">Name</a></th>
                        <?php
                        $subcat = "cat";
                        $catcat="";
                        if(isset($_REQUEST['subcat'])) {
                            $subcat = 'subcat';
                            $catcat = $_REQUEST['subcat'];
                        }
                        $cat = "";
                        if(isset($_REQUEST['cat'])){
                            $cat =  $_REQUEST['cat'];
                        }
                        $order = "desc";
                        if(isset($_REQUEST['order'])) {
                            $order = $_REQUEST['order'];
                            if ($order == 'asc') {
                                $order = 'desc';
                            }
                            else{
                                $order = 'asc';
                            }
                        }
                        ?>
                        <th><a href="?<?php echo $subcat ?>=<?php echo $cat; echo $catcat; ?>&by=category&order=<?php echo $order; ?>">Category</a></th>
                        <th><a href="?<?php echo $subcat ?>=<?php echo $cat; echo $catcat; ?>&by=package&order=<?php echo $order; ?>">Package</a></th>
                        <th><a href="?<?php echo $subcat ?>=<?php echo $cat; echo $catcat; ?>&by=pins&order=<?php echo $order; ?>">Pins</a></th>
                        <th>Image</th>
                        <th>Datasheet</th>
                        <th><a href="?<?php echo $subcat ?>=<?php echo $cat; echo $catcat; ?>&by=smd&order=<?php echo $order; ?>">SMD</a></th>
                        <th><a href="?<?php echo $subcat ?>=<?php echo $cat; echo $catcat; ?>&by=price&order=<?php echo $order; ?>">Price</a></th>
                        <th><a href="?<?php echo $subcat ?>=<?php echo $cat; echo $catcat; ?>&by=quantity&order=<?php echo $order; ?>">Quantity</a></th>
                        <th>Comment</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include('include/include.php');
                    $Category = new ShowComponents;
                    $Category->Category();
                ?>
                </tbody>
            </table>
        </div>
        <!-- END -->
        <!-- Text outside the main content -->
        <?php include 'include/footer.php'; ?>
        <!-- END -->
    </div>
</body>
</html>