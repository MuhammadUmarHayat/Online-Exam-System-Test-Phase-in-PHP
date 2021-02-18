<?php include '../../config.php';?>
<?php
checkAuth('Teacher');

$user = $_SESSION['auth'];
$question = "";
$marks = "";
$subject = "";
$options = [];
$questionErr = "";
$marksErr = "";
$subjectErr = "";
$optionsErr = "";

$qry = "SELECT subjects.* from subjects 
        INNER JOIN teacher_subjects ON teacher_subjects.subject_id = subjects.id 
        WHERE teacher_subjects.teacher_id='" . $user['id'] . "'";
$subjects = mysqli_query($con, $qry);


if(!empty($_POST)) {
    if (!empty($_POST['question'])) {
        $question = $_POST['question'];
        if (!empty($_POST['marks']) && is_numeric($_POST['marks'])) {
            $marks = $_POST['marks'];
            if (!empty($_POST['subject']) && is_numeric($_POST['subject'])) {
                $subject = $_POST['subject'];
                if (!empty($_POST['options'])) {
                    if (!empty($_POST['correct'])) {



                        $qry = "INSERT INTO questions(question,marks,subject_id,teacher_id) VALUES ('$question','$marks','$subject','" . $user['id'] . "')";
                        if(mysqli_query($con,$qry)){
                            $question_id = mysqli_insert_id($con);
                            $correctInd = $_POST['correct'];
                            foreach($_POST['options'] as $ind => $opt){

                                $correct = 0;
                                if($ind == $correctInd) {
                                    $correct = 1;
                                }

                                $qry = "INSERT INTO question_options(`option`,is_correct,question_id) VALUES ('$opt','$correct','$question_id')";
                                mysqli_query($con,$qry);
                            }
                            $_SESSION['message'] = "Question created successfully.";
                            header('location:'.$url.'teacher/index.php');
                        }

                    } else {
                        $optionsErr = "Atleast 1 option should be correct.";
                    }
                } else {
                    $optionsErr = "1 Option is required.";
                }
            } else {
                $nameErr = "Subject field is empty.";
            }
        } else {
            $nameErr = "Marks field is empty.";
        }
    } else {
        $nameErr = "Question field is empty.";
    }
}
?>
<?php include '../header.php'; ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-secondary"><span class="text-success">C</span>reate Question</h1>
</div>
<div class="container mt-5">
    <div class="px-4 py-2">
        <div class="row">
            <div class="col-12 col-lg-8 mx-auto">
                <form method="POST">
                    <a href="<?php echo $url . 'teacher/index.php'; ?>" class="btn backbutton w-25 rounded-pill">Back</a>
                    <div class="form-group p-1 pt-5">
                        <p class="text-danger mb-0 ml-2"><?php echo $questionErr?></p>
                        <textarea name="question" class="form-control border-success" id="question" aria-describedby="emailHelp" value="<?php echo $question; ?>" placeholder="Question" required><?php echo $question;?></textarea>
                    </div>
                    <div class="form-group p-1">
                        <p class="text-danger mb-0 ml-2"><?php echo $marksErr?></p>
                        <input type="number" name="marks" min="1" class="form-control border-success rounded-pill" id="marks" aria-describedby="emailHelp" value="<?php echo $marks; ?>" placeholder="Marks" required>
                    </div>
                    <div class="form-group p-1">
                        <p class="text-danger mb-0 ml-2"><?php echo $subjectErr?></p>
                        <select name="subject" class="form-control border-success rounded-pill" id="subject" aria-describedby="emailHelp" required>
                            <option value="">Select a Subject</option>
                            <?php
                            if($subjects != false){
                                foreach($subjects as $item){
                                    $checked = "";
                                    if($item['id'] == $subject)
                                        $checked = "selected";
                                    ?>
                                    <option <?php echo $checked; ?> value="<?php echo $item['id'];?>"><?php echo $item['name'];?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group p-1">
                        <p class="text-danger mb-0 ml-2"><?php echo $optionsErr?></p>
                        <div id="option-grid">
                            <div class="row">
                                <div class="col-6">
                                    <input class="option form-control" placeholder="Option" name="options[1]">
                                </div>
                                <div class="col-2">
                                    <label><input type="radio" name="correct" value="1"> Correct</label>
                                </div>
                                <div class="col-4"> <button type="button" id="add-option" class="btn btn-success">Add Option</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="float-right btn btn-success w-100 rounded-pill">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../footer.php'; ?>
<script>
    function delOpt(ele){
        $(ele).parent().parent().remove()
    }
    $(function () {
        let i = 1;
        $("#add-option").click(function () {
            i++;
            $("#option-grid").append('<div class="row">' +
                '<div class="col-6">\n' +
                '<input class="option form-control mt-2" placeholder="Option" name="options[' + i + ']">\n' +
                '</div>\n' +
                '<div class="col-2">\n' +
                '<label><input type="radio" class="mt-2" name="correct" value=' + i + '> Correct</label>\n' +
                '</div>\n' +
                '<div class="col-4"> ' +
                '<button type="button" onclick="delOpt(this)" class="btn btn-danger mt-2">Delete Option</button>\n' +
                '</div>' +
                '</div>')
        });
    });
</script>
