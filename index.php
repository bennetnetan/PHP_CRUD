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
                    <a name="" id="" class="btn btn-primary" href="./add.php" role="button">
                        Add students
                    </a>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-borderless table-success align-middle text-dark">
                        <thead class="table-light">
                            <caption>
                                Student records
                            </caption>
                            <tr>
                                <th>id</th>
                                <th>First name</th>
                                <th>Last Name</th>
                                <th>Grade</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <tr class="table-primary">
                            <?php
                                // Query to retrieve data from the database with pagination
                                $query = "SELECT * FROM students";
                                $result = $conn->query($query);

                                // Get total number of rows
                                $total_rows = $result->num_rows;

                                // Set pagination variables
                                $per_page = 5; // number of records per page
                                $total_pages = ceil($total_rows / $per_page);
                                $current_page = (isset($_GET['page']) ? $_GET['page'] : 1);

                                // Calculate offset for pagination
                                $offset = ($current_page - 1) * $per_page;

                                // Query to retrieve data with pagination
                                $query = "SELECT * FROM students LIMIT $offset, $per_page";
                                $result = $conn->query($query);

                                if (@$result->num_rows > 0) {
                                    // Output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <td scope="row"><?=$row["id"]?></td>
                                                <td><?=$row["firstname"]?></td>
                                                <td><?=$row["lastname"]?></td>
                                                <td><?=$row["class"]?></td>
                                                    <form class="d-flex">
                                                        <div class="col">
                                                            <div class="mb-3">
                                                            <td>
                                                                <a href="edit.php?id=<?=$row["id"]?>" class="btn btn-sm btn-info">Edit</a>
                                                                <a href="delete.php?id=<?=$row["id"]?>" class="btn btn-sm btn-danger">Delete</a>
                                                            </td>
                                                            </div>
                                                        </div>
                                                    </form>
                                            </tr>
                                        <?php
                                    }
                                } else {
                                    echo "0 results";
                                }
                                $conn->close();
                                ?>
                            </tr>
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                    
                        <!-- Pagination links -->
                        <nav aria-label="Pagination">
                            <ul class="pagination">
                                <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                                    <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>">
                                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </nav>
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>