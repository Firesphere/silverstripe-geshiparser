<?php
use SilverStripe\View\Parsers\ShortcodeParser;
use Firesphere\GeSHiParser\GeSHiParser;

ShortcodeParser::get('default')
    ->register('code', array(GeSHiParser::class, 'handle_shortcode'));
