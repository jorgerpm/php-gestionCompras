<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="tamañoTitulo fa fa-dashboard"></i> Asignación de permisos</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Administraci&oacute;n</li>
            <li class="breadcrumb-item active"><a href="#">Gesti&oacute;n de permisos</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <?php
                    //require_once './acciones/listarArchivos.php';
                    $menuRolControlador = new menuRolControlador();
                    
                    if(isset($_GET['select'])){
                        $idRolUsuario = $_GET['select'];
                        $listaMenuPorRol = $menuRolControlador->listarMenusRolPorRol($idRolUsuario);
                        
                    } else{
                        
                    }
                ?>
                <div>
                    <p><button style="display: none;" id="btnBuscar" name="btnBuscar" class="btn btn-primary btn-sm fa" type="button" onclick="window.location.href = ''">buscar</button></p>
                </div>
                <form name="f1" id="formMenuRol" action="">
                <div class="btn-group mb-4" role="group">
                    <select class="form-control" name="select" onchange="this.form.submit()" id="cbxListaRol">
                        <option class="menuRol" value="" >SELECCIONE UN ROL</option>
                        <?php require_once './acciones/listarRoles.php';
                        foreach($listaRoles as $rol) { ?>
                        <option class="menuRol" value="<?php echo $rol->id; ?>" <?php if(isset($_GET['select']) && $_GET['select'] == $rol->id) echo "selected"; ?> ><?php echo $rol->nombre; ?></option>
                        <?php } ?>
                    </select>
                </div>
                
                <?php require_once './acciones/listarMenus.php';
                foreach ($listaMenus as $menu) {
                    
                    if ($menu->idMenu == null) {
                        $menuPadre = $menu->id;
                        $arrayAux = [];
                        foreach ($listaMenus as $menuHijo) {
                            if ($menuHijo->idMenu == $menuPadre) {
                            array_push($arrayAux, $menuHijo);
                            }
                        }
                        if (count($arrayAux) > 0) { ?>
                            <div class="treeview">
                                <span class="toggle">
                                    <label>
                                        <input type="checkbox" onchange="checkAll(this)" id="<?php $menu->id ?>"><span class="button-indecator"></span>
                                    </label>
                                </span>
                                <a class="app-menu__item" data-toggle="treeview" style="margin-top: -45px; margin-left: 20px;background: none;border-left-color: transparent;">
                                    <span class="app-menu__label"><?php echo $menu->titulo; ?></span>
                                    <i class="treeview-indicator fa fa-angle-right"></i>
                                </a>
                                <ul class="treeview-menu" style="padding-left:50px; background:none">
                                <?php foreach ($arrayAux as $menuHijoAux) { ?>
                                    <div class="toggle">
                                        <label>
                                            <input type="checkbox" id="<?php $menuHijoAux->id ?>" <?php if(isset($listaMenuPorRol)){
                                                foreach ($listaMenuPorRol as $menuRol) {
                                                    if($menuRol->idMenu == $menuHijoAux->id) {
                                                        echo "checked";
                                                    }
                                                }
                                            }?>><span class="button-indecator"></span>
                                        </label>
                                        <label style="font-size: 16px"><?php echo " " . $menuHijoAux->titulo; ?></label>
                                    </div>
                                        
                                <?php } ?>
                                </ul>
                            </div>
                        <?php }else { ?>
                            <div class="toggle">
                                <label>
                                    <input type="checkbox" id="<?php $menu->id ?>" <?php if(isset($listaMenuPorRol)){
                                        foreach ($listaMenuPorRol as $menuRol) {
                                            if($menuRol->idMenu == $menu->id) {
                                                echo "checked";
                                            }
                                        }
                                    } ?>><span class="button-indecator"></span>
                                </label>
                                <label style="font-size: 16px"><?php echo " " . $menu->titulo; ?></label>
                            </div>
                        <?php }
                    }
                } ?>
                </form>
            </div>
            
        </div>
    </div>
</main>
<?php 
echo '<script></script>' ?>
<script src="./Assets/js/functions_menu_rol.js"></script>