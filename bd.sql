CREATE DATABASE cinema;

CREATE TABLE IF NOT EXISTS sala (
  numero int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  numacentos int(11) NOT NULL,
  status tinyint(1) DEFAULT '1',
  PRIMARY KEY (numero)
)
CREATE TABLE IF NOT EXISTS problema (
  id int(11) NOT NULL AUTO_INCREMENT,
  descricao varchar(500) NOT NULL,
  data date NOT NULL,
  urgencia varchar(60) NOT NULL,
  numero int(6) UNSIGNED NOT NULL,
  status boolean,
  PRIMARY KEY (id),
  KEY fk_sala_id (numero)
)

INSERT INTO sala (numero, numacentos, status) VALUES
(1, 60, 1),
(2, 50, 1),
(3, 100, 1),
(4, 75, 1),
(5, 80, 1),
(6, 100, 1),
(7, 80, 1),
(8, 50, 1);