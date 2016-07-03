<?php

namespace TetraFramework\Core;

use TetraFramework\Infra\ConfigParser;

class Bootstrap 
{
	public static function init()
	{ 
		// Adicionando os caminhos do Framework e da Aplicação nos locais da include
		set_include_path(
			get_include_path() 	. PATH_SEPARATOR . 
			FMKROOTPATH 		. PATH_SEPARATOR .
			APPROOTPATH 		. PATH_SEPARATOR
		);

		ConfigParser::setFile(SECURED_FOLDER_PATH . DS . 'config.' . APPLICATION_ENV . '.json');
	}
}
