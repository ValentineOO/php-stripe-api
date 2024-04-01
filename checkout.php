<?php

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/config.php";


$stripe_secret_key = $config["api_key"]["api_secret_key"];

\Stripe\Stripe::setApiKey($stripe_secret_key);

$checkout_session = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" => "http://localhost/php/php-stripe-api/success.php",
    "cancel_url" => "http://localhost/php/php-stripe-api/index.php",
    "line_items" => [
        [
            "quantity" => 1,
            "price_data" => [
                "currency" => "usd",
                "unit_amount" => 3000,
                "product_data" => [
                    "name" => "Php Beginner's Course"
                ]

            ]
        ],
        [
            "quantity" => 1,
            "price_data" => [
                "currency" => "usd",
                "unit_amount" => 4000,
                "product_data" => [
                    "name" => "PHP Advanced Course"
                ]

            ]
        ],
    ]
]);
http_response_code(303);
header("Location: " . $checkout_session->url);
