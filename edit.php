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
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h2>Students Records</h2>
                    <h4>Edit student record</h4>
                    <?php
                      // Retrieve the id from the URL
                      $id = $_GET['id'];

                      // Query to retrieve the student's data
                      $query = "SELECT * FROM students WHERE id = $id";
                      $result = $conn->query($query);

                      // Check if the student exists
                      if ($result->num_rows > 0) {
                          $row = $result->fetch_assoc();
                      } else {
                          echo "Student not found";
                          exit;
                      }
                      ?>

                      <form action="./edit.php?id=<?php echo $id; ?>"" method="post">
                          <input type="hidden" name="id" value="<?php echo $id; ?>">
                          <div class="form-group">
                              <label for="">First name</label>
                              <input type="text" class="form-control" name="fname" id="" aria-describedby="helpId" placeholder="" value="<?php echo $row["firstname"]; ?>">
                              <small id="helpId" class="form-text text-muted">Student's first name</small>
                          </div>
                          <div class="form-group">
                              <label for="">Last name</label>
                              <input type="text" class="form-control" name="lname" id="" aria-describedby="helpId" placeholder="" value="<?php echo $row["lastname"]; ?>">
                              <small id="helpId" class="form-text text-muted">Student's last name</small>
                          </div>
                          <div class="form-group">
                              <label for="">Class</label>
                              <input type="text" class="form-control" name="classs" id="" aria-describedby="helpId" placeholder="" value="<?php echo $row["class"]; ?>">
                              <small id="helpId" class="form-text text-muted">Student's class</small>
                          </div>
                          <button type="submit" class="btn btn-primary">
                              Update student
                          </button>
                          <a class="btn btn-danger" href="index.php" role="button">
                              Cancel
                          </a>
                      </form>

                      <?php
                        // Update the student's data if the form is submitted
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $id = $_POST['id'];
                            $fname = $_POST['fname'];
                            $lname = $_POST['lname'];
                            $class = $_POST['classs'];

                            $query = "UPDATE students SET firstname = '$fname', lastname = '$lname', class = '$class' WHERE id = $id";
                            $result = $conn->query($query);

                            if ($result) {
                                ?>
                                <div class="alert alert-success" role="alert">
                                    Student updated successfully!
                                </div>
                                <?php
                                header("Location: index.php");
                                exit;
                            } else {
                                ?>
                                <div class="alert alert-danger" role="alert">
                                    Error updating student!
                                </div>
                                <?php
                            }
                        }
                      ?>
                
            </div>
        </div>
    </div>
</body>
</html>