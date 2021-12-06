<?php 


namespace Webfan\Autoloader;




class RemoteFallbackLoader {

	protected $salted = true;
	
	protected $selfDomain;
	protected $server;
	protected $domain;
	protected $version;
	protected $allowFromSelfOrigin = false;
	
	protected static $instances = [];
	protected static $classmap = [
	    \Wehowski\Gist\Http\Response\Helper::class => 'https://gist.githubusercontent.com/wehowski/d762cc34d5aa2b388f3ebbfe7c87d822/raw/5c3acdab92e9c149082caee3714f0cf6a7a9fe0b/Wehowski%255CGist%255CHttp%255CResponse%255CHelper.php?cache_bust=${salt}',
				'GuzzleHttp\\uri_template' => 'https://03.webfan.de/install/?salt=${salt}&version=${version}&source=GuzzleHttp\choose_handler',
		'GuzzleHttp\\describe_type' => 'https://03.webfan.de/install/?salt=${salt}&version=${version}&source=GuzzleHttp\choose_handler',
		'GuzzleHttp\\headers_from_lines' => 'https://03.webfan.de/install/?salt=${salt}&version=${version}&source=GuzzleHttp\choose_handler',
		'GuzzleHttp\\debug_resource' => 'https://03.webfan.de/install/?salt=${salt}&version=${version}&source=GuzzleHttp\choose_handler',
		'GuzzleHttp\\choose_handler' => 'https://03.webfan.de/install/?salt=${salt}&version=${version}&source=GuzzleHttp\choose_handler',
		'GuzzleHttp\\default_user_agent' => 'https://03.webfan.de/install/?salt=${salt}&version=${version}&source=GuzzleHttp\choose_handler',
		'GuzzleHttp\\default_ca_bundle' => 'https://03.webfan.de/install/?salt=${salt}&version=${version}&source=GuzzleHttp\choose_handler',
		'GuzzleHttp\\normalize_header_keys' => 'https://03.webfan.de/install/?salt=${salt}&version=${version}&source=GuzzleHttp\choose_handler',
		'GuzzleHttp\\is_host_in_noproxy' => 'https://03.webfan.de/install/?salt=${salt}&version=${version}&source=GuzzleHttp\choose_handler',
		'GuzzleHttp\\json_decode' => 'https://03.webfan.de/install/?salt=${salt}&version=${version}&source=GuzzleHttp\choose_handler',
		'GuzzleHttp\\json_encode' => 'https://03.webfan.de/install/?salt=${salt}&version=${version}&source=GuzzleHttp\choose_handler',
		
	\GuzzleHttp\LoadGuzzleFunctionsForFrdl::class => 'https://03.webfan.de/install/?salt=${salt}&version=${version}&source=GuzzleHttp\LoadGuzzleFunctionsForFrdl',
		 
		'GuzzleHttp\\Psr7\\uri_for' =>  'https://03.webfan.de/install/?salt=${salt}&version=${version}&source=GuzzleHttp\Psr7\uri_for',
		
	
		
	\webfan\hps\Format\DataUri::class => 'https://03.webfan.de/install/?salt=${salt}&source=webfan\hps\Format\DataUri',
	'frdl\\Proxy\\' => 'https://raw.githubusercontent.com/frdl/proxy/master/src/${class}.php?cache_bust=${salt}',
	 \frdlweb\Thread\ShutdownTasks::class => 'https://raw.githubusercontent.com/frdl/shutdown-helper/master/src/ShutdownTasks.php?cache_bust=${salt}',

		
		'Fusio\\Adapter\\Webfantize\\' => 'https://raw.githubusercontent.com/frdl/fusio-adapter-webfantize/master/src/${class}.php?cache_bust=${salt}',
		
		//frdl\implementation\psr4 
		//Nette\Loaders\FrdlRobotLoader
		'@frdl\\implementation\\Autoload\\Local' =>  \Webfan\Autoload\ClassMapGenerator::class,
		/* \Nette\Loaders\FrdlRobotLoader::class, */
		'@frdl\\implementation\\Autoload\\Remote' => __CLASS__,
		'@frdl\\implementation\\Build\\ClassMap' => \Webfan\Autoload\ClassMapGenerator::class,
		'@frdl\\implementation\\Autoload' => __CLASS__,
		
		/*
		 \Webfan\Autoupdate\SVLClassInterface::class=>
		    'https://cdn.frdl.io/@webfan3/stubs-and-fixtures/classes/frdl/implementation/psr4/RemoteAutoloader',
		  \Webfan\Autoupdate\SVLClassTrait::class =>  
		     'https://cdn.frdl.io/@webfan3/stubs-and-fixtures/classes/frdl/implementation/psr4/RemoteAutoloader',
			 */
			 
    // NAMESPACES
    // Zend Framework components
    '@Zend\\AuraDi\\Config' => 'Laminas\\AuraDi\\Config',
    '@Zend\\Authentication' => 'Laminas\\Authentication',
    '@Zend\\Barcode' => 'Laminas\\Barcode',
    '@Zend\\Cache' => 'Laminas\\Cache',
    '@Zend\\Captcha' => 'Laminas\\Captcha',
    '@Zend\\Code' => 'Laminas\\Code',
    '@ZendCodingStandard\\Sniffs' => 'LaminasCodingStandard\\Sniffs',
    '@ZendCodingStandard\\Utils' => 'LaminasCodingStandard\\Utils',
    '@Zend\\ComponentInstaller' => 'Laminas\\ComponentInstaller',
    '@Zend\\Config' => 'Laminas\\Config',
    '@Zend\\ConfigAggregator' => 'Laminas\\ConfigAggregator',
    '@Zend\\ConfigAggregatorModuleManager' => 'Laminas\\ConfigAggregatorModuleManager',
    '@Zend\\ConfigAggregatorParameters' => 'Laminas\\ConfigAggregatorParameters',
    '@Zend\\Console' => 'Laminas\\Console',
    '@Zend\\ContainerConfigTest' => 'Laminas\\ContainerConfigTest',
    '@Zend\\Crypt' => 'Laminas\\Crypt',
    '@Zend\\Db' => 'Laminas\\Db',
    '@ZendDeveloperTools' => 'Laminas\\DeveloperTools',
    '@Zend\\Di' => 'Laminas\\Di',
    '@Zend\\Diactoros' => 'Laminas\\Diactoros',
    '@ZendDiagnostics\\Check' => 'Laminas\\Diagnostics\\Check',
    '@ZendDiagnostics\\Result' => 'Laminas\\Diagnostics\\Result',
    '@ZendDiagnostics\\Runner' => 'Laminas\\Diagnostics\\Runner',
    '@Zend\\Dom' => 'Laminas\\Dom',
    '@Zend\\Escaper' => 'Laminas\\Escaper',
    '@Zend\\EventManager' => 'Laminas\\EventManager',
    '@Zend\\Feed' => 'Laminas\\Feed',
    '@Zend\\File' => 'Laminas\\File',
    '@Zend\\Filter' => 'Laminas\\Filter',
    '@Zend\\Form' => 'Laminas\\Form',
    '@Zend\\Http' => 'Laminas\\Http',
    '@Zend\\HttpHandlerRunner' => 'Laminas\\HttpHandlerRunner',
    '@Zend\\Hydrator' => 'Laminas\\Hydrator',
    '@Zend\\I18n' => 'Laminas\\I18n',
    '@Zend\\InputFilter' => 'Laminas\\InputFilter',
    '@Zend\\Json' => 'Laminas\\Json',
    '@Zend\\Ldap' => 'Laminas\\Ldap',
    '@Zend\\Loader' => 'Laminas\\Loader',
    '@Zend\\Log' => 'Laminas\\Log',
    '@Zend\\Mail' => 'Laminas\\Mail',
    '@Zend\\Math' => 'Laminas\\Math',
    '@Zend\\Memory' => 'Laminas\\Memory',
    '@Zend\\Mime' => 'Laminas\\Mime',
    '@Zend\\ModuleManager' => 'Laminas\\ModuleManager',
    '@Zend\\Mvc' => 'Laminas\\Mvc',
    '@Zend\\Navigation' => 'Laminas\\Navigation',
    '@Zend\\Paginator' => 'Laminas\\Paginator',
    '@Zend\\Permissions' => 'Laminas\\Permissions',
    '@Zend\\Pimple\\Config' => 'Laminas\\Pimple\\Config',
    '@Zend\\ProblemDetails' => 'Mezzio\\ProblemDetails',
    '@Zend\\ProgressBar' => 'Laminas\\ProgressBar',
    '@Zend\\Psr7Bridge' => 'Laminas\\Psr7Bridge',
    '@Zend\\Router' => 'Laminas\\Router',
    '@Zend\\Serializer' => 'Laminas\\Serializer',
    '@Zend\\Server' => 'Laminas\\Server',
    '@Zend\\ServiceManager' => 'Laminas\\ServiceManager',
    '@ZendService\\ReCaptcha' => 'Laminas\\ReCaptcha',
    '@ZendService\\Twitter' => 'Laminas\\Twitter',
    '@Zend\\Session' => 'Laminas\\Session',
    '@Zend\\SkeletonInstaller' => 'Laminas\\SkeletonInstaller',
    '@Zend\\Soap' => 'Laminas\\Soap',
    '@Zend\\Stdlib' => 'Laminas\\Stdlib',
    '@Zend\\Stratigility' => 'Laminas\\Stratigility',
    '@Zend\\Tag' => 'Laminas\\Tag',
    '@Zend\\Test' => 'Laminas\\Test',
    '@Zend\\Text' => 'Laminas\\Text',
    '@Zend\\Uri' => 'Laminas\\Uri',
    '@Zend\\Validator' => 'Laminas\\Validator',
    '@Zend\\View' => 'Laminas\\View',
    '@ZendXml' => 'Laminas\\Xml',
    '@Zend\\Xml2Json' => 'Laminas\\Xml2Json',
    '@Zend\\XmlRpc' => 'Laminas\\XmlRpc',
    '@ZendOAuth' => 'Laminas\\OAuth',	
		
		
		//https://raw.githubusercontent.com/elastic/elasticsearch-php/v7.12.0/src/autoload.php
	'Elasticsearch\\' => 'https://raw.githubusercontent.com/elastic/elasticsearch-php/v7.12.0/src/${class}.php?cache_bust=${salt}',
		
		\WeidDnsConverter::class =>
		'https://raw.githubusercontent.com/frdl/oid2weid/master/src/WeidDnsConverter.php?cache_bust=${salt}',
		\WeidHelper::class =>
		'https://raw.githubusercontent.com/frdl/oid2weid/master/src/WeidHelper.php?cache_bust=${salt}',
		\WeidOidConverter::class =>
		'https://raw.githubusercontent.com/frdl/oid2weid/master/src/WeidOidConverter.php?cache_bust=${salt}',
	];
	
