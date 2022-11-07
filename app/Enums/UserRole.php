<?php


namespace App\Enums;


abstract class UserRole
{
    public const RECEIVER = 'receiver';
    public const SENDER = 'sender';
    public const TRUCK_DRIVER = 'truck_driver';

    public static function values()
    {
        return [
            self::RECEIVER,

            self::SENDER,
            self::TRUCK_DRIVER,
        ];
    }

    public static function toCollection()
    {
        return collect(self::values());
    }
}
