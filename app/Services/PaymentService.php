<?php 

namespace App\Services;

class PaymentService
{
    public function processPayment($amount)
    {
        return "Processing payment of $amount";
    }
}