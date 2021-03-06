<?php
  header('Content-Type: text/html; charset=utf-8');
  error_reporting(E_ALL ^ E_NOTICE);
  ob_start();
  session_start();
  require_once "php/logica/logica-usuario.php";
  require_once "php/alerta/mostra-alerta.php";
  if(usuarioEstaLogado()) {
    header("Location: php/index/index2.php");
    $_SESSION["success"] = "Bem Vindo ao Projek Manager";
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="ico/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="css/index.css">

    <title>Projek | Gestão da Qualidade Total</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <section id="login">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="form-wrap">
              <h1>Entre com o seu email:</h1>
              <form role="form" action="login.php" method="post" id="login-form" autocomplete="off">
                <div class="form-group">
                  <input type="email" name="email" id="email" class="form-control" placeholder="alguem@projek.com">
                </div>
                <div class="form-group">
                  <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha">
                </div>
                <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Entrar">
              </form>
              <hr>
            </div>
          </div>
        </div>
      </div>
    </section>
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <script src="js/notify.js"></script>
    <?php
    if(isset($_SESSION['success'])){
    ?>
      <script>
        $.notify('<?=$_SESSION['success']?>', "success");
      </script>

    <?php
      unset($_SESSION['success']);
    }
    ?>

    <?php
    if(isset($_SESSION['error'])){
    ?>
      <script>
        $.notify('<?=$_SESSION['error']?>', "error");
      </script>

    <?php
      unset($_SESSION['error']);
    }
    ?>
  </body>
  <footer id="footer">
      <div class="container">
          <div class="row">
              <div class="col-xs-12">
                  <p><img src="images/botao.png" width="40" right="40" ><span>PROJEK</span></p>
              </div>
          </div>
      </div>
  </footer>
</html>
