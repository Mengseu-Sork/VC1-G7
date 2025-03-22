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
  <form action="/products/store" method="POST" enctype="multipart/form-data">
    <div class="image-upload">
      <label for="image">Upload Image</label>
      <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)">
      <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8'); ?>">
      <div class="upload-area">
        <img id="image-preview" src="/Assets/images/<?php echo htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8'); ?>" width="100" height="100">
<p>Click or drag to upload image</p>
      </div>
    </div>

    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8'); ?>" required>
    </div>

    <div class="form-grid">
      <div class="form-group">
        <label for="price">Price</label>
        <input type="number" id="price" name="price" value="<?php echo $product['price']; ?>" required>
</div>
      <div class="form-group">
        <label for="date-start">Date Start</label>
        <input type="date" id="date-start" name="date-start" value="<?php echo date('Y-m-d', strtotime($product['date'])); ?>" required>
</div>
      <div class="form-group">
        <label for="type">Type</label>
        <select id="type" name="type" required>
          <option value="">Select Type</option>
          <option value="Powder" <?php if($product['type'] == 'Powder') echo 'selected'; ?>>Powder</option>
          <option value="Nut" <?php if($product['type'] == 'Nut') echo 'selected'; ?>>Nut</option>
        </select>
      </div>
    </div>

    <div class="button-container">
      <a href="/products" class="cancel-button">Cancel</a>
      <button type="submit" class="save">Save</button>
    </div>
  </form>
</div>

<script>
  function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
      document.getElementById('image-preview').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  }
</script>

</body>

</html>