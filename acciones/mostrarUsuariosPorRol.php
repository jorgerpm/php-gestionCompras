<?php
if(is_file('./Utils/configUtil.php')){
    require_once './Utils/configUtil.php';
}
else{
    require_once '../Utils/configUtil.php';
}

if(isset($_POST['idComboRol'])){

    $userContr = new usuarioControlador(); 
    $listaUser = $userContr->listar_usuarios_activos_porrol($_POST['idComboRol']); 
    ?>

            <select class="form-control btn-sm" id="cmbUserListRecep" name="cmbUserListRecep">
                <option value="">- Usuarios -</option>
                <?php foreach ($listaUser as $userModal){ ?>
                <option value="<?php echo $userModal->nombre.'#'.$userModal->id.'#'.$userModal->correo.'#'.$userModal->nombreRol; ?>"><?php echo $userModal->nombre; ?></option>
                <?php } ?>
            </select>

    <?php
}
