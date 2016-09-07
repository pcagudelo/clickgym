
DROP database clickgym;
CREATE database clickgym;
USE clickgym;

create table estado (
    codigoEstado tinyint(4) not null auto_increment,
    nombreEstado varchar(30),
    primary key (codigoEstado)) engine=innoDB ;

create table gimnasio (
    codigoGimnasio smallint(6) not null auto_increment, 
    nombreGimnasio varchar (30) not null,
    departamento varchar (30) not null,
    localidad varchar (30) not null,
    direccion varchar (30) not null,
    telefono varchar (30) not null,
    primary key (codigoGimnasio)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
                      
CREATE TABLE tipoUsuario (
    codigoTUsuario tinyint(4) NOT NULL AUTO_INCREMENT,
    nombreTUsuario varchar(30) NOT NULL,
    primary key (codigoTUsuario)   
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
                    
CREATE TABLE persona (
    cedulaPersona int(11) NOT NULL,
    nombrePersona varchar(30) NOT NULL,
    generoPersona tinyint(4) NOT NULL,
    primary key (cedulaPersona)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
                    
                    
CREATE TABLE usuario (
    codigoUsuario smallint(6) NOT NULL auto_increment,
    nombreUsuario varchar(20) NOT NULL,
    nombreCUsuario varchar(30) NOT NULL,
    claveUsuario varchar(40) NOT NULL,
    fk_codigoGimnasio smallint(6) NOT NULL,
    fk_codigoTUsuario tinyint(4) NOT NULL,
    fk_estadoEstado tinyint(4) NOT NULL,
     	primary key(codigoUsuario),
       	index fkcgim (fk_codigoGimnasio),
        index fkcTUsuario (fk_codigoTUsuario),
        index fkeEstado (fk_estadoEstado),
     	  foreign key (fk_codigoGimnasio) references gimnasio (codigoGimnasio) on delete cascade on update cascade,
        foreign key (fk_codigoTUsuario) references tipoUsuario (codigoTUsuario) on delete cascade on update cascade,
      	foreign key (fk_estadoEstado) references estado (codigoEstado) on delete cascade on update cascade 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE membresia (
  codigoMembresia smallint(11) NOT NULL AUTO_INCREMENT,
  nombreMembresia varchar(30) NOT NULL,
  descripcionMembresia varchar(100) NOT NULL,
  vigenciaMembresia smallint(4) NOT NULL,
  valorMembresia int(11) NOT NULL,
  fk_codigoGimnasio smallint(6) NOT NULL,
  fk_codigoEstado tinyint(4) NOT NULL,
  PRIMARY KEY (codigoMembresia),
   	index fkcEstado (fk_codigoEstado),
    index fkcgim (fk_codigoGimnasio), 
    FOREIGN KEY (fk_codigoEstado) REFERENCES estado (codigoEstado) ON DELETE CASCADE ON UPDATE CASCADE,
    foreign key (fk_codigoGimnasio) references gimnasio (codigoGimnasio) on delete cascade on update cascade
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE inscripcion (
  codigoInscripcion int(11) NOT NULL AUTO_INCREMENT,
  fechaInscripcion date NOT NULL,
  fk_cedulaPersona int(11) NOT NULL,
  fk_codigoEstado tinyint(4) NOT NULL,
  fk_codigoMembresia smallint(6) NOT NULL,
  PRIMARY KEY(codigoInscripcion),
    index fkcPersona (fk_cedulaPersona),
    index fkcEstado (fk_codigoEstado),
    INDEX fkcMembresia (fk_codigoEstado),
    FOREIGN KEY (fk_cedulaPersona) REFERENCES persona (cedulaPersona) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (fk_codigoEstado) REFERENCES estado (codigoEstado) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (fk_codigoMembresia) REFERENCES membresia (codigoMembresia)ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT into estado VALUES (null ,"Habilitado"),(null,"Deshabilitado"),(null,"Pago Realizado"),(null,"Pago Pendiente"),(null,"Anulado");
INSERT INTO tipoUsuario VALUES (null,"Administrador Sistemas"),(null,"Administrador Gimnasio"),(null,"Instructor Gimnasio");
INSERT INTO gimnasio VALUES (null,"ClickGym","Valle del Cauca", "Zarzal", "Cll4 n 9 47","3126021142");
INSERT INTO usuario VALUES (null,"pcagudelo","Pablo Cesar Agudelo",MD5('clave'),1,1,1);