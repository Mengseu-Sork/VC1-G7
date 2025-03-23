<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <style>
        :root {
            --primary-color: #4a6cf7;
            --success-color: #22c55e;
            --warning-color: #eab308;
            --danger-color: #ef4444;
            --border-color: #e5e7eb;
            --text-color: #374151;
            --bg-color: #ffffff;
            --shadow-color: rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fb;
            color: var(--text-color);
            line-height: 1.6;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 24px;
            background-color: var(--bg-color);
            border-radius: 8px;
            box-shadow: 0 4px 6px var(--shadow-color);
        }

        h4 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 16px;
            color: var(--text-color);
        }

        form {
            margin: 16px 0;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
        }

        @media (min-width: 768px) {
            .grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .flex-col {
            display: flex;
            flex-direction: column;
        }

        .col-span-1 {
            grid-column: span 1;
        }

        @media (min-width: 768px) {
            .md-col-span-2 {
                grid-column: span 2;
            }

            .md-col-span-3 {
                grid-column: span 3;
            }
        }

        label {
            font-weight: 600;
            margin-bottom: 4px;
        }

        input, select, textarea {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 8px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.3s;
        }

        input:focus, select:focus, textarea:focus {
            border-color: var(--primary-color);
        }

        textarea {
            height: 128px;
            resize: vertical;
        }

        .image-upload {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .image-preview {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 8px;
        }

        .image-preview img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 8px;
            display: none;
        }

        .image-preview h4 {
            color: #6b7280;
            font-size: 14px;
            font-weight: normal;
        }

        .button-container {
            display: flex;
            flex-direction: row;
            gap: 16px;
            justify-content: flex-end;
            margin-top: 10px;
        }

        button {
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            color: white;
            font-weight: 500;
            cursor: pointer;
            transition: opacity 0.3s;
        }

        button:hover {
            opacity: 0.9;
        }

        .btn-submit {
            background-color: var(--success-color);
        }

        .btn-back {
            background-color: var(--warning-color);
        }

        .error-message {
            color: var(--danger-color);
            font-size: 12px;
            margin-top: 4px;
            display: none;
        }

        /* Drag and drop styles */
        .drop-zone {
            border: 2px dashed var(--border-color);
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.3s;
        }

        .drop-zone:hover {
            border-color: var(--primary-color);
        }

        .drop-zone.active {
            border-color: var(--success-color);
            background-color: rgba(34, 197, 94, 0.05);
        }
    </style>
</head>
<body>

<div class="form-container">
  <h2>Edit Product</h2>
  <form action="/products/store" method="POST" enctype="multipart/form-data">
    <div class="image-upload">
      <label for="image">Upload Image</label>
<<<<<<<<< Temporary merge branch 1
      <input type="file" id="image" name="image" accept="image/*" required>
      <div class="upload-area" onclick="document.getElementById('image').click()">
        Click or drag to upload image
=========
      <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)">
      <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8'); ?>">
      <div class="upload-area">
        <img id="image-preview" src="/Assets/images/<?php echo htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8'); ?>" width="100" height="100">
<p>Click or drag to upload image</p>
>>>>>>>>> Temporary merge branch 2
      </div>
    </div>

    <div class="form-group">
      <label for="name">Name</label>
<<<<<<<<< Temporary merge branch 1
      <input type="text" id="name" name="name" required>
=========
      <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8'); ?>" required>
>>>>>>>>> Temporary merge branch 2
    </div>

    <div class="form-grid">
      <div class="form-group">
        <label for="price">Price</label>
<<<<<<<<< Temporary merge branch 1
        <input type="number" id="price" name="price" required>
      </div>
      <div class="form-group">
        <label for="date-start">Date Start</label>
        <input type="date" id="date-start" name="date-start" required>
      </div>
=========
        <input type="number" id="price" name="price" value="<?php echo $product['price']; ?>" required>
</div>
      <div class="form-group">
        <label for="date-start">Date Start</label>
        <input type="date" id="date-start" name="date-start" value="<?php echo date('Y-m-d', strtotime($product['date'])); ?>" required>
</div>
>>>>>>>>> Temporary merge branch 2
      <div class="form-group">
        <label for="type">Type</label>
        <select id="type" name="type" required>
          <option value="">Select Type</option>
<<<<<<<<< Temporary merge branch 1
          <option value="Powder">Flour</option>
          <option value="Nuts">Nut</option>
          <option value="Drink">Drink</option>
=========
          <option value="Powder" <?php if($product['type'] == 'Powder') echo 'selected'; ?>>Powder</option>
          <option value="Nut" <?php if($product['type'] == 'Nut') echo 'selected'; ?>>Nut</option>
>>>>>>>>> Temporary merge branch 2
        </select>
      </div>
    </div>

<<<<<<<<< Temporary merge branch 1
      <div class="button-container">
        <button type="button" class="cancel" onclick="window.location.href='/products'">Cancel</button>
        <button type="submit" class="save">Save</button>
      </div>
    </form>
  </div>
=========
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

>>>>>>>>> Temporary merge branch 2
</body>
</html>