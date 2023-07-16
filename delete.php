<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "upload");

// Fetch records from the database
$query = "SELECT * FROM sb_upload";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Display Data</title>
</head>
<body>
    <h1>Display Data</h1>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Image</th>
            <th>LinkedIn ID</th>
            <th>Document</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row["name"]; ?></td>
            <td><img src="images/<?php echo $row["image"]; ?>" width="100"></td>
            <td><?php echo $row["linkedin"]; ?></td>
            <td><a href="documents/<?php echo $row["document"]; ?>" target="_blank">View Document</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
