<?php	
/**
 * TetraFramework
 * 
 * @package	TetraFramework
 */


/*
 *---------------------------------------------------------------
 * Kickstart - Ponta-pé inicial
 *---------------------------------------------------------------
 *
 * Carrega as configurações vitais definidas no htaccess ou nas 
 * configurações de virtualhost do Apache.
 *
 */

defined('APPLICATION_ENV')
    || define('APPLICATION_ENV',
              (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

define('SECURED_FOLDER_PATH', getenv('SECURED_FOLDER_PATH'));


/*
 *---------------------------------------------------------------
 * Carregamento das configurações
 *---------------------------------------------------------------
 *
 * Carrega o núcleo inicial e as configurações para todo o 
 * framework. 
 *
 */

define('DS', DIRECTORY_SEPARATOR);
define('ROOTDIR', __DIR__);
define('FMKROOTPATH' , ROOTDIR . DS . SECURED_FOLDER_PATH . DS . 'TetraFramework' . DS);
define('APPROOTPATH' , ROOTDIR . DS . SECURED_FOLDER_PATH . DS . 'src' . DS);
define('VENDORPATH' , ROOTDIR . DS . SECURED_FOLDER_PATH . DS . 'vendor' . DS);

require_once(VENDORPATH . 'autoload.php');

use TetraFramework\Core\Bootstrap;
use TetraFramework\Infra\ConfigParser;
use TetraFramework\Security\BootSecurity;
use TetraFramework\Controllers\Dispatcher;

Bootstrap::init();


/*
 *---------------------------------------------------------------
 * Diretivas e ações inicias de segurança.
 *---------------------------------------------------------------
 *
 * Executa algumas ações para garantir uma maior segurança a 
 * aplicação.
 *
 */

BootSecurity::removeMagicQuotes();
BootSecurity::unregisterGlobals();


/*
 *---------------------------------------------------------------
 * Configurações de inicialização padrão para todo o framework.
 *---------------------------------------------------------------
 *
 * Preprando a engine do PHP para as configurações necessárias do 
 * framework.
 *
 */

setlocale(LC_ALL, ConfigParser::get('TetraFramework')->locale);
ini_set('default_charset', ConfigParser::get('TetraFramework')->charset);
mb_internal_encoding(ConfigParser::get('TetraFramework')->charset);
mb_http_output(ConfigParser::get('TetraFramework')->charset); 


/*
 *---------------------------------------------------------------
 * O Fuso horário padrão do TetraFramework
 *---------------------------------------------------------------
 *
 * O fuso horário padrão para todo o sistema, pode variar de 
 * acordo com a área do usuário.
 *
 */

date_default_timezone_set(ConfigParser::get('TetraFramework')->timezone);


/*
 *---------------------------------------------------------------
 * Gerenciamento de erros
 *---------------------------------------------------------------
 *
 * Os ambientes diferentes do servidor podem exigir tratamento de 
 * erros diferentes. Por padrão o ambiente "development" mostra 
 * todos os erros.
 *
 */

switch (APPLICATION_ENV)
{
	case 'development':
		error_reporting(-1);
		ini_set('display_errors', 1);
		ini_set('display_startup_errors',1);
	break;

	case 'testing':
	case 'production':
		ini_set('display_errors', 0);
		if (version_compare(PHP_VERSION, '5.3', '>='))
		{
			error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
		}
		else
		{
			error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
		}
	break;

	default:
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'A variável de ambiente não foi configurada corretamente no arquivo .htaccess.';
		exit(1); 
}


/*
 * --------------------------------------------------------------------
 * Inicializando a aplicação...
 * --------------------------------------------------------------------
 * 
 * Definindo as rotas e carregando a aplicação.
 *
 */

Dispatcher::init();
