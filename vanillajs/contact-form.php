<?php
$emailTo = '<YOUR_EMAIL_HERE>';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name     = stripslashes(trim($_POST['name']));
    $email    = stripslashes(trim($_POST['email']));
    $assunto  = stripslashes(trim($_POST['assunto']));
    $mensagem = stripslashes(trim($_POST['mensagem']));

    $emailIsValid = preg_match('/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/', $email);

    if($name && $email && $emailIsValid && $assunto && $mensagem){
        $subject = "[Contato via site] $assunto";
        $body = "Nome: $name <br /> Email: $email <br /> Mensagem: $mensagem";

        $headers  = 'MIME-Version: 1.1' . PHP_EOL;
        $headers .= 'Content-type: text/html; charset=utf-8' . PHP_EOL;
        $headers .= "From: $name <$email>" . PHP_EOL;
        $headers .= "Return-Path: $emailTo" . PHP_EOL;
        $headers .= "Reply-To: $email" . PHP_EOL;

        mail($emailTo, $subject, $body, $headers);
        $emailSent = true;

    } else {
        $hasError = true;
    }
}
?><!DOCTYPE html>
<html>
<head>
    <title>Simple PHP Contact Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>
    <div class="jumbotron">
        <h1>Simple PHP Contact Form</h1>
        <p>A Simple Contact Form developed in PHP with VanillaJS Form validation.</p>
    </div>
    <?php if(isset($emailSent) && $emailSent): ?>
        <div class="col-md-6 col-md-offset-3">
            <div class="alert alert-success text-center">Sua mensagem foi enviada com sucesso.</div>
        </div>
    <?php else: ?>
        <?php if(isset($hasError) && $hasError): ?>
        <div class="col-md-5 col-md-offset-4">
            <div class="alert alert-danger text-center">Houve um erro no envio, tente novamente mais tarde.</div>
        </div>
        <?php endif; ?>

    <div class="col-md-6 col-md-offset-3">
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="contact-form" class="form-horizontal" role="form" method="post">
            <div class="form-group">
                <label for="name" class="col-lg-2 control-label">Nome</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control required" id="name" name="name" placeholder="Nome" />
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-lg-2 control-label">Email</label>
                <div class="col-lg-10">
                    <input type="email" class="form-control required" id="email" name="email" placeholder="Email" />
                </div>
            </div>
            <div class="form-group">
                <label for="assunto" class="col-lg-2 control-label">Assunto</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control required" id="assunto" name="assunto" placeholder="Assunto" />
                </div>
            </div>
            <div class="form-group">
                <label for="mensagem" class="col-lg-2 control-label">Mensagem</label>
                <div class="col-lg-10">
                    <textarea class="form-control required" rows="3" id="mensagem" name="mensagem" placeholder="Mensagem" /><?php if(isset($_POST['mensagem'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['mensagem']); } else { echo $_POST['mensagem']; } } ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <button type="submit" class="btn btn-default">Enviar</button>
                </div>
            </div>
        </form>
    </div>
    <?php endif; ?>

    <script type="text/javascript" src="assets/js/contact-form.js"></script>
</body>
</html>