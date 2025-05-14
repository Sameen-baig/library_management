<?php
$payload=["useriddelete"=>intval($_GET['useriddelete'])];
$ch = curl_init('http://127.0.0.1:5000/deleteuser');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
$resp = curl_exec($ch); curl_close($ch);
echo "Ray response: $resp";
