<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class OrderStatusEnum extends Enum
{
    public const PROCESSING = 0;
    public const IN_TRANSIT = 1;
    public const COMPLETED = 2;
    public const CANCELED = 3;

    public static function getArrayView()
    {
        return [
            self::PROCESSING =>  'Đang xử lý',
            self::IN_TRANSIT =>   'Đang vận chuyển',
            self::COMPLETED => 'Hoàn Thành',
            self::CANCELED =>  'Đã Hủy',
        ];
    }
}
