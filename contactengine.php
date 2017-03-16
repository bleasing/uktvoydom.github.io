<?php
if(isset($_POST['submit']) && !empty($_POST['submit'])):
    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])):
        //your site secret key
        $secret = '6LdVqiMTAAAAAFyZ5fsbYLuKtfZuaY3fONuQ3SY8';
        //get verify response data
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        if($responseData->success):
            //contact form submission code
            $name = !empty($_POST['name'])?$_POST['name']:'';
            $email = !empty($_POST['email'])?$_POST['email']:'';
            $message = !empty($_POST['message'])?$_POST['message']:'';
            
            $to = 'bleasing@bk.ru';
            $subject = 'Письмо подтвержение с сайта bleasing.ru';
            $htmlContent = "
                <h1>Contact information</h1>
                <p><b>Name: </b>".$name."</p>
                <p><b>Email: </b>".$email."</p>
                <p><b>Message: </b>".$message."</p>
            ";
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
            $headers .= 'From:'.$name.' <'.$email.'>' . "\r\n";
            //send email
            @mail($to,$subject,$htmlContent,$headers);
            
            
            {
	header('Refresh: 3; URL=http://bleasing.ru');
	echo 'Письмо отправлено, в ближайшее время мы свяжемся с Вами!';}
        else:
            {
	header('Refresh: 3; URL=http://bleasing.ru');
	echo 'Письмо не отправлено, проверьте свои данные';}
        endif;
    else:
        {
	header('Refresh: 3; URL=http://bleasing.ru');
	echo 'Письмо не отправлено, пройдите проверку на спам!';}
    endif;
else:
    $errMsg = '';
    $succMsg = '';
endif;
?>