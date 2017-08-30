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

if (isset($_POST['id']) && isset($_POST['type'])) {
//    $_SESSION['testid'] = $_POST['id'];

    if ($_POST['type'] == 'wronganswer') {
        $query =    "SELECT c.indexoftest,b.id, b.name, b.a, b.b, b.c, b.d, b.e, b.f, a.check, a.answerofuser, b.answer
                    from do_question as a, question as b, manage_test as c, test as d
                    where a.question_id = b.id
                    and c.question_id = b.id
                    and c.test_id = d.id
                    and a.user_id = ".$_SESSION['id']."
                    and d.id = ".$_POST['id']." 
                    and a.check = 0
                    order by c.indexoftest asc";
        $database->query($query);
        $detailofdonesentence = $database->select();

        $xhtml = '';
        if (!empty($detailofdonesentence))
        {
//                $xhtml = '<div class="container-fluid">';
            foreach($detailofdonesentence as $key => $value) {
                $xhtml .='<div class="question">
                        <div class="item">
                            <p class="title">Câu ' . $value['indexoftest'] . '.</p>
                            <p class="title-content">' . $value['name'] . '</p>
                        </div>';
                $temp['A'] = $value['a'];
                $temp['B'] = $value['b'];
                $temp['C'] = $value['c'];
                $temp['D'] = $value['d'];
                if ($value['e']) $temp['E'] = $value['e'];
                if ($value['f']) $temp['F'] = $value['f'];

                foreach($temp as $key2 => $value2) {
                    $xhtml .= '<div class="item">
                                <p class="answer">'.$key2.'.</p>
                                <p>' . $value2 . '</p>
                            </div>';
                }

                $color = $value['check']==0 ? 'red':'blue';

                $xhtml .= '<p style="padding-left:10px;display:block;font-size:13px;font-family:Arial,sans-serif;line-height:30px;font-weight: 600;height:30px;color: '.$color.';background:#e9ebee">'.strtoupper($value['answer']).' - Trả lời '.strtoupper($value['answerofuser']).'</p></div>';

            }
//                $xhtml .= '</div>';
        }
        echo $xhtml;
    } else if ($_POST['type'] == 'rightanswer') {
        //    $query = "";
        $query =    "SELECT c.indexoftest,b.id, b.name, b.a, b.b, b.c, b.d, b.e, b.f, a.check, a.answerofuser, b.answer
                    from do_question as a, question as b, manage_test as c, test as d
                    where a.question_id = b.id
                    and c.question_id = b.id
                    and c.test_id = d.id
                    and a.user_id = ".$_SESSION['id']."
                    and d.id = ".$_POST['id']." 
                    and a.check = 1
                    order by c.indexoftest asc";
        $database->query($query);
        $detailofdonesentence = $database->select();

        $xhtml = '';
        if (!empty($detailofdonesentence))
        {
//                $xhtml = '<div class="container-fluid">';
            foreach($detailofdonesentence as $key => $value) {
                $xhtml .='<div class="question">
                        <div class="item">
                            <p class="title">Câu ' . $value['indexoftest'] . '.</p>
                            <p class="title-content">' . $value['name'] . '</p>
                        </div>';
                $temp['A'] = $value['a'];
                $temp['B'] = $value['b'];
                $temp['C'] = $value['c'];
                $temp['D'] = $value['d'];
                if ($value['e']) $temp['E'] = $value['e'];
                if ($value['f']) $temp['F'] = $value['f'];

                foreach($temp as $key2 => $value2) {
                    $xhtml .= '<div class="item">
                                <p class="answer">'.$key2.'.</p>
                                <p>' . $value2 . '</p>
                            </div>';
                }

                $color = $value['check']==0 ? 'red':'blue';

                $xhtml .= '<p style="padding-left:10px;display:block;font-size:13px;font-family:Arial,sans-serif;line-height:30px;font-weight: 600;height:30px;color: '.$color.';background:#e9ebee">'.strtoupper($value['answer']).' - Trả lời '.strtoupper($value['answerofuser']).'</p></div>';

            }
//                $xhtml .= '</div>';
        }
        echo $xhtml;
    } else if ($_POST['type'] == 'done') {
        $query =    "SELECT c.indexoftest,b.id, b.name, b.a, b.b, b.c, b.d, b.e, b.f, a.check, a.answerofuser, b.answer
                    from do_question as a, question as b, manage_test as c, test as d
                    where a.question_id = b.id
                    and c.question_id = b.id
                    and c.test_id = d.id
                    and a.user_id = ".$_SESSION['id']."
                    and d.id = ".$_POST['id']."
                    order by c.indexoftest asc";
        $database->query($query);
        $detailofdonesentence = $database->select();

        $xhtml = '';
        if (!empty($detailofdonesentence))
        {
            $xhtml = '<div class="choiceuser-content" style="width:60%; display: table-cell; vertical-align: top">';

            foreach($detailofdonesentence as $key => $value) {
                $color = '';
                $class = '';
                if ($value['check'] == 0) { // Nếu đáp án sai
                    $color = 'red';
                    $class = 'wrong';
                } else { // Đáp án đúng
                    $color = 'blue';
                    $class = 'right';
                }

                $xhtml .='<div class="question '.$class.'">
                            <div class="item">
                                <p class="title">Câu ' . $value['indexoftest'] . '.</p>
                                <p class="title-content">' . $value['name'] . '</p>
                            </div>';
                $temp['A'] = $value['a'];
                $temp['B'] = $value['b'];
                $temp['C'] = $value['c'];
                $temp['D'] = $value['d'];
                if ($value['e']) $temp['E'] = $value['e'];
                if ($value['f']) $temp['F'] = $value['f'];

                foreach($temp as $key2 => $value2) {
                    $xhtml .= '<div class="item">
                                <p class="answer">'.$key2.'.</p>
                                <p>' . $value2 . '</p>
                            </div>';
                }

//                $color = $value['check']==0 ? 'red':'blue';

                $xhtml .= '<p style="padding-left:10px;display:block;margin:0;font-size:13px;font-family:Arial,sans-serif;line-height:30px;font-weight: 600;height:30px;color: '.$color.';background:#e9ebee">'.strtoupper($value['answer']).' - Trả lời '.strtoupper($value['answerofuser']).'</p>
                        </div>';
            }
                $xhtml .= '</div>';

        }
        echo $xhtml;
    }
    else if ($_POST['type'] == 'facebook') {
        echo '<iframe style="width: 100%; height: 100%" src="../detail/'.$_POST['id'].'.php"></iframe>';
    }
}



