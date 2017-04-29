<?php

namespace Firesphere\GeSHiParser;

use SilverStripe\View\Parsers\ShortcodeParser;
use SilverStripe\View\Parsers\ShortcodeHandler;

/**
 * Class GeSHiParser
 *
 * Handle the shortcode [code] to parse it into nicely formatted and highlighted code.
 *
 * @package FireSphere\GeSHiParser
 */
class GeSHiParser implements ShortcodeHandler
{

    public static function get_shortcodes()
    {
        return ['code'];
    }

    /**
     * @param string $arguments array with the type
     * @param array $code string of the code to parse
     * @param ShortcodeParser $parser Parser root user.
     * @param string $shortcode
     * @param array $extra
     *
     * @return String of parsed code.
     */
    public static function handle_shortcode($arguments, $code, $parser, $shortcode, $extra = array())
    {
        if (!isset($arguments['type'])) {
            /** Assuming most code is PHP. Feel free to update. Should this be a configurable? */
            $arguments['type'] = 'php';
        }
        $code = self::br2nl($code);
        $code = trim(str_replace("</p><p>", "\n", $code));
        $geshi = new \GeSHi(html_entity_decode($code), $arguments['type']);
        $geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);

        $result = '<h4 class="parsed-code-title">' . (isset($arguments['title']) ? $arguments['title'] : $arguments['type']) . ':</h4>';
        $result .= $geshi->parse_code();
        return $result;
    }

    public static function br2nl($string){
        return preg_replace('#<br\s*?/?>#i', "\n", $string);
    }

}
