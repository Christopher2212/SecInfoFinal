<!DOCTYPE html>
<html>
    <body>
        <php?
            include 'defines.php';

            // load graph-sdk files
            require_once __DIR__ . 'php-graph-sdk-5.x\src\Facebook\autoload.php'
            
            // facebook credentials array

            $creds = array(
                'app_id' => FACEBOOK_APP_ID,
                'app_secret' => FACEBOOK_APP_SECRET,
                'default_graph_version' => 'v5'
                'persistent_data_handeler' => 'session'
            );

            // create facebook object
            
            $facebook = new Facebook\Facebook($creds);

            $helper = $facebook -> getRedirectLoginHelper();

            $oAuth2Client = $facebook -> getOAuth2Client(); 

            if(isset($_GET['code'])){

            }else{
                $perissions = ['public_profile', 'instagram_basic', 'pages_show_list'];
                $loginUrl  = $helper -> getLoginUrl(FACEBOOK_APP_REDIRECT_URL, $permissions)
                
                echo'<a href="' . loginUrl . '">
                    Login With Facebook
                    </a>';
            }
        ?>
    </body>
</html>
