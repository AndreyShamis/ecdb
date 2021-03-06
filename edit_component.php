<?php
require_once 'include/Class_DB.php';
require_once 'include/login/auth.php';
require_once 'include/debug.php';

$owner 	= 	$_SESSION['SESS_MEMBER_ID'];
$id 	= 	(int)$_REQUEST['edit'];

$GetDataComponent = $db->query('SELECT * FROM data WHERE id = ' .$id. ' AND owner = ' .$owner);
$executesql = $db->fetch_assoc($GetDataComponent);

$GetPersonal = $db->query('SELECT currency, measurement FROM members WHERE member_id = ' .$owner);
$personal = $db->fetch_assoc($GetPersonal);

if ($executesql['owner'] !== $owner) {
    header('Location: error.php?id=2');
}

if ($executesql['category'] < 999) {
    $head_cat_id = substr($executesql['category'], -3, 1);
}
else {
    $head_cat_id = substr($executesql['category'], -4, 2);
}

$GetHeadCatName = $db->query('SELECT * FROM category_head WHERE id = ' . (int)$head_cat_id);
$executesql_head_catname = $db->fetch_assoc($GetHeadCatName);

$sub_cat_id = $executesql['category'];

$GetSubCatName = $db->query('SELECT * FROM category_sub WHERE id = ' . (int)$sub_cat_id);
$executesql_sub_catname = $db->fetch_assoc($GetSubCatName);

$GetDataComponentsAll = 'SELECT * FROM category_sub';
$sql_exec = $db->query($GetDataComponentsAll);

if(isset($_POST['delete'])) {
    $sqlDeleteComopnent = 'DELETE FROM data WHERE id = ' . $id . ' LIMIT 1';
    $sql_exec_component_delete = $db->query($sqlDeleteComopnent);

    $sqlDeleteProject = "DELETE FROM projects_data WHERE projects_data_component_id = '$id'";
    $sql_exec_project_delete = $db->query($sqlDeleteProject);

    header('Location: .');
}

if(isset($_POST['based'])) {
    header("Location: add_based.php?based=$id");
}

if (isset($_POST['quantity_increase'])) {
    $quantity_before	=	$_POST['quantity'];
    $quantity_after		= 	$quantity_before + 1;

    $sql = "UPDATE data SET quantity = '".$quantity_after."' WHERE id = ".$id." ";
    $sql_exec = $db->query($sql);
    header("location: " . $_SERVER['REQUEST_URI']);
}

if (isset($_POST['quantity_decrease'])) {
    $quantity_before	=	$_POST['quantity'];
    $quantity_after 	= 	$quantity_before - 1;

    $sql = "UPDATE data SET quantity = '".$quantity_after."' WHERE id = ".$id." ";
    $sql_exec = $db->query($sql);
    header("location: " . $_SERVER['REQUEST_URI']);
}

if (isset($_POST['orderquant_increase'])) {
    $quantity_before	=	$_POST['orderquant'];
    $quantity_after		= 	$quantity_before + 1;

    $sql = "UPDATE data SET order_quantity = '".$quantity_after."' WHERE id = ".$id." ";
    $sql_exec = $db->query($sql);
    header("location: " . $_SERVER['REQUEST_URI']);
}

