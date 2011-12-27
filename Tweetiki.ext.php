<?php
include dirname(__FILE__).'/includes/TwitterOAuth/twitteroauth.php';
class Tweetiki
{
    static function getLoginLink($params)
    {
        $wiki_url = 'http://localhost/mediawiki/';
        $connection = new TwitterOAuth('IPs4LAerAqSybJB9uOJ0A', 
                      'pQngKocjGAp2FnTMly4GEMr8wc0Khu0ko9QhlEQSHI');
        $temporary_credentials = $connection->getRequestToken($wiki_url .
                                 'index.php?title=Special:Tweetiki' . '&' .
                                 $params);
        $_SESSION['tw_oauth_token'] = $token=$temporary_credentials['oauth_token'];
        $_SESSION['tw_oauth_token_secret'] = $temporary_credentials['oauth_token_secret'];
        $redirect_url = $connection->getAuthorizeURL($temporary_credentials);
        return $redirect_url;
    }    
    static function showTweetCheck(&$editpage, &$checks, &$tabindex)
    {
        global $wgOut;
        $attribs = array(
                          'tabindex'  => ++$tabindex,
                          'accesskey' => 'accesskey-sendtotwitter',
                          'id'        => 'TweetThis');
        $checkmarkup = Xml::check('TweetThis', true, $attribs);
        $label = '&nbsp;<label for="TweetThis" title="' .
                  'Check This for Tweet'.'">' .
                  'Tweet This</label>';
        $checks['tweetiki'] = $checkmarkup . $label;
        $wgOut->includeJQuery();
        $params = 'urltitle=' . $editpage->mTitle->mUrlform;
        $login_link = Tweetiki::getLoginLink($params);
        $script = '$("#wpSave").click(function(){
                      if($("#TweetThis").attr("checked"))
                      window.open("' . $login_link
                   . '");});';
        $wgOut->addScript(Html::inlineScript($script));
        return true;
    }
}

