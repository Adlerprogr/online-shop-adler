<!DOCTYPE html>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
<main id="cart" style="max-width:1500px">
    <div class="back"><a href="http://localhost/main">&#11178; <h3>Shop</h3></a></div>
    <h1>Your Cart</h1>
    <div class="container-fluid">
        <div class="row align-items-start">
            <div class="col-12 col-sm-8 items">
                <?php foreach ($cartUser as $product): ?>
                <!--1-->
                <div class="cartItem row align-items-start">
                    <div class="col-3 mb-2">
                        <img class="w-100" src="<?php echo $product['img_url']; ?>" alt="art image">
                    </div>
                    <div class="col-5 mb-2">
                        <h5 class=""><?php echo $product['name']; ?></h5>
                        <p class="pl-1 mb-0">20 x 24</p>
                        <p class="pl-1 mb-0"><h6><?php echo $product['description']; ?></h6></p>
                    </div>
                    <div class="col-2">
                        <p class="cartItemQuantity p-1 text-center"><?php echo $product['quantity']; ?></p>
                    </div>
                    <div class="col-2">
                        <p id="cartItem1Price"><?php echo $product['price']; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="col-12 col-sm-4 p-3 proceed form">
                <div class="row m-0">
                    <div class="col-sm-8 p-0">
                        <h6>Subtotal</h6>
                    </div>
                    <div class="col-sm-4 p-0">
                        <p id="subtotal"><?php echo $sumProducts['sum_qp']; ?></p>
                    </div>
                </div>
                <div class="row m-0">
                    <div class="col-sm-8 p-0 ">
                        <h6>Types of goods</h6>
                    </div>
                    <div class="col-sm-4 p-0">
                        <p id="tax"><?php echo count($cartUser); ?></p>
                    </div>
                </div>
                <hr>
                <div class="row mx-0 mb-2">
                    <div class="col-sm-8 p-0 d-inline">
                        <h5>Total</h5>
                    </div>
                    <div class="col-sm-4 p-0">
                        <p id="total">$138.40</p>
                    </div>
                </div>
                <a href="#"><button id="btn-checkout" class="shopnow"><span>Checkout</span></button></a>
            </div>
        </div>
    </div>
    </div>
</main>
<footer class="container">
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>

<style>

    #cart {
        max-width: 1440px;
        padding-top: 60px;
        margin: auto;
    }
    .form div {
        margin-bottom: 0.4em;
    }
    .cartItem {
        --bs-gutter-x: 1.5rem;
    }
    .cartItemQuantity,
    .proceed {
        background: #f4f4f4;
    }
    .items {
        padding-right: 30px;
    }
    #btn-checkout {
        min-width: 100%;
    }

    /* stasysiia.com */
    @import url("https://fonts.googleapis.com/css2?family=Exo&display=swap");
    body {
        background-color: #fff;
        font-family: "Exo", sans-serif;
        font-size: 22px;
        margin: 0;
        padding: 0;
        color: #111111;
        justify-content: center;
        align-items: center;
    }
    a {
        color: #0e1111;
        text-decoration: none;
    }
    .btn-check:focus + .btn-primary,
    .btn-primary:focus {
        color: #fff;
        background-color: #111;
        border-color: transparent;
        box-shadow: 0 0 0 0.25rem rgb(49 132 253 / 50%);
    }
    button:hover,
    .btn:hover {
        box-shadow: 5px 5px 7px #c8c8c8, -5px -5px 7px white;
    }
    button:active {
        box-shadow: 2px 2px 2px #c8c8c8, -2px -2px 2px white;
    }

    /*PREVENT BROWSER SELECTION*/
    a:focus,
    button:focus,
    input:focus,
    textarea:focus {
        outline: none;
    }
    /*main*/
    main:before {
        content: "";
        display: block;
        height: 88px;
    }
    h1 {
        font-size: 2.4em;
        font-weight: 600;
        letter-spacing: 0.15rem;
        text-align: center;
        margin: 30px 6px;
    }
    h2 {
        color: rgb(37, 44, 54);
        font-weight: 700;
        font-size: 2.5em;
    }
    h3 {
        border-bottom: solid 2px #000;
    }
    h5 {
        padding: 0;
        font-weight: bold;
        color: #92afcc;
    }
    p {
        color: #333;
        font-family: "Roboto", sans-serif;
        margin: 0.6em 0;
    }
    h1,
    h2,
    h4 {
        text-align: center;
        padding-top: 16px;
    }
    /* yukito bloody */
    .back {
        position: relative;
        top: -30px;
        font-size: 16px;
        margin: 10px 10px 3px 15px;
    }
    .inline {
        display: inline-block;
    }

    .shopnow,
    .contact {
        background-color: #000;
        padding: 10px 20px;
        font-size: 30px;
        color: white;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.5s;
        cursor: pointer;
    }
    .shopnow:hover {
        text-decoration: none;
        color: white;
        background-color: #c41505;
    }
    /* for button animation*/
    .shopnow span {
        cursor: pointer;
        display: inline-block;
        position: relative;
        transition: all 0.5s;
    }
    .shopnow span:after {
        content: url("https://badux.co/smc/codepen/caticon.png");
        position: absolute;
        font-size: 30px;
        opacity: 0;
        top: 2px;
        right: -6px;
        transition: all 0.5s;
    }
    .shopnow:hover span {
        padding-right: 25px;
    }
    .shopnow:hover span:after {
        opacity: 1;
        top: 2px;
        right: -6px;
    }
    .ma {
        margin: auto;
    }
    .price {
        color: slategrey;
        font-size: 2em;
    }
    #mycart {
        min-width: 90px;
    }
    #cartItems {
        font-size: 17px;
    }
    #product .container .row .pr4 {
        padding-right: 15px;
    }
    #product .container .row .pl4 {
        padding-left: 15px;
    }

