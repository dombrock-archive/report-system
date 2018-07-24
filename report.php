<?php
$zip = $_GET["zip"]??"not-found";

$ip = "not-found";
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
$ua = $_SERVER['HTTP_USER_AGENT']??"not-found";
$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
?>
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<div class="wrap">
<h1>SITE NAME/h1>
<hr>
<form>
  <h2>META INFO</h2>
  IP:<br>
  <input type="text" id="ip" value="<?php echo $ip ?>" readonly="readonly" disabled="disabled"><br><br>
  CURRENT ZIP:<br>
  <input type="text" id="zip" value="<?php echo $zip ?>" readonly="readonly" disabled="disabled"><br><br>
  Accessing URL:<br>
  <input type="text" id="link" value="<?php echo $actual_link ?>" readonly="readonly" disabled="disabled"><br><br>
  User Agent:<br>
  <textarea id="user-agent" readonly="readonly" disabled="disabled"><?php echo $ua ?></textarea><br><br>
  OS:<br>
  <input type="text" id="os" value="loading..." readonly="readonly" disabled="disabled"><br><br>
  Screen Size:<br>
  <input type="text" id="size" value="loading..." readonly="readonly" disabled="disabled"><br><br>
  <hr>
  <h2>FORM</h2>
  Your Name:<br>
  <input type="text" id="name"><br><br>
  Device Model (optional):<br>
  <input type="text" id="device" placeholder="iPhoneX, Galaxy s5 ect."><br><br>
  PayPal Test Account Email (if applicable):<br><br>
  <input type="text" id="paypal" placeholder="test-buyer[X]@gmail.com"><br><br>
  Comments / Suggestion / Bug Report (1028 char max):<br>
  <textarea id="comments" maxlength="1028">Please limit to one suggestion / issue per report. After submitting you will have an option to submit another report without filling in all of your info again. Thanks! -Mathieu</textarea><br><br>
  <div class="submit">SUBMIT</div>
</form>
</div>
<script>
var OSName="Unknown OS";
if (navigator.appVersion.indexOf("Win")!=-1) OSName="Windows";
if (navigator.appVersion.indexOf("Mac")!=-1) OSName="MacOS";
if (navigator.appVersion.indexOf("X11")!=-1) OSName="UNIX";
if (navigator.appVersion.indexOf("Linux")!=-1) OSName="Linux";
console.log('Your OS: '+OSName);
$("#os").val(OSName);

var size = String($(window).height())+"x"+String($(window).width());
$("#size").val(size);

var oc_ip = $("#ip").val();
var oc_zip = $("#zip").val();
var oc_link = $("#link").val();
var oc_ua = $("#user-agent").val();
var oc_os = $("#os").val();
var oc_size = $("#size").val();

var oc_name = $("#name").val();
var oc_device = $("#device").val();
var oc_paypal = $("#paypal").val();
var oc_comments = $("#comments").val();

var old_content = $(".wrap").html();
$(document).on('click', '.submit', function(){ 
    oc_ip = $("#ip").val();
    oc_zip = $("#zip").val();
    oc_link = $("#link").val();
    oc_ua = $("#user-agent").val();
    oc_os = $("#os").val();
    oc_size = $("#size").val();

    oc_name = $("#name").val();
    oc_device = $("#device").val();
    oc_paypal = $("#paypal").val();
    oc_comments = $("#comments").val();

    //console.log(old_content);
    $url = "report-submit.php?ip="+oc_ip+"&zip="+oc_zip+"&link="+oc_link+"&user-agent="+oc_ua+"&os="+oc_os+"&size="+oc_size+"&name="+oc_name+"&device="+oc_device+"&paypal="+oc_paypal+"&comments="+oc_comments;
    $url = encodeURI($url);
    console.log($url);
    $.ajax({url: $url, success: function(result){
        $(".wrap").html("Thanks! Your report has been submitted and saved. If you want to submit another, click the 'reload' button below. <div class='reload'>RELOAD</div>");
    }});
});

$(document).on('click', '.reload', function(){ 
    console.log("reload");
    //console.log(old_content);
    $(".wrap").html(old_content);
    $("#size").val(oc_size);
    $("#os").val(oc_os);
    $("#name").val(oc_name);
    $("#device").val(oc_device);
    $("#paypal").val(oc_paypal);
    $("#comments").val(oc_comments);
});
</script>
<style>
@import url('https://fonts.googleapis.com/css?family=Open+Sans');
body{
    text-align:center;
    background:darkgrey;
    background-image:url('http://celebwallpapers.net/wp-content/uploads/2018/02/free-background-images-blurred-fresh-wallpaper-hd-free-blurry-wallpaper-pic-wpc-wallpaper-of-free-background-images-blurred.jpg');
    background-attachment:fixed;
    background-size:cover;
    font-family: 'Open Sans', sans-serif;
}
input, textarea{
    width:480px;
}
textarea{
    height:128px;
}
.wrap{
    background:gainsboro;
    border-radius:0.5em;
    width:512px;
    margin:0 auto;
    padding:1em;
    opacity:0.9;
}
.submit, .reload{
    background:forestgreen;
    color:white;
    width:128px;
    margin:0 auto;
    border-radius:0.5em;
    padding:0.5em;
    border:0.1em solid forestgreen;
}
.submit:hover,.reload:hover{
    border:0.1em solid black;
}
</style>
