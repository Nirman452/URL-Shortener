<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="style.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <title>URL shortener</title>
</head>

<body>

<div id="wrapper">

<h1><a href="index.php">Url shortener</a></h1>

<h3>Please enter your url</h3>

<form>
<input id="input" type="url" name="url">
<input id="submit" type="submit">
</form>

<?php
$current_url='http://localhost/urlapp/';

if (isset($_GET['url']) && $_GET['url']!=""){
    $conn = mysqli_connect("localhost", "root", "", "url_shortener");
    if (!$conn) {
    	echo "Connection failed: " . mysqli_connect_error();
    }

    $url=urldecode($_GET['url']);
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        echo("URL entered: $url");
    } else {
        echo("$url is not a valid URL");
    }

    $slug=GetShortUrl($url);
    echo "<br><br><p class='message'>Shortened URL: <a href='".$current_url.$slug."'>".$current_url.$slug."</a></p> <br>";
    echo "<div class='clicks'>";
    $clicks=getResults();
    
}


function GetShortUrl($url){
    $url=urldecode($_GET['url']);
    global $conn;
    $query = "SELECT * FROM short_url WHERE long_url = '".$url."' "; 
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
         $row = $result->fetch_assoc();
          return $row['shortened_url'];
         } else {
         $short_url = makeNewID();
         $sql = "INSERT INTO short_url (long_url, shortened_url, click_counter)
        VALUES ('".$url."', '".$short_url."', '0')";
        if ($conn->query($sql) === TRUE) {
             return $short_url;
        } 
        else { 
            die("error!");
        }
    }
}


function makeNewID(){
    global $conn; 
    $token = substr(md5(uniqid(rand(), true)),0,5); 
    $query = "SELECT * FROM short_url WHERE shortened_url = '".$token."' ";
    $result = $conn->query($query); 
    if ($result->num_rows > 0) {
        makeNewID();
    } else {
        return $token;
    }
}


if(isset($_GET['redirect']) && $_GET['redirect']!="") { 
    $slug=urldecode($_GET['redirect']);

    $conn = mysqli_connect("localhost", "root", "", "url_shortener");
    if (!$conn) {
    	echo "Connection failed: " . mysqli_connect_error();
    }
    $url= GetRedirectUrl($slug);
    $conn->close();
    header("location:".$url);
    exit;
}


function GetRedirectUrl($slug){
    global $conn;
    $query = "SELECT * FROM short_url WHERE shortened_url = '".addslashes($slug)."' "; 
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hits=$row['click_counter']+1;
        $sql = "update short_url set click_counter='".$hits."' where id='".$row['id']."' ";
        $conn->query($sql);
        return $row['long_url'];
   }
   else 
        { 
    die("Invalid Link!");
   }
}


function getResults(){
    global $conn;
    $query = "SELECT click_counter, long_url FROM short_url";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()){
          echo "<ul><li>Number of clicks for <b>".$row["long_url"] ."</b>: ". $row["click_counter"]. "</li>";
          echo "</ul>";

        }
    }
    
}  
?>
</div>
</body>
</html>
