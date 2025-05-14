<?php
$data = [
  "request"=>intval($_GET['reqid']),
  "book"=>$_GET['book'],
  "userselect"=>intval($_GET['userselect']),
  "username"=>$_GET['userselect'],    // or fetch name via data_class if needed
  "usertype"=>$_GET['userselect'],    // adjust as needed
  "days"=>intval($_GET['days']),
  "getdate"=>date("d/m/Y"),
  "returnDate"=>date("d/m/Y",strtotime("+".$_GET['days']." days"))
];
$ch = curl_init('http://127.0.0.1:5000/approve');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
$resp = curl_exec($ch); curl_close($ch);
echo "Ray response: $resp";
