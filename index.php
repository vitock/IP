<?php date_default_timezone_set("Etc/GMT-8"); ?>
<?php $counter = intval(file_get_contents("counter.dat")); ?>
<?php include 'function.php';?>
<?php
header("Content-type: image/JPEG");
$r = rand(0,10);
$im = imagecreatefromjpeg( "xhxh".$r.".jpg"); 

$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];// $_SERVER["REMOTE_ADDR"];
$weekarray=array("日","一","二","三","四","五","六"); //先定义一个数组
$get=$_GET["s"];
$get=base64_decode(str_replace(" ","+",$get));
//$wangzhi=$_SERVER['HTTP_REFERER'];这里获取当前网址
//here is ip 
$url="http://ip.taobao.com/service/getIpInfo.php?ip=".$ip; 
$UserAgent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; .NET CLR 3.5.21022; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';  
$curl = curl_init(); 
curl_setopt($curl, CURLOPT_URL, $url); 
curl_setopt($curl, CURLOPT_HEADER, 0);  
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);  
curl_setopt($curl, CURLOPT_ENCODING, '');  
curl_setopt($curl, CURLOPT_USERAGENT, $UserAgent);  
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);  
$data = curl_exec($curl);
$data = json_decode($data, true);
$country = $data['data']['country']; 
$region = $data['data']['region']; 
$city = $data['data']['city'];
$bak = getenv("BAK");
$url = "http://api.map.baidu.com/telematics/v3/weather?output=json&ak=".$bak."&location=".$region.$city;
$url = "https://www.tianqiapi.com/api/?city=".$city;
$curl = curl_init(); 
curl_setopt($curl, CURLOPT_URL, $url); 
curl_setopt($curl, CURLOPT_HEADER, 0);  
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);  
curl_setopt($curl, CURLOPT_ENCODING, '');  
curl_setopt($curl, CURLOPT_USERAGENT, $UserAgent);  
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);  
$data = curl_exec($curl);
$data = json_decode($data, true);
if(strcmp($data['city'],$city) ===  0){
    $weather = $data["data"][0]["wea"]." ".$data["data"][0]["tem2"]."~".$data["data"][0]["tem1"];
}

if(strlen($weather) > 2){

}
else{
    $weather = "您使用的是:".$bro;
}

//定义颜色
$black = ImageColorAllocate($im, 0,0,0);//定义黑色的值
$red = ImageColorAllocate($im, 255,0,0);//红色
$font = 'msyh.ttf';//加载字体
$address = $country.'-'.$region.'-'.$city;
if (strlen($address) == 2) {
    $address = ' 太阳系 ';
}
//输出
imagettftext($im, 16, 0, 10, 40, $black, $font,'欢迎您,来自'.$address.'的朋友');
imagettftext($im, 16, 0, 10, 72, $black, $font, '今天是'.date('Y年n月j日')." 星期".$weekarray[date("w")]);//当前时间添加到图片
imagettftext($im, 16, 0, 10, 104, $black, $font,$weather );//ip
imagettftext($im, 15, 0, 10, 140, $black, $font,'您的IP是:'.$ip.'  :('.$counter.')' );
imagettftext($im, 15, 0, 10, 175, $black, $font,'您使用的是'.$os.'操作系统');
imagettftext($im, 16, 0, 10, 205, $red, $font,$get);  
// ImageGif($im);
imagejpeg($im,null,30);
ImageDestroy($im);
?>
<?php
    $counter = intval(file_get_contents("counter.dat"));  
     $_SESSION['#'] = true;  
     $counter++;  
     $fp = fopen("counter.dat","w");  
     fwrite($fp, $counter);  
     fclose($fp); 
 ?>
