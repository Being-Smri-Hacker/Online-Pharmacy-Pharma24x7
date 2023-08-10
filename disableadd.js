window.onload = function() {
    var productId = getParameterByName('productID');

    if (productId) {
        // Retrieve product details from the server
        getProductDetails(productId, function(response) {
            var product = JSON.parse(response);

            // Display product details
            document.getElementById('product-name').textContent = product.name;
            document.getElementById('product-stock').textContent = product.stock;

            // Enable the "Add to Cart" button if stock is greater than zero
            var addToCartButton = document.getElementById('add-to-cart');
            if (product.stock > 0) {
                addToCartButton.removeAttribute('disabled');
            }

            // Attach the click event listener to the button
            addToCartButton.addEventListener('click', function() {
                addToCart(productId, product.stock);
            });
        });
    }
};

function getProductDetails(productId, callback) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            callback(xhr.responseText);
        }
    };

    xhr.open('GET', 'get_product.php?id=' + productId, true);
    xhr.send();
}

function addToCart(productId, stock) {
    var addToCartButton = document.getElementById('add-to-cart');

    // Disable the button to prevent multiple clicks
    addToCartButton.disabled = true;

    // Check if the stock is still available
    if (stock > 0) {
        // Send request to add product to cart
        addToCartRequest(productId, function(response) {
            var result = JSON.parse(response);

            if (result.success) {
                // Product added successfully, update stock and enable the button again
                var productStock = document.getElementById('product-stock');
                productStock.textContent = stock - 1;
                addToCartButton.removeAttribute('disabled');
            } else {
                // Product could not be added, display error message and enable the button again
                alert(result.message);
                addToCartButton.removeAttribute('disabled');
            }
        });
    } else {
        // Product is out of stock, enable the button again
        alert('Product is out of stock.');
        addToCartButton.removeAttribute('disabled');
    }
}

function addToCartRequest(productId, callback) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            callback(xhr.responseText);
        }
    };

    xhr.open('GET', 'add_to_cart.php?id=' + productId, true);
    xhr.send();
}

function getParameterByName(name) {
    var url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}
