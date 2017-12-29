<?php
	require_once('include/Class_DB.php');
	require_once('include/login/auth.php');
	require_once('include/debug.php');

	$order = isset($_REQUEST['order']) ? $_REQUEST['order'] : "desc";
?>
<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="include/style.css" media="screen"/>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
		<meta name="description" content="Viwe all your added components."/>
		<meta name="keywords" content="electronics, components, database, project, inventory"/>
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="apple-touch-icon" href="img/apple.png" />
		<title>Home - ecDB</title>
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

                <?php

                if($order == "desc"){
                    $order_write = "asc";
                }
                else{
                    $order_write = "desc";
                }
                ?>
				<table class="globalTables" cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th></th>
							<th><a href="?by=name&order=<?php echo $order_write;?>">Name</a></th>
							<th><a href="?by=category&order=<?php echo $order_write;?>">Category&nbsp;</a></th>
							<th><a href="?by=package&order=<?php echo $order_write;?>">Package&nbsp;</a></th>
							<th><a href="?by=pins&order=<?php echo $order_write;?>">Pins&nbsp;</a></th>
							<th>Image&nbsp;</th>
							<th>Datasheet&nbsp;</th>
							<th><a href="?by=smd&order=<?php echo $order_write;?>">SMD&nbsp;</a></th>
							<th><a href="?by=price&order=<?php echo $order_write;?>">Price&nbsp;</a></th>
							<th><a href="?by=quantity&order=<?php echo $order_write;?>">Quantity&nbsp;</a></th>
							<th>Comment</th>
						</tr>
					</thead>
					<tbody>
					<?php
						include('include/include.php');

						$Index = new ShowComponents();
						$Index->Index();
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
