CREATE DATABASE IF NOT EXISTS laravel_master;
USE laravel_master;

CREATE TABLE users(
    id              int(255) auto_increment not null,
    role            varchar(20),
    name            varchar(100),
    surname         varchar(100),
    nick            varchar(100),
    email           varchar(255),
    password     varchar(255),
    image           varchar(255),
    created_at      datetime,
    updated_at      datetime,
    remember_token  varchar(255),

    CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE = InnoDb;

INSERT INTO users VALUES(
                         NULL,
                         'user',
                         'pedro',
                         'Pascal',
                         'Pascalito',
                         'pascal@pascal.com',
                         'pascalito123',
                         null,
                         CURTIME(),
                         CURTIME(),
                         NULL
                        );
INSERT INTO users VALUES(
                         NULL,
                         'admin',
                         'nick',
                         'Cage',
                         'GhostRider',
                         'ghost@rider.com',
                         'diablo66',
                         null,
                         CURTIME(),
                         CURTIME(),
                         NULL
                        );

INSERT INTO users VALUES(
                         NULL,
                         'user',
                         'Juan',
                         'Rudas',
                         'HAHAHAHAHAA',
                         'rudas@rudas.com',
                         'rudas123',
                         null,
                         CURTIME(),
                         CURTIME(),
                         NULL
                        );

CREATE TABLE  IF NOT EXISTS image(
    id              int(255) auto_increment not null,
    user_id         int(255),
    imagen_path     varchar(255),
    description     varchar(255),
    created_at      datetime,
    updated_at      datetime,

    CONSTRAINT pk_image PRIMARY KEY(id),
    CONSTRAINT fk_image_users FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE = InnoDb;

INSERT INTO image VALUES(
                         NUll,
                         1,
                         'text.jpg',
                         'descripcion de prueba 1',
                         CURTIME(),
                         CURTIME()
                        );
INSERT INTO image VALUES(
                            NUll,
                            1,
                            'text2.jpg',
                            'descripcion de prueba 2',
                            CURTIME(),
                            CURTIME()
                        );
INSERT INTO image VALUES(
                            NUll,
                            1,
                            'text3.jpg',
                            'descripcion de prueba 3',
                            CURTIME(),
                            CURTIME()
                        );
INSERT INTO image VALUES(
                            NUll,
                            2,
                            'ghostRider.jpg',
                            'descripcion de prueba 4 GHOST RIDER',
                            CURTIME(),
                            CURTIME()
                        );

CREATE TABLE  IF NOT EXISTS coment(
    id              int(255) auto_increment not null,
    user_id			int(255),
    image_id		int(255),
    content			text,
    created_at      datetime,
    updated_at      datetime,

    CONSTRAINT pk_coment PRIMARY KEY(id),
    CONSTRAINT fk_coment_users FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT fk_coment_image FOREIGN KEY(image_id) REFERENCES image(id)
)ENGINE = InnoDb;

INSERT INTO coment VALUES(
                          NULL,
                          1,
                          4,
                          'Buena foto del vengador',
                          CURTIME(),
                          CURTIME()
                         );
INSERT INTO coment VALUES(
                             NULL,
                             2,
                             1,
                             'Buena foto ',
                             CURTIME(),
                             CURTIME()
                         );
INSERT INTO coment VALUES(
                             NULL,
                             2,
                             4,
                             'Buena foto ',
                             CURTIME(),
                             CURTIME()
                         );




CREATE TABLE  IF NOT EXISTS `like`(
    id              int(255) auto_increment not null,
    user_id			int(255),
    image_id		int(255),
    created_at      datetime,
    updated_at      datetime,

    CONSTRAINT pk_like PRIMARY KEY(id),
    CONSTRAINT fk_like_users FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT fk_like_image FOREIGN KEY(image_id) REFERENCES image(id)
)ENGINE = InnoDb;

INSERT INTO `like`VALUES(
                         NULL,
                         1,
                         4,
                         CURTIME(),
                         curtime()
                        );
INSERT INTO `like`VALUES(
                            NULL,
                            2,
                            4,
                            CURTIME(),
                            curtime()
                        );
INSERT INTO `like`VALUES(
                            NULL,
                            3,
                            1,
                            CURTIME(),
                            curtime()
                        );
INSERT INTO `like`VALUES(
                            NULL,
                            3,
                            2,
                            CURTIME(),
                            curtime()
                        );
INSERT INTO `like`VALUES(
                            NULL,
                            2,
                            1,
                            CURTIME(),
                            curtime()
                        );
