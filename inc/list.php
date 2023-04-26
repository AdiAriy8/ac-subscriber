<?php
// Get ActiveCampaign Lists
function get_activecampaign_lists($api_key, $api_url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url . '/api/3/lists');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Api-Token: '.$api_key
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);

    curl_close($ch);

    $lists = json_decode($result, true);

    return $lists['lists'];
}
