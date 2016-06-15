<?php
/**
 * Created by IntelliJ IDEA.
 * User: simon
 * Date: 15/06/16
 * Time: 19:37
 */

namespace FireSphere\GeSHiParser;


class GeSHiParser
{


    /**
     * @param string $arguments array with the type
     * @param array $code string of the code to parse
     *
     * @return String of parsed code.
     */
    public static function handle_shortcode($arguments, $code, $parser, $shortcode, $extra = array())
    {
        if (!isset($arguments['type'])) {
            /** Assuming most code is PHP. Feel free to update. Should this be a configurable? */
            $arguments['type'] = 'php';
        }
        $geshi = new \GeSHi(html_entity_decode(str_replace('<br>', "\n", $code)), $arguments['type']);
        $geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);

        return $geshi->parse_code();
    }

}