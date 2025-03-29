<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">  
    <title>Add Product</title>
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
            /* box-sizing: border-box; */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fb;
            color: var(--text-color);
            /* line-height: 1.6; */
            /* padding: 20px; */
        }

        .container {
            max-width: 1900px;
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

        .btn-cancel {
            background-color: var(--danger-color);
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
<div class="mx-auto flex-1 h-full overflow-x-hidden overflow-y-auto">    
    <div class="container">
        <h4>Add Product</h4>
        <form id="addProductForm" action="/products/store" method="POST" enctype="multipart/form-data">
            <div class="grid">
                <div class="flex-col md-col-span-1"> 
                    <label for="product_name">Product Name</label>
                    <input type="text" name="name" id="product_name" required>
                    <span class="error-message" id="product_name_error">Please enter a product name</span>
                </div>
                <div class="flex-col md-col-span-1">
                    <label for="price">Price</label>
                    <input type="number" name="price" id="price" step="0.01" min="0" required>
                    <span class="error-message" id="price_error">Please enter a valid price</span>
                </div>

                <div class="flex-col md-col-span-1">
                    <label for="date-start">Date</label>
                    <input type="date" name="date-start" id="date-start" required>
                    <span class="error-message" id="date_error">Please select a valid date</span>
                </div>

                <div class="flex-col md-col-span-1">
                    <label for="type">Category</label>
                    <select name="type" id="type" required>
                        <option value="">Choose Category</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['category_id']; ?>">
                                <?php echo htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8'); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="error-message" id="category_id_error">Please select a category</span>
                </div>

                <div class="flex-col md-col-span-1">
                    <label for="product_content">Product Content</label>
                    <textarea name="product_content" id="product_content" rows="2"></textarea>
                </div>

                <div class="flex-col md-col-span-1">
                    <label>Product Image</label>
                    <div class="image-upload">
                        <input type="file" name="image" id="image" accept="image/*" onchange="previewImage(this)">
                        <div class="drop-zone" id="drop-zone">
                            <div class="image-preview">
                                <img id="image-preview" src="#" alt="Product Image Preview">
                                <h4>Drag and drop a file to upload</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="button-container md-col-span-2">
                    <button type="button" class="btn-cancel" onclick="window.location.href='/products'">Cancel</button>
                    <button type="submit" class="btn-submit">Submit</button>
                    <button type="button" class="btn-back" onclick="goBack()">Back</button>
                </div>
            </div>
        </form>
    </div>
</div>
    <script>
        // Image preview functionality
        function previewImage(input) {
            const preview = document.getElementById('image-preview');
            const file = input.files[0];
            
            if (file) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        }

        // Go back function
        function goBack() {
            window.history.back();
        }

        // Form validation
        document.getElementById('addProductForm').addEventListener('submit', function(event) {
            let isValid = true;
            
            // Validate product name
            const productName = document.getElementById('product_name');
            if (!productName.value.trim()) {
                document.getElementById('product_name_error').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('product_name_error').style.display = 'none';
            }
            
            // Validate date
            const date = document.getElementById('date-start');
            if (!date.value) {
                document.getElementById('date_error').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('date_error').style.display = 'none';
            }
            
            // Validate price
            const price = document.getElementById('price');
            if (!price.value || price.value < 0) {
                document.getElementById('price_error').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('price_error').style.display = 'none';
            }
            
            // Validate category
            const category = document.getElementById('type');
            if (!category.value) {
                document.getElementById('category_id_error').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('category_id_error').style.display = 'none';
            }
            
            if (!isValid) {
                event.preventDefault();
            }
        });
 
    </script>
</body>
</html>