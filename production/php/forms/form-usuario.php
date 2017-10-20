<?php
  header('Content-Type: text/html; charset=utf-8');
  error_reporting(E_ALL ^ E_NOTICE);
  require_once "../bancos/conecta.php";
  require_once "../bancos/banco-usuario.php";
  require_once"../bancos/banco-profissao.php";
  require_once "../logica/logica-usuario.php";
  require_once "../alerta/mostra-alerta.php";
  verificaUsuario();
  $email = $_SESSION["usuario_logado"];
  $usuario = buscaUsuarioEmail($conexao, $email);
  $id_usuario = $usuario['id_usuario'];
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Projek | Novo Usuário</title>

    <link rel="shortcut icon" type="image/x-icon" href="../../ico/favicon.ico"/>
    <link href="../../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../../../vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="../../../build/css/custom.min.css" rel="stylesheet">
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="../index/index2.php" class="site_title"><img src="../../images/botao.png" width="40" right="40" ><span>PROJEK</span></a>
              <div class="clearfix"></div>
              <div class="profile clearfix">
                <div class="profile_pic">
                  <?php
                    $sql = "SELECT * FROM profileimg WHERE id_usuario = $id_usuario";
                    $sth = $conexao->query($sql);
                    $result=mysqli_fetch_array($sth);
                    if($result != null){
                      echo '<img class="img-responsive img-circle profile_img" src="data:image/jpeg;base64,'.base64_encode( $result['image'] ).'"/>';
                    }else{
                  ?>
                  <img class="img-responsive img-circle profile_img" src="../../images/user.png">
                  <?php
                    }

                  ?>
                  <img src="" alt="..." >
                </div>
                <div class="profile_info">
                  <span>Bem Vindo,</span>
                  <h2><?=$usuario['nome']?></h2>
                </div>
              </div>
              <br />
              <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                <div class="menu_section">
                  <ul class="nav side-menu">
                    <li><a><i class="fa fa-home"></i> Home<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="../index/index2.php">Dashboard</a></li>
                      </ul>
                    </li>
                    <li><a><i class="fa fa-user"></i> Usuários<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="../usuarios/consultores.php">Consultores</a></li>
                      </ul>
                    </li>
                    <li><a><i class="fa fa-briefcase"></i> Clientes<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="../clientes/clientes.php">Clientes</a></li>
                        <li><a href="../clientes/departamentos.php">Departamentos</a></li>
                        <li><a href="../clientes/gestores.php">Gestores</a></li>
                      </ul>
                    </li>
                    <li><a><i class="fa fa-file-text"></i> Mapeamentos<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="../processos/processos.php">Processos em Andamento</a></li>
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>
              <!-- /menu footer buttons -->
              <div class="sidebar-footer hidden-small">
                <a data-toggle="tooltip" data-placement="top" title="Settings">
                  <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                </a>
                <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                  <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                </a>
                <a data-toggle="tooltip" data-placement="top" title="Lock">
                  <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                </a>
                <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                  <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                </a>
              </div>
              <!-- Sidebar-->
            </div>
          </div>
        </div>
        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <?=$usuario['nome']?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Perfil</a></li>
                    <li>
                      <a href="javascript:;">
                        <span>Configurações</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Ajuda</a></li>
                    <li><a href="../../logout.php"><i class="fa fa-sign-out pull-right"></i> Sair</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false"></a></li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
              <div class="page-title">
                <div class="title_left">
                  <h3>Novo Usuário</h3>
                </div>
                <div class="title_right">
                  <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Pesquise...">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Go!</button>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_content">
                      <form id="form" action="../adiciona/adiciona-usuario.php" method="post"  enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">Nome <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="nome" name="nome" data-parsley-maxlength="10" required="required" class="form-control col-md-7 col-xs-12">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sobrenome">Sobrenome <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="sobrenome" name="sobrenome" required="required" class="form-control col-md-7 col-xs-12">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email<span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="email" id="email" name="email" required="required" class="form-control col-md-8 col-xs-12">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="senha">Senha<span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" id="senha" name="senha" required="required" class="form-control col-md-8 col-xs-12">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="telefone">Telefone<span class="required">*</span></label>
                          <div class="col-md-3 col-sm-6 col-xs-12">
                            <input class="form-control col-md-8" type="text" id="telefone" data-inputmask="'mask' : '(99) 9999[9]-9999'" name="telefone" required="required">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sexo">Sexo<span class="required">*</span>
                          </label>
                          <div class="col-md-3 col-sm-6 col-xs-12">
                            <select class="form-control col-md-3"  id="sexo" name="sexo" required="required" >
                              <option value="feminino">Feminino</option>
                              <option value="masculino">Masculino</option>
                            </select>
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="profissao">Profissão<span class="required">*</span>
                          </label>
                          <div class="col-sm-8 col-xs-12 col-md-6">
                            <select id="profissao" name="profissao" required class="form-control col-md-8 col-xs-12">
                            <?php
                            $profissoes = listaProfissao($conexao);
                            foreach ($profissoes as $profissao) {
                            ?>
                              <option value="<?=$profissao['id_profissao']?>"><?=$profissao['descricao']?></option>
                            <?php
                            }
                            ?>
                            </select>
                          </div>
                        </div>
                        <div class=" form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="estado1">Estado <span class="required">*</span>
                          </label>
                          <div class="col-sm-6 col-xs-12 col-md-2">
                            <select id="estado1" name="estado1" class="optional form-control col-md-7 col-xs-12"></select>
                          </div>
                          <label for="cidade1" class="control-label col-md-1 col-sm-3 col-xs-12">Cidade <span class="required">*</span>
                          </label>
                          <div class="col-sm-6 col-xs-12 col-md-3">
                            <select id="cidade1" name="cidade1" class="form-control col-md-7 col-xs-12" required>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="telefone">Imagem</label>
                          <div class="col-md-3 col-sm-6 col-xs-12">
                            <input type="file" name="image">
                          </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class=" form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="reset" name="reset" class="btn btn-primary">Resetar</button>
                            <button id="send" type="submit" name="enviar" class="btn btn-success">Cadastrar</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <br />
             </div>
            </div>
        </div>
         <!-- /page content -->
         <!-- footer content -->
        <footer>
          <div class="pull-right">
            PROJEK
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    <!-- jQuery -->
    <script src="../../../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../../../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../../../vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <!-- NProgress -->
    <script src="../../../vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../../../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- Parsley -->
    <script src="../../../vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../../../build/js/custom.min.js"></script>
    <!-- Cidades e Estados -->
    <script src="../../js/cidades-estados-utf8.js"></script>
    <script language="JavaScript" type="text/javascript" charset="utf-8">
      new dgCidadesEstados({
        cidade: document.getElementById('cidade1'),
        estado: document.getElementById('estado1')
      })
    </script>
    <script>
      $('#form').parsley();
    </script>
    <script type="text/javascript">
      window.ParsleyValidator.setLocale('pt-br');
    </script>
    <script type="text/javascript">
      $(document).on('click', '#close-preview', function(){
          $('.image-preview').popover('hide');
          // Hover befor close the preview
          $('.image-preview').hover(
              function () {
                 $('.image-preview').popover('show');
              },
               function () {
                 $('.image-preview').popover('hide');
              }
          );
      });

      $(function() {
          // Create the close button
          var closebtn = $('<button/>', {
              type:"button",
              text: 'x',
              id: 'close-preview',
              style: 'font-size: initial;',
          });
          closebtn.attr("class","close pull-right");
          // Set the popover default content
          $('.image-preview').popover({
              trigger:'manual',
              html:true,
              title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
              content: "There's no image",
              placement:'bottom'
          });
          // Clear event
          $('.image-preview-clear').click(function(){
              $('.image-preview').attr("data-content","").popover('hide');
              $('.image-preview-filename').val("");
              $('.image-preview-clear').hide();
              $('.image-preview-input input:file').val("");
              $(".image-preview-input-title").text("Browse");
          });
          // Create the preview image
          $(".image-preview-input input:file").change(function (){
              var img = $('<img/>', {
                  id: 'dynamic',
                  width:250,
                  height:200
              });
              var file = this.files[0];
              var reader = new FileReader();
              // Set preview image into the popover data-content
              reader.onload = function (e) {
                  $(".image-preview-input-title").text("Change");
                  $(".image-preview-clear").show();
                  $(".image-preview-filename").val(file.name);
                  img.attr('src', e.target.result);
                  $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
              }
              reader.readAsDataURL(file);
          });
    </script>
  </body>
</html>
