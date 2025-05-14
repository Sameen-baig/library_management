<?php
if(!isset($_GET['bookid'])) die("No bookid");
$bid=(int)$_GET['bookid'];
$ch=curl_init("http://127.0.0.1:5000/bookdetail?bookid=$bid");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$json=curl_exec($ch); curl_close($ch);
$data=json_decode($json,true);
if(isset($data['error'])) die("Not found");
?>
<!DOCTYPE html><html><head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
</head><body class="p-4">
<div class="container">
  <h2><?=htmlspecialchars($data['bookname'])?></h2>
  <img src="uploads/<?=htmlspecialchars($data['bookpic'])?>" style="width:150px">
  <p><strong>Author:</strong> <?=$data['bookaudor']?></p>
  <p><strong>Pub:</strong> <?=$data['bookpub']?></p>
  <p><strong>Branch:</strong> <?=$data['branch']?></p>
  <p><strong>Price:</strong> <?=$data['bookprice']?></p>
  <p><strong>Available:</strong> <?=$data['bookava']?></p>
  <p><strong>Rent:</strong> <?=$data['bookrent']?></p>
  <a href="admin_service_dashboard.php" class="btn btn-secondary">Back</a>
</div>
</body></html>
