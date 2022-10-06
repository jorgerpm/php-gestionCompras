<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="description" content="Sistema para carga de facturas xml">
        
        <title>Sistema para carga de facturas xml</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Main CSS-->
        <link rel="stylesheet" type="text/css" href="./Assets/css/main.css">
        <link rel="stylesheet" type="text/css" href="./Assets/css/estilosExtra.css">
        <!-- Font-icon css-->
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <!-- Essential javascripts for application to work-->
        <script src="./Assets/js/jquery-3.3.1.min.js"></script>
    
    </head>
    <body class="app sidebar-mini">
        <!-- Barra de navegaciój-->
        <header class="app-header"><a class="app-header__logo" href="home">Inicio</a>
            <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
            <!-- menú derecho de barra de navegación-->
            <ul class="app-nav">
                <!--li class="app-search">
                    <input class="app-search__input" type="search" placeholder="Search">
                    <button class="app-search__button"><i class="fa fa-search"></i></button>
                </li-->
                <!--Notification Menú-->
                <!-- li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa fa-bell-o fa-lg"></i></a>
                    <ul class="app-notification dropdown-menu dropdown-menu-right">
                        <li class="app-notification__title">You have 4 new notifications.</li>
                        <div class="app-notification__content">
                            <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                                <div>
                                    <p class="app-notification__message">Lisa sent you a mail</p>
                                    <p class="app-notification__meta">2 min ago</p>
                                </div>
                            </a></li>
                            <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-danger"></i><i class="fa fa-hdd-o fa-stack-1x fa-inverse"></i></span></span>
                                <div>
                                    <p class="app-notification__message">Mail server not working</p>
                                    <p class="app-notification__meta">5 min ago</p>
                                </div>
                            </a></li>
                            <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-success"></i><i class="fa fa-money fa-stack-1x fa-inverse"></i></span></span>
                                <div>
                                    <p class="app-notification__message">Transaction complete</p>
                                    <p class="app-notification__meta">2 days ago</p>
                                </div>
                            </a></li>
                            <div class="app-notification__content">
                                <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                                    <div>
                                        <p class="app-notification__message">Lisa sent you a mail</p>
                                        <p class="app-notification__meta">2 min ago</p>
                                    </div>
                                </a></li>
                                <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-danger"></i><i class="fa fa-hdd-o fa-stack-1x fa-inverse"></i></span></span>
                                    <div>
                                        <p class="app-notification__message">Mail server not working</p>
                                        <p class="app-notification__meta">5 min ago</p>
                                    </div>
                                </a></li>
                                <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-success"></i><i class="fa fa-money fa-stack-1x fa-inverse"></i></span></span>
                                    <div>
                                        <p class="app-notification__message">Transaction complete</p>
                                        <p class="app-notification__meta">2 days ago</p>
                                    </div>
                                </a></li>
                            </div>
                        </div>
                        <li class="app-notification__footer"><a href="#">See all notifications.</a></li>
                    </ul>
                </li -->
                <!-- User Menu-->
                <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
                    <ul class="dropdown-menu settings-menu dropdown-menu-right">
                        <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-user fa-lg"></i> Perfil</a></li>
                        <li><a class="dropdown-item" href="logout"><i class="fa fa-sign-out fa-lg"></i> Salir</a></li>
                    </ul>
                </li>
            </ul>
        </header>
        <!-- Sidebar menu-->
        <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
        <aside class="app-sidebar">
            <div class="app-sidebar__user fa fa-user-circle" style="text-align:center">
                <div>
                    <span class="app-sidebar__user-name tamañoTitulo"><?php echo $_SESSION['Usuario']->nombre ?></span>
                    <!--<p class="app-sidebar__user-designation">Frontend Developer</p>-->
                </div>
            </div>
            <ul class="app-menu">
                <?php
                require_once './acciones/listarMenuPorRol.php';
                foreach ($listaMenuPorRol as $menu) {
                    if ($menu->idMenu == null) {
                        $menuPadre = $menu->id;
                        $arrayAux = [];?>
                        <?php
                        foreach ($listaMenuPorRol as $menuHijo) {
                            if ($menuHijo->idMenu == $menuPadre) {
                            array_push($arrayAux, $menuHijo);
                            }?>
                        <?php }
                        if (count($arrayAux) > 0) { ?>
                            <li class="treeview">
                                <a class="app-menu__item" href="<?php echo $menu->link; ?>" data-toggle="treeview">
                                    <i class="app-menu__icon fa <?php echo $menu->imagen; ?>">
                                    </i>
                                    <span class="app-menu__label"><?php echo $menu->titulo; ?>
                                    </span>
                                    <i class="treeview-indicator fa fa-angle-right">
                                    </i>
                                </a>
                                <ul class="treeview-menu">
                                <?php foreach ($arrayAux as $menuHijoAux) { ?>
                                        <li>
                                            <a class="treeview-item" style="padding: 7px 0 7px 20px" href="<?php echo $menuHijoAux->link; ?>">
                                                <i class="icon fa <?php echo $menuHijoAux->imagen; ?>">
                                                    <span class="app-menu__label"><?php echo $menuHijoAux->titulo; ?>
                                                    </span>
                                                </i>
                                            </a>
                                        </li>
                                <?php } ?>
                                </ul>
                            </li>
                        <?php }else { ?>
                            <li><a class="app-menu__item" href="<?php echo $menu->link; ?>"><i class="app-menu__icon fa <?php echo $menu->imagen; ?>"></i><span class="app-menu__label"><?php echo $menu->titulo; ?></span></a></li>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </ul>
        </aside>