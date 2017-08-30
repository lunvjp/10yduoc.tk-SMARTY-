<html>
<head>
    <title>10YDuoc.tk - Cùng nhau luyện đề</title>
    <meta charset="utf-8">
    <link href="../css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body {
            background: lightskyblue;
            font-family: "Segoe UI", Arial, sans-serif;
        }


        .form-setup a:hover {
            text-decoration: none;
        }

        .content .form-add-submit {
            left: 20%;
        }

        #choiceuser-container {
            position: fixed;
            width: 40%;
            top: 35px;
            bottom: 40px;
            overflow-x: hidden;
            overflow-y: auto;
            left: 20.05%;
            /*border-right: 1px solid grey;*/
            text-align: justify;
        }

        #facebook {
            position: fixed;
            top: 35px;
            left: 60.1%;
            right: 0;
            bottom: 40px;
        }

        .form-setup {
            width: 20%;
        }

        .content {
            border: 1px solid grey;
            padding: 0;
            box-sizing: border-box;
            position: fixed;
            top: 35px;
            bottom: 38px;
            left: 20%;
            width: 80%;
            /*overflow-x: hidden;*/
            /*overflow-y: auto;*/
            background-color: white;
            border-top: none;
        }

        .content .question {
            font-family: "Times New Roman", sans-serif;
            padding-top: 15px;
        }

        .content .question hr {
            width: 100%;
            height: 1px;
            background-color: grey;
            margin: 0;
        }

        .content #id {
            background: lightskyblue;
        }

        .auto-padding {
            padding-top: 40px;
        }
    </style>
    <script>

    </script>
</head>
<body>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Thông báo</h4>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn làm đề này không?</p>
            </div>
            <div class="modal-footer">
                <button id="yes" type="button" class="btn btn-success" data-dismiss="modal">Yes</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
            </div>
        </div>

    </div>
</div>


<div class="mynavbar">
    <!--                <a href="" class="topnav-icons fa fa-menu w3-hide-large w3-left w3-bar-item w3-button" title="Menu"></a>-->
    <a href=".." title="Home"><i class="fa fa-home" style="line-height: 35px;" aria-hidden="true"></i></a>
    <a href="." title="Làm Đề Giải Phẫu">GIẢI PHẪU</a>
    <a href="../sinhditruyen" title="Làm Đề Sinh Di Truyền">SINH DI TRUYỀN</a>
    <div id="account" style="float: right;margin-right:10px;">
        {$edit}
        {$info}
        <!--
        if (isset($_SESSION['email']) && $_SESSION['email'] == 'lunvjp@gmail.com') echo "<a href='../edit.php'>CHỈNH SỬA ĐỀ</a>";
        if (isset($_SESSION['info'])) echo $_SESSION['info'];
        -->
    </div>
</div>

<div class="form-setup" style="border-right: none;"> <!-- Hiện các bộ đề đã làm ở đây -->
    <ol>
        {$html}
    </ol>
</div>

<div class="content"> <!-- Hiển thị số câu đã làm ở đây -->
    <div id="time"
         style="position:fixed;z-index: 1;width:100%;display: none;background: lightskyblue; height:40px;border-bottom:1px solid grey;font-size:25px;font-weight: bold;font-family: Arial,sans-serif;color: #ffff80;line-height: 40px;padding-left:10px;">
        <span>BẮT ĐẦU</span></div>

    <div id="choiceuser-container">
        <div id="ajax-load" style="display: none; height: 100px; width: 160px; margin: auto; margin-top:20px">
            <i class="fa fa-spinner fa-spin" style="font-size: 7em; color: #D9ECFF;"></i>
        </div>
        <div id="choiceuser"></div>
    </div>
    <div id="facebook"></div>

    <div class="form-add-submit" style="position: fixed;">
        <form method="post" name="form-edit">
            <input type="hidden" id="wrongsentence" name="wrongsentence"
                   value="">
            <button type="button" id="wrong-button">Bài làm sai</button>
            <button type="button" id="right-button">Bài làm đúng</button>
            <button type="button" id="submit-button">Nộp bài</button>
            <button type="button" id="turnoffface-button">Bật/Tắt bình luận</button>
        </form>
    </div>
</div>
<script async src='//go.su/e/QA9X'></script>
<script src="../giaiphau/check.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
