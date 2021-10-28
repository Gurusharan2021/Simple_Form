<?php
session_start();
$status = '';
if ( isset($_POST['captcha']) && ($_POST['captcha']!="") ){
// Validation: Checking entered captcha code with the generated captcha code
if(strcasecmp($_SESSION['captcha'], $_POST['captcha']) != 0){
// Note: the captcha code is compared case insensitively.
// if you want case sensitive match, update the check above to strcmp()
$status = "<p style='color:#FFFFFF; font-size:20px'><span style='background-color:#FF0000;'>Entered captcha code does not match! Kindly try again.</span></p>";
}else{
$status = "<p style='color:#FFFFFF; font-size:20px'><span style='background-color:#46ab4a;'>Your captcha code is match.</span></p>";	
	}
}
?>
<html>
<head>
<title>A Form</title>
</head>
<body>
<h1>Form</h1>
<div>Registration closes in <span id="timer" style="color: red;"></span>

<form name="form" method="post" action="">
<label>Name</label>
<input type="text" name="name" required> <br>
<label>Email</label>
<input type="email" name="name" required> <br>
<label>Date of Birth</label>
<input type="date" name="name" required> <br>
<textarea placeholder="Tell us about yourself...." tabindex="5" required></textarea>
<br>
<br>
<label><strong>Enter Captcha:</strong></label>
<p><br /><img src="captcha.php?rand=<?php echo rand(); ?>" id='captcha_image'></p>
<input type="text" name="captcha" />
<p><a href='javascript: refreshCaptcha();'>click here</a> to refresh CAPTCHA</p>
<?php echo $status; ?>
<input type="submit" name="submit" value="Submit" id="submitBtn">
</form>


<script type="text/javascript">
//Timer
document.getElementById('timer').innerHTML =
  03 + ":" + 00;
startTimer();


function startTimer() {
  var presentTime = document.getElementById('timer').innerHTML;
  var timeArray = presentTime.split(/[:]+/);
  var m = timeArray[0];
  var s = checkSecond((timeArray[1] - 1));
  if(s==59){m=m-1}
  if(m<0){
    return
  }
  
  document.getElementById('timer').innerHTML =
    m + ":" + s;
  console.log(m)
  setTimeout(startTimer, 1000);

  if(m==0 && s==0){alert("Time's up for Registration");
 	document.getElementById("submitBtn").disabled = true;}
  
}

function checkSecond(sec) {
  if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
  if (sec < 0) {sec = "59"};
  return sec;
}
</script>

<script>
//Refresh Captcha
function refreshCaptcha(){
    var img = document.images['captcha_image'];
    img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>

</body>
</html>