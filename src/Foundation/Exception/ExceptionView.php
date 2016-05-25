<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">

    <link rel="stylesheet" href="https://bootswatch.com/slate/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body style="padding: 50px;">

    <div class="jumbotron" style="padding: 50px;">
        <h1>MonoKit</h1>
        <p><?php echo $this->message; ?></p>
        <p><a class="btn btn-primary btn-lg"><?php echo $this->class; ?></a></p>
    </div>

    <div class="well well-lg"><?php echo $this->vars; ?></div>

</body>
</html>