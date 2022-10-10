<?php

class loginModelo extends serviciosWebModelo {
    protected function ingresar_sistema_modelo($datos) {
        return serviciosWebModelo::invocarPost('usuario/loginSistema', $datos);
    }
}

