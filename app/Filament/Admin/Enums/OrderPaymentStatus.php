<?php

namespace App\Filament\Admin\Enums;

enum OrderPaymentStatus : string
{
    case Paid = 'paid';
    case Unpaid = 'unpaid';
}
