<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SAEP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container" style="margin-top:15%">
        <center>
            <div class="card w-50">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h2>Bem Vindo</h2>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha:</label>
                                <input type="password" class="form-control" id="senha" name="senha">
                            </div>
                        </div>
                        <div class="alert alert-success" id="log" role="alert" style="display:none">
                            A simple dark alert—check it out!
                        </div>
                        <div id="loading"></div>
                        <center><button class="btn btn-outline-primary" style="width:20%" onclick="login()">Entrar</button></center>
                    </div>
                </div>
        </center>
    </div>

    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>