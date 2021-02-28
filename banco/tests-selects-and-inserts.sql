-- create database avII_desenvweb;
use avII_desenvweb;

-- Select apenas dos links ativos
SELECT `name`, `url` FROM `LINKS` WHERE `status` = true AND (`permanentLink` = true OR (`permanentLink` = false AND `expirationDatetime` > NOW()));

-- Select dados de usuário
SELECT `idUser`, `passwordHash`, `type`, `status` FROM `USER` WHERE `username` = 'rogerec' LIMIT 1;

-- Update hash da senha de um usuário
UPDATE `USER` SET `passwordHash` = "123" WHERE `idUser` = 1 LIMIT 1;