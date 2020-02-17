<?php require_once "header.php"; ?>

<body>
  <?php
  if (!isset($_SESSION['nome'])) {
      echo "<script type='text/javascript'> window.location.href = 'login.php'; </script>";
  }

  if ($_SESSION['acesso'] < 10) {
      echo "<script type='text/javascript'> window.location.href = 'index.php'; </script>";
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
                        <div class="col-lg-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-md-6 "><h4 class="header-title">Buscar Patrimonios</h4></div> 
                                <div class="col-md-8"> 
                                    <input value="Buscar por nº do Patrimonio:" type="text" class="form-control col-md-6" style="float:left;border: none;background-color: #fff" disabled> 
                                    <input class="form-control col-md-6" type="text" onchange="" placeholder="" id="seach">                                     
                                </div>
                                <br>
                                <div class="col-md-8"> 
                                    <input value="Selecione a Descrição: " type="text" class="form-control col-md-6" style="float:left;border: none;background-color: #fff" disabled> 
                                    <input type="text" class="form-control col-md-6"  name="descricao" id="descricao">
                                                                         
                                </div>
                                <br>
                                <div class="col-md-8"> 
                                    <input value="Selecione a Localidade: " type="text" class="form-control col-md-6" style="float:left;border: none;background-color: #fff" disabled> 
                                    <input type="text"  class="form-control col-md-6" list="huge_list"  id="localizacao">
                                    <datalist id="huge_list">
                                        <?php
                                        $query = "SELECT DISTINCT localizacao FROM patrimonios";
                                        $run = mysqli_query($GLOBALS['conn'], $query);
                                            while ($row = mysqli_fetch_assoc($run)) {
                                                echo "<option>".$row['localizacao']."</option>";
                                            }

                                         ?>
                                       

                                    </datalist>
                                    <ul class="sugestoes"></ul>
                               
                                </div>
                                <br>
                                <div class="col-md-8"> 
                                    
                                   <button style="float: left;" onclick="buscarPatrimonios()" class="btn btn-success btn-sm">Buscar</button>
                                   
                                  
                                   <button style="float: left; margin-left: 20px" onclick="imprimir()" class="btn btn-primary btn-sm">Imprimir Selecionados</button> 
                                                                      
                                </div>

                                <div class="modal fade" id="update" role="dialog">
                                    <div class="modal-dialog">
                                    
                                     
                                      <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Atualização de patrimonio</h4>
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          
                                        </div>
                                        <div id="contatt" class="modal-body">

                                        </div>
                                        <div class="modal-footer">
                                          <center><button type="button" class="btn" data-dismiss="modal">Fechar</button></center>
                                        </div>
                                      </div>
                                      
                                    </div>
                                  </div>

                                
                                <br>
                                <script type="text/javascript">
                                   /* var local = document.getElementById("localizacao");

                                    local.addEventListener("input", () =>{
                                        console.log("asdas");
                                    })

*/


                                   jQuery(function(){
                                        var esportes = [
                                            "Natação",
                                            "Futebol",
                                            "Vôlei",
                                            "Basquete"
                                        ];
                                        jQuery("#localizacao" ).autocomplete({
                                            source: esportes
                                        });
                                        });











                                    function attpatrimonio(){
                                        var descricao = $("#descricao1").val();
                                        var modelo = $("#modelo1").val();
                                        var localizacao = $("#localizacao1").val();
                                        var n_patr = $("#n_patr1").val();
                                        var estado_equip = $("#estado_equip1").val();
                                        var man_loc = $("#man_loc1").val();
                                        var clt = $("#clt").val();
                                        var idc = $("#idc").val();
                                        var npo = $("#npo").val();

                                        console.log(npo);
                                        $.post("att_patrim.php", { npo:npo , clt:clt, idc:idc, descricao: descricao, modelo:modelo, localizacao:localizacao, n_patr:n_patr, estado_equip:estado_equip, man_loc:man_loc}, function(resposta){
                                            
                                            if (resposta.status == false) {
                                                mostraDialogo(resposta.msg, "danger", 5000);
                                            }else{
                                                mostraDialogo(resposta.msg, "success", 5000);   
                                            }
                                        }, "json");
                                    }
                                     function checkestado(){
                                        var estado = $("#estado_equip1").val();
                                        if (estado == "3") {
                                            document.getElementById("man_loc1").style.visibility = "visible";
                                        }else{
                                            document.getElementById("man_loc1").style.visibility = "hidden";
                                        }
                                    }

                                    function attPatr(id){
                                        $('#update').modal('show');
                                        $.post('getPatrUp.php', {id: id}, function(resposta) {
                                           
                                                document.getElementById("contatt").innerHTML = resposta;
                                                
                                            
                                                
                                        });
                                    }
                                    function deletePatr(id){
                                        $.post('deletePatr.php', {id: id}, function(resposta) {
                                            
                                            mostraDialogo("Deletado com sucesso!", 'success', 5000);
                                           document.getElementById('card' + id).remove();
                                             
                                                
                                        });

                                    }
                                    function imprimir(){
                                        var pacote = document.querySelectorAll('[id=patrs]:checked');
                                        var values = [];
                                        for (var i = 0; i < pacote.length; i++) {
                                            values.push(pacote[i].value);
                                        } 

                                       $.post('imprimir.php', {values: values}, function(resposta) {
                                            
                                            tela_impressao = window.open('about:blank');
                                            tela_impressao.document.write(resposta);
                                            tela_impressao.window.print();
                                            tela_impressao.window.close();
                                             
                                                
                                        });
                                      
                                    }

                                    function buscarPatrimonios(){

                                        var localizacao = $("#localizacao").val();
                                        var seach = $("#seach").val();
                                        var descricao = $("#descricao").val();
                                             
                                        $.post('buscarPatrimonios.php', {descricao: descricao, seach: seach, localizacao: localizacao}, function(resposta) {
                                            
                                            
                                                $("#accordion1").html(resposta);
                                             
                                                
                                        });
                                    }

                                    function check(){
                                        $(".despp").each(
                                            function() {
                                                if ($("#main").prop("checked")) {
                                                    $(this).prop("checked", true);
                                                } else {
                                                    $(this).prop("checked", false);
                                                }
                                            }
                                        );
                                    }
                                                
                                </script><br><br>
                                <div  class="col-md-3">
                                   <input type="checkbox" id="main" onchange="check()" class="form-control" style="width: auto;float: left;height: 24px; margin-right: 5px" id="asd" name="asd">
                                   <label for="asd"> Todos</label>
                                   </div><br><br>
                               
                                <div id="accordion1" class="according">

                                    
                                    
                                
                                </div>
                            </div>
                        </div>
                    </div>

                    </div>
                </div>
                <!-- row area start-->
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <?php require_once "footer.php"; ?>
</body>

</html>