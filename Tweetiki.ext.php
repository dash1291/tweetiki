<?php
class Tweetiki
{
    static function showTweetCheck( &$editpage, &$checks, &$tabindex )
    {
        $attribs = array(
                          'tabindex'  => ++$tabindex,
                          'accesskey' => 'accesskey-sendtotwitter',
                          'id'        => 'TweetThis');
        $checkmarkup = Xml::check( 'TweetThis', true, $attribs );
        $label = '&nbsp;<label for="TweetThis" title="' .
                  'Check This for Tweet'.'">' .
                  'Tweet This</label>';
        $checks['tweetiki'] = $checkmarkup . $label;
        return true;
    }
}
        



