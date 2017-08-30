<?php
/* Smarty version 3.1.30, created on 2017-08-30 06:34:04
  from "D:\SOFTWARES\xampp\htdocs\php\10yduoc.tk(smarty)\templates\edit.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59a6403cf00c22_02209873',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1827367ba83996f0e9feacc26bcd974dddbc86c7' => 
    array (
      0 => 'D:\\SOFTWARES\\xampp\\htdocs\\php\\10yduoc.tk(smarty)\\templates\\edit.tpl',
      1 => 1504067571,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59a6403cf00c22_02209873 (Smarty_Internal_Template $_smarty_tpl) {
?>
<html>
<head>
    <title>Thêm đề</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"><?php echo '</script'; ?>
>
    <style>
        
        * {
            border: 0;
            padding: 0;
            margin: 0;
        }

        body {
            background: lightskyblue;
            font-family: "Segoe UI", Arial, sans-serif;
        }


        .mynavbar {
            background-color: #5f5f5f;
            color: #f1f1f1;
            font-size: 17px;
            letter-spacing: 1px;
            height: 35px;
            line-height: 35px;
            margin:0;
        }

        .mynavbar a {
            color: #f1f1f1;
            padding: 0 7px;
            height: 100%;
            float: left;
            display: block;
        }

        .mynavbar a:hover, .mynavbar a:active {
            text-decoration: none;
            background-color: black;
            color: #f1f1f1;
        }

        .error {
            color: red;
        }

        .form-setup {
            /*border: 1px solid grey;*/
            border: none;
            height: 100%;
            width: 30%;
            padding: 8px;
            box-sizing: border-box;
            position: fixed;
            overflow-x: hidden;
            overflow-y: scroll;
            background-color: #f1f1f1;
        }

        .form-setup span {
            font-weight: normal;
            font-size: 1em;
        }

        .form-setup ol li {
            display: list-item;
            list-style-position: inside;
            list-style-type: decimal;
        }

        .form-setup a {
            text-decoration: none;
            color: black;
        }

        .form-setup a:hover {
            background-color: #cccccc;
        }

        .content {
            border: 1px solid grey;
            padding: 0;
            box-sizing: border-box;
            position: fixed;
            top: 35px;
            bottom: 30px;
            left: 30%;
            width: 70%;
            overflow-x: hidden;
            overflow-y: auto;
            border-top: none;
            padding-top: 5px;
        }

        .content .question {
            font-family: "Times New Roman", sans-serif;
        }

        .content .question hr {
            width: 100%;
            height: 1px;
            background-color: grey;
            margin: 10px 0 20px 0;
        }

        .content .form-add-submit {
            background: #017ebe;
            position: fixed;
            z-index: 100;
            bottom: 0;
            left: 30%;
            height: 40px;
            width: 100%;
            border-color: grey;
            color: black;
            vertical-align: middle;
        }

        .content .form-add-submit button, .content .form-add-submit a {
            vertical-align: middle;
            padding: 0 10px;
            border: 1px solid;
            font-weight: bold;
            height: 100%;
            cursor: pointer;
        }

        .content .form-add-submit a {
            color: black;
            text-decoration: none;
            display: inline-block;
            background: lightgray;
            line-height: 38px;
        }

        .content .form-add-submit button:hover, .content .form-add-submit a:hover {
            background: darkgray;
        }

        .content .item {
            display: table;
            width: 100%;
            margin-bottom: 4px;
        }

        .content .item p {
            display: table-cell;
        }

        .content .item .answer {
            width: 20px;
            vertical-align: middle;
        }

        .content .item .title {
            width: 45px;
            vertical-align: top;
            font-weight: bold;
        }

        .content .item input, .content .item textarea {
            width: 100%;
            border: 1px solid;
            padding: 2px;
        }

        
    </style>
</head>
<body>
<div class="mynavbar">
    <!--                <a href="" class="topnav-icons fa fa-menu w3-hide-large w3-left w3-bar-item w3-button" title="Menu"></a>-->
    <a href="." title="Home"><i class="fa fa-home" style="line-height: 35px;" aria-hidden="true"></i></a>
    <a href="edit.php?subid=1" title="Làm Đề Giải Phẫu">GIẢI PHẪU</a>
    <a href="edit.php?subid=2" title="Làm Đề Giải Phẫu">SINH DI TRUYỀN</a>
    <div style="float: right;margin-right:10px;">
        <?php if (isset($_smarty_tpl->tpl_vars['admin']->value)) {
echo $_smarty_tpl->tpl_vars['admin']->value;
}?>
        <?php ob_start();
echo $_SESSION['info'];
$_prefixVariable1=ob_get_clean();
if (isset($_prefixVariable1)) {
echo $_SESSION['info'];
}?>
    </div>
</div>

<div class="form-setup" style="border-right: none;"> <!-- Hiện các bộ đề trong CSDL ở đây -->
    <ol><?php echo $_smarty_tpl->tpl_vars['html']->value;?>

    </ol>
</div>

<div class="content">
    <?php if (isset($_smarty_tpl->tpl_vars['successHTML']->value)) {
echo $_smarty_tpl->tpl_vars['successHTML']->value;
}?>
    <form method="post" name="update-form" id="update-form">
        <div id="choiceuser">
            <?php if (isset($_smarty_tpl->tpl_vars['xhtml']->value)) {
echo $_smarty_tpl->tpl_vars['xhtml']->value;
}?>
        </div>
    </form>

    <div class="form-add-submit" style="position: fixed;"> <!-- Nút cập nhật tại đây -->
        <form method="post" name="form-edit">
            <input hidden id="test" name="test"
                   value="<?php if (isset($_GET['testid'])) {
echo $_GET['testid'];
}?>">
            <button type="button" id="update-button">Cập nhật</button>
        </form>
    </div>
</div>
<?php echo '<script'; ?>
>
    
    $(function () {
        $("#update-button").click(function () {
            $("#update-form").submit();
        });
    });
    
<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"><?php echo '</script'; ?>
>
</body>
</html>

<?php }
}
