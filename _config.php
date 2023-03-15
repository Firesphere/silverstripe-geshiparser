<?php

use SilverStripe\View\Parsers\ShortcodeParser;
use Firesphere\GeSHiParser\GeSHiParser;

ShortcodeParser::get('default')
    ->register('code', [GeSHiParser::class, 'handle_shortcode']);