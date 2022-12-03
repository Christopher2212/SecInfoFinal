<?php
    include 'defines.php';

    // load graph-sdk files
    require_once __DIR__ . '\Facebook\autoload.php';
            
    // facebook credentials array

    $creds = array(
        'app_id' => FACEBOOK_APP_ID,
        'app_secret' => FACEBOOK_APP_SECRET,
        'default_graph_version' => 'v15',
        'persistent_data_handeler' => 'session'
    );

    // create facebook object
    
    $facebook = new Facebook\Facebook($creds);

    $helper = $facebook -> getRedirectLoginHelper();

    $oAuth2Client = $facebook -> getOAuth2Client(); 

    if(isset($_GET['code'])){ // get access token
        try {
            $accessToken = $helper->getAccessToken();
        } catch (Facebook\Exceptions\FacebookResponseException $e){
            echo 'Graph returned an error ' . $e->getMessage();
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error ' . $e->getMessage();
        }

        echo '<h1>Short Lived Access Token</h1>';
        print_r((string) $accessToken);

        if ( !$accessToken->isLongLived()) { // exchange short for long
            try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken( $accessToken );
            } catch(Facebook\Exceptions\FacebookSDKException $e){
                echo 'Error getting long lived access token ' + $e->getMessage();
            }
        }

        echo '<pre>';
        var_dump($accessToken);

        $accessToken = (string) $accessToken;
        echo '<h1>Long Lived Access Token</h1>';
        print_r($accessToken);

    }else{
        $permissions = ['public_profile', 'instagram_basic', 'pages_show_list'];
        $loginUrl  = $helper -> getLoginUrl(FACEBOOK_APP_REDIRECT_URI, $permissions);
        
        echo '<a href="' . $loginUrl . '">
            Login With Facebook
            </a>';
            
    }
?>
