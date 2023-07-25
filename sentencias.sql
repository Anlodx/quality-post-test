/*
--LA BASE DE DATOS LLEVA COMO NOMBRE "persons",
-El proyecto consiste en enlistar a los mejores usuarios de qualitypost segun se ingresen en la base de datos
-Consta de una tabla llamada "best_users" que enlistara a los ya antes mencionados, 
-En esta tabla se realizan las principales operaciones de el controlador.
    
*/

-- CREAR LA TABLA PRINCIPAL

CREATE TABLE `persons`.`best_users` (`id` INT NOT NULL AUTO_INCREMENT , `name` TEXT NOT NULL , `address` TEXT NOT NULL , `age` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;


-- INSERTAR UN REGISTRO

INSERT INTO `best_users` (`id`, `name`, `address`, `age`) VALUES (NULL, 'ANGEL HERNANDEZ', 'EL MUNDO ENTERO', '21')


-- ACTUALIZARLO

UPDATE `best_users` SET `name` = 'ANGEL HERNANDEZ HDEZ', `address` = 'MEXICO, NUEVO LEON', `age` = '20' WHERE `best_users`.`id` = 1

--BORRARLO
DELETE FROM best_users WHERE `best_users`.`id` = 1

-- MOSTRAR TODOS

SELECT * FROM `best_users`