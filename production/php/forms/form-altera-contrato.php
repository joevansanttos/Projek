<?php
	header('Content-Type: text/html; charset=utf-8'); 
	error_reporting(E_ALL ^ E_NOTICE); 
	require_once "../bancos/conecta.php";
	require_once "../bancos/banco-market.php";
	require_once "../bancos/banco-prospect.php";
	require_once "../bancos/banco-usuario.php";
	require_once "../bancos/banco-departamentos.php";
	require_once "../bancos/banco-produto.php";
	require_once "../bancos/banco-contrato.php";
	require_once "../logica/logica-usuario.php";
	require_once "../alerta/mostra-alerta.php";
	$n_contrato = $_GET['n_contrato'];
	$contrato = buscaContrato($conexao , $n_contrato);	
	$produtoId = buscaProduto($conexao, $contrato['id_produto']);
	$produtos = listaProdutos($conexao);
	$clientes = listaMarkets($conexao);
	$departamentos = listaDepartamentos($conexao);
	$market = buscaMarket($conexao, $contrato['id_clientes']); 
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
	 	<title>Projek | Alterar Contrato</title>

	  <link rel="shortcut icon" type="image/x-icon" href="../../ico/favicon.ico"/>
	  <link href="../../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	  <link href="../../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	  <link href="../../../vendors/nprogress/nprogress.css" rel="stylesheet">
	  <link href="../../../build/css/custom.min.css" rel="stylesheet">
	  <link href="../../../vendors/lou-multi-select/css/multi-select.css" media="screen" rel="stylesheet" type="text/css">
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
	                  echo '<img class="img-responsive img-circle profile_img" src="data:image/jpeg;base64,'.base64_encode( $result['image'] ).'"/>';
	                ?>
	              </div>
	              <div class="profile_info">
	                <span>Bem Vindo,</span>
	                <h2><?=$usuario['nome']?></h2>
	              </div>
	            </div>
	            <br />
	            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
	              <div class="menu_section">
	                <h3>Geral</h3>
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
	                <h3>Alterar Contrato</h3>
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
	                		<form action="../adiciona/adiciona-contrato.php" method="get" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">                  
	                		  <div class="item form-group">
	                		   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">Nº Contrato <span class="required">*</span>
	                		   </label>
	                		   <div class="col-md-6 col-sm-6 col-xs-12">
	                		     <input type="text" id="n_contrato" name="n_contrato" required="required" class="form-control" >
	                		   </div>
	                		  </div>
	                		  <div class="item form-group">
	                		   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_cliente">Nome Fantasia<span class="required">*</span>
	                		   </label>
	                		   <div class="col-md-6 col-sm-6 col-xs-12">
	                		     <input readonly="readonly" type="text" value="<?=$market['nome']?>" id="nome" name="nome" required="required" class="form-control col-md-7 col-xs-12">
	                		   </div>
	                		  </div>
	                		  <div class="item form-group">
	                		    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="razao">Razão Social <span class="required">*</span>
	                		   </label>
	                		   <div class="col-md-6 col-sm-6 col-xs-12">
	                		     <input  readonly="readonly" id="razao" name="razao" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" value="<?=$market['razao']?>" name="razao" required="required" type="text">
	                		   </div>
	                		  </div>
	                		  <div class="item form-group">
	                		    <label for="cnpj" class="control-label col-md-3 col-sm-3 col-xs-12">CNPJ <span class="required">*</span></label>
	                		   <div class="col-sm-6 col-xs-12 col-md-6">
	                		    <input readonly="readonly" id="cnpj" value="<?=$market['cnpj']?>" type="text" name="cnpj" data-validate-linked="cnpj" class="form-control col-md-2 col-xs-12" required="required">
	                		   </div>
	                		  </div>
	                		  <div class="item form-group">
	                		    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="endereco">Sede <span class="required">*</span>
	                		    </label>
	                		    <div class="col-md-6 col-sm-6 col-xs-12">
	                		      <input readonly="readonly" type="text" id="sede" name="sede" value="<?=$market['endereco']?>" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
	                		   </div>
	                		  </div>	                		  
	                		  <div class="item form-group">
	                		    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_produto">Produto<span class="required">*</span>
	                		    </label>
	                		    <div class="col-md-6 col-sm-6 col-xs-12">
	                		      <select name="id_produto" class="form-control col-md-7 col-xs-12">
	                		       <?php
	                		       foreach ($produtos as $produto){  
	                		         ?>
	                		         <option value="<?=$produto['id_produto']?>" ><?=$produto['nome']?></option>
	                		         <?php
	                		       }
	                		       ?>  
	                		      </select>
	                		    </div>
	                		  </div>
	                		 	<div class="item form-group ">
	                		 	  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="razao">Departamentos<span class="required">*</span>
	                		 	  </label>
	                		 	  <div class="col-md-6 col-sm-6 col-xs-12">
	                		 	  
	                		 	    <select multiple="multiple" id="my-select" name="my-select[]">
	                		 	  <?php
	                		 	    foreach ($departamentos as  $departamento) {
	                		 	  ?>
	                		 	          <option value='<?=$departamento['id_departamento']?>'>
	                		 	            <?=$departamento['descricao']?>                                
	                		 	          </option>
	                		 	  <?php
	                		 	    }
	                		 	  ?>
	                		 	    </select>
	                		 	  </div>
	                		 	</div>
	                		  <div class="item form-group">
	                		    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_consultor">Consultor<span class="required">*</span>
	                		    </label>
	                		    <div class="col-md-6 col-sm-6 col-xs-12">
	                		      <select name="id_consultor" class="form-control col-md-7 col-xs-12">
	                		       <?php
	                		       $usuarios = listaUsuarios($conexao);
	                		       foreach ($usuarios as $usuario){ 
	                		         if($usuario["id_profissao"] == '1'){
	                		           ?>

	                		           <option value="<?=$usuario['id_usuario']?>" ><?=$usuario['nome']?></option>
	                		           <?php
	                		         }
	                		       }
	                		       ?>  
	                		      </select>
	                		    </div>
	                		  </div>              
	                		  <div class="item form-group">
	                		    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="data_inicio">Inicio<span class="required">*</span></label>
	                		    <div class="col-sm-2 col-xs-12 col-md-2">
	                		      <input type="date" id="data_inicio" name="data_inicio" required="required" data-validate-length-range="8,20" class="form-control col-md-7 col-xs-12">
	                		    </div>
	                		    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="data_fim">Fim<span class="required">*</span></label>
	                		    <div class="col-sm-2 col-xs-12 col-md-2">
	                		      <input type="date" id="data_fim" name="data_fim" required="required" data-validate-length-range="6,20" class="form-control col-md-7 col-xs-12">
	                		     </div>
	                		  </div>
	                		  <div class="ln_solid"></div>
	                		  <div class="form-group">
	                		    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
	                		      <button type="button" class="btn btn-primary">Cancelar</button>
	                		      <button type="submit" class="btn btn-success">Cadastrar</button>
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
	  <!-- JQuery -->
		<script src="../../../vendors/jquery/dist/jquery.min.js"></script>
		<!-- Bootstrap -->
		<script src="../../../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
		<!-- NProgress -->
		<script src="../../../vendors/nprogress/nprogress.js"></script>
		<!-- Parsley -->
		<script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
		<!-- InputMask -->
		<script src="../../../vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
		<!-- Custom Theme Scripts -->
		<script src="../../../build/js/custom.min.js"></script>
		<script type="text/javascript">
		  $(function () {

		          var addFormGroup = function (event) {
		              event.preventDefault();

		              var $formGroup = $(this).closest('.form-group');
		              var $multipleFormGroup = $formGroup.closest('.multiple-form-group');
		              var $formGroupClone = $formGroup.clone();

		              $(this)
		                  .toggleClass('btn-default btn-add btn-danger btn-remove')
		                  .html('–');

		              $formGroupClone.find('input').val('');
		              $formGroupClone.insertAfter($formGroup);

		              var $lastFormGroupLast = $multipleFormGroup.find('.form-group:last');
		              if ($multipleFormGroup.data('max') <= countFormGroup($multipleFormGroup)) {
		                  $lastFormGroupLast.find('.btn-add').attr('disabled', true);
		              }
		          };

		          var removeFormGroup = function (event) {
		              event.preventDefault();

		              var $formGroup = $(this).closest('.form-group');
		              var $multipleFormGroup = $formGroup.closest('.multiple-form-group');

		              var $lastFormGroupLast = $multipleFormGroup.find('.form-group:last');
		              if ($multipleFormGroup.data('max') >= countFormGroup($multipleFormGroup)) {
		                  $lastFormGroupLast.find('.btn-add').attr('disabled', false);
		              }

		              $formGroup.remove();
		          };

		          var countFormGroup = function ($form) {
		              return $form.find('.form-group').length;
		          };

		          $(document).on('click', '.btn-add', addFormGroup);
		          $(document).on('click', '.btn-remove', removeFormGroup);

		      });
		</script>
		<script type="text/javascript">
		  
		</script>
		<script src="../../../vendors/lou-multi-select/js/jquery.multi-select.js" type="text/javascript">

		</script>
		<script type="text/javascript">
		    $('#my-select').multiSelect();
		</script>
	</body>
</html>