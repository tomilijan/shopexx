document.addEventListener("DOMContentLoaded", function () {
    const decreaseButtons = document.querySelectorAll(".decrease-btn");
    const increaseButtons = document.querySelectorAll(".increase-btn");
    const totalPriceElement = document.getElementById("cart-total");
    const checkboxes = document.querySelectorAll(".purchase-checkbox");
  
    decreaseButtons.forEach(function (btn) {
      btn.addEventListener("click", function () {
        const productId = btn.getAttribute("data-product-id");
        const input = document.querySelector(
          `.quantity-input[data-product-id='${productId}']`
        );
        let newValue = parseInt(input.value);
        newValue = newValue > 1 ? newValue - 1 : 1;
        input.value = newValue;
        updateCartQuantity(productId, newValue);
      });
    });
  
    increaseButtons.forEach(function (btn) {
      btn.addEventListener("click", function () {
        const productId = btn.getAttribute("data-product-id");
        const input = document.querySelector(
          `.quantity-input[data-product-id='${productId}']`
        );
        let newValue = parseInt(input.value);
        newValue += 1;
        input.value = newValue;
        updateCartQuantity(productId, newValue);
      });
    });
  
    checkboxes.forEach(function (checkbox) {
      checkbox.addEventListener("change", function () {
        updateTotalPrice();
      });
    });
  
    function updateCartQuantity(productId, quantity) {
      const formData = new FormData();
      formData.append("product_id", productId);
      formData.append("quantity", quantity);
  
      fetch("../functions/update_cart_quantity.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.text())
        .then((data) => {
          console.log(data);
          updateTotalPrice();
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    }
  
    function updateTotalPrice() {
      let newTotalPrice = 0;
  
      checkboxes.forEach(function (checkbox) {
        if (checkbox.checked) {
          const productId = parseInt(checkbox.value);
          const input = document.querySelector(
            `.quantity-input[data-product-id='${productId}']`
          );
          const quantity = parseInt(input.value);
          const price = parseFloat(prices[productId]);
          newTotalPrice += price * quantity;
          document.getElementById(
            `product-total-${productId}`
          ).textContent = (price * quantity).toFixed(2);
        }
      });
  
      totalPriceElement.textContent = newTotalPrice.toFixed(2);
    }
  });
  