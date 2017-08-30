<?php
require_once "../connect.php";
require_once "../libs/Smarty.class.php";
session_start();

$smarty = new Smarty();
$smarty->caching = false;
$smarty->setTemplateDir('../templates/');
$smarty->setCompileDir('../templates_c/');
$smarty->setConfigDir('../configs/');
$smarty->setCacheDir('../cache/');

if (isset($_POST['done'])) {

    $database->table = 'do_question';

    array_shift($_POST);
    $result = $_SESSION['answer'];

    $done = $_POST;

    foreach ($done as $key => $value) {
        $right = $result[$key];
        $check = 0; //Wrong
        if (strtolower($right) == strtolower($value)) { // Right
            $check = 1;
        }
        $insert = array('user_id' => $_SESSION['id'], 'question_id' => $key, 'check' => $check, 'answerofuser' => $value);
        $database->insert($insert, 'single');
    }

    header('location: .');
    exit();
}

$result = array();
$data = array();


$html = 'Dữ liệu đang cập nhật';
if (isset($_SESSION['username'])) {
    $database->table = 'test';

    $query = "select test.id, test.name, count(manage_test.question_id) as total from subject, unit, test, manage_test
                where manage_test.test_id = test.id
                and test.unit_id = unit.id
                and unit.subject_id = subject.id
                and subject.id = 2
                group by test.id";
    $database->query($query);
    $data = $database->select();

    $donesentence = "select e.id, e.name, count(c.id) as donetotal
                    from user as a, do_question as b, question as c, manage_test as d, test as e, unit, subject
                    where a.id = b.user_id
                    and b.question_id = c.id
                    and d.question_id = c.id
                    and e.id = d.test_id
                    and e.unit_id = unit.id
                    and unit.subject_id = subject.id
                    and a.id = " . $_SESSION['id'] . "
                    and subject.id = 1
                    group by e.id";
    $database->query($donesentence);
    $donesentencelist = $database->select();

    foreach ($data as $key => $value) {
        $idsentence = $value['id']; // tất cả mã đề từ bảng dữ liệu
        $check = false;
        if (!empty($donesentencelist)) {
            foreach ($donesentencelist as $index => $val) {
                if ($idsentence == $val['id']) {
                    $html .= '<li>
                            <span><a style="cursor: pointer;" onclick="seeResult(' . $value['id'] . ')">' . $value["name"] . '</a></span> 
                            <span style="padding-left:10px;color: yellowgreen">' . $val['donetotal'] . '/' . $value['total'] . '</span>
                            <span style="padding-left:10px;"><a style="cursor: pointer;color: yellowgreen" onclick="doMoreQuestion(' . $value['id'] . ')">Làm tiếp</a></span>
                        </li>';
                    $check = true;
                    break;
                }
            }
        }

        if ($check == false) {
            $query = "select * from do_test where test_id = $idsentence and user_id = " . $_SESSION['id'] . "";
            $database->query($query);
            $temp = $database->select();

            if (!empty($temp))
            {
                $check = true;
                $html .= '<li>
                            <span><a style="cursor: pointer;" onclick="seeResult(' . $value['id'] . ')">' . $value["name"] . '</a></span> 
                            <span style="padding-left:10px;color: yellowgreen">0/' . $value['total'] . '</span>
                            <span style="padding-left:10px;"><a style="cursor: pointer;color: yellowgreen" onclick="doMoreQuestion(' . $value['id'] . ')">Làm tiếp</a></span>
                        </li>';
            }
        }

        if ($check == false) { // Chưa làm 1 câu hỏi nào trong mã đề này
            $html .= '<li>
                    <span><a style="cursor: pointer" data-toggle="modal" data-target="#myModal" onclick="getLink(' . $value['id'] . ')">' . $value["name"] . '</a></span>
                </li>';
        }
    }


} else {
    header('location: ..');
    exit();
}
$smarty->assign('html',$html);


$edit='';
if (isset($_SESSION['email']) && $_SESSION['email'] == 'lunvjp@gmail.com') {
    $edit = "<a href='../edit.php'>CHỈNH SỬA ĐỀ</a>";
}
$smarty->assign('edit',$edit);

$info = '';
if (isset($_SESSION['info'])) $info = $_SESSION['info'];
$smarty->assign('info',$info);

$smarty->display('sinhditruyen.tpl');