	protected static $prefixes = [];
	protected static $registeredGlobal = false;
	
   public function __construct($server=null,// = 'frdl.webfan.de', 
			       $register = true, 
			       $version = 'latest', 
			       $allowFromSelfOrigin = false,
			       $salted = true,
			      $classMap =null, 
			        $prefix = '',			
			       $prependPrefix = false
			      ){
	   if(null===$server){
		 $server  = 'https://startdir.de/install/?salt=${salt}&source=${class}';   
	   }
	   
	   if(null===$classMap){
		 $classMap  = self::$classmap;   
	   }
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
		   $this->registerGlobal();
		}		
	   
	     if(is_string($prefix)){
		 self::addNamespace($prefix, $this, $prependPrefix); 
	     }
	}
	
	
public function AutoloadGlobal($class){
	 $prefix = $class;

        // work backwards through the namespace names of the fully-qualified
        // class name to find a mapped file name
         while (false !== $pos = strrpos($prefix, '\\')) {

            // retain the trailing namespace separator in the prefix
            $prefix = substr($class, 0, $pos + 1);

            // the rest is the relative class name
            $relative_class = substr($class, $pos + 1);


      
  
		 if (isset(self::$prefixes[$prefix]) ) {    	    
			 foreach (self::$prefixes[$prefix] as $server) {  		  
				 if ($server instanceof self && $server->Autoload($relative_class)) {  		
					 return true;           
				 }       	  	   
			 }      
		 }
            $prefix = rtrim($prefix, '\\');	
	 }	

  return $this->Autoload($class);	
}
	
	
	public function registerGlobal($prepend = false){
		if(false !== self::$registeredGlobal){
		  return self::$registeredGlobal;	
		}
		
		
		
		if(!$this->allowFromSelfOrigin && $this->domain === $this->selfDomain){
		   throw new \Exception('You should not autoload from remote where you have local access to the source (remote server = host)');
		}		
		
		self::$registeredGlobal =$this->register($prepend); 
	
	}	
		
	public static function getLoaderGlobal(){
	   return self::getInstance()->getLoader();
		//  $firstMutex = (count(self::$instances)) ? self::$instances[0] : self::getInstance();
	     //return [$firstMutex, 'AutoloadGlobal'];
	}
	
   public static function addNamespace($prefix, self &$server, $prepend = false)
    {
        // normalize namespace prefix
        $prefix = trim($prefix, '\\') . '\\';

        // normalize the base directory with a trailing separator
      

        // initialize the namespace prefix array
        if (!isset(self::$prefixes[$prefix])) {
            self::$prefixes[$prefix] = [];
        }

        // retain the base directory for the namespace prefix
        if ($prepend) {
            array_unshift(self::$prefixes[$prefix], $server);
        } else {
            array_push(self::$prefixes[$prefix], $server);
        }
  }
	
	
  public function withClassmap(  $classMap = null){
     if(is_array($classMap)){
	   foreach($classMap as $class => $server){
		self::$classmap[$class] = $server;   
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
	
	
  public static function getInstance($server=null,// = 'frdl.webfan.de', 
				     $register = false,
				     $version = 'latest', 
				     $allowFromSelfOrigin = false,
				     $salted = true,
			       $classMap=null , 
			        $prefix = '',			
			     $prependPrefix = false){
	  
	  
	  
	  if(null===$server){
		 $server  = 'https://03.webfan.de/install/?salt=${salt}&bundle=${class}';   
	   }
	  
	  if(is_array($server)){
	      $arr = [];
	      foreach($server as $s){
		  $arr[]= self::getInstance($s['server'], $s['register'], $s['version'], $s['allowFromSelfOrigin'], $s['salted'], $s['classmap'], $s['prefix'], $s['prependPrefix']);      
	      }
		  
	    return $arr;	  
	  }elseif(is_callable($server)){
		$key = \spl_object_id($server);  
	  }elseif(is_string($server)){
		$key = $server;  
	  }
	  
	  if(!isset(self::$instances[$key])){
		  self::$instances[$key] = new self($server, $register, $version, $allowFromSelfOrigin, $salted, $prefix, $prependPrefix);
	  }
	  
	 return self::$instances[$key];
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
	  
        $server = (isset(self::$classmap[$class]))
		? self::$classmap[$class]
		: $this->server; 
	  
	if(!is_string($salt) && true === $this->withSalt()){
		$salt = mt_rand(10000000,99999999);
	}
	  
	
	$class = str_replace('\\', '/', $class);  
     
	
     if(is_callable($server)){
	$url = call_user_func_array($server, [$class, $this->version, $salt]);	  
     }elseif(substr($server, 0, strlen('http://')) === 'http://' || substr($server, 0, strlen('https://')) === 'https://'){
	  $url = str_replace(['${salt}', '${class}', '${version}'], [$salt, $class, $this->version], $server);   
     }else{	  
	  $url = 'https://'.$server.'/install/?salt='.$salt.'&source='. $class.'&version='.$this->version;
     }

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
	
	public function register(/* $throw = true, $prepend = false */){
		$args=func_get_args();
		$prepend =(0<count($args) && true === $args[0]) ? array_shift($args) : false;
		$throw =(0<count($args) && true === $args[0]) ? array_shift($args) : true;
		 
		
		
		if(!$this->allowFromSelfOrigin && $this->domain === $this->selfDomain){
		/*   throw new \Exception('You should not autoload from remote where you have local access to the source (remote server = host)'.
							   $this->domain.' '.$this->selfDomain);
				*/
			die('You should not autoload from remote where you have local access to the source (remote server = host)'.
							   $this->domain.' '.$this->selfDomain);
		
		}		
		
		$autoloadFunctions = \spl_autoload_functions() ;
		
		if(is_array($autoloadFunctions) && !in_array($this->getLoader(),$autoloadFunctions) ){
			return \spl_autoload_register($this->getLoader(), $throw, $prepend);
		}
	}
	
	public function getLoader(){
		return [$this, 'Autoload'];
	}
	
  public function Autoload($class){
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
