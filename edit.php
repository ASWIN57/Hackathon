<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "upload");

// Check if the form is submitted
if (isset($_POST["update"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $linkedin = $_POST["linkedin"];

    // Check if a new image is uploaded
    if ($_FILES["image"]["name"] !== "") {
        $image = $_FILES["image"]["name"];
        $image_tmp = $_FILES["image"]["tmp_name"];
        move_uploaded_file($image_tmp, "images/$image");

        // Update query with image
        $query = "UPDATE sb_upload SET name = '$name', image = '$image', linkedin = '$linkedin' WHERE id = $id";
    } else {
        // Update query without image
        $query = "UPDATE sb_upload SET name = '$name', linkedin = '$linkedin' WHERE id = $id";
    }

    mysqli_query($conn, $query);

    header("Location: table.php");
    exit();
}

// Fetch the record to be edited
$id = $_GET["id"];
$query = "SELECT * FROM sb_upload WHERE id = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Data</title>
</head>
<body>
    <h1>Edit Data</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $row["name"]; ?>" required><br>
        <label for="image">Image:</label>
        <input type="file" name="image"><br>
        <label for="linkedin">LinkedIn ID:</label>
        <input type="text" name="linkedin" value="<?php echo $row["linkedin"]; ?>" required><br>
        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>