if (isset($_POST['id']) && isset($_POST['action'])) { // Khi người dùng bấm vào làm bài tại đây thì ngay lần đầu tiên chúng ta thêm vào cơ sơ dữ liệu
    // Điều kiện đề in ra danh sách các đề đưuọc làm tiếp theo là

    $content = '<form method="post" name="form-add" id="form-do-test"><input type="hidden" name="done" value="'.$_POST['id'].'">';
    $id = htmlspecialchars($_POST['id']);
    $id = trim($id);

    // Khi click vào nút yes thì insert id user là $_SESSION['id']
    // và insert test_id là $id;
    $database->table = 'do_test';
    $insert = array('user_id'=>$_SESSION['id'],'test_id'=>$id);
    $database->insert($insert);


    $database->table = 'test';

    $query = "select b.indexoftest,a.id,a.name as question,a.a,a.b,a.c,a.d,a.e,a.f,a.answer FROM question as a, manage_test as b, test
            where a.id = b.question_id
            and b.test_id = test.id
            and test.id = $id
            and a.id not in (
                select do_question.question_id from do_question
                where user_id = ".$_SESSION['id']."
            )
            order by b.indexoftest asc";
    $database->query($query);
    $data = $database->select();

    $result = array();
    foreach ($data as $key => $value) {
        $result[$value['id']] = $value['answer'];

        $item['A'] = $value['a'];
        $item['B'] = $value['b'];
        $item['C'] = $value['c'];
        $item['D'] = $value['d'];
        if ($value['e']) $item['E'] = $value['e'];
        if ($value['f']) $item['F'] = $value['f'];


        $temp = '<div class="question" id="'.$value['id'].'">
                    <div class="item">
                        <p class="title">Câu ' . $value['indexoftest'] . '.</p>
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
    echo $content;
    $_SESSION['answer'] = $result; // mảng kết quả
    $_SESSION['timeout']=(time() + 30*60) * 1000;
}

if (isset($_POST['time'])) {
    echo $_SESSION['timeout'];
}