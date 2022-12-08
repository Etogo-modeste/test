<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Administrated_data_base</title>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>

<body>
    <?php require_once "process.php"; ?>

    <?php if (isset($_SESSION['message'])) : ?>

        <div class="alert alert-<?php $_SESSION['msg_type'] ?>">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>

    <?php endif ?>

    <div class="container">
        <?php
        $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
        //pre_r($result);
        // pre_r($result->fetch_assoc());
        // pre_r($result->fetch_assoc());
        ?>

        <div class="row justify-content-center">
            <table class=table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tr>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['location']; ?></td>
                        <td>
                            <a href="index.php?Edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                            <a href="index.php?Delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                </tr>
            <?php endwhile; ?>
            </table>
        </div>



        <?php
        function pre_r($array)
        {
            echo '<prev>';
            print_r($array);
            echo '</prev>';
        }

        ?>

        <br> <br>
        <div>
            <form method="POST" action="process.php">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $name ?>" placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label for="location">location</label>
                    <input type="text" name="location" class="form-control" value="<?php echo $location ?>" placeholder="Enter your location">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="save">Save</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>