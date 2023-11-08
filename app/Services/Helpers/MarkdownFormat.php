<?php

namespace App\Services\Helpers;

class MarkdownFormat
{
    static function replaceFirstLevelHeaders($string)
    {
        return preg_replace('/(^|\n)#([^#\n]+)/', "\$1##\$2", $string);
    }

}
