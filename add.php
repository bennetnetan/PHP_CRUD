<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link href="./Assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="./Assets/JS/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h2>CRUD Students Records</h2>
                <h4>Add students</h4>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="form-group">
                      <label for="">First name</label>
                      <input type="text"
                        class="form-control" name="fname" id="" aria-describedby="helpId" placeholder="">
                      <small id="helpId" class="form-text text-muted">Student's first name</small>
                    </div>
                    <div class="form-group">
                      <label for="">Last name</label>
                      <input type="text"
                        class="form-control" name="lname" id="" aria-describedby="helpId" placeholder="">
                      <small id="helpId" class="form-text text-muted">Student's last name</small>
                    </div>
                    <div class="form-group">
                      <label for="">Class</label>
                      <input type="text"
                        class="form-control" name="classs" id="" aria-describedby="helpId" placeholder="">
                      <small id="helpId" class="form-text text-muted">Student's class</small>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Add student
                    </button>
                    <a name="" id="" class="btn btn-danger" href="index.php" role="button">
                        Home
                    </a>
                </form>
                
            </div>
        </div>
    </div>
</body>
<?php
    include('connection.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $class = $_POST['classs'];

        $query = "INSERT INTO students (firstname, lastname, class) VALUES ('$fname', '$lname', '$class')";
        $result = $conn->query($query);

        if ($result) {
            ?>
            <div class="alert alert-success" role="alert">
                Student added successfully!
            </div>
            <?php
            header("Location: index.php");
            exit;
        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                Error adding student!
            </div>
            <?php
        }
    }
?>
</html>