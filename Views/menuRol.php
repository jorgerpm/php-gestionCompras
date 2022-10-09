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
        <div class="col-md-6">
            <div class="tile">
                <div>
                    <p><button style="display: none;" id="btnBuscar" name="btnBuscar" class="btn btn-primary btn-sm fa" type="button" onclick="window.location.href = ''">buscar</button></p>
                </div>
                <div class="btn-group mb-4" role="group">
                    <select class="form-control" name="select">
                        <option class="menuRol" value="value1" selected>SELECCIONE UN ROL</option>
                        <?php require_once './acciones/listarRoles.php';
                        foreach($listaRoles as $rol) { ?>
                            <option class="menuRol" value="<?php echo $rol->id; ?>"><?php echo $rol->nombre; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <?php require_once './acciones/listarMenuPorRol.php';
                foreach ($listaMenuPorRol as $menu) {
                    if ($menu->idMenu == null) {
                        $menuPadre = $menu->id;
                        $arrayAux = [];
                        foreach ($listaMenuPorRol as $menuHijo) {
                            if ($menuHijo->idMenu == $menuPadre) {
                            array_push($arrayAux, $menuHijo);
                            }
                        }
                        if (count($arrayAux) > 0) { ?>
                            <div class="treeview">
                                <div class="toggle">
                                    <label>
                                        <input type="checkbox"><span class="button-indecator"></span>
                                    </label>
                                </div>
                                <a class="itemsMenuRol" data-toggle="treeview">
                                    <i class="app-menu__icon fa <?php echo $menu->imagen; ?>"></i>
                                    <span class="app-menu__label"><?php echo $menu->titulo; ?></span>
                                    <i class="treeview-indicator fa fa-angle-right"></i>
                                </a>
                                <ul class="treeview-menu" style="background-color: white; padding-left: 50px">
                                <?php foreach ($arrayAux as $menuHijoAux) { ?>
                                    <div class="toggle">
                                        <label>
                                            <input type="checkbox"><span class="button-indecator"></span>
                                        </label>
                                    </div>
                                    <a class="treeview-item" style="padding: 7px 0 7px 20px">
                                        <label class="fa <?php echo $menuHijoAux->imagen; ?>"><?php echo $menuHijoAux->titulo; ?></label>
                                    </a>
                                <?php } ?>
                                </ul>
                            </div>
                        <?php }else { ?>
                            <div class="toggle">
                                <label>
                                    <input type="checkbox"><span class="button-indecator"></span>
                                </label>
                            </div>
                            <label class="fa <?php echo $menu->imagen; ?>"><?php echo $menu->titulo; ?></label>
                        <?php }
                    }
                } ?>
            </div>
        </div>
    </div>
</main>