<?php
require_once('vendor/autoload.php');

$stripe_secret_key = 'sk_test_51OFwu8KZD4b1xfUytohzPK1O3uKZzkkGbUEAPsuSsXuEMwXaOVMOAhIPyT2PWeV4NKz8YiDZ7KT9rQ8TxlbmmIo9001PrpsZ8s'; // Remplacez par votre clé secrète Stripe

$stripe = new \Stripe\StripeClient($stripe_secret_key);
?>
