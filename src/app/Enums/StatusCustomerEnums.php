<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class StatusCustomerEnums extends Enum 
{
    const Active = 1;
    const Block = 2;
    const Pending = 3;
}
