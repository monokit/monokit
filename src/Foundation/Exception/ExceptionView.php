<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

</head>
<body>

    <div class="jumbotron">
        <h1>MonoKit</h1>
        <p><?php echo $this->message; ?></p>
        <button class="btn btn-primary btn-lg"><?php echo $this->class; ?></button>
    </div>

    <div class="well well-lg"><?php echo $this->vars; ?></div>

</body>
</html>