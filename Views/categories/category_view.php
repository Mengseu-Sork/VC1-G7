<!DOCTYPE html>
<html>
<head>
    <title>Category View</title>
</head>
<body>
    <h1><?php echo $category['name']; ?></h1>
    <p>Type: <?php echo $category['type']; ?></p>
    <p>Description: <?php echo $category['description']; ?></p>
    <a href="Router.php?action=list">Back to Category List</a>
</body>
</html>
