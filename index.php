<?php
define('SITE_KEY', '6LebC4YUAAAAAOrNz0c1CGPUU3wl3lH3ZqCjnur3');
define('SECRET_KEY', '6LebC4YUAAAAACudHW8SRk9XDIPs59hlLUOtLddO');

if($_POST){
    function getCaptcha($SecretKey){
        $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SECRET_KEY."&response={$SecretKey}");
        $Return = json_decode($Response);
        return $Return;
    }
    $Return = getCaptcha($_POST['g-recaptcha-response']);
    //var_dump($Return);
    if($Return->success == true && $Return->score > 0.5){
        echo "Succes!";
    }else{
        echo "You are a Robot!!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ReCaptcha V3</title>
    <script src='https://www.google.com/recaptcha/api.js?render=<?php echo SITE_KEY; ?>'></script>
</head>
<body>
    <form action="/" method="POST">
        <input type="text" name="name" /><br />
        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" /><br >
        <input type="submit" value="Submit" />
    </form>
    <script>
    grecaptcha.ready(function() {
    grecaptcha.execute('<?php echo SITE_KEY; ?>', {action: 'homepage'})
    .then(function(token) {
        //console.log(token);
        document.getElementById('g-recaptcha-response').value=token;
    });
    });
    </script>
</body>
</html>