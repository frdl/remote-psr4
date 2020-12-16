<?php
namespace frdl\implementation\psr4;


$oldc = file_get_contents(__FILE__);
$code = file_get_contents('https://frdl.webfan.de/install/?salt='.sha1(mt_rand(1000,9999)).'&source=\frdl\implementation\psr4\RemoteAutoloader');
try{
if(false === $code){
  throw new \Exception(sprintf('Could not load %s from %s', \frdl\implementation\psr4\RemoteAutoloader::class, 'frdlwebfan.de'));
}

  file_put_contents(__FILE__, $code);
 
// return require __FILE__;

}catch(\Exception $e){
   file_put_contents(__FILE__, $oldc);
    throw $e;
}



class RemoteAutoloader
{

	protected $salted = true;
	
	protected $selfDomain;
	protected $server;
	protected $domain;
	protected $version;
	protected $allowFromSelfOrigin = false;
	
	protected static $prefixes = [];
	
	protected static $instances = [];
	protected static $classmap = [
	    \Wehowski\Gist\Http\Response\Helper::class => 'https://gist.githubusercontent.com/wehowski/d762cc34d5aa2b388f3ebbfe7c87d822/raw/5c3acdab92e9c149082caee3714f0cf6a7a9fe0b/Wehowski%255CGist%255CHttp%255CResponse%255CHelper.php?cache_bust=${salt}',
	];
	
	
   public function __construct($server = 'frdl.webfan.de', $register = true, $version = 'latest', $allowFromSelfOrigin = false, $salted = true, $classMap = null){
	        $this->withSalt($salted);
	        $this->withClassmap($classMap);
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
	
    public function withNamespace($prefix, $server, $prepend = false)
    {
        // normalize namespace prefix
        $prefix = trim($prefix, '\\') . '\\';

        // normalize the base directory with a trailing separator
     //   $base_dir = rtrim($base_dir, DIRECTORY_SEPARATOR) . '/';

        // initialize the namespace prefix array
        if (isset($this->prefixes[$prefix]) === false) {
            $this->prefixes[$prefix] = [];
        }

        // retain the base directory for the namespace prefix
        if ($prepend) {
            array_unshift($this->prefixes[$prefix], $server);
        } else {
            array_push($this->prefixes[$prefix], $server);
        }
    }

	
   public function getUrl($class, $server){
	  $url = false; 
			
			if(is_string($server) && '\\' === substr($server, -1)  ){
				return $this->loadClass( $server.ltrim(str_replace($server, '', $class), '/\\') );
		   }	
		 
     if(is_string($server) && substr($server, 0, strlen('http://')) === 'http://' || substr($server, 0, strlen('https://')) === 'https://'){
	    $url = str_replace(['${salt}', '${class}', '${version}'], [$salt, $class, $this->version], $server);   
     }elseif(is_string($server) && '~' === substr($server, 0, 1) || is_string($server) && '.' === substr($server, 0, 1) || substr($server, 0, strlen('file://')) === 'file://'){
	    $url =  \DIRECTORY_SEPARATOR.str_replace('\\', \DIRECTORY_SEPARATOR,
												 getcwd() .str_replace(['file://', '~', '${salt}', '${class}', '${version}'],
																	   ['', (!empty(getenv('FRDL_HOME'))) ? getenv('FRDL_HOME') : '', $salt, $class, $this->version],
																	   $server). '.php');   
     }elseif(is_string($server)){	  
	    $url = 'https://'.$server.'/install/?salt='.$salt.'&source='. $class.'&version='.$this->version;
     }elseif(is_callable($server)){
	    $url = call_user_func_array($server, [$class, $this->version, $salt]);	  
     }elseif(is_object($server)  && is_callable([$server, 'has']) && is_callable([$server, 'get']) && true === call_user_func_array([$server, 'has'], [$class]) ){
	    $url = call_user_func_array([$server, 'get'], [$class, $this->version, $salt]);	  
     }elseif(is_object($server) && is_callable([$server, 'get']) ){
	    $url = call_user_func_array([$server, 'get'], [$class, $this->version, $salt]);	  
     }
	   return  (is_string($url)) ? str_replace(['${salt}', '${class}', '${version}'], [$salt, 
																   $class,
																   $this->version], $url)
		    : $url;
   }
    /**
     * Loads the class file for a given class name.
     *
     * @param string $class The fully-qualified class name.
     * @return mixed The mapped file name on success, or boolean false on
     * failure.
     */
    public function loadClass($class)
    {
		
        // the current namespace prefix
        $prefix = $class;
	
		
        // work backwards through the namespace names of the fully-qualified
        // class name to find a mapped file name
        while (false !== $pos = strrpos($prefix, '\\')) {

            // retain the trailing namespace separator in the prefix
            $prefix = substr($class, 0, $pos + 1);

            // the rest is the relative class name
            $relative_class = substr($class, $pos + 1);

		
            // try to load a mapped file for the prefix and relative class
            $mapped_file = $this->loadMappedSource($prefix, $relative_class);
            if ($mapped_file) {
                return $mapped_file;
            }

            // remove the trailing namespace separator for the next iteration
            // of strrpos()
            $prefix = rtrim($prefix, '\\');
        }

        // never found a mapped file
        return false;
    }

    /**
     * Load the mapped file for a namespace prefix and relative class.
     *
     * @param string $prefix The namespace prefix.
     * @param string $relative_class The relative class name.
     * @return mixed Boolean false if no mapped file can be loaded, or the
     * name of the mapped file that was loaded.
     */
    protected function loadMappedSource($prefix, $relative_class)
    {
		$url = false;
	/*		
		if(isset(self::$classmap[$class]) && is_string(self::$classmap[$class]) && '\\' !== substr($class, -1)  && '\\' !== substr(self::$classmap[$class], -1) ){
			return self::$classmap[$class];
		}
		*/
        // are there any base directories for this namespace prefix?
      //  if (isset($this->prefixes[$prefix]) === false) {
      //      return false;
      //  }

	if (isset($this->prefixes[$prefix]) !== false) {
        // look through base directories for this namespace prefix
        foreach ($this->prefixes[$prefix] as $server) {

			$url = $this->getUrl($relative_class, $server);
			
			if(is_string($url) && $this->exists($url)){
			  //return $url;
				break;
			}
        }
	}
        // never found it
        return $url;
    }

    /**
     * If a file exists, require it from the file system.
     *
     * @param string $file The file to require.
     * @return bool True if the file exists, false if not.
     */
  protected function requireFile($file){
        if (file_exists($file)) {
            require $file;
            return true;
        }
        return false;
  }	
  public function withClassmap(array $classMap = null){
     if(null !== $classMap){
	   foreach($classMap as $class => $server){
		   if('\\' === substr($class, -1)){
               $this->withNamespace($class, $server, is_string($server));		
		   }else{
		        self::$classmap[$class] = $server;   
		   }

	   }
     }
	  
    return self::$classmap;	  
  }	

  public function withSalt(bool $salted = null){
     if(null !== $salted){
	     $this->salted = $salted; 
     }
	  
    return $this->salted;	  
  }
	
	
  public static function getInstance($server = 'frdl.webfan.de', $register = false, $version = 'latest', $allowFromSelfOrigin = false, $salted = true, $classMap = null){
	  if(is_array($server)){
	      $arr = [];
	      foreach($server as $s){
		  $arr[]= self::getInstance($s['server'], $s['register'], $s['version'], $s['allowFromSelfOrigin'], $s['salted'], $s['classmap']);      
	      }
		  
	    return $arr;	  
	  }elseif(is_callable($server)){
		$key = \spl_object_id($server);  
	  }elseif(is_string($server)){
		$key = $server;  
	  }
	  
	  if(!isset(self::$instances[$server])){
		  self::$instances[$server] = new self($server, $register, $version, $allowFromSelfOrigin, $salted, $classMap = null);
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
	
  public function exists($source){
	if(is_file($source) && file_exists($source) && is_readable($source)){
		return true;
	}
	  
	$options = [
		'https' => [
           'method'  => 'HEAD',
            'ignore_errors' => true,        
  
		   ]
	];
    $context  = stream_context_create($options);
    $res = @file_get_contents($source, false, $context);
	return false !== $res;  
  }
	
  protected function fetchCode($class, $salt = null){	
	  /*
        $server = (isset(self::$classmap[$class]))
		? self::$classmap[$class]
		: $this->server; 
	  */
	if(!is_string($salt) && true === $this->withSalt()){
		$salt = mt_rand(10000000,99999999);
	}
	  
	/*
	//$class = str_replace('\\', '/', $class);  
     
	
    if(is_callable($server)){
	$url = call_user_func_array($server, [$class, $this->version, $salt]);	  
     }elseif(substr($server, 0, strlen('http://')) === 'http://' || substr($server, 0, strlen('https://')) === 'https://'){
	  $url = str_replace(['${salt}', '${class}', '${version}'], [$salt, $class, $this->version], $server);   
     }else{	  
	  $url = 'https://'.$server.'/install/?salt='.$salt.'&source='. $class.'&version='.$this->version;
     }
*/
	  $url = $this->loadClass($class);

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
	  
	  
   
	  if(false===$code || !is_string($code) || (true === $this->withSalt() && (!isset($hash) || !isset($userHash)))){	
		  return false;	
	  }
	
	
	  $oCode =$code;
	

	$hash_check = strlen($oCode).'.'.sha1($oCode);
	$userHash_check = sha1($salt .$hash_check);	
   
     if(false!==$salt && true === $this->withSalt()){
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
	    if(false === ($this->requireFile($cacheFile)) && file_exists($cacheFile)){
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
