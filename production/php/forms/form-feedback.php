<?php 
  header('Content-Type: text/html; charset=utf-8'); 
  error_reporting(E_ALL ^ E_NOTICE); 
  require_once "../bancos/conecta.php";
  require_once "../bancos/banco-contrato.php";
  require_once "../bancos/banco-usuario.php";
  require_once "../logica/logica-usuario.php";
  require_once "../alerta/mostra-alerta.php";
  verificaUsuario();
  $email = $_SESSION["usuario_logado"];
  $usuario = buscaUsuarioEmail($conexao, $email);
  $id_usuario = $usuario['id_usuario'];
  $n_contrato = $_GET['n_contrato'];
  $contrato = buscaContrato($conexao , $n_contrato);
  $consultor = buscaUsuario($conexao , $contrato['id_consultor']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Projek | Novo Feedback</title>

  <link rel="shortcut icon" type="image/x-icon" href="../../ico/favicon.ico"/>
  <link href="../../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="../../../vendors/nprogress/nprogress.css" rel="stylesheet">
  <link href="../../../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
  <link href="../../../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
  <link href="../../../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
  <link href="../../../build/css/custom.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/teste.css">
  <!-- Datatables -->
  <link href="../../../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="../../../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="../../../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="../../../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="../../../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript">
    function handle(){
        value = $("button").text();
        alert(value);
      }

      $(function(){
        $("button").click(handle);
      });
  </script>
</head>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <!-- Sidebar-->      
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="../../index2.php" class="site_title"><img src="../../images/botão copiar.png" width="40" right="40" ><span>PROJEK</span></a>
          </div>
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
              <<h2><?=$usuario['nome']?></h2>
            </div>
          </div>
          <br />
          <?php
            if($usuario['id_profissao'] != 4){
          ?>
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <ul class="nav side-menu">
                <li><a><i class="fa fa-home"></i> Menu<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="../index/index2.php">Dashboard</a></li>
                  </ul>
                  
                </li>
                <li><a><i class="fa fa-list"></i> Listar<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="../usuarios/usuarios.php">Usuários</a></li>
                    <li><a href="../produtos/produtos.php">Produtos</a></li>
                    <li><a href="../usuarios/consultores.php">Consultores</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-briefcase"></i> Negócios <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="../empresas/market.php">Market</a></li>
                    <li><a href="../empresas/leads.php">Leads</a></li>
                    <li><a href="../empresas/suspects.php">Suspects</a></li>
                    <li><a href="../empresas/prospects.php">Prospects</a></li>
                    <li><a href="../contratos/contratos.php">Contratos</a></li>                     
                    <li><a href="../pos-venda/pos-venda.php">Pós-venda</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-table"></i> Consultoria <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="../consultoria/projetos.php">Projetos</a></li>                     
                  </ul>
                </li>
              </ul>
            </div>
          </div>
          <?php
            }else{
          ?>
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <ul class="nav side-menu">
                
                <li><a><i class="fa fa-briefcase"></i> Negócios <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="../empresas/market.php">Market</a></li>
                    <li><a href="../empresas/leads.php">Leads</a></li>
                    <li><a href="../empresas/suspects.php">Suspects</a></li>
                    <li><a href="../empresas/prospects.php">Prospects</a></li>
                    <li><a href="../contratos/contratos.php">Contratos</a></li>                     
                    <li><a href="../pos-venda/pos-venda.php">Pós-venda</a></li>
                  </ul>
                </li>
                
              </ul>
            </div>
          </div>
          <?php
            }
          ?>
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

        </div>
      </div>      
      <!-- Col-->
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
                  <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Sair</a></li>
                </ul>
              </li>

              <li role="presentation" class="dropdown">
                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false"></a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation --> 
      <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3>Feedback sobre Consultor</h3>
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
          <!--Page Title-->             
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a></li>
                        <li><a href="#">Settings 2</a></li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                  </ul>
                </div>
                <div class="clearfix"></div>                
                <div class="x_content">
                 
                    <form action="../adiciona/adiciona-feedback.php" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                      <div class="item form-group">
                         <h2>Pontualidade</h2>
                        <label class="radio-inline">
                          <input type="radio" value="25" name="pontual">Nada Pontual
                        </label>
                        <label class="radio-inline">
                          <input type="radio" value="50" name="pontual">Pouco Pontual
                        </label>
                        <label class="radio-inline">
                          <input type="radio" value="75" name="pontual">Pontual
                        </label>
                        <label class="radio-inline">
                          <input type="radio" value="100" name="pontual">Muito Pontual
                        </label>
                      </div>
                      <div class="item form-group">
                         <h2>Assiduidade</h2>
                        <label class="radio-inline">
                          <input type="radio" value="25" name="assiduo">Nada Assíduo
                        </label>
                        <label class="radio-inline">
                          <input type="radio" value="50" name="assiduo">Pouco Assíduo
                        </label>
                        <label class="radio-inline">
                          <input type="radio" value="75" name="assiduo">Assíduo
                        </label>
                        <label class="radio-inline">
                          <input type="radio" value="100" name="assiduo">Muito Assíduo
                        </label>
                      </div>
                      <div class="item form-group">
                         <h2>Conhecimento</h2>
                        <label class="radio-inline">
                          <input type="radio" value="25" name="conhecimento">Nenhum Conhecimento
                        </label>
                        <label class="radio-inline">
                          <input type="radio" value="50" name="conhecimento">Pouco Conhecimento
                        </label>
                        <label class="radio-inline">
                          <input type="radio" value="75" name="conhecimento">Tem Conhecimento
                        </label>
                        <label class="radio-inline">
                          <input type="radio" value="100" name="conhecimento">Muito Conhecimento
                        </label>
                      </div>
                      <div class="item form-group">
                         <h2>Empatia</h2>
                        <label class="radio-inline">
                          <input type="radio" value="25" name="empatia">Nenhuma Empatia
                        </label>
                        <label class="radio-inline">
                          <input type="radio" value="50" name="empatia">Pouca Empatia
                        </label>
                        <label class="radio-inline">
                          <input type="radio" value="75" name="empatia">Tem Empatia
                        </label>
                        <label class="radio-inline">
                          <input type="radio" value="100" name="empatia">Muito Empatia
                        </label>
                      </div>
                      <div class="ln_solid"></div>
                      <div class=" form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <input type="hidden" name="n_contrato" id="n_contrato" value="<?=$contrato['n_contrato']?>" />
                          <input type="hidden" name="id_clientes" id="id_clientes" value="<?=$contrato['id_clientes']?>" />
                          <input type="hidden" name="id_consultor" id="id_consultor" value="<?=$consultor['id_usuario']?>" />

                          <button type="submit" name="cancelar" class="btn btn-primary">Cancelar</button>
                          <button id="send" type="submit" name="enviar" class="btn btn-success">Cadastrar</button>
                        </div>
                      </div>
                    </form>                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="clearfix"></div>
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
  <script src="../../../vendors/jquery/dist/jquery.min.js"></script>

  <!-- Bootstrap -->
  <script src="../../../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="../../../vendors/fastclick/lib/fastclick.js"></script>
  <!-- NProgress -->
  <script src="../../../vendors/nprogress/nprogress.js"></script>
  <!-- bootstrap-progressbar -->
  <script src="../../../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
  <!-- iCheck -->
  <script src="../../../vendors/iCheck/icheck.min.js"></script>
  <!-- bootstrap-daterangepicker -->
  <script src="../../../vendors/moment/min/moment.min.js"></script>
  <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
  <!-- bootstrap-wysiwyg -->
  <script src="../../../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
  <script src="../../../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
  <script src="../../../vendors/google-code-prettify/src/prettify.js"></script>
  <!-- jQuery Tags Input -->
  <script src="../../../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
  <!-- Switchery -->
  <script src="../../../vendors/switchery/dist/switchery.min.js"></script>
  <!-- Select2 -->
  <script src="../../../vendors/select2/dist/js/select2.full.min.js"></script>
  <!-- Parsley -->
  <script src="../../../vendors/parsleyjs/dist/parsley.min.js"></script>
  <!-- Autosize -->
  <script src="../../../vendors/autosize/dist/autosize.min.js"></script>
  <!-- jQuery autocomplete -->
  <script src="../../../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
  <!-- starrr -->
  <script src="../../../vendors/starrr/dist/starrr.js"></script>
  <!-- Custom Theme Scripts -->
  <script src="../../../build/js/custom.min.js"></script>
  <script src="../../../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="../../../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="../../../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../../../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
  <script src="../../../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
  <script src="../../../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="../../../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="../../../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
  <script src="../../../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
  <script src="../../../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../../../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
  <script src="../../../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <!-- Cidades e Estados -->
    <script src="js/cidades-estados-utf8.js"></script>
  <script language="JavaScript" type="text/javascript" charset="utf-8">
      new dgCidadesEstados({
        cidade: document.getElementById('cidade1'),
        estado: document.getElementById('estado1')
      })
    </script>
  <script src="js/teste.js"></script>
  <script>
      $(document).ready(function() {
        $('#usuarios').dataTable({
         "language": {
          "sEmptyTable": "Nenhum registro encontrado",
          "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
          "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
          "sInfoFiltered": "(Filtrados de _MAX_ registros)",
          "sInfoPostFix": "",
          "sInfoThousands": ".",
          "sLengthMenu": "_MENU_ resultados por página",
          "sLoadingRecords": "Carregando...",
          "sProcessing": "Processando...",
          "sZeroRecords": "Nenhum registro encontrado",
          "sSearch": "Pesquisar",
          "oPaginate": {
            "sNext": "Próximo",
            "sPrevious": "Anterior",
            "sFirst": "Primeiro",
            "sLast": "Último"
          },
          "oAria": {
            "sSortAscending": ": Ordenar colunas de forma ascendente",
            "sSortDescending": ": Ordenar colunas de forma descendente"
          }
        }
      });
      });     
  </script>
  <script type="text/javascript">
    $(document).ready(function(){
        $("button").click(function(){
            
        });
    });
  </script>      
</body>
</html>
