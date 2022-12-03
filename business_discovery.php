<?php
    include 'defines.php';

    // get pages endpoint
    $endpointFormat = ENDPOINT_BASE . '{ig-user-id}?fields=business_discovery
        .username({ig-username}){username,website,name,ig_id,id,profile_picture
            _url,biography,follows_count,followers_count,media_count,media{
                caption,like_count,comments_count,media_url,permalink,media_type}
            }&access_token={access-token}';
    $endpoint = ENDPOINT_BASE . $instagramAccountId;

    // endpoint params
    $igParams = array(
        'fields' => 'instagram_business_account',
        'access_token' => $accessToken
    );

    // add params to endpoint
    $endpoint .= '?' . http_build_query($igParams);

    // setup curl
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $endpoint);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // make call and get response
    $response = curl_exec($ch);
    curl_close($ch);
    $responseArray = json_decode($response, true);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Get Page's Instagram Business Account</title>
	</head>
	<body>
		<h1>Get Page's Instagram Business Account</h1>
		<hr />
		<h3>Endpoint: <?php echo $endpointFormat; ?></h3>
		<hr />
		<h3>Display:</h3>
		<h4>Instagram Business Account Id: <?php echo $responseArray['
            instagram_business_account']['id']; ?></h4>
		<h4>Facebook Page ID: <?php echo $responseArray['id']; ?></h4>
		<hr />
		<h3>Raw Response</h3>
		<textarea style="width:100%;height:6300px;"><?php print_r( $responseArray ); ?></textarea>
	</body>
</html>