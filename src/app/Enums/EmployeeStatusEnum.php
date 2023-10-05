<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class EmployeeStatusEnum extends Enum
{
    const Active = 1;
    const Block = 2;
    const Pending = 3;
}
