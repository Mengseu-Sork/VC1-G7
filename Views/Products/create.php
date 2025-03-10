<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="/Assets/css/edite.css">
<title>Add New Product</title>
</head>
<body>

<div class="form-container">
  <h2>Add New Product</h2>
  <form>
    <div class="image-upload">
      
      <label for="image">Upload img</label>
      <input type="file" id="image" name="image" accept="image/*" required>
      <div class="upload-area" onclick="document.getElementById('image').click()">
        Click or drag to upload image
      </div>
    </div>

    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" id="name" name="name" required>
    </div>
    <div class="form-grid">
      <div class="form-group">
        <label for="price">Price</label>
        <input type="number" id="price" name="price" required>
      </div>
      <div class="form-group">
        <label for="date-start">Date start</label>
        <input type="date" id="date-start" name="date-start" required>
      </div>
      <div class="form-group">
        <label for="type">Type</label>
        <select id="type" name="type" required>
          <option value="">Select type</option>
          <option value="type1">Type 1</option>
          <option value="type2">Type 2</option>
        </select>
      </div>
      <div class="form-group">
        <label for="date-end">Date end</label>
        <input type="date" id="date-end" name="date-end" required>
      </div>
    </div>

    <div class="form-group">
      <label for="description">Description</label>
      <textarea id="description" name="description" required></textarea>
    </div>

    <div class="button-container">
      <button type="button" class="cancel">Cancel</button>
      <button type="submit" class="save">Save</button>
    </div>
  </form>
</div>

</body>
</html>