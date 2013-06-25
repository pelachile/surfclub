<?php

if(isset($_POST['first_name'])) {
  $fname = $_POST['first_name'];
  $lname = $_POST['last_name'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  if($fname === '') {
    $error = true;
  } else {
    $fname = $fname;
  }

  if($lname === '') {
    $error = true;
  } else {
    $lname = $lname;
  }

  $isValid = validEmail($email);

  if($isValid) {
    $email = $email;
  }

  if($message === '') {
    $error = true;
  } else {
    $messgae = $message;
  }

  if(!isset($error)){
    $name = $fname.' '.$lname;
    $email = $email;
    $subject = 'Comments from executivesurfclub.com';
    $comments = $name .' sent the following comments:'. "\r\n". $message;
    $headers = 'From:'. $email . "\r\n" .
      'Reply-To:' . $email . "\r\n" .
      'X-Mailer: PHP/' . phpversion();

    $to = 'pelachile@gmail.com';
    $sent = mail($to,$subject,$comments,$headers);

  }

  if($sent) {
    echo 'true';
  } else {
    echo 'false';
  }


}

function validEmail($email)
{
  $isValid = true;
  $atIndex = strrpos($email, "@");
  if (is_bool($atIndex) && !$atIndex)
  {
    $isValid = false;
  }
  else
  {
    $domain = substr($email, $atIndex+1);
    $local = substr($email, 0, $atIndex);
    $localLen = strlen($local);
    $domainLen = strlen($domain);
    if ($localLen < 1 || $localLen > 64)
    {
      // local part length exceeded
      $isValid = false;
    }
    else if ($domainLen < 1 || $domainLen > 255)
    {
      // domain part length exceeded
      $isValid = false;
    }
    else if ($local[0] == '.' || $local[$localLen-1] == '.')
    {
      // local part starts or ends with '.'
      $isValid = false;
    }
    else if (preg_match('/\\.\\./', $local))
    {
      // local part has two consecutive dots
      $isValid = false;
    }
    else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
    {
      // character not valid in domain part
      $isValid = false;
    }
    else if (preg_match('/\\.\\./', $domain))
    {
      // domain part has two consecutive dots
      $isValid = false;
    }
    else if(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
      str_replace("\\\\","",$local)))
    {
      // character not valid in local part unless 
      // local part is quoted
      if (!preg_match('/^"(\\\\"|[^"])+"$/',
        str_replace("\\\\","",$local)))
      {
        $isValid = false;
      }
    }
    if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A")))
    {
      // domain not found in DNS
      $isValid = false;
    }
  }
  return $isValid;
} 
