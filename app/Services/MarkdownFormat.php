<?php

namespace App\Services;

class MarkdownFormat
{
    static function replace_first_level_headers_to_second_level($string) {
        return preg_replace('/(^|\n)#([^#\n]+)/', "\$1##\$2", $string);
    }

}
