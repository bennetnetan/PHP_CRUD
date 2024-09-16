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
    <?php
        include('connection.php');
        $id = $_GET['id'];
        $query = "SELECT * FROM students WHERE id = $id";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "Student not found";
            exit;
        }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h2>Delete Student Record</h2>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Student Details</h5>
                        <p class="card-text">First Name: <?php echo $row["firstname"]; ?></p>
                        <p class="card-text">Last Name: <?php echo $row["lastname"]; ?></p>
                        <p class="card-text">Class: <?php echo $row["class"]; ?></p>
                    </div>
                    <div class="card-footer">
                        <form action="./delete.php?id=<?php echo $id; ?>" method="post">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <button type="submit" class="btn btn-danger">
                                Delete Student
                            </button>
                            <a class="btn btn-secondary" href="index.php" role="button">
                                Cancel
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['id'];
            $query = "DELETE FROM students WHERE id = $id";
            $result = $conn->query($query);
            if ($result) {
                ?>
                <div class="alert alert-success" role="alert">
                    Student deleted successfully!
                </div>
                <?php
                header("Location: index.php");
                exit;
            } else {
                ?>
                <div class="alert alert-danger" role="alert">
                    Error deleting student!
                </div>
                <?php
            }
        }
    ?>
</body>
</html>