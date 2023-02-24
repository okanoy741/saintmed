<!DOCTYPE html>
<html>
<head>
    <title>My E-Commerce Site</title>
    <style>
        body {
            margin: 0 auto;
            width: 800px;
        }

        h1 {
            text-align: center;
        }

        .products {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .product {
            width: 30%;
            margin-bottom: 1rem;
        }

        .product-image {
            width: 100%;
        }

        .product-name {
            font-weight: bold;
        }

        .product-price {
            color: green;
        }

        .shopping-cart {
            float: right;
        }

        .cart-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .cart-item-name {
            font-weight: bold;
            margin-right: 0.5rem;
        }

        .cart-item-quantity {
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>
    <h1>My E-Commerce Site</h1>

    <div class="products">
        <div class="product">
            <img class="product-image" src="product1.jpg" alt="Product 1">
            <div class="product-name">Product 1</div>
            <div class="product-price">$10.00</div>
            <button>Add to Cart</button>
        </div>
        <div class="product">
            <img class="product-image" src="product2.jpg" alt="Product 2">
            <div class="product-name">Product 2</div>
            <div class="product-price">$20.00</div>
            <button>Add to Cart</button>
        </div>
        <!-- more products here -->
    </div>

    <div class="shopping-cart">
        <h2>Shopping Cart</h2>
        <div class="cart-item">
            <span class="cart-item-name">Product 1</span>
            <span class="cart-item-quantity">3</span>
            <span class="cart-item-price">$30.00</span>
            <button>Remove</button>
        </div>
        <div class="cart-item">
            <span class="cart-item-name">Product 2</span>
            <span class="cart-item-quantity">1</span>
            <span class="cart-item-price">$20.00</span>
            <button>Remove</button>
        </div>
        <!-- more cart items here -->
        <div class="cart-total">Total: $50.00</div>
    </div>
</body>
</html>
