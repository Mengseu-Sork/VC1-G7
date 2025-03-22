<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/Assets/css/create.css">
  <title>Create Product</title>
</head>
<body>

<div class="form-container">
  <h2>Create Product</h2>
  <form action="/products/store" method="POST" enctype="multipart/form-data">
    <div class="image-upload">
      <label for="image">Upload Image</label>
      <input type="file" id="image" value="" name="image" accept="image/*" required>
      <div class="upload-area" onclick="document.getElementById('image').click()">
        Click or drag to upload image
      </div>
    </div>

    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" id="name" value="" name="name" required>
    </div>

    <div class="form-grid">
      <div class="form-group">
        <label for="price">Price</label>
        <input type="number" id="price" value="" name="price" required>
      </div>
      <div class="form-group">
        <label for="date-start">Date Start</label>
        <input type="date" id="date-start" value="" name="date-start" required>
      </div>
      <div class="form-group">
        <label for="type">Type</label>
        <select id="type" name="type" required>
          <option value="">Select Type</option>
          <option value="Powder">Flour</option>
          <option value="Nuts">Nut</option>
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
