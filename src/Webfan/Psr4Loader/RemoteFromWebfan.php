<?php 


namespace Webfan\Psr4Loader;




class RemoteFromWebfan
{

	protected $selfDomain;
	protected $server;
	protected $domain;
	protected $version;
	protected $allowFromSelfOrigin = false;
	
	protected static $instances = [];
	
	
	function __construct($server = 'frdl.webfan.de', $register = true, $version = 'latest', $allowFromSelfOrigin = false){
		$this->allowFromSelfOrigin = $allowFromSelfOrigin;
		$this->version=$version;
		$this->server = $server;	
		$_self = (isset($_SERVER['SERVER_NAME'])) ? $_SERVER['SERVER_NAME'] : $_SERVER['HTTP_HOST'];
		$h = explode('.', $_self);
		$dns = array_reverse($h);
		$this->selfDomain = $dns[1].'.'.$dns[0];
		
		$h = explode('.', $this->server);
		$dns = array_reverse($h);
		$this->domain = $dns[1].'.'.$dns[0];
		
		
		if(!$this->allowFromSelfOrigin && $this->domain === $this->selfDomain){
		  $register = false;	
		}
		
		if(true === $register){
		   $this->register();	
		}		
	}
	
	
  public static function getInstance($server = 'frdl.webfan.de', $register = false, $version = 'latest', $allowFromSelfOrigin = false){
	  if(!isset(self::$instances[$server])){
		  self::$instances[$server] = new self($server, $register, $version, $allowFromSelfOrigin);
	  }
	  
	 return self::$instances[$server];
  }	
	
  public static function __callStatic($name, $arguments){
	  $me = (count(self::$instances)) ? self::$instances[0] : self::getInstance();
	   return call_user_func_array([$me, $name], $arguments);	
  }
	
  public function __call($name, $arguments){
	   if(!in_array($name, ['fetch', 'fetchCode', '__invoke', 'register', 'getLoader', 'Autoload'])){
		  throw new \Exception('Method '.$name.' not allowed in '.__METHOD__);   
	   }
	   return call_user_func_array([$this, $name], $arguments);	
  }	
	
  protected function fetch(){
	  return call_user_func_array([$this, 'fetchCode'], func_get_args());	
  }
	
	
  protected function fetchCode($class, $salt = null){
	if(!is_string($salt)){
		$salt = mt_rand(10000000,99999999);
	}
	  
	  
	$url =	'https://'.$this->server.'/install/?salt='.$salt.'&source='. $class.'&version='.$this->version;


	$options = [
		'https' => [
           'method'  => 'GET',
            'ignore_errors' => true,        
  
		   ]
	];
    $context  = stream_context_create($options);
    $code = @file_get_contents($url, false, $context);
	foreach($http_response_header as $i => $header){
		$h = explode(':', $header);
		if('x-content-hash' === strtolower(trim($h[0]))){
			$hash = trim($h[1]);
		}		
		if('x-user-hash' === strtolower(trim($h[0]))){
			$userHash = trim($h[1]);
		}		
	}	  
	  
	  
    if(false===$code || !isset($hash) || !isset($userHash)){
		return false;
	}
	

	
	$oCode =$code;
	

	$hash_check = strlen($oCode).'.'.sha1($oCode);
	$userHash_check = sha1($salt .$hash_check);	
   
     if(false!==$salt){
	   if($hash_check !== $hash || $userHash_check !== $userHash){
		   throw new \Exception('Invalid checksums while fetching source code for '.$class.' from '.$url);
	   }	   	
     }	

  $code = trim($code);
  if('<?php' === substr($code, 0, strlen('<?php')) ){
	  $code = substr($code, strlen('<?php'), strlen($code));
  }
    $code = trim($code, '<?php> ');
  $codeWithStartTags = "<?php "."\n".$code;	
		
    return $codeWithStartTags;
 }
	
	
	
	public function __invoke(){
	   return call_user_func_array($this->getLoader(), func_get_args());	
	}
	
	protected function register($throw = true, $prepend = false){
		
		if(!$this->allowFromSelfOrigin && $this->domain === $this->selfDomain){
		   throw new \Exception('You should not autoload from remote where you have local access to the source (remote server = host)');
		}		
		
		if(!in_array($this->getLoader(), spl_autoload_functions()) ){
			return spl_autoload_register($this->getLoader(), $throw, $prepend);
		}
	}
	
	protected function getLoader(){
		return [$this, 'Autoload'];
	}
	
  protected function Autoload($class){
	$cacheFile = ((isset($_ENV['FRDL_HPS_PSR4_CACHE_DIR'])) ? $_ENV['FRDL_HPS_PSR4_CACHE_DIR'] 
                   : sys_get_temp_dir() . \DIRECTORY_SEPARATOR. 'psr4'. \DIRECTORY_SEPARATOR
					  )
		         
	            	.  str_replace('\\', \DIRECTORY_SEPARATOR, $class). '.php';
	
 

	
	if(file_exists($cacheFile) 
	   && (!isset($_ENV['FRDL_HPS_PSR4_CACHE_LIMIT'])  
								   || (filemtime($cacheFile) > time() - ((isset($_ENV['FRDL_HPS_PSR4_CACHE_LIMIT']) ) ? intval($_ENV['FRDL_HPS_PSR4_CACHE_LIMIT']) :  3 * 60 * 60)) )){
	   require $cacheFile;
       return true;
	}


	$code = $this->fetchCode($class, null);
	



	if(false !==$code){			
		if(!is_dir(dirname($cacheFile))){			
		  mkdir(dirname($cacheFile), 0755, true);
		}
		
      if(isset($_ENV['FRDL_HPS_PSR4_CACHE_LIMIT']) 
		  && file_exists($cacheFile) 
	      && (filemtime($cacheFile) < time() - ((isset($_ENV['FRDL_HPS_PSR4_CACHE_LIMIT']) ) ? intval($_ENV['FRDL_HPS_PSR4_CACHE_LIMIT']) :  3 * 60 * 60)) ){
		     unlink($cacheFile);
      }	
	 //  if(!file_put_contents($cacheFile, $code)){
	  //   throw new \Exception('Cannot write '.$url.' to '.$cacheFile);/*   error_log('Cannot write '.$url.' to '.$cacheFile, \E_WARNING); */
	 //  }
		file_put_contents($cacheFile, $code);
	  		
   }//if(false !==$code)	
	
	
	
	if(file_exists($cacheFile) ){
	    if(false === (require $cacheFile)){
			unlink($cacheFile);
		}
	  	return true;	
	}elseif(false !==$code){
		$code =ltrim($code, '<?php');
		$code =rtrim($code, '?php>');	
		eval($code);
		return true;	
	}
			
  }
	
}
