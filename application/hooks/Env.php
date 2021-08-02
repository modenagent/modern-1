<?php

function env() {
	include FCPATH.'vendor/autoload.php';
	$dotenv = Dotenv\Dotenv::createImmutable(FCPATH);
        
    $dotenv->load();
}
