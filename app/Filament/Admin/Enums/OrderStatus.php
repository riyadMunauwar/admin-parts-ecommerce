<?php

namespace App\Filament\Admin\Enums;

enum OrderStatus : string
{
    case New = 'new';
    case Pending = 'pending';
    case Shipped = 'shipped';
    case Deliverd = 'deliverd';
    case Cancelled = 'cancelled';
    case Refunded = 'refunded';
}
