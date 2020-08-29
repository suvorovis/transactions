<?php

use transactions\Config;

Config::set('app.name', 'Transactions');
Config::set('db.host', 'transactions_mysql');
Config::set('db.name', 'transactions');
Config::set('db.port', '3306');
Config::set('db.user', 'transactions');
Config::set('db.password', 'p@ssw0rd');
Config::set('session.lifetime', '600');