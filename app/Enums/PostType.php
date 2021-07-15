<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Submitted()
 * @method static static Pending()
 * @method static static Accepted()
 * @method static static Rejected()
 */
final class PostType extends Enum
{
    const Submitted= 0;
    const Pending=   1;
    const Accepted=  2;
    const Rejected=  3;

    public static function getPostType($value){
        switch ($value) {
            case self::Submitted:
                return 0;
                break;
            case self::Pending:
                return 1;
                break;
            case self::Accepted:
                return 2;
                break;
            case self::Rejected:
                return 3;
                break;
            default:
                return '';
        }
    }
}
