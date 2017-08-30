<?php
require_once "connect.php";
require_once "libs/Smarty.class.php";
session_start();

$smarty = new Smarty();
$smarty->setTemplateDir('./templates/');
$smarty->setCompileDir('./templates_c/');
$smarty->setConfigDir('./configs/');
$smarty->setCacheDir('./cache/');
$smarty->caching = false;


$html = '';
if (isset($_SESSION['id'])) { // login successfully
    header("location: ./giaiphau/");
    exit();
}

$database->table = 'test';
$query = "select test.id, test.name, count(manage_test.question_id) as total from subject, unit, test, manage_test
                where manage_test.test_id = test.id
                and test.unit_id = unit.id
                and unit.subject_id = subject.id
                and subject.id = 1
                group by test.id";
$database->query($query);
$data = $database->select();

foreach ($data as $key => $value) {
    if ($key <= 4) {
        $html .= '<li><span><a style="cursor: pointer;color: yellowgreen" onclick="doTest(' . $value['id'] . ')">' . $value["name"] . '</a></span></li>';
    } else {
        $html .= '<li><span><a style="cursor: pointer;color: red;" data-toggle="modal" data-target="#myModal">' . $value["name"] . '</a></span></li>';
    }
}
$smarty->assign('html',$html);




$content = '<form method="post" name="form-add" id="form-do-test"><input type="hidden" name="done" value="1">';
$query = "select a.id,a.name as question,a.a,a.b,a.c,a.d,a.e,a.f,a.answer FROM question as a, manage_test as b, test
                where a.id = b.question_id
                and b.test_id = test.id
                and test.id = 1";
$database->query($query);
$data = $database->select();

$list = array();
foreach ($data as $key => $value) {
    if ($key == 20) break;
    $list[$value['id']] = $value['answer'];

    $item['A'] = $value['a'];
    $item['B'] = $value['b'];
    $item['C'] = $value['c'];
    $item['D'] = $value['d'];
    if ($value['e']) $item['E'] = $value['e'];
    if ($value['f']) $item['F'] = $value['f'];


    $temp = '<div class="question" id="'.$value['id'].'">
                    <div class="item">
                        <p class="title">Câu ' . ($key+1) . '.</p>
                        <p class="title-content">' . $value['question'] . '</p>
                    </div>';
    foreach($item as $i => $val) {
        $temp .= '<div class="item">
                        <p class="answer">'.$i.'.</p>
                        <p style="width:2%;vertical-align: middle;"><input class="'.$value['id'].'" value="'.strtolower($i).'" type="radio" name="'.$value['id'].'"></p>
                        <p style="padding-left:10px;"><span>'.$val.'</span></p>
                    </div>';
    }
    $temp .='<hr></div>';
    $content .=$temp;

}
$content .='</form>';


if (!isset($_SESSION['answer'])) $_SESSION['answer'] = $list;

if (isset($_POST['done'])) {
    $database->table = 'do_question';

    array_shift($_POST); // Xóa thằng input bị che đi
    $list = $_SESSION['answer'];

    $done = $_POST;

    $dem = 0;
    foreach ($done as $key => $value) {
        $right = $list[$key];
        if (strtolower($right) == strtolower($value)) { // Right
            $dem++; // số câu đúng
        }
    }

    $_SESSION['result'] = "<div style='position: relative;' class='alert alert-success alert-dismissable fade in'>
                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                        <span style='width:100%;'>Kết quả: " . $dem . "/20</span>
                        <span style='width:100%;'>Đăng nhập để xem chi tiết đáp án và làm thêm thật nhiều đề nhé</span>
                    </div>";
    header('location: .');
    exit();
}



$info = '';
if (isset($_SESSION['info'])) $info = $_SESSION['info'];
$smarty->assign('info',$info);


$result = '';
if (isset($_SESSION['result'])) {
    $result =  $_SESSION['result'];
}
$smarty->assign('result',$result);

$contentHTML = '';
if (!isset($_SESSION['result'])) $contentHTML = $content;
else unset($_SESSION['result']);
$smarty->assign('contentHTML',$contentHTML);

$smarty->display('index.tpl');