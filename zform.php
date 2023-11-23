<!DOCTYPE html>
<html>

<head>
    <title>Upload Form</title>
</head>

<body>
    <form action="test.php" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required><br><br>

        <input type="submit" value="Submit">
    </form>
</body>

</html>



<div>
    <label for="image" class="img-label">Ajouter une photo</label>
    <input type="file" name="image" placeholder="Ajouter une photo">
</div>