if (isset($_POST['orderquant_decrease'])) {
    $quantity_before	=	$_POST['orderquant'];
    $quantity_after 	= 	$quantity_before - 1;

    $sql = "UPDATE data SET order_quantity = '".$quantity_after."' WHERE id = ".$id;
    $sql_exec = $db->query($sql);
    header("location: " . $_SERVER['REQUEST_URI']);
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="include/style.css" media="screen"/>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="description" content="If you wany to edit something of the component, do it here."/>
    <meta name="keywords" content="electronics, components, database, project, inventory"/>
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="apple-touch-icon" href="img/apple.png" />
    <title>Edit component - <?php echo $executesql['name']; ?> - ecDB</title>
    <?php include_once "include/analytics.php" ?>
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
            <h1>
                <a href="category.php?cat=<?php echo $executesql_head_catname['id'];?>"><?php echo $executesql_head_catname['name'];?></a>
                <a href="category.php?subcat=<?php echo $executesql_sub_catname['id'];?>"><?php echo $executesql_sub_catname['name'];?></a>
                /
                <a href="component.php?view=<?php echo $executesql['id']; ?>"><?php echo $executesql['name']; ?></a>
            </h1>
            <?php
                include 'include/include.php';
                $Add = new ShowComponents;
                $Add->Add();
            ?>
            <form class="globalForms noPadding" action="" method="post">
                <div class="textBoxInput">
                    <label class="keyWord boldText">Comment </label>
                    <div class="text"><!--cols="104"-->
                        <textarea name="comment" rows="14" style="width: 99%; resize: both !important;"><?php echo $executesql['comment']; ?></textarea>
                    </div>
                </div>
                <table class="globalTables leftAlign noHover" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td class="boldText">Name</td>
                            <td>
                                <input name="name" type="text" class="medium" value="<?php echo $executesql['name']; ?>" id="name" />
                            </td>
                            <td class="boldText">Category</td>
                            <td>
                                <select name="category">
                                <?php
                                $HeadCategoryNameQuery = 'SELECT * FROM category_head ORDER by name ASC';
                                $sql_exec_headcat = $db->query($HeadCategoryNameQuery);

                                while ($HeadCategory = $db->fetch_assoc($sql_exec_headcat)) {

                                    echo '<option class="main_category" value="';
                                    echo $HeadCategory['id'];
                                    echo '" disabled>';
                                    echo $HeadCategory['name'];
                                    echo '</option>';

                                    $subcatfrom = $HeadCategory['id'] * 100;
                                    $subcatto   = $subcatfrom + 99;

                                    $SubCategoryNameQuery   = 'SELECT * FROM category_sub WHERE id BETWEEN ' .$subcatfrom. ' AND ' .$subcatto. ' ORDER by name ASC';
                                    $sql_exec_subcat        = $db->query($SubCategoryNameQuery);

                                    while ($SubCategory = $db->fetch_assoc($sql_exec_subcat)) {
                                        echo '<option value="';
                                        echo $SubCategory['id'];
                                        echo '"';
                                            if ($executesql_sub_catname['id'] == $SubCategory['id']) {
                                                echo ' selected';
                                            }
                                        echo '>';
                                        echo $SubCategory['name'];
                                        echo '</option>';
                                    }
                                }
                                ?>
                                </select>
                            </td>
                            <td class="boldText">Quantity</td>
                            <td>
                                <input name="quantity" type="text" class="small" value="<?php echo $executesql['quantity']; ?>" id="quantity"/>
                                <button class="button white small" name="quantity_increase" type="submit"><span class="icon medium roundPlus"></span></button>
                                <button class="button white small" name="quantity_decrease" type="submit"><span class="icon medium roundMinus"></span></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="boldText">Manufacturer</td>
                            <td>
                                <input name="manufacturer" type="text" class="medium" value="<?php echo $executesql['manufacturer']; ?>" />
                            </td>
                            <td class="boldText">Package</td>
                            <td>
                                <input name="package" type="text" class="medium" value="<?php echo $executesql['package']; ?>" />
                            </td>
                            <td class="boldText">Pins</td>
                            <td>
                                <input name="pins" type="text" class="small" value="<?php echo $executesql['pins']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td class="boldText">Location</td>
                            <td>
                                <input name="location" type="text" class="medium" value="<?php echo $executesql['location']; ?>" id="location" />
                            </td>
                            <td class="boldText">Price</td>
                            <td>
                                <input name="price" type="text" class="small" value="<?php echo $executesql['price']; ?>" id="price" /> <?php echo $personal['currency']; ?>
                            </td>
                            <td class="boldText">To order</td>
                            <td>
                                <input name="orderquant" type="text" class="small" value="<?php echo $executesql['order_quantity']; ?>" id="orderquant"/>
                                <button class="button white small" name="orderquant_increase" type="submit"><span class="icon medium roundPlus"></span></button>
                                <button class="button white small" name="orderquant_decrease" type="submit"><span class="icon medium roundMinus"></span></button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6"></td>
                        </tr>
                        <tr>
                            <td class="boldText">SMD</td>
                            <td>
                            <?php
                            if($executesql['smd'] == 'Yes'){
                                echo '<input type="radio" name="smd" value="Yes" checked="checked" /> Yes ';
                                echo '<input type="radio" name="smd" value="No" /> No';
                            }
                            else{
                                echo '<input type="radio" name="smd" value="Yes" /> Yes ';
                                echo '<input type="radio" name="smd" value="No" checked="checked" /> No';
                            }
                            ?>
                            </td>
                            <td class="boldText">Scrap</td>
                            <td>
                            <?php
                            if($executesql['scrap'] == 'Yes'){
                                echo '<input type="radio" name="scrap" value="Yes" checked="checked" /> Yes ';
                                echo '<input type="radio" name="scrap" value="No" /> No';
                            }
                            else{
                                echo '<input type="radio" name="scrap" value="Yes" /> Yes ';
                                echo '<input type="radio" name="scrap" value="No" checked="checked" /> No';
                            }
                            ?>
                            </td>
                            <td class="boldText">Public</td>
                            <td>
                            <?php
                            if($executesql['public'] == 'Yes'){
                                echo '<input type="radio" name="public" value="Yes" checked="checked" /> Yes ';
                                echo '<input type="radio" name="public" value="No" /> No';
                            }
                            else{
                                echo '<input type="radio" name="public" value="Yes" /> Yes ';
                                echo '<input type="radio" name="public" value="No" checked="checked" /> No';
                            }
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6"></td>
                        </tr>
                        <tr>
                            <td class="boldText">Weight</td>
                            <td>
                                <input name="weight" type="text" class="small" value="<?php echo $executesql['weight']; ?>" /> <?php if($personal['measurement'] == 1){echo 'g';} else {echo 'g'; } ?>
                            </td>
                            <td class="boldText">Width</td>
                            <td>
                                <input name="width" type="text" class="small" value="<?php echo $executesql['width']; ?>" /> <?php if($personal['measurement'] == 1){echo 'mm';} else {echo 'in'; } ?>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="boldText">Depth</td>
                            <td>
                                <input name="depth" type="text" class="small" value="<?php echo $executesql['depth']; ?>" /> <?php if($personal['measurement'] == 1){echo 'mm';} else {echo 'in'; } ?>
                            </td>
                            <td><img class="packageImage" border="0" src="img/boxSize.png"/></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="boldText">Datasheet URL</td>
                            <td>
                                <input name="datasheet" type="text" class="medium" value="<?php echo $executesql['datasheet']; ?>" />
                            </td>
                            <td class="boldText">Height</td>
                            <td>
                                <input name="height" type="text" class="small" value="<?php echo $executesql['height']; ?>" /> <?php if($personal['measurement'] == 1){echo 'mm';} else {echo 'in'; } ?>
                            </td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td colspan="6"></td>
                        </tr>
                        <tr>
                            <td class="boldText">Image URL 1</td>
                            <td>
                                <input name="url1" type="text" class="medium" value="<?php echo $executesql['url1']; ?>" />
                            </td>
                            <td class="boldText">Image URL 2</td>
                            <td>
                                <input name="url2" type="text" class="medium" value="<?php echo $executesql['url2']; ?>"  />
                            </td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td class="boldText">Image URL 3</td>
                            <td>
                                <input name="url3" type="text" class="medium" value="<?php echo $executesql['url3']; ?>" />
                            </td>
                            <td class="boldText">Image URL 4</td>
                            <td>
                                <input name="url4" type="text" class="medium" value="<?php echo $executesql['url4']; ?>" />
                            </td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="boldText">Add to project</td>
                            <td class="boldText">Quantity</td>
                            <?php

                            $sql       = 'SELECT projects_data_component_id FROM projects_data WHERE projects_data_component_id = ' .(int)$_REQUEST['edit'];
                            $sql_echo   = $db->query($sql);

                            if ($db->count($sql_echo) == 0) {
                                echo '<td colspan="3"></td>';
                            }
                            else {
                                echo '<td class="boldText">Project</td>';
                                echo '<td class="boldText">Quantity</td>';
                                echo '<td></td>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <select name="project">
                                <?php
                                    include 'include/include_component_edit_project_add.php';
                                    $MenuProj = new AddMenuProj;
                                    $MenuProj->MenuProj();
                                ?>
                                </select>
                            </td>
                            <td>
                                <input name="projquant" type="text" class="small" value="<?php if(isset($_POST['submit'])) { echo $_POST['projquant']; } ?>" />
                            </td>
                            <td>
                            <?php
                                include 'include/include_component_edit_project_edit.php';
                                $MenuProj = new EditProj;
                                $MenuProj->MenuProj();
                            ?>
                    </tbody>
                </table>

                <div class="buttons">
                    <div class="input">
                        <button class="button green" name="update" type="submit"><span class="icon medium save"></span> Update</button>
                        <button class="button" name="based" type="submit"><span class="icon medium sqPlus"></span> New based on this</button>
                        <button class="button red" name="delete" type="submit"><span class="icon medium trash"></span> Delete</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- END -->
        <!-- Text outside the main content -->
            <?php include 'include/footer.php'; ?>
        <!-- END -->
    </div>
</body>
</html>