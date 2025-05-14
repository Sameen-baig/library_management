<?php
// handle upload
if (move_uploaded_file($_FILES["bookphoto"]["tmp_name"], "uploads/".$_FILES["bookphoto"]["name"])) {
    $data = [
        "bookphoto"=>$_FILES["bookphoto"]["name"],
        "bookname"=>$_POST['bookname'],
        "bookdetail"=>$_POST['bookdetail'],
        "bookaudor"=>$_POST['bookaudor'],
        "bookpub"=>$_POST['bookpub'],
        "branch"=>$_POST['branch'],
        "bookprice"=>$_POST['bookprice'],
        "bookquantity"=>$_POST['bookquantity']
    ];
    $ch = curl_init('http://127.0.0.1:5000/addbook');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $resp = curl_exec($ch); curl_close($ch);
    echo "Ray response: $resp";
} else {
    echo "File upload failed.";
}
