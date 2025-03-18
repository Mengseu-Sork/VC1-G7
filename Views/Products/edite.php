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
    <form action="/products/update" method="POST" enctype="multipart/form-data">
      <div class="image-upload">
        <label for="image">Upload Image</label>
        <input type="file" id="image" value="<?= $product['image'] ?>" name="image" accept="image/*" required>
        <div class="upload-area" onclick="document.getElementById('image').click()">
          Click or drag to upload image
        </div>
      </div>
      <input type="hidden" name="id" value="<?= $product['id'] ?>">

      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="product_name" value="<?= htmlspecialchars($product['product_name']) ?>" required>
      </div>

      <div class="form-grid">
        <div class="form-group">
          <label for="price">Price</label>
          <input type="number" id="price" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>
        </div>
        <div class="form-group">
          <label for="date-start">Date Start</label>
          <input type="date" id="date-start" name="date-start" value="<?= htmlspecialchars($product['date']) ?>" required>
        </div>
        <div class="form-group">
          <label for="type">Type</label>
          <select id="type" name="type" required>
            <option value="">Select Type</option>
            <option value="Powder" <?= $product['type'] == 'Powder' ? 'selected' : '' ?>>Flour</option>
            <option value="Nuts" <?= $product['type'] == 'Nuts' ? 'selected' : '' ?>>Nut</option>
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