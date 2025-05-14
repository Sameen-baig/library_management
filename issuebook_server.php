<?php
$data=[
  "book"=>intval($_POST['book']),
  "userselect"=>$_POST['userselect'],
  "username"=>$_POST['userselect'],
  "usertype"=>$_POST['userselect'],
  "days"=>intval($_POST['days']),
  "getdate"=>date("d/m/Y"),
  "returnDate"=>date("d/m/Y",strtotime("+".$_POST['days']." days"))
];
$ch=curl_init('http://127.0.0.1:5000/issuebook');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-Type: application/json']);
curl_setopt($ch,CURLOPT_POST,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($data));
$resp=curl_exec($ch); curl_close($ch);
echo "Ray response: $resp";
