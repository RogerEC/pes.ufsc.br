-- create database avII_desenvweb;
use avII_desenvweb;

-- Select apenas dos links ativos
SELECT `name`, `url` FROM `LINKS` WHERE `status` = true AND (`permanentLink` = true OR (`permanentLink` = false AND `expirationDatetime` > NOW()));