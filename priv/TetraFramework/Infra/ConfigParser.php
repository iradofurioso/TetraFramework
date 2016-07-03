<?php

namespace TetraFramework\Infra;

use \InvalidArgumentException;

class ConfigParser
{
	
	private static $file;
	private static $config;
	

	public static function setFile($configFile)
	{
		self::$file = $configFile;
		self::$config = self::parseFile($configFile);
	}
	
	
	public static function get($property)
	{
		if (self::$config === null) 
		{
			throw new InvalidArgumentException(
				'O arquivo de configuração não foi carregado!'
			);
		}
		
		if (!isset(self::$config->$property)) 
		{
			throw new InvalidArgumentException(
				'A propriedade "' . $property . '" não existe!'
			);
		}
		
		return self::$config->$property;
	}

	
	protected static function parseFile($file)
	{
		if (!file_exists($file)) 
		{
			throw new InvalidArgumentException(
				'O arquivo "' . $file . '" não existe!'
			);
		}
		
		return json_decode(file_get_contents($file)); 
	}

}
