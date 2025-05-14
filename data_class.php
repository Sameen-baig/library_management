<?php
include("db.php");

class data extends db {

    // —————————————————————————————————————————————————————————
    // helper: call Ray endpoint via cURL
    private function callRay(string $path, array $payload, bool $isGet=false) {
        $url = "http://127.0.0.1:5000{$path}";
        if ($isGet) {
            $url .= '?' . http_build_query($payload);
            $ch = curl_init($url);
        } else {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $resp = curl_exec($ch);
        curl_close($ch);
        return json_decode($resp, true);
    }

    // —————————————————————————————————————————————————————————
    // USER & ADMIN LOGIN (unchanged except POST→GET keys)
    function userLogin($email, $pass) {
        $q="SELECT * FROM userdata where email=? and pass=?";
        $stmt = $this->connection->prepare($q);
        $stmt->execute([$email,$pass]);
        if ($row = $stmt->fetch()) {
            header("Location: otheruser_dashboard.php?userlogid=".$row['id']);
        } else {
            header("Location: index.php?msg=Invalid Credentials");
        }
    }

    function adminLogin($email, $pass) {
        $q="SELECT * FROM admin where email=? and pass=?";
        $stmt = $this->connection->prepare($q);
        $stmt->execute([$email,$pass]);
        if ($row = $stmt->fetch()) {
            header("Location: admin_service_dashboard.php?logid=".$row['id']);
        } else {
            header("Location: index.php?msg=Invalid Credentials");
        }
    }

    // —————————————————————————————————————————————————————————
    // ADD NEW USER → Ray
    function addnewuser($name,$pasword,$email,$type){
        $payload = ["name"=>$name,"password"=>$pasword,"email"=>$email,"type"=>$type];
        $r = $this->callRay('/adduser',$payload);
        if(isset($r['status'])) header("Location: admin_service_dashboard.php?msg=User Added");
        else header("Location: admin_service_dashboard.php?msg=Register Fail");
    }

    // ADD BOOK → Ray
    function addbook($bookpic, $bookname, $bookdetail, $bookaudor, $bookpub, $branch, $bookprice, $bookquantity) {
        $payload = compact('bookpic','bookname','bookdetail','bookaudor','bookpub','branch','bookprice','bookquantity');
        $r = $this->callRay('/addbook',$payload);
        if(isset($r['status'])) header("Location: admin_service_dashboard.php?msg=done");
        else header("Location: admin_service_dashboard.php?msg=fail");
    }

    // DELETE BOOK → Ray
    function deletebook($id){
        $r = $this->callRay('/deletebook',["deletebookid"=>$id]);
        if(isset($r['status'])) header("Location: admin_service_dashboard.php?msg=done");
        else header("Location: admin_service_dashboard.php?msg=fail");
    }

    // DELETE USER → Ray
    function delteuserdata($id){
        $r = $this->callRay('/deleteuser',["useriddelete"=>$id]);
        if(isset($r['status'])) header("Location: admin_service_dashboard.php?msg=done");
        else header("Location: admin_service_dashboard.php?msg=fail");
    }

    // REQUEST BOOK → Ray
    function requestbook($userid,$bookid){
        // gather username/usertype/bookname locally
        $u=$this->connection->prepare("SELECT name,type FROM userdata WHERE id=?"); $u->execute([$userid]); $usr=$u->fetch();
        $b=$this->connection->prepare("SELECT bookname FROM book WHERE id=?"); $b->execute([$bookid]); $bk=$b->fetch();
        $payload = [
            "userid"=>$userid,
            "bookid"=>$bookid,
            "username"=>$usr['name'],
            "usertype"=>$usr['type'],
            "bookname"=>$bk['bookname'],
            "issuedays"=> ($usr['type']=='teacher'?21:7)
        ];
        $r = $this->callRay('/requestbook',$payload);
        header("Location: otheruser_dashboard.php?userlogid=$userid");
    }

    // APPROVE REQUEST → Ray
    function issuebookapprove($book,$userselect,$days,$getdate,$returnDate,$request){
        $payload = compact('book','userselect','days','getdate','returnDate','request');
        $r = $this->callRay('/approve',$payload);
        header("Location: admin_service_dashboard.php?msg=".$r['status']);
    }

    // ISSUE BOOK → Ray
    function issuebook($book,$userselect,$days,$getdate,$returnDate){
        // need username/usertype too
        $u=$this->connection->prepare("SELECT name,type FROM userdata WHERE name=?"); $u->execute([$userselect]); $usr=$u->fetch();
        $payload = [
            "book"=>$book,
            "userselect"=>$userselect,
            "username"=>$usr['name'],
            "usertype"=>$usr['type'],
            "days"=>$days,
            "getdate"=>$getdate,
            "returnDate"=>$returnDate
        ];
        $r = $this->callRay('/issuebook',$payload);
        header("Location: admin_service_dashboard.php?msg=".$r['status']);
    }

    // —————————————————————————————————————————————————————————
    // READ‑ONLY operations remain local
    function getbook() {
        return $this->connection->query("SELECT * FROM book");
    }
    function getbookissue(){
        return $this->connection->query("SELECT * FROM book where bookava !=0");
    }
    function userdata() {
        return $this->connection->query("SELECT * FROM userdata");
    }
    function getbookdetail($id){
        return $this->connection->query("SELECT * FROM book where id =$id");
    }
    function userdetail($id){
        return $this->connection->query("SELECT * FROM userdata where id =$id");
    }
    function getissuebook($userloginid) {
        return $this->connection->query("SELECT * FROM issuebook where userid='$userloginid'");
    }
    function issuereport(){
        return $this->connection->query("SELECT * FROM issuebook");
    }
    function requestbookdata(){
        return $this->connection->query("SELECT * FROM requestbook");
    }
}
