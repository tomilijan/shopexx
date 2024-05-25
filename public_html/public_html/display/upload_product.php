<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Product</title>
    <link rel="stylesheet" href="../assets/upload_product.css">
</head>

<body>

    <nav>
        <h1 class="logo">ShopEX</h1>
        <div class="links">
            <a href="../redirect.php">Home</a>
            <a href="../display/productby_id.php">Display</a>
        </div>
    </nav>

    <form id="uploadForm" action="../functions/upload_handler.php" method="POST" enctype="multipart/form-data">   
        <h2>Upload New Product</h2>
        <p>Step 1 :</p>
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>
        </div>
        <div>
            <label for="category">Category:</label>
            <input type="text" id="category" name="category" required>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" required >
        </div>

        <div>
            <button type="button" id="nextStep">></button>
        </div>
        <div>
            <input type="hidden" name="store_id" value="1">
        </div>
    </form>

    <form id="uploadImageForm" action="../functions/upload_handler.php" method="POST" enctype="multipart/form-data" style="display: none;">
        <h2>Upload Product Image</h2>
        <p>Step 2 :</p>
        <div>
            <label class="upload_image" for="image">Upload Image</label>
            <input type="file" id="image" name="image" required>
        </div>

        <div>
            <button type="button" id="prevStep"><</button>
            <input type="submit" name="upload" value="Upload Product">
        </div>
        <div>
            <input type="hidden" id="productName" name="name">
            <input type="hidden" id="productDescription" name="description">
            <input type="hidden" id="productCategory" name="category">
            <input type="hidden" id="productPrice" name="price">
            <input type="hidden" name="store_id" value="1">
        </div>
    </form>
    
    <<script>
        document.getElementById('nextStep').addEventListener('click', function() {
            document.getElementById('uploadForm').style.display = 'none';
            document.getElementById('uploadImageForm').style.display = 'block';
           
            document.getElementById('productName').value = document.getElementById('name').value;
            document.getElementById('productDescription').value = document.getElementById('description').value;
            document.getElementById('productCategory').value = document.getElementById('category').value;
            document.getElementById('productPrice').value = document.getElementById('price').value;
        });

        document.getElementById('prevStep').addEventListener('click', function() {
            document.getElementById('uploadForm').style.display = 'block';
            document.getElementById('uploadImageForm').style.display = 'none';
        });
    </script>
</body>

</html>

