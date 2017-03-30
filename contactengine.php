<?php
if(isset($_POST['submit']) && !empty($_POST['submit'])):
    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])):
        //your site secret key
        $secret = '6Lf61RoUAAAAAGTaaeuitkCvNfDGgbTDbeufdkp-';
        //get verify response data
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        if($responseData->success):
            //contact form submission code
            $name = !empty($_POST['name'])?$_POST['name']:'';
            $email = !empty($_POST['email'])?$_POST['email']:'';
            $message = !empty($_POST['message'])?$_POST['message']:'';
            
            $to = 'mmzhirkov@yandex.ru';
            $subject = 'Форма обратной связи bleasing.ru';
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
	header('Refresh: 3; URL=https://bleasing.github.io');
	echo 'Ïèñüìî îòïðàâëåíî, â áëèæàéøåå âðåìÿ ìû ñâÿæåìñÿ ñ Âàìè!';}
        else:
            {
	header('Refresh: 3; URL=https://bleasing.github.io');
	echo 'Ïèñüìî íå îòïðàâëåíî, ïðîâåðüòå ñâîè äàííûå';}
        endif;
    else:
        {
	header('Refresh: 3; URL=https://bleasing.github.io');
	echo 'Ïèñüìî íå îòïðàâëåíî, ïðîéäèòå ïðîâåðêó íà ñïàì!';}
    endif;
else:
    $errMsg = '';
    $succMsg = '';
endif;
?>
