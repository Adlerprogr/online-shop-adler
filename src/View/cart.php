<!DOCTYPE html>

<html lang="en">

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="section-title text-center mb-4 pb-2">
                <h3 class="title mb-4">Basket</h3>
                <p class="text-muted para-desc mx-auto mb-0">▂ ▃ ▄ ▅ ▆ ▇ █ █ ▇ ▆ ▅ ▄ ▃ ▂▂ ▃ ▄ ▅ ▆ ▇ █ █ ▇ ▆ ▅ ▄ ▃ ▂▂ ▃ ▄ ▅ ▆ ▇ █ █ ▇ ▆ ▅ ▄ ▃ ▂▂ ▃ ▄ ▅ ▆ ▇ █ █ ▇ ▆ ▅ ▄ ▃ ▂</p>
            </div>
        </div><!--end col-->
    </div><!--end row-->

    <div class="row">
        <?php foreach ($cartUser as $product): ?>
        <div class="col-md-3 col-sm-6">
            <div class="product-grid">
                <div class="product-image">
                    <a href="#" class="image">
                        <img class="pic-1" src="<?php echo $product['img_url']; ?>">
                        <img class="pic-2" src="<?php echo $product['img_url']; ?>">
                    </a>
                </div>
                <div class="product-content">
                    <h3 class="title"><a href="#"><?php echo $product['name']; ?></a></h3>
                    <h2 class="title"><a href="#"><?php echo $product['description']; ?></a></h2>
                    <div class="price"><?php echo $product['price']; ?>р</div>
                    <div class="price"><?php echo $product['quantity']; ?>шт</div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

</div>
</body>
</html>

<style>
    :root{
        --bs-white: #fff;
        --bs-gray: #6c757d;
        --bs-hover:#192a56;
        --bs-primary:#565c64;
    }
    .product-grid{
        background-color: #fff;
        font-family: 'Montserrat', sans-serif;
        text-align: center;
    }
    .product-grid .product-image{
        overflow: hidden;
        position: relative;
    }
    .product-grid .product-image a.image{ display: block; }
    .product-grid .product-image img{
        width: 100%;
        height: auto;
    }
    .product-grid .product-image .pic-1{ transition: all 0.3s ease 0s; }
    .product-grid .product-image:hover .pic-1{ transform: translateX(100%); }
    .product-grid .product-image .pic-2{
        width: 100%;
        height: 100%;
        transform: translateX(-101%);
        position: absolute;
        top: 0;
        left: 0;
        transition: all 0.3s ease 0s;
    }
    .product-grid .product-image:hover .pic-2{ transform: translateX(0); }
    .product-grid .product-sale-label{
        color: #fff;
        background: var(--bs-hover);
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 2px 8px;
        position: absolute;
        top: 15px;
        left: 15px;
    }
    .product-grid .product-like-icon{
        color: #696969;
        font-size: 22px;
        line-height: 20px;
        position: absolute;
        top: 15px;
        right: 15px;
    }
    .product-grid .product-like-icon:hover{ color: var(--bs-hover); }
    .product-grid .product-like-icon:before,
    .product-grid .product-like-icon:after{
        content: attr(data-tip);
        color: #fff;
        background-color: #000;
        font-size: 12px;
        line-height: 18px;
        padding: 7px 7px 5px;
        visibility: hidden;
        position: absolute;
        right: 0;
        top: 15px;
        transition: all 0.3s ease 0s;
    }
    .product-grid .product-like-icon:after{
        content: '';
        height: 15px;
        width: 15px;
        padding: 0;
        transform: translateX(-50%) rotate(45deg);
        right: auto;
        left: 50%;
        top: 15px;
        z-index: -1;
    }
    .product-grid .product-like-icon:hover:before,
    .product-grid .product-like-icon:hover:after{
        visibility: visible;
        top: 30px;
    }
    .product-grid .product-links{
        width: 170px;
        padding: 0;
        margin: 0;
        list-style: none;
        opacity: 0;
        transform: translateX(-50%);
        position: absolute;
        bottom: -50px;
        left: 50%;
        transition: all 0.3s ease 0s;
    }
    .product-grid:hover .product-links{
        bottom: 40px;
        opacity: 1;
    }
    .product-grid .product-links li{
        display: inline-block;
        margin: 0 2px;
    }
    .product-grid .product-links li a{
        color: #fff;
        background: #192a56;
        font-size: 16px;
        line-height: 48px;
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: block;
        transition: all 0.3s ease 0s;
    }
    .product-grid:hover .product-links li a:hover{ background: #333; }
    .product-grid .product-content{
        text-align: left;
        padding: 15px 0 0;
    }
    .product-grid .title{
        font-size: 14px;
        font-weight: 500;
        text-transform: capitalize;
        margin: 0 0 8px;
    }
    .product-grid .title a{
        color: #333;
        transition: all 0.3s ease 0s;
        text-decoration:none;
        font-weight:600;
        font-size:18px;
    }
    .product-grid .title a:hover{ color: var(--bs-hover); }
    .product-grid .price{
        color: var(--bs-hover);
        font-size: 16px;
        font-weight: 500;
    }
    .product-grid .price span{
        color: #555;
        font-size: 14px;
        font-weight: 400;
        text-decoration: line-through;
        margin: 0 5px 0 0;
    }
    @media screen and (max-width: 990px){
        .product-grid{ margin: 0 0 30px; }
    }
</style>