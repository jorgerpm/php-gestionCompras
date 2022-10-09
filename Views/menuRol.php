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
                    <select class="btn btn-primary" name="select">
                        <option class="menuRol" value="value1" selected>SELECCIONE UN ROL</option>
                        <?php require_once './acciones/listarRoles.php';
                        foreach($listaRoles as $rol) { ?>
                            <option class="menuRol" value="<?php echo $rol->id; ?>"><?php echo $rol->nombre; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <table class="table" id="">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Menú</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php require_once './acciones/listarMenus.php';
                        foreach ($listaMenus as $menu) { ?>
                            <tr>
                                <td>
                                    <div class="toggle">
                                        <label>
                                            <input type="checkbox"><span class="button-indecator"></span>
                                        </label>
                                    </div>
                                        <!--<button class="btn btn-info fa fa-edit" type="button" onclick='openModalMenu(variableMenu =<?php echo json_encode($menu); ?>);'></button>-->
                                </td>
                                <td><?php echo $menu->titulo ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>