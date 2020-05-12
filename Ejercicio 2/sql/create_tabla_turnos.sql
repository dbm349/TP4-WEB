USE TurnosImg;

CREATE TABLE turnos (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre TEXT NOT NULL,
    email TEXT NOT NULL,
    tel TEXT NOT NULL,
    edad INTEGER,
    talla FLOAT,
    altura FLOAT,
    nacimiento TIMESTAMP NOT NULL,
    cpelo TEXT, 
    fechaturno TIMESTAMP NOT NULL,
    horaturno TEXT NOT NULL,
    diagnostico longblob,
    extension TEXT
    );
