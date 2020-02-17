<?php require_once "header.php"; ?>

<body>
  <?php 
    if(!isset($_SESSION['nome'])){
	   echo "<script type='text/javascript'> window.location.href = 'login.php'; </script>";
	}   

?>

   <?php require_once "sidebar.php"; ?>

        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
        <?php require_once "header2.php"; ?>
            <!-- header area end -->
            <!-- page title area start -->
        <?php require_once "header2_down.php"; ?>
            <!-- page title area end -->
            <div class="main-content-inner">
                <!-- sales report area start -->
                <div class="sales-report-area mt-5 mb-5">
                    <div class="row">
                        <?php if ($_SESSION['acesso'] >= 10) {
                            
                        ?>
                        <div class="col-lg-12 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">ADICIONAR USUÁRIO
                                    :</h4>
                                    <br>
                                    <div class="col-md-3">
                                        
                                        <input type="text" class="form-control " name="login" id="login" placeholder="Login">
                                        <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
                                        <input type="password" class="form-control" id="senha2" name="senha2" placeholder="Repita a senha">
                                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do cliente">

                                        <select class="form-control " style="padding: inherit;" id="acctype">
                                           <option value="nulo">Tipo de conta...</option>
                                           <option value="10">ADMINISTRADOR</option>
                                           <option value="user">USUÁRIO</option>
                                        </select>

                                       <br>
                                       <button type="submit" onclick="adduser()" class="btn btn-primary btn-sm">Adicionar</button>
                                        <script type="text/javascript">
                                            function adduser(){
                                                var login = $("#login").val();
                                                var senha = $("#senha").val();
                                                var senha2 = $("#senha2").val();
                                                var nome = $("#nome").val();
                                                var acctype = $("#acctype").val();

                                                $.post("add_user.php", {acctype: acctype, login: login, senha:senha, senha2:senha2, nome:nome}, function(resposta){
                                                    if (resposta.status == false) {
                                                        mostraDialogo(resposta.msg, "danger", 5000);
                                                    }else{
                                                        mostraDialogo(resposta.msg, "success", 5000);   
                                                    }
                                                }, "json");
                                            }
                                        </script>
                                       
                                     </div>
                                </div>
                            </div>
                        </div>
                        <?php }else{ ?>
                            <div class="col-lg-12 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">ADICIONAR PATRIMÔNIO:</h4>
                                        <br>
                                        <div class="col-md-12">
                                            
                                            
                                            <input type="text" class="form-control col-md-6" style=" float: left;" id="localizacao" placeholder="Localização do Patrimônio">


                                            <input value="Selecione a unidade do patrimônio" type="text" class="form-control col-md-6" style="border: none" disabled>
                                          
                                           <br>

                                        
                                    
                                            <input type="text" class="form-control col-md-6" style="float: left;" name="descricao" id="descricao" placeholder="Descrição do Patrimônio">
                                                

                                            <input value="Selecione a descrição do patrimônio" type="text" class="form-control col-md-6" style="border: none" disabled>
                                            <br>
                                            <input style="float: left;" type="text" class="form-control col-md-6" name="modelo" id="modelo" placeholder="Modelo do equipamento">

                                            <input value="Inorme o modelo do equipamento" type="text" class="form-control col-md-6" style="border: none" disabled>
                                            <br>
                                            <input type="text" style="float: left;" class="form-control col-md-6" name="n_patr" id="n_patr" placeholder="Número do Patrimônio">

                                            <input value="Obs: Caso não haja número do patrimônio digite apenas '1'" type="text" class="form-control col-md-6" style="border: none" disabled>
                                           <br>
                                            <select onchange="checkestado()" class="form-control col-md-6" style="padding: inherit;float: left;" id="estado_equip">
                                                <option value="0">Estado do equipamento:</option>
                                                <option value="1">Funcionando</option>
                                                <option value="2">Quebrado</option>
                                                <option value="3">Em Manutenção</option>
                                            </select>  

                                            <input value="Selecione o estado do equipamento" type="text" class="form-control col-md-6" style="border: none" disabled>
                                            <br>
                                            <input type="text" class="form-control col-md-6" name="man_loc" id="man_loc" placeholder="Localização do patrimonio em Manutenção" style="visibility: hidden;float: left;">

                                            <input id="man_loc2" value="Informe a Localização do patrimonio em Manutenção" type="text" class="form-control col-md-6" style="visibility: hidden;border: none" disabled>

                                            <br>
                                            <button type="submit" onclick="addpatrimonio()" class="btn btn-primary btn-sm">Adicionar Patrimonio</button>
                                            <script type="text/javascript">
                                                function addpatrimonio(){
                                                    var descricao = $("#descricao").val();
                                                    var modelo = $("#modelo").val();
                                                    var localizacao = $("#localizacao").val();
                                                    var n_patr = $("#n_patr").val();
                                                    var estado_equip = $("#estado_equip").val();
                                                    var man_loc = $("#man_loc").val();
                                                    
                                                    $.post("add_patrim.php", { descricao: descricao, modelo:modelo, localizacao:localizacao, n_patr:n_patr, estado_equip:estado_equip, man_loc:man_loc}, function(resposta){
                                                        
                                                        if (resposta.status == false) {
                                                            mostraDialogo(resposta.msg, "danger", 5000);
                                                        }else{
                                                            mostraDialogo(resposta.msg, "success", 5000);   
                                                        }
                                                    }, "json");
                                                }
                                                function checkestado(){
                                                    var estado = $("#estado_equip").val();
                                                    if (estado == "3") {
                                                        document.getElementById("man_loc").style.visibility = "visible";
                                                        document.getElementById("man_loc2").style.visibility = "visible";
                                                    }else{
                                                        document.getElementById("man_loc").style.visibility = "hidden";
                                                        document.getElementById("man_loc2").style.visibility = "hidden";
                                                    }
                                                }
                                            </script>
                                           
                                         </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                
                <div class="row">
                   
                </div>

            </div>
        </div>
        <?php require_once "footer.php"; ?>
</body>

</html>
