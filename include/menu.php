<div id="menu">
	<ul>
		<li><a href="." class="<?php if ($_SERVER["REQUEST_URI"] == '/' or $_SERVER["REQUEST_URI"] == '/index.php'or isset($_REQUEST['view']) or isset($_REQUEST['cat'])or isset($_REQUEST['subcat']) or isset($_REQUEST['edit']) or isset($_REQUEST['based'])){echo 'selected';}?>"><span class="icon medium inbox"></span> My components</a></li>
		<li><a href="add.php" class="<?php if ($_SERVER["REQUEST_URI"] == '/add.php'){echo 'selected';}?>"><span class="icon medium sqPlus"></span> Add component</a></li>
		<li><a href="shoplist.php" class="<?php if ($_SERVER["REQUEST_URI"] == '/shoplist.php'){echo 'selected';}?>"><span class="icon medium shopCart"></span> Shopping list</a></li>
		<li><a href="proj_list.php" class="<?php if ($_SERVER["REQUEST_URI"] == '/proj_list.php' or isset($_REQUEST['proj_id'])){echo 'selected';}?>"><span class="icon medium cube"></span> Projects</a></li>
		<li><a href="my.php" class="<?php if ($_SERVER["REQUEST_URI"] == '/my.php'){echo 'selected';}?>"><span class="icon medium user"></span> My account</a></li>
	</ul>
</div>