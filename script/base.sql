-- prueba.messenger_messages definition

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8_unicode_ci NOT NULL,
  `queue_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- prueba.`user` definition

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `puesto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- prueba.valor_horas definition

CREATE TABLE `valor_horas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hora_extra` int(11) NOT NULL,
  `detalle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- prueba.horas_extra definition

CREATE TABLE `horas_extra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `valor_horas_id` int(11) NOT NULL,
  `actividad` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C82D58F6A76ED395` (`user_id`),
  KEY `IDX_C82D58F6DD927CFF` (`valor_horas_id`),
  CONSTRAINT `FK_C82D58F6A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_C82D58F6DD927CFF` FOREIGN KEY (`valor_horas_id`) REFERENCES `valor_horas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO prueba.`user` (username,roles,password,nombre,apellido,puesto) VALUES
	 ('administrador','["ROLE_ADMIN"]','$2y$13$RahTYfU2G1A9.zSBO4odeeEn8Tt4eiigdqHrUq8u/zJpe6WwwuZni','administrador','administrador',NULL),
	 ('Santi312B','["ROLE_USER"]','$2y$13$XoSGxUVQjmpx4p.mDiugB./vcZL4aHdMhRKYov.loftPRY2bniZri','Santiago','Suárez','Empleado');

INSERT INTO prueba.`valor_horas` (hora_extra,detalle) VALUES
	 (7,'Des pues de jornada laboral'),
	 (5,'Fin de semana');


INSERT INTO prueba.`horas_extra` (user_id,valor_horas_id,actividad) VALUES
	 (2,1,'Recolección de datos'),
	 (2,2,'Diseño');