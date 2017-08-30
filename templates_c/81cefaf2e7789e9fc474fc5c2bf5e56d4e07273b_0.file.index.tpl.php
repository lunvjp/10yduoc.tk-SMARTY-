<?php
/* Smarty version 3.1.30, created on 2017-08-30 06:56:46
  from "D:\SOFTWARES\xampp\htdocs\php\10yduoc.tk(smarty)\templates\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59a6458e19d090_01576509',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '81cefaf2e7789e9fc474fc5c2bf5e56d4e07273b' => 
    array (
      0 => 'D:\\SOFTWARES\\xampp\\htdocs\\php\\10yduoc.tk(smarty)\\templates\\index.tpl',
      1 => 1504069004,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59a6458e19d090_01576509 (Smarty_Internal_Template $_smarty_tpl) {
?>
<html>
<head>
    <title>10YDuoc.tk - Cùng nhau luyện đề</title>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"><?php echo '</script'; ?>
>
</head>
<body>

<div class="mynavbar">
    <a href="." title="Home"><i class="fa fa-home" style="line-height: 35px;"  aria-hidden="true"></i></a>
    <a href="./giaiphau" title="Làm Đề Giải Phẫu">GIẢI PHẪU</a>
    <a href="./sinhditruyen" title="Làm Đề Giải Phẫu">SINH DI TRUYỀN</a>
    <div id="account" style="float: right;margin-right:10px;"><?php echo $_smarty_tpl->tpl_vars['info']->value;?>
</div>
</div>

<div class="form-setup" style="border-right: none;"> <!-- Hiện các bộ đề đã làm ở đây -->
    <a href="javascript:void(0);" onclick="fbLogin()" id="fbLink"><img src="images/fblogin.png"></a>
    <ol><?php echo $_smarty_tpl->tpl_vars['html']->value;?>
</ol>
</div>

<div class="content"> <!-- Hiển thị số câu đã làm ở đây -->

    <div id="time"
         style="position:fixed;width:100%;background: lightskyblue; height:40px;border-bottom:1px solid grey;font-size:25px;font-weight: bold;font-family: Arial,sans-serif;color: #ffff80;line-height: 40px;padding-left:10px;">
        <span>BẮT ĐẦU</span></div>

    <div id="result"><?php echo $_smarty_tpl->tpl_vars['result']->value;?>
</div>

    <div id="ajax-load" style="display: none; height: 100px; width: 160px; margin: auto; margin-top:60px">
        <i class="fa fa-spinner fa-spin" style="font-size: 7em; color: #D9ECFF;"></i>
    </div>

    <div id="choiceuser" style="padding-top: 40px"><?php echo $_smarty_tpl->tpl_vars['contentHTML']->value;?>
</div>


    <div class="form-add-submit" style="position: fixed;">
        <form id="form-fade" method="post"></form>
        <button type="button" id="submit-button">Nộp bài</button>
    </div>
</div>
<?php echo '<script'; ?>
 src="./check.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    
    var countDownDate = new Date().getTime() + 10 * 60 * 1000;

    var x = setInterval(function () {
        if (countDownDate) {
            var now = new Date().getTime();
            var distance = countDownDate - now;

            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            $("#time").html(minutes + ":" + seconds);

            if (distance < 0) {
                // clearInterval(x);
                document.getElementById("time").innerHTML = "HẾT GIỜ";
                $("#choiceuser").empty().removeClass('auto-padding');
                setTimeout(function () {
                    window.location = '.';
                }, 1000);
            }
        }
    }, 1000);


    function doTest(id) {
        countDownDate = new Date().getTime() + 10 * 60 * 1000;
        $("#result").empty();
        $("#choiceuser").empty();
        $("#ajax-load").css('display', 'block');
        $("#time").css('display', 'block');
        $.ajax({
            url: 'check.php',
            type: 'POST',
            data: {
                id: id, // id của bộ test
                action: 'dotest'
            },
            success: function (data) {
                $("#ajax-load").css('display', 'none');
                $("#choiceuser").html(data);

            }
        });
    }


    $("#submit-button").click(function () {
//        $("#choiceuser").empty();
        $("#form-do-test").submit();

    });
    //    $(document).on("submit","#form-do-test",function(){
    //        $("#time").css('display','none');
    //    });
    $(document).on("click", "input", function () {
        id = $(this).attr("class");
        temp = 'div#' + id;
//                x = 'input'+'.'+id;
        $(temp).css({'pointer-events': 'none', 'background-color': 'antiquewhite'});

//                setTimeout(function(){
//                    $(temp).hide();
//                },200);
    });

    window.fbAsyncInit = function () {
        // FB JavaScript SDK configuration and setup
        FB.init({
            appId: '503740856637847', // FB App ID 309350989506967
            cookie: true,  // enable cookies to allow the server to access the session
            xfbml: true,  // parse social plugins on this page
            version: 'v2.8' // use graph api version 2.8
        });

    };

    // Load the JavaScript SDK asynchronously
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    // Facebook login with JavaScript SDK
    function fbLogin() {
        FB.login(function (response) {
            if (response.authResponse) { // Đăng nhập thành công ở ngay đây rồi
                // Get and display the user profile data
                getFbUserData();
            } else {
//                document.getElementById('status').innerHTML = 'User cancelled login or did not fully authorize.';
            }
        }, {scope: 'public_profile,email'});
    }

    // Fetch the user profile data from facebook
    function getFbUserData() {
        FB.api('/me', {locale: 'en_US', fields: 'id,first_name,last_name,email,link,gender,locale,picture'},
            function (response) {
                // Save user data
                saveUserData(response);
            });
    }

    // Logout from facebook
    function fbLogout() {
        FB.logout(function () {
            document.getElementById('fbLink').setAttribute("onclick", "fbLogin()");
            document.getElementById('fbLink').innerHTML = '<img src="images/fblogin.png"/>';
            document.getElementById('userData').innerHTML = '';
            document.getElementById('status').innerHTML = 'You have successfully logout from Facebook.';
        });
    }

    // Save user data to the database
    function saveUserData(userData) {
        $.post('userData.php',
            {oauth_provider: 'facebook', userData: JSON.stringify(userData)},
            function (data) {
                $("#account").html(data);
                window.location.replace('./giaiphau/');
                return true;
            });
    }
    

<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"><?php echo '</script'; ?>
>
</body>
</html><?php }
}
