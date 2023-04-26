<?php
// Add Subscriber to ActiveCampaign List
function add_subscriber_to_list($subscriber_email, $subscriber_name, $list_id, $api_key, $api_url) {

    $data = array(
        'email' => $subscriber_email,
        'first_name' => $subscriber_name,
        'p['.$list_id.']' => $list_id,
        'status['.$list_id.']' => 1
    );
    $data_string = json_encode($data);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url . '/api/3/contacts');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Api-Token: '.$api_key
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);

    curl_close($ch);

    return $result;
}
