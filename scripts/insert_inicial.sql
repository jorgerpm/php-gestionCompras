insert into rol (nombre, idestado) values ('ADMINISTRADOR', 1);
insert into usuario (nombre, usuario, clave, correo, idrol, idestado) 
values ('Administrador', 'admin', 'admin', '', 1, 1);

INSERT INTO parametro
(id, nombre, valor, idEstado)
VALUES(1, 'HOSTMAIL', 'smtp.office365.com', 1);
INSERT INTO parametro
(id, nombre, valor, idEstado)
VALUES(2, 'PUERTOMAIL', '587', 1);
INSERT INTO parametro
(id, nombre, valor, idEstado)
VALUES(3, 'USERMAIL', '', 1);
INSERT INTO parametro
(id, nombre, valor, idEstado)
VALUES(4, 'CLAVEMAIL', '', 1);
INSERT INTO parametro
(id, nombre, valor, idEstado)
VALUES(5, 'REMITENTEMAIL_RC', 'Pruebas xml', 1);
INSERT INTO parametro
(id, nombre, valor, idEstado)
VALUES(6, 'ASUNTOMAIL_RC', 'Recuperación de contraseña', 1);
INSERT INTO parametro
(id, nombre, valor, idEstado)
VALUES(7, 'MENSAJEMAIL_RC', 'Estimado [nombre]<br><br>Su nueva clave para acceder al portal es: [clave]<br><br><hr>Saludos', 1);

insert into estado (nombre) values ('ACTIVO');
insert into estado (nombre) values ('INACTIVO');

INSERT INTO menu(id, titulo, link, imagen, idMenu, idEstado) VALUES (1, 'Administración', '', null, null, 1);
INSERT INTO menu(id, titulo, link, imagen, idMenu, idEstado) VALUES (2, 'Gestión roles', 'rol', 'fa-address-card-o', 1, 1);
INSERT INTO menu(id, titulo, link, imagen, idMenu, idEstado) VALUES (3, 'Gestión usuarios', 'usuario', 'fa-user-o', 1, 1);
INSERT INTO menu(id, titulo, link, imagen, idMenu, idEstado) VALUES (4, 'Cargar xml', 'cargarXml', 'fa-upload', null, 1);
INSERT INTO menu(id, titulo, link, imagen, idMenu, idEstado) VALUES (5, 'Gestión proveedor', 'proveedor', 'fa-truck', null, 1);
INSERT INTO menu(id, titulo, link, imagen, idMenu, idEstado) VALUES (6, 'Gestión parámetros', 'parametro', 'fa-bookmark-o', 1, 1);
INSERT INTO menu(id, titulo, link, imagen, idMenu, idEstado) VALUES (7, 'Consultar facturas', 'archivoXml', 'fa-calculator', null, 1);

insert into menurol(idrol, idmenu) values (1, 1);
insert into menurol(idrol, idmenu) values (1, 2);
insert into menurol(idrol, idmenu) values (1, 3);
insert into menurol(idrol, idmenu) values (1, 4);
