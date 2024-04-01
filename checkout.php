<?php

require __DIR__ . "/vendor/autoload.php";

// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__, ".env");
// $dotenv->load();

$stripe_secret_key = "";

\Stripe\Stripe::setApiKey($stripe_secret_key);

$checkout_session = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" => "http://localhost/php/php-stripe-api/success.php",
    "line_items" => [
        [
            "quantity" => 1,
            "price_data" => [
                "currency" => "usd" . " ",
                "unit_amount" => 2000,
                "product_data" => [
                    "name" => "T-shirt"
                ]

            ]
        ]
    ]
]);
http_response_code(303);
header("Location: " . $checkout_session->url);
