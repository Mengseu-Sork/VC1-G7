<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/Assets/css/create.css">
  <title>Edit Product</title>
</head>
<body>

<div class="form-container">
  <h2>Edit Product</h2>
  <form action="/products/update/<?php echo $product['id']; ?>" method="POST" enctype="multipart/form-data">
    <div class="image-upload">
      <label for="image">Upload Image</label>
      <input type="file" id="image" name="image" accept="image/*">
      <input type="hidden" name="existing_image" value="<?php echo $product['image']; ?>">
      <div class="upload-area" onclick="document.getElementById('image').click()">
        Click or drag to upload image
      </div>
    </div>

    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" id="name" name="name" value="<?php echo $product['product_name']; ?>" required>
    </div>

    <div class="form-grid">
      <div class="form-group">
        <label for="price">Price</label>
        <input type="number" id="price" name="price" value="<?php echo $product['price']; ?>" required>
      </div>
      <div class="form-group">
        <label for="date-start">Date Start</label>
        <input type="date" id="date-start" name="date-start" value="<?php echo $product['date']; ?>" required>
      </div>
      <div class="form-group">
        <label for="type">Type</label>
        <select id="type" name="type" required>
          <option value="">Select Type</option>
          <option value="Powder" <?php if($product['type'] == 'Powder') echo 'selected'; ?>>Powder</option>
          <option value="Nuts" <?php if($product['type'] == 'Nut') echo 'selected'; ?>>Nut</option>
        </select>
      </div>
    </div>

    <div class="button-container">
      <button type="button" class="cancel" onclick="window.location.href='/products'">Cancel</button>
      <button type="submit" class="save">Save</button>
    </div>
  </form>
</div>

</body>
</html>