</style>

<!--<html lang="en">-->
<!---->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="utf-8">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1">-->
<!--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">-->
<!--    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">-->
<!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />-->
<!---->
<!--    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />-->
<!---->
<!--</head>-->
<!--<body>-->
<!---->
<!--<div class="container">-->
<!--    <div class="row justify-content-center">-->
<!--        <div class="col-12">-->
<!--            <div class="section-title text-center mb-4 pb-2">-->
<!--                <h3 class="title mb-4">Basket</h3>-->
<!--                <p class="text-muted para-desc mx-auto mb-0">▂ ▃ ▄ ▅ ▆ ▇ █ █ ▇ ▆ ▅ ▄ ▃ ▂▂ ▃ ▄ ▅ ▆ ▇ █ █ ▇ ▆ ▅ ▄ ▃ ▂▂ ▃ ▄ ▅ ▆ ▇ █ █ ▇ ▆ ▅ ▄ ▃ ▂▂ ▃ ▄ ▅ ▆ ▇ █ █ ▇ ▆ ▅ ▄ ▃ ▂</p>-->
<!--            </div>-->
<!--        </div><!--end col-->-->
<!--    </div><!--end row-->-->
<!---->
<!--    <div class="row">-->
<!--        --><?php //foreach ($cartUser as $product): ?>
<!--        <div class="col-md-3 col-sm-6">-->
<!--            <div class="product-grid">-->
<!--                <div class="product-image">-->
<!--                    <a href="#" class="image">-->
<!--                        <img class="pic-1" src="--><?php //echo $product['img_url']; ?><!--">-->
<!--                        <img class="pic-2" src="--><?php //echo $product['img_url']; ?><!--">-->
<!--                    </a>-->
<!--                </div>-->
<!--                <div class="product-content">-->
<!--                    <h3 class="title"><a href="#">--><?php //echo $product['name']; ?><!--</a></h3>-->
<!--                    <h2 class="title"><a href="#">--><?php //echo $product['description']; ?><!--</a></h2>-->
<!--                    <div class="price">--><?php //echo $product['price']; ?><!--р</div>-->
<!--                    <div class="price">--><?php //echo $product['quantity']; ?><!--шт</div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        --><?php //endforeach; ?>
<!--    </div>-->
<!---->
<!--</div>-->
<!--</body>-->
<!--</html>-->
<!---->
<!--<style>-->
<!--    :root{-->
<!--        --bs-white: #fff;-->
<!--        --bs-gray: #6c757d;-->
<!--        --bs-hover:#192a56;-->
<!--        --bs-primary:#565c64;-->
<!--    }-->
<!--    .product-grid{-->
<!--        background-color: #fff;-->
<!--        font-family: 'Montserrat', sans-serif;-->
<!--        text-align: center;-->
<!--    }-->
<!--    .product-grid .product-image{-->
<!--        overflow: hidden;-->
<!--        position: relative;-->
<!--    }-->
<!--    .product-grid .product-image a.image{ display: block; }-->
<!--    .product-grid .product-image img{-->
<!--        width: 100%;-->
<!--        height: auto;-->
<!--    }-->
<!--    .product-grid .product-image .pic-1{ transition: all 0.3s ease 0s; }-->
<!--    .product-grid .product-image:hover .pic-1{ transform: translateX(100%); }-->
<!--    .product-grid .product-image .pic-2{-->
<!--        width: 100%;-->
<!--        height: 100%;-->
<!--        transform: translateX(-101%);-->
<!--        position: absolute;-->
<!--        top: 0;-->
<!--        left: 0;-->
<!--        transition: all 0.3s ease 0s;-->
<!--    }-->
<!--    .product-grid .product-image:hover .pic-2{ transform: translateX(0); }-->
<!--    .product-grid .product-sale-label{-->
<!--        color: #fff;-->
<!--        background: var(--bs-hover);-->
<!--        font-size: 13px;-->
<!--        text-transform: uppercase;-->
<!--        letter-spacing: 1px;-->
<!--        padding: 2px 8px;-->
<!--        position: absolute;-->
<!--        top: 15px;-->
<!--        left: 15px;-->
<!--    }-->
<!--    .product-grid .product-like-icon{-->
<!--        color: #696969;-->
<!--        font-size: 22px;-->
<!--        line-height: 20px;-->
<!--        position: absolute;-->
<!--        top: 15px;-->
<!--        right: 15px;-->
<!--    }-->
<!--    .product-grid .product-like-icon:hover{ color: var(--bs-hover); }-->
<!--    .product-grid .product-like-icon:before,-->
<!--    .product-grid .product-like-icon:after{-->
<!--        content: attr(data-tip);-->
<!--        color: #fff;-->
<!--        background-color: #000;-->
<!--        font-size: 12px;-->
<!--        line-height: 18px;-->
<!--        padding: 7px 7px 5px;-->
<!--        visibility: hidden;-->
<!--        position: absolute;-->
<!--        right: 0;-->
<!--        top: 15px;-->
<!--        transition: all 0.3s ease 0s;-->
<!--    }-->
<!--    .product-grid .product-like-icon:after{-->
<!--        content: '';-->
<!--        height: 15px;-->
<!--        width: 15px;-->
<!--        padding: 0;-->
<!--        transform: translateX(-50%) rotate(45deg);-->
<!--        right: auto;-->
<!--        left: 50%;-->
<!--        top: 15px;-->
<!--        z-index: -1;-->
<!--    }-->
<!--    .product-grid .product-like-icon:hover:before,-->
<!--    .product-grid .product-like-icon:hover:after{-->
<!--        visibility: visible;-->
<!--        top: 30px;-->
<!--    }-->
<!--    .product-grid .product-links{-->
<!--        width: 170px;-->
<!--        padding: 0;-->
<!--        margin: 0;-->
<!--        list-style: none;-->
<!--        opacity: 0;-->
<!--        transform: translateX(-50%);-->
<!--        position: absolute;-->
<!--        bottom: -50px;-->
<!--        left: 50%;-->
<!--        transition: all 0.3s ease 0s;-->
<!--    }-->
<!--    .product-grid:hover .product-links{-->
<!--        bottom: 40px;-->
<!--        opacity: 1;-->
<!--    }-->
<!--    .product-grid .product-links li{-->
<!--        display: inline-block;-->
<!--        margin: 0 2px;-->
<!--    }-->
<!--    .product-grid .product-links li a{-->
<!--        color: #fff;-->
<!--        background: #192a56;-->
<!--        font-size: 16px;-->
<!--        line-height: 48px;-->
<!--        width: 48px;-->
<!--        height: 48px;-->
<!--        border-radius: 50%;-->
<!--        display: block;-->
<!--        transition: all 0.3s ease 0s;-->
<!--    }-->
<!--    .product-grid:hover .product-links li a:hover{ background: #333; }-->
<!--    .product-grid .product-content{-->
<!--        text-align: left;-->
<!--        padding: 15px 0 0;-->
<!--    }-->
<!--    .product-grid .title{-->
<!--        font-size: 14px;-->
<!--        font-weight: 500;-->
<!--        text-transform: capitalize;-->
<!--        margin: 0 0 8px;-->
<!--    }-->
<!--    .product-grid .title a{-->
<!--        color: #333;-->
<!--        transition: all 0.3s ease 0s;-->
<!--        text-decoration:none;-->
<!--        font-weight:600;-->
<!--        font-size:18px;-->
<!--    }-->
<!--    .product-grid .title a:hover{ color: var(--bs-hover); }-->
<!--    .product-grid .price{-->
<!--        color: var(--bs-hover);-->
<!--        font-size: 16px;-->
<!--        font-weight: 500;-->
<!--    }-->
<!--    .product-grid .price span{-->
<!--        color: #555;-->
<!--        font-size: 14px;-->
<!--        font-weight: 400;-->
<!--        text-decoration: line-through;-->
<!--        margin: 0 5px 0 0;-->
<!--    }-->
<!--    @media screen and (max-width: 990px){-->
<!--        .product-grid{ margin: 0 0 30px; }-->
<!--    }-->
<!--</style>-->