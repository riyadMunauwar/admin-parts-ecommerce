<?php

namespace App\Enums;

enum Role : int
{
    case User = 1;
    case Admin = 2;
    case Manager = 3;
    case Editor = 4;
    case Retailer = 5;
    case RoyalUser = 6;
    case Wholesaler = 7;
}
