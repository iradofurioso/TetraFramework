<?php

namespace TetraFramework\Security;

class BootSecurity
{
	
	protected static function stripSlashesDeep($value) 
	{
		$value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
		return $value;
	}

	public static function removeMagicQuotes() 
	{
		if ( get_magic_quotes_gpc() ) 
		{
			$_GET    = self::stripSlashesDeep($_GET);
			$_POST   = self::stripSlashesDeep($_POST);
			$_COOKIE = self::stripSlashesDeep($_COOKIE);
		}
	}

	public static function unregisterGlobals() 
	{
	    if(ini_get('register_globals')) 
	    {
	        $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');

	        foreach($array as $value) 
	        {
	            foreach($GLOBALS[$value] as $key => $var) 
	            {
	                if($var === $GLOBALS[$key]) 
	                {
	                    unset($GLOBALS[$key]);
	                }
	            }
	        }
	    }
	}

}
