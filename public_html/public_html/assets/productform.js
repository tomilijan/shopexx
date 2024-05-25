document.getElementById("addProduct").addEventListener("click", function () {
  const productFields = document.getElementById("productFields");
  const numProducts = document.querySelectorAll('[name^="name[]"]').length + 1;

  const div = document.createElement("div");
  div.innerHTML = `
                <h3>Product ${numProducts}</h3>
                <div>
                    <label for="name${numProducts}">Name:</label>
                    <input type="text" id="name${numProducts}" name="name[]" required>
                </div>
                <div>
                    <label for="description${numProducts}">Description:</label>
                    <textarea id="description${numProducts}" name="description[]" required></textarea>
                </div>
                <div>
                    <label for="category${numProducts}">Category:</label>
                    <input type="text" id="category${numProducts}" name="category[]" required>
                </div>
                <div>
                    <label for="price${numProducts}">Price:</label>
                    <input type="text" id="price${numProducts}" name="price[]" required>
                </div>
                <div>
                    <label for="image${numProducts}">Image:</label>
                    <input type="file" id="image${numProducts}" name="image[]" required>
                </div>
            `;

  productFields.appendChild(div);
});
