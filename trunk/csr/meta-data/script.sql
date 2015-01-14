create database csr character set utf8 collate utf8_general_ci;

use csr;

create table cliente(
	rut varchar(12),
	nombre varchar(100),
	mail varchar(200),
	telefono varchar(100),
	primary key(rut)
);

insert into cliente values('11-1','Patricio Pérez Pinto','patodeath@gmail.com','85138020');
insert into cliente values('22-2','Julia Muñoz Ampuero','jmunoz@gmail.com','222222');
insert into cliente values('33-3','Raul Pérez Hermosilla','rperez@gmail.com','333333');
insert into cliente values('44-4','Juan Carlos Mackay','jcarlos@gmail.com','444444');
insert into cliente values('55-5','Santo Tomás Rancagua','stomas@gmail.com','123122');

create table usuario(
	id int auto_increment,
	rut varchar(12),
	pass varchar(100),
	primary key(id),
	foreign key(rut) references cliente(rut)
);

insert into usuario values(null, '44-4','123');

create table hora(
	id int auto_increment,
	descripcion varchar(20),
	valor int,
	primary key(id)
);

insert into hora values(null, '10:00 - 11:00', '18000');
insert into hora values(null, '11:00 - 12:00', '18000');
insert into hora values(null, '12:00 - 13:00', '18000');
insert into hora values(null, '13:00 - 14:00', '18000');
insert into hora values(null, '14:00 - 15:00', '20000');
insert into hora values(null, '15:00 - 16:00', '20000');
insert into hora values(null, '16:00 - 17:00', '20000');
insert into hora values(null, '17:00 - 18:00', '20000');
insert into hora values(null, '18:00 - 19:00', '20000');
insert into hora values(null, '19:00 - 20:00', '24000');
insert into hora values(null, '20:00 - 21:00', '24000');
insert into hora values(null, '21:00 - 22:00', '24000');
insert into hora values(null, '22:00 - 23:00', '24000');
insert into hora values(null, '23:00 - 24:00', '24000');

select * from hora;

create table cancha(
	id int auto_increment,
	nombre varchar(20),
	primary key(id)
);

insert into cancha values(null, 'cancha1');

create table reserva(
	id int auto_increment,
	fecha_reserva date,/*Fecha que quiere la cancha*/
	hora int,
	cancha int,
	cliente varchar(12),
	fecha_pedido datetime,/*Fecha actual que realizo el pedido*/
	fallo boolean,
	primary key(id),
	foreign key(hora) references hora(id),
	foreign key(cancha) references cancha(id),
	foreign key(cliente) references cliente(rut)
);

create table reservasAdmin(
	id int auto_increment,
	reserva int,
	primary key(id),
	foreign key(reserva) references reserva(id)
);

insert into reserva values(null, '2015-01-08','2','1','11-1','2015-01-07',false);

select * from reserva;

drop table reserva;

delete from reserva where id > 0;

select * from reserva where fecha_reserva = '2015-01-08' and hora = '2' and cancha = '1';


