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
            'Đang xử lý' => self::PROCESSING,
            'Đang vận chuyển' => self::IN_TRANSIT,
            'Hoàn Thành' => self::PROCESSING,
            'Đã Hủy' => self::PROCESSING,
        ];
    }
}
