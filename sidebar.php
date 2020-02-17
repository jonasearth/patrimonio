
<?php
if ($ant != "hack") {
        echo "<script type='text/javascript'> window.location.href = 'login.php'; </script>";
    }
 ?>

    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="index.php"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li class="active">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Pagina Inicial</span></a>
                                <ul class="collapse">
                                    <li class="active"><a href="index.php"><?php if($_SESSION['acesso'] == 0){
                                        echo "Adicionar Patrimônios";
                                    }else{ echo "Adicionar Usuários"; } ?></a></li>
                                    <?php 
                                    	if ($_SESSION['acesso'] == 10) {
                                    		echo "<li><a href='patrimonios.php'>Patrimônios</a></li>";
                                    	}
                                    ?>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->