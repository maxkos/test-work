<?php
namespace app\modules\ShortUrl\helpers;

/**
 * Class CodeGenerator
 */
class CodeGenerator
{
    const CHAR_LINE = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

    /**
     * @param string $data
     * @return string
     */
    public static function generate($data)
    {
        $str = '';

        if ($data)
        {
            $hash = bcadd(sprintf('%u', crc32($data)), 0x100000000);
            do {
                $str = self::CHAR_LINE[bcmod($hash, 62)] . $str;
                $hash = bcdiv($hash, 62);
            } while ($hash >= 1);

        }
        return $str;
    }
}