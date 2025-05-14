<?php
$data=[
  "userid"=>intval($_GET['userid']),
  "bookid"=>intval($_GET['bookid']),
  "username"=>$_GET['userid'],
  "usertype"=>$_GET['userid'],
  "bookname"=>$_GET['bookid'],    // adjust if you need actual name
  "issuedays"=>0
];
$ch=curl_init('http://127.0.0.1:5000/requestbook');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-Type: application/json']);
curl_setopt($ch,CURLOPT_POST,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($data));
$resp=curl_exec($ch); curl_close($ch);
echo "Ray response: $resp";
