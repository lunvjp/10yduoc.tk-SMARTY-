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

if (isset($_SESSION['username']) && $_SESSION['username'] == 'momabz6') {
    $smarty->assign('admin', "<a href='edit.php'>CHỈNH SỬA ĐỀ</a>");
}


if (isset($_POST['question'])) {
    $database->table = 'question';
    $check = false;
    foreach ($_POST['question'] as $key => $value) {
        $set['name'] = trim(ucfirst($_POST['name'][$key]));
        $set['a'] = trim(ucfirst($_POST['A'][$key]));
        $set['b'] = trim(ucfirst($_POST['B'][$key]));
        $set['c'] = trim(ucfirst($_POST['C'][$key]));
        $set['d'] = trim(ucfirst($_POST['D'][$key]));
        $set['e'] = trim(ucfirst($_POST['E'][$key]));
        $set['f'] = trim(ucfirst($_POST['F'][$key]));
        $set['g'] = trim(ucfirst($_POST['G'][$key]));
        $set['answer'] = trim(strtoupper($_POST['answer'][$key]));
        $set['detail_answer'] = trim(ucfirst($_POST['detailofanswer'][$key]));

        $database->update($set, array('id' => $value));
        if ($database->showRows() == 1) $check = true;
    }

    if ($check) {
        $_SESSION['success-update'] = '<strong>Success!</strong> Cập nhật thành công';
        header("location: edit.php?subid=" . $_GET['subid'] . "");
        exit();
    }
}

$account = '';
if (isset($_SESSION['username'])) {
    $account = "<a href='logout.php'>Đăng xuất</a>";
    $account .= ' Chào ' . $_SESSION['username'];
}
$smarty->assign('account', $account);

// Lấy ra các bộ đề có trong CSDL
$html = '';
if (isset($_GET['subid'])) {
    $query = "select a.id,a.name,count(b.question_id) as total from test as a, manage_test as b, unit, subject
                    where a.id = b.test_id
                    and a.unit_id = unit.id
                    and unit.subject_id = subject.id
                    and subject.id = " . $_GET['subid'] . "
                    group by a.id";
    $database->query($query);
    $data = $database->select();

    foreach ($data as $key => $value) {
        $style = '';
        if (isset($_GET['testid']) && ($_GET['testid'] == $value['id'])) {
            $style = "style='background-color: lightskyblue'";
        }
        $html .= '<li>
                    <span><a ' . $style . ' href="edit.php?subid=' . $_GET['subid'] . '&testid=' . $value["id"] . '">' . $value["name"] . '</a></span> 
                    <span style="padding-left:10px;color: yellowgreen">' . $value['total'] . ' Câu</span>
                </li>';
    }
}
$smarty->assign('html', $html);


if (isset($_SESSION['success-update'])) {
    $successHTML = "<div style='margin:10px;box-sizing: border-box' class='alert alert-success'>" . $_SESSION['success-update'] . "</div>";
    unset($_SESSION['success-update']);
    $smarty->assign('successHTML', $successHTML);
}


if (isset($_GET['testid'])) {
    $query = "select question.id, question.name, question.a, question.b, question.c, question.d, question.e, question.f, question.g, question.answer, question.detail_answer 
                    from question, manage_test, test
                    where question.id = manage_test.question_id
                    and test.id = manage_test.test_id
                    and test.id = " . $_GET['testid'] . "";
    $database->query($query);
    $sentenceList = $database->select();
//            $_SESSION['question'] = $sentenceList;

    $xhtml = '';
    if (!empty($sentenceList)) {
        foreach ($sentenceList as $key => $value) {
            $xhtml .= "<div class='question' style='padding-left: 10px'>
                                    <input type='hidden' name='question[]' value=" . $value['id'] . ">
                                    <div class='item'>
                                        <p class='title'>Câu " . ($key + 1) . "</p>
                                    <p><textarea rows='3' id='textarea' name='name[]'>" . $value['name'] . "</textarea></p>
                                    </div>";

            $temp['A'] = $value['a'];
            $temp['B'] = $value['b'];
            $temp['C'] = $value['c'];
            $temp['D'] = $value['d'];
//                    if ($value['e']) $temp['E'] = $value['e'];
//                    if ($value['f']) $temp['F'] = $value['f'];
            $temp['E'] = $value['e'];
            $temp['F'] = $value['f'];
            $temp['G'] = $value['g'];

            foreach ($temp as $key2 => $value2) {
                $style = '';
                if (!($value2 && $value2 != 'NULL')) $style = 'style="display:none"';

                $xhtml .= '<div class="item" ' . $style . '>
                                        <p class="answer">' . $key2 . '.</p>
                                        <p><input type="text" name="' . $key2 . '[]" value="' . $value2 . '"></p>
                                    </div>';
            }

            $xhtml .= "<div class='item'>
                                    <p class='answer' style='width:40px;vertical-align: top;'>ĐS<input style='width:80%' type='text' name='answer[]' value=" . $value['answer'] . "></p>
                                    <p>Lời giải<textarea rows='2' id='textarea' name='detailofanswer[]'>" . $value['detail_answer'] . "</textarea></p>
                                </div>";
            $xhtml .= "<hr></div>";
        }
    } else $xhtml = 'Dữ liệu không tồn tại';
    $smarty->assign('xhtml', $xhtml);
}

$smarty->display('edit.tpl');