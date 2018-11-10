<?php
$subject = $message_ok  = '';
if(isset($_GET['type']) && $_GET['type']=='product') {
	$subject.='Quotations product: '. addslashes($_GET['name']);
}
?>
<script language="javascript">
function chechemail()
{
	var name=document.getElementById("name");
	var phone=document.getElementById("phone");
	var content=document.getElementById("content");
	var email=document.getElementById("email");
	reg1=/^[0-9A-Za-z]+[0-9A-Za-z_]*@[\w\d.]+.\w{2,4}$/;
	testmail=reg1.test(email.value);
	if(name.value==""){
		document.getElementById('message').innerHTML = '<font color="#FF0000">Please enter your name</font>';
		name.focus();
		return false;
	}
	if(!testmail){
		document.getElementById('message').innerHTML = '<font color="#FF0000">Email address is not valid</font>';
		email.focus();
		return false;
	}
	if(phone.value==""){
		document.getElementById('message').innerHTML = '<font color="#FF0000">Please enter the contact telephone number</font>';
		phone.focus();
		return false;
	}
	else if(isNaN(phone.value)){
		document.getElementById('message').innerHTML = '<font color="#FF0000">Phone number is invalid</font>';
		phone.focus();
		return false;
	}
	if(content.value==""){
		document.getElementById('message').innerHTML = '<font color="#FF0000">Please type the letter</font>';
		content.focus();
		return false;
	}
	document.getElementById("frmcontact").submit();
	return true;
}
</script>
<?php
$conf = new CLS_CONFIG();
$conf->load_config();
require_once 'libs/cls.mail.php';
$noidung="<h3>Contact info:</h3>";
if(isset($_POST['name']))
{
    $name=addslashes($_POST["name"]);
    $email=addslashes($_POST["email"]);
    $phone=addslashes($_POST["phone"]);
    $subject=addslashes($_POST["subject"]);
    $text=addslashes($_POST["text"]);
	
    if($_POST["name"]!="")
		$noidung.="<strong>Full name:</strong> ".$name."<br />";
	if($_POST["email"]!="")
		$noidung.="<strong>Email:</strong> ".$email."<br />";
	if($_POST["phone"]!="")
		$noidung.="<strong>Phone:</strong> ".$phone."<br />";

	if($_POST["text"]!="")
		$noidung.="<hr><strong>Content:</strong>".$text."<br />";
    $objMailer=new CLS_MAILER();
    $header='MIME-Version: 1.0' . "\r\n";
	$header.='Content-type: text/html; charset=utf-8' . "\r\n";//Content-type: text/html; charset=iso-8859-1′ . “\r\n
	$header.="FROM: <".$email."> \r\n";
   	$objMailer->FROM="$name<$email>";//WEB_MAIL;
	$objMailer->HEADER=$header;
	$objMailer->TO=$conf->Email; //somebody@example.com, somebodyelse@example.com
	if($subject!='') $objMailer->SUBJECT=$subject;
	else $objMailer->SUBJECT = "Contact information from the website: ".$_SERVER['SERVER_NAME'];
	$objMailer->CONTENT=$noidung;
	$objMailer->SendMail();
	
	$message_ok = '<div><font color="#FF0000"><strong>Sent mail success. We will respond to you as soon as possible. Thank you ! </strong></font></div>';
}
?>	
<div class="clr padding"></div>
<div class="row"><?php $this->loadModule("box4");?></div>
<div class="contact_com">
<?php if($message_ok!='') echo $message_ok; 
else {
?>
<div  class="col-md-12">
  <form name="frmcontact" id="frmcontact" style="padding: 0px; margin:0px;" method="post" action="">
	<div align="center">
		<h2 class="title">CONTACT WITH HOANG HUY COMPANY</h2>
		Please send us your questions and comments. We will respond to you as soon as possible.<br>
    </div>
    <div id="message">&nbsp;</div>
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<input type="text" size="30" name="name" id="name" placeholder="Full name">
		</div>
		<div class="col-md-6 col-sm-12">
			<input type="text" size="52" name="subject" id="subject" placeholder="Title" value="<?php echo $subject;?>">
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<input type="text" id="email" size="30" name="email" placeholder="Email"><br>
			<input type="text" id="phone" size="30" name="phone" placeholder="Phone">
		</div>
		<div class="col-md-6 col-sm-12">
			<textarea id="content" name="text" rows="5" cols="40" placeholder="Subject"></textarea>
		</div>
	</div>
	<div class="row">
		<a href="#" onclick="return chechemail();" class="btninput" align="center">
			<span class="glyphicon glyphicon-envelope"></span> SEND
		</a>
	</div>
  </form>
</div>
<?php } ?>
</div>
