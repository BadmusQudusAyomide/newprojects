
document.addEventListener("DOMContentLoaded", function () {
  fetchProducts();
});

function fetchProducts() {
  fetch("php/product.php")
    .then((response) => response.json())
    .then((data) => {
      const productsContainer = document.getElementById("products-container");
      data.forEach((product) => {
        const div = document.createElement("div");
        div.innerHTML = `
                <h2>${product.name}</h2>
                <p>${product.description}</p>
                <p>$${product.price}</p>
                <button onclick="addToCart(${product.id})">Add to Cart</button>
            `;
        productsContainer.appendChild(div);
      });
    });
}

function addToCart(productId) {
  fetch("php/cart.php", {
    method: "POST",
    body: new URLSearchParams({
      product_id: productId,
    }),
  })
    .then((response) => response.text())
    .then((data) => {
      alert(data);
    });
}
