<?php include '../config.php'; ?>
<?php
checkAuth('Teacher');
$user = $_SESSION['auth'];
$qry = "Select questions.*, subjects.name as subject from questions 
        INNER JOIN subjects ON subjects.id = questions.subject_id
        where teacher_id='" . $user['id'] . "'";
$results = mysqli_query($con,$qry);
?>
<?php include 'header.php'; ?>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 text-secondary"><span class="text-success">Q</span>uestions</h1>
    </div>
<?php
if(!empty($_SESSION['message'])) {

    echo "<div class='alert alert-success alert-dismissible'>" .
        $_SESSION['message'] .
        '<button type="button" class="close" data-dismiss="alert">&times;</button>' .
        "</div>";
    unset($_SESSION['message']);
}
?>
    <div class="container mt-5">
        <a href="<?php echo $url . "teacher/questions/create.php"?>" class="btn btn-success px-4 my-2">Add</a>
        <div class="table-responsive bg-white px-4 py-2">
            <table class="table table-border">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Question</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Marks</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($results as $result){
                    echo "<tr>".
                        "<td>".$result['id']."</td>".
                        "<td>".$result['question']."</td>".
                        "<td>".$result['subject']."</td>".
                        "<td>".$result['marks']."</td>" .
                        "<td class='py-1 px-0'><a class='text-primary bg-white w-75 text-center' href='" . $url . "teacher/questions/edit.php?id=".$result['id']."'><i class='fa fa-pencil-alt'></i></a></td>".
                        "<td class='py-1 px-0'><a class='text-danger bg-white w-75 text-center delete-btn' href='" . $url . "teacher/questions/delete.php?id=".$result['id']."'><i class='fa fa-trash-alt'></i></a></td>".
                        "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
<?php include 'footer.php'; ?>
<script>
    $(document.body).on('click','.delete-btn',function (e) {
        e.preventDefault();
        if(confirm('Are you sure ?')){
            window.location.href = $(this).attr('href');
        }
    });
</script>
