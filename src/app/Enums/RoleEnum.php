<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class RoleEnum extends Enum
{
    const Admin = 'admin';
    const Employee = 'employee';
    const Customer = 'customer';
    static public function Roles(): array
    {
        return [
            self::Admin,
            self::Employee,
            self::Customer,
        ];
    }
}
