<?php
namespace frdl\implementation\psr4;

$sourcesRaces=[
	'https://cdn.frdl.io/@webfan3/stubs-and-fixtures/classes/frdl/implementation/psr4/RemoteAutoloader',
	'https://cdn.webfan.de/@webfan3/stubs-and-fixtures/classes/frdl/implementation/psr4/RemoteAutoloader',
	'https://03.webfan.de/install/?salt='.sha1(mt_rand(1000,9999)).'&source=\frdl\implementation\psr4\RemoteAutoloader',
	__FILE__
];

call_user_func(function($SourcesRaces){

   $oldc = file_get_contents(__FILE__);
   $links_hint=[];
   $trys=[];
   $code=false;
	while(($code===false || empty($code) ) && count($SourcesRaces) > 0){
		array_push($trys, array_shift($SourcesRaces) );
		$current=$trys[count($trys)-1];
		   try{
	                  $code =    @file_get_contents($current);		
		   }catch(\Exception $e){		   
			   $code=false; 
		   }
		if($code === false && $current!==__FILE__){
			array_push($links_hint,  $current );
		}
	}
  
   try{
	 
 if(false === $code){
     throw new \Exception(sprintf('Could not load %s from %s', \frdl\implementation\psr4\RemoteAutoloader::class, print_r($links_hint,true)));
 }else{
        file_put_contents(__FILE__, $code);
        return require __FILE__;
 }
	   
// return require __FILE__;

}catch(\Exception $e){
     file_put_contents(__FILE__, $oldc);
     throw $e;
  }
}, $sourcesRaces);



class RemoteAutoloader
{
	
	const HASH_ALGO = 'sha1';
	const ACCESS_LEVEL_SHARED = 0;
	const ACCESS_LEVEL_PUBLIC = 1;
	const ACCESS_LEVEL_OWNER = 2;
	const ACCESS_LEVEL_PROJECT = 4;
	const ACCESS_LEVEL_BUCKET = 8;
	const ACCESS_LEVEL_CONTEXT = 16;
	
	const CLASSMAP_DEFAULTS = [
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
		
	//	'GuzzleHttp\\Psr7\\uri_for' =>  'https://03.webfan.de/install/?salt=${salt}&version=${version}&source=GuzzleHttp\Psr7\uri_for',
		'GuzzleHttp\\Psr7\\uri_for' =>  'https://03.webfan.de/install/?salt=${salt}&version=${version}&source=GuzzleHttp\Psr7\uri_for',
		
	
		\Wehowski\Gist\Http\Response\Helper::class =>
'https://gist.githubusercontent.com/wehowski/d762cc34d5aa2b388f3ebbfe7c87d822/raw/5c3acdab92e9c149082caee3714f0cf6a7a9fe0b/Wehowski%255CGist%255CHttp%255CResponse%255CHelper.php?cache_bust=${salt}',
	\webfan\hps\Format\DataUri::class => 'https://03.webfan.de/install/?salt=${salt}&source=webfan\hps\Format\DataUri',
	'frdl\\Proxy\\' => 'https://raw.githubusercontent.com/frdl/proxy/master/src/${class}.php?cache_bust=${salt}',
	 \frdlweb\Thread\ShutdownTasks::class => 'https://raw.githubusercontent.com/frdl/shutdown-helper/master/src/ShutdownTasks.php?cache_bust=${salt}',

		
		'Fusio\\Adapter\\Webfantize\\' => 'https://raw.githubusercontent.com/frdl/fusio-adapter-webfantize/master/src/${class}.php?cache_bust=${salt}',
		
		
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
	];
	
	
	protected $salted = false;
	
	protected $selfDomain;
	protected $server;
	protected $domain;
	protected $version;
	protected $allowFromSelfOrigin = false;
	
	protected $prefixes = [];
	protected $cacheDir;
	protected $cacheLimit = 0;
	protected static $instances = [];	
	protected $alias = [];
	protected static $classmap = [];

	
	
  public static function getInstance($server = '03.webfan.de', $register = true, $version = 'latest', $allowFromSelfOrigin = false, $salted = false,
									 $classMap = null, $cacheDirOrAccessLevel = self::ACCESS_LEVEL_SHARED,       $cacheLimit = null, $password = null){
	  	
	   if(!is_array($classMap)){
		  $classMap = self::CLASSMAP_DEFAULTS;  
	   }
	 
	 
	  
	  if(is_array($server)){
	      $instance = [];
	      foreach($server as $indexOrServer => $_s){ 
			     $s=array_merge($_s, [
					     'server' => (is_string($indexOrServer))?$indexOrServer:$server,
					     'register'=>$register,
					     'version'=>$version,
					     'allowFromSelfOrigin'=>$allowFromSelfOrigin,
					     'salted'=>$salted,
					     'classmap'=>(is_string($indexOrServer)&&is_string($_s))?[$indexOrServer=>$_s]:$classmap,
					     'cacheDirOrAccessLevel'=>$cacheDirOrAccessLevel,
					     'cacheLimit'=>$cacheLimit,
					     'password'=>$password,
					 ]);
				$instance[(is_string($indexOrServer))?$indexOrServer:$_s] = self::getInstance($s['server'], $s['register'], $s['version'], $s['allowFromSelfOrigin'], $s['salted'], $s['classmap'], $s['cacheDirOrAccessLevel'], $s['cacheLimit'], $s['password']);      
	      }

		  
		//$server = 'file://'.getcwd().\DIRECTORY_SEPARATOR;
		
	  }else{
		   $key = static::ik($server, $classMap);
	         if(!isset(self::$instances[$key])){
		
			    self::$instances[$key] = new self($server, 
					   $register,
					   $version,
					   $allowFromSelfOrigin,
					   $salted,
					   $classMap, 
					   $cacheDirOrAccessLevel,
					   $cacheLimit,
					   $password);
	        }		  
		   $instance = self::$instances[$key];
	  }
	  	

	  
	 return $instance;
  }		
	
	
   public static function ik($server, $classMap){
	   if(is_array($classMap)){
		   ksort($classMap);
	   }
	  return sha1(serialize([$server, $classMap])); 
   }
	
	
   protected function __construct($server = '03.webfan.de', 
							   $register = true,
							   $version = 'latest',
							   $allowFromSelfOrigin = false,
							   $salted = false, 
							   $classMap = null, 
							   $cacheDirOrAccessLevel = self::ACCESS_LEVEL_SHARED, 
							    $cacheLimit = null, 
							    $password = null){
	    
	  
	   $key = static::ik();
	   self::$instances[static::ik()] = &$this;
	   
	    $defauoltcacheLimit = -1;
	    $bucketHash = $this->generateHash([
			                               self::class//,
			                             //  $version
										  ], 
										  '',
										  self::HASH_ALGO,
										 '-');
	   
	   
	
	   
	   switch($cacheDirOrAccessLevel){
		 
		   case self::ACCESS_LEVEL_PUBLIC : 
		        $bucket = \get_current_user().\DIRECTORY_SEPARATOR.'shared';
			   break;
		   case self::ACCESS_LEVEL_OWNER : 
		        $bucket = \get_current_user().\DIRECTORY_SEPARATOR 
					          .$this->generateHash([
								                       $bucketHash,
								                       $version,
								                     \get_current_user ( ),
													  //$_SERVER['SERVER_NAME']
								                    //  $_SERVER['SERVER_ADDR']
								  
								                        
												   ], 
										  $password,
										  self::HASH_ALGO,
										 '-');
			   break;
		   case self::ACCESS_LEVEL_PROJECT : 
			   		        $bucket = \get_current_user ( ).\DIRECTORY_SEPARATOR 
					          .$this->generateHash([
								                        $bucketHash,
								                           $version,
								                     \get_current_user ( ),
												 	 $_SERVER['SERVER_NAME'],
								                     $_SERVER['SERVER_ADDR'],
								                     basename(getcwd()),
								                     realpath(getcwd()),
								                  
												   ], 
										  $password,
										  self::HASH_ALGO,
										 '-');
			   
			   break;
		   case self::ACCESS_LEVEL_BUCKET : 
		        $bucket = \get_current_user ( ).\DIRECTORY_SEPARATOR .$this->generateHash([
								                    $bucketHash,
								                    $version
												   ], 
										  $password,
										  self::HASH_ALGO,
										 '-');
			   break;
		   case self::ACCESS_LEVEL_CONTEXT : 
		        $bucket =   \get_current_user ( ).\DIRECTORY_SEPARATOR 
					          .$this->generateHash([
								  					$bucketHash,
								                    $version,
								                     \get_current_user ( ),
												 	 $_SERVER['SERVER_NAME'],
								                     $_SERVER['SERVER_ADDR'],
								                     $_SERVER['REMOTE_ADDR'],
								                     basename(getcwd()),
								                     realpath(getcwd())
												   ], 
										  $password,
										  self::HASH_ALGO,
										 '-');
					
 
			        
			   break;
			    
		   case self::ACCESS_LEVEL_SHARED : 
			   default: 
		        $bucket = '_'.\DIRECTORY_SEPARATOR.'shared';
			   break;
	   }
	   
	    $this->cacheLimit = (is_int($cacheLimit)) ? $cacheLimit : ((isset($_ENV['FRDL_HPS_PSR4_CACHE_LIMIT']))? $_ENV['FRDL_HPS_PSR4_CACHE_LIMIT'] : $defauoltcacheLimit);   

	   
	   $this->cacheDir = (is_string($cacheDirOrAccessLevel) && is_dir($cacheDirOrAccessLevel) && is_readable($cacheDirOrAccessLevel) && is_writeable($cacheDirOrAccessLevel) ) 
		   ? $cacheDirOrAccessLevel 
			:  \sys_get_temp_dir().\DIRECTORY_SEPARATOR
			                      //   .'.frdl'.\DIRECTORY_SEPARATOR
			                         .$bucket.\DIRECTORY_SEPARATOR
			                         .'lib'.\DIRECTORY_SEPARATOR
			                         .'php'.\DIRECTORY_SEPARATOR
			                         .'src'.\DIRECTORY_SEPARATOR
			                         .'psr4'.\DIRECTORY_SEPARATOR; 
	   
	   
	    
	 /*     */   
	   
	   	$valCacheDir;    
		$valCacheDir = (function($CacheDir, $checkAccessable = true, $checkNotIsSysTemp = true, $r = null) use(&$valCacheDir){
			if(null ===$r)$r=dirname($CacheDir);
			
			$checkRoot = substr($r,  0, strlen($CacheDir) );
			
			
			$checkSame = $r === $CacheDir;
			
			
			$checked = false === $checkNotIsSysTemp
				 || false === $checkSame
			|| (
				(
			       rtrim($CacheDir, \DIRECTORY_SEPARATOR.'/\\ ') !== rtrim(\sys_get_temp_dir(),\DIRECTORY_SEPARATOR.'/\\ ') 
			   && 'tmp' !== basename($CacheDir) 
			 //  && 'tmp' !== basename(dirname($CacheDir))
				)
																
			);
			
			return (
				  $checkAccessable === false
				||
				(
				 //  (//is_dir($CacheDir)					 
				//	|| is_dir(dirname($CacheDir))					
					//|| is_dir(dirname(dirname($CacheDir)))
					// ||
				//	$valCacheDir($r, false, false, $CacheDir)
				//	)
				//&&
				
			      is_writable($CacheDir) 
			   && is_readable($CacheDir) 
				)
			 )
			
			 && true === $checked
				 
				? true
				: false
			;
		});	
	

 if(!$valCacheDir($this->cacheDir,false,false) ){

	throw new \Exception('Bootstrap error in '.basename(__FILE__).' '.__LINE__.' for '.$this->cacheDir); 
 }
	
	  if(!is_dir($this->cacheDir)){
		 mkdir($this->cacheDir, 0777,true);
	  }
	   //die($this->cacheDir);
	   if(!is_array($classMap)){
		  $classMap = self::CLASSMAP_DEFAULTS;  
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
		}		
	}
	
    public function generateHash( array $chunks = [], $key = null, $algo = 'sha1', $delimiter = '-', &$ctx = null ){ 
  
		$size = count($chunks);
    $initial = null === $ctx;
   $asString = serialize($chunks);//implode($delimiter, $chunks);
	$buffer = '';	
  $l = 0;
		$c = $size + ($initial);
  if(null===$key || empty($key)){
	  $c++;	
	  $key = \hash( $algo , serialize([$delimiter, [$algo,$size, $delimiter, $c, $asString]]) );
  }

   $MetaCtx = \hash_init ( $algo , \HASH_HMAC, $key ) ;	
   \hash_update($MetaCtx, $key);
		
 if( true === $initial || null === $ctx){
   $ctx = \hash_init ( $algo , \HASH_HMAC, $key ) ;
 }
	  
		while(count($chunks) > 0 && $data = array_shift($chunks)){	  
			
		   $buffer .=$data;
		   $l += strlen($data);
		   $c += count($chunks);	
			
            \hash_update($ctx, $data);		
			
			\hash_update($MetaCtx, $buffer);
			\hash_update($MetaCtx, $l);
			\hash_update($MetaCtx, $c);
		}

		
	  $c++;	
	  //$h2 = $this->generateHash([$algo,count($chunks),$l,$asString, $delimiter, $key, $c], $key, 'sha1', $delimiter, $ctx); 
      $h2 = \hash( $algo , $size .'.'. $l. '.' . $c. '.' .  strlen($buffer.$asString) ); 	 
	  \hash_update($ctx, $h2);	
	  \hash_update($MetaCtx, $h2);	
		
	$c++;	
	$h3 = hash_final($MetaCtx); 		
		
	\hash_update($ctx, $h3);	
		
	$hash = hash_final($ctx);    
	return implode($delimiter, [$size .'.'. $l. '.' . $c. '.' .  (strlen($h2.$buffer.$asString) * $c) % 20, 
								$h3, 
								$hash,
								$h2]);
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

	
   public function str_contains($haystack, $needle, $ignoreCase = false) {
    if ($ignoreCase) {
        $haystack = strtolower($haystack);
        $needle   = strtolower($needle);
    }
    $needlePos = strpos($haystack, $needle);
    return ($needlePos === false ? false : ($needlePos+1));
  }
	

   public function str_parse_vars($string,$start = '[',$end = '/]', $variableDelimiter = '='){
     preg_match_all('/' . preg_quote($start, '/') . '(.*?)'. preg_quote($end, '/').'/i', $string, $m);
     $out = [];
     foreach($m[1] as $key => $value){
       $type = explode($variableDelimiter,$value);
       if(sizeof($type)>1){
          if(!is_array($out[$type[0]]))
             $out[$type[0]] = [];
             $out[$type[0]][] = $type[1];
       } else {
          $out[] = $value;
       }
     }

	return $out;
  }
	
	
public function url($class, $salt = null){
  if(true===$salt){
     $salt = sha1(mt_rand(1000,99999999).time());	  
  }
  return $this->replaceUrlVars($this->urlTemplate($class, null), $salt, $class, $this->version);
}	
	
public function urlTemplate($class, $salt = null){	
  $url = $this->loadClass($class, $salt);

  if(is_bool($url)){
    return $url;  
  }
  return $url;
}
	
	
   public function getUrl($class, $server, $salt = null, $parseVars = false){
	   if(!is_string($salt))$salt=mt_rand(1000,9999);
	  $url = false; 
			
		

	if(is_string($server) ){	   
     if(substr($server, 0, strlen('http://')) === 'http://' || substr($server, 0, strlen('https://')) === 'https://'){
	 //   $url = str_replace(['${salt}', '${class}', '${version}'], [$salt, $class, $this->version], $server);   
		  $url = $server;
     }elseif('~' === substr($server, 0, 1) || is_string($server) && '.' === substr($server, 0, 1) || substr($server, 0, strlen('file://')) === 'file://'){
	    $url =  \DIRECTORY_SEPARATOR.str_replace('\\', \DIRECTORY_SEPARATOR,
												 getcwd() .str_replace(['file://', '~'/*, '${salt}', '${class}', '${version}'*/],
																	   ['', (!empty(getenv('FRDL_HOME'))) ? getenv('FRDL_HOME') : getenv('HOME')/*, $salt, $class, $this->version*/],
																	   $server). '.php');   
     }elseif(preg_match("/^([a-z0-9]+)\.webfan\.de$/", $server, $m) && false !== strpos($server, '.') ){
		 $url = 'https://'.$m[1].'.webfan.de/install/?salt=${salt}&source=${class}&version=${version}';
	 }elseif(preg_match("/^([\w\.^\/]+)(\/[.*]+)?$/", $server, $m) && false !== strpos($server, '.') ){
		 $url = 'https://'.$m[1].((isset($m[2])) ? $m[2] : '/');
	 }//else{	  
	  //  $url = 'https://'.$server.'/install/?salt='.$salt.'&source='. $class.'&version='.$this->version;
		 
		 //$url = 'https://'.$server.'/install/?salt=${salt}&source=${class}&version=${version}';
   //  }
		if(!$this->str_contains($url, '${class}', false) && '.php' !== substr(explode('?', $url)[0], -4)){
			$url = rtrim($url, '/').'/${class}';
		}		
		
		if(!$this->str_contains($url, '${salt}', false)){
			$url .= (( $this->str_contains($url, '?', false) ) ? '&' : '?').'salt=${salt}';
		}	
		
	}elseif(is_callable($server)){
	    $url = call_user_func_array($server, [$class, $this->version, $salt]);	  
     }elseif(is_object($server)  && is_callable([$server, 'has']) && is_callable([$server, 'get']) && true === call_user_func_array([$server, 'has'], [$class]) ){
	    $url = call_user_func_array([$server, 'get'], [$class, $this->version, $salt]);	  
     }elseif(is_object($server) && is_callable([$server, 'get']) ){
	    $url = call_user_func_array([$server, 'get'], [$class, $this->version, $salt]);	  
     }
	   return  (true === $parseVars && is_string($url)) ?  $this->replaceUrlVars($url, $salt, $class, $version) : $url;
   }
	
	
	
	public function replaceUrlVars($url, $salt, $class, $version){
		return str_replace(['${salt}', '${class}', '${version}'], [$salt, $class, $version], $url);
	}
	
	
    /**
     * Loads the class file for a given class name.
     *
     * @param string $class The fully-qualified class name.
     * @return mixed The mapped file name on success, or boolean false on
     * failure.
     */
    public function loadClass($class, $salt = null)
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
            $mapped_file = $this->loadMappedSource($prefix, $relative_class, $salt);
            if ($mapped_file) {		
                return $mapped_file;
            }

            // remove the trailing namespace separator for the next iteration
            // of strrpos()
            $prefix = rtrim($prefix, '\\');
        }
		
		
        // never found a mapped file
        return $this->loadMappedSource('', $class, $salt);
    }

    /**
     * Load the mapped file for a namespace prefix and relative class.
     *
     * @param string $prefix The namespace prefix.
     * @param string $relative_class The relative class name.
     * @return mixed Boolean false if no mapped file can be loaded, or the
     * name of the mapped file that was loaded.
     */
    protected function loadMappedSource($prefix, $relative_class, $salt = null)
    {
		
	    $url = false;
		$class = $prefix.$relative_class;
		
		//if(isset($this->alias[$class]) ){
		//	\webfan\hps\Format\DataUri
		//	die(__LINE__.$class.' Alias: '.$this->alias[$class]);
	//	}
		$pfx = !isset($this->alias[$prefix]) && substr($prefix,-1) === '\\' ? substr($prefix, 0, -1) : $prefix;
		
	
		
		if(isset($this->alias[$pfx]) ){
		//	\webfan\hps\Format\DataUri
			$originalClass = substr($this->alias[$pfx],-1) === '\\' ? substr($this->alias[$pfx], 0, -1) : $this->alias[$pfx];
			$originalClass .= '\\'.$relative_class;
			$alias = $class;
			
		//	die($classOrInterfaceExists.' <br />'.$alias.' <br />rc: '.$originalClass.'<br />'.$datUri);
			 $classOrInterfaceExistsAndNotEqualsAlias =( 
				    class_exists($originalClass, $originalClass !== $alias) 
				 || interface_exists($originalClass, $originalClass !== $alias) 
				 || (function_exists('trait_exists') && trait_exists($originalClass, $originalClass !== $alias))
					) && $originalClass !== $alias;	
			
			
            if($classOrInterfaceExistsAndNotEqualsAlias){	
			   \class_alias($originalClass, $alias);
			}
			
			return true;
			//return $classOrInterfaceExistsAndNotEqualsAlias;
		}	
		
		
		if(isset(self::$classmap[$class]) && is_string(self::$classmap[$class]) && '\\' !== substr($class, -1)  && '\\' !== substr(self::$classmap[$class], -1) ){
			return $this->getUrl($class, self::$classmap[$class], $salt);
		//	return self::$classmap[$class];
		}

	 if (isset($this->prefixes[$prefix]) ) {
        // look through base directories for this namespace prefix
        foreach ($this->prefixes[$prefix] as $server) {

			$url = $this->getUrl($relative_class, $server, $salt);
			
			if(is_string($url) 
			   && $this->exists($url)
			  ){
			    return $url;
			}
        }
	 }
        // never found it
       return $this->getUrl($class, $this->server, $salt);
   }

    /**
     * If a file exists, require it from the file system.
     *
     * @param string $file The file to require.
     * @return bool True if the file exists, false if not.
     */
  protected function requireFile($file){
        if (file_exists($file)) {
			try{
               require $file;
			}catch(\Exception $e){
			   trigger_error($e->getMessage(), \E_USER_ERROR);
			   return false;	
			}
            return true;
        }
        return false;
  }	
  public function withClassmap(array $classMap = null){
     if(null !== $classMap){
	   foreach($classMap as $class => $server){
		   if('@' === substr($class, 0, 1) && is_string($server)){
               $this->withAlias($class, $server);		
		   }elseif('\\' === substr($class, -1)){
               $this->withNamespace($class, $server, is_string($server));		
		   }else{
		        self::$classmap[$class] = $server;   
		   }

	   }
     }
	  
    return self::$classmap;	  
  }	
  public function withAlias(string $alias, string $rewrite){
       $this->alias[ltrim($alias, '@')] = $rewrite;
  }
	
  public function withSalt(bool $salted = null){
     if(null !== $salted){
	     $this->salted = $salted; 
     }
	  
    return $this->salted;	  
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
	if('http://'!==substr($source, 0, strlen('http://'))
	   && 'https://'!==substr($source, 0, strlen('https://'))
	   && is_file($source) && file_exists($source) && is_readable($source)){
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
	if(!is_string($salt) 
	   //&& true === $this->withSalt()
	  ){
		$salt = mt_rand(10000000,99999999);
	}
	  

	  $url = $this->loadClass($class, $salt);
	
	  if(is_bool($url)){
		 return $url;  
	  }
	  
	  $withSaltedUrl = (true === $this->str_contains($url, '${salt}', false)) ? true : false;
	  $url =  $this->replaceUrlVars($url, $salt, $class, $this->version);
	  
	  
	$options = [
		'https' => [
           'method'  => 'GET',
            'ignore_errors' => true,        
  
		   ]
	];
    $context  = stream_context_create($options);
    $code = @file_get_contents($url, false, $context);
	    $statusCode = 0;  
	  //$code = file_get_contents($url);
	foreach($http_response_header as $i => $header){
				
		if(0===$i){
			   preg_match('{HTTP\/\S*\s(\d{3})}', $header, $match);
               $statusCode = intval($match[1]);
		}
		
		$h = explode(':', $header);
		if('x-content-hash' === strtolower(trim($h[0]))){
			$hash = trim($h[1]);
		}		
		if('x-user-hash' === strtolower(trim($h[0]))){
			$userHash = trim($h[1]);
		}		
	}	  
	  
	  
   
	  if(   200!==$statusCode
		 || false===$code 
		 || !is_string($code) 
		 || (true === $withSaltedUrl && true === $this->withSalt() && (!isset($hash) || !isset($userHash)))
		
		){	
		//  throw new \Exception('Missing checksums while fetching source code for '.$class.' from '.$url);
		  return false;	
	  }
	
	
	  $oCode =$code;
   
     if(is_string($salt) && true === $withSaltedUrl && true === $this->withSalt() ){
	   $hash_check = strlen($oCode).'.'.sha1($oCode);
	   $userHash_check = sha1($salt .$hash_check);			 
		 
	   if($hash_check !== $hash || $userHash_check !== $userHash){
		   throw new \Exception('Invalid checksums while fetching source code for '.$class.' from '.$url);
	   }	   	
     }	
 
  $code = trim($code);
	  
    if(!$this->str_contains($code, '<?', false)){
		  throw new \Exception('Invalid source code for '.$class.' from '.$url.': '.base64_encode($code));
	}
	  
	  
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
	
	public function register($throw = true, $prepend = false){
		
		$res = false;
	
		
		if(!$this->allowFromSelfOrigin && $this->domain === $this->selfDomain){
		   throw new \Exception('You should not autoload from remote where you have local access to the source (remote server = host)');
		}		
		
		$aFuncs = \spl_autoload_functions();
		if(!is_array($aFuncs) || !in_array($this->getLoader(), $aFuncs) ){
			$res =  \spl_autoload_register($this->getLoader(), $throw, $prepend);
		}
		
		
			if( false !== $res  ){	             
                 $this->pruneCache();			
		    }else{
				 throw new \Exception(sprintf('Cannot register Autoloader of "%s" with cachedir "%s"', __METHOD__, $this->cacheDir));
			}
		
		
		
		return $res;
	}
	
	protected function getLoader(){
		return [$this, 'Autoload'];
	}
	
	
  public function pruneCache(){
	
	 if($this->cacheLimit !== 0
		   && $this->cacheLimit !== -1){
					 
                              
		 $ShutdownTasks = (class_exists(\frdlweb\Thread\ShutdownTasks::class))
					  ? \frdlweb\Thread\ShutdownTasks::mutex()
					  : function(){
						  call_user_func_array('register_shutdown_function', func_get_args());
					  };
		 
		 
                  $ShutdownTasks(function($CacheDir, $maxCacheTime){		
                   
						  \webfan\hps\patch\Fs::pruneDir($CacheDir, $maxCacheTime, true,  'tmp' !== basename($CacheDir));		
      
				  }, $this->cacheDir, $this->cacheLimit);			
	  
    }
  }
	

  public function getCacheDir(){
	 return $this->cacheDir;  
  }
	
	
  public function Autoload($class){

	$cacheFile = rtrim($this->cacheDir, \DIRECTORY_SEPARATOR.'/\\ '). \DIRECTORY_SEPARATOR. str_replace('\\', \DIRECTORY_SEPARATOR, $class). '.php';
	//$cacheFile = realpath($cacheFile);
 	
	 if(file_exists($cacheFile) 
	   && ($this->cacheLimit !== 0
		   && $this->cacheLimit !== -1
		   && (filemtime($cacheFile) < time() - $this->cacheLimit)
		  )){
		     unlink($cacheFile);
		     clearstatcache(true, $cacheFile); 
      }	
	  
	  
	if(!file_exists($cacheFile) 
	   || (
		   $this->cacheLimit !== 0
		   && $this->cacheLimit !== -1
		   && (filemtime($cacheFile) < time() - $this->cacheLimit)
		  )
	  ){
	  


	$code = $this->fetchCode($class, null);
    if(true === $code){
		return true;
	}elseif(false !==$code){			
		if(!is_dir(dirname($cacheFile))){			
		  mkdir(dirname($cacheFile), 0775, true);
		}
		
    	if(!file_put_contents($cacheFile, $code)){
	      throw new \Exception('Cannot write source for class '.$class.' to '.$cacheFile);
	   }
	  		
   }else/*if(false ===$code || !file_exists($cacheFile))*/{
		 // die($cacheFile);
	  return false;	
	}	
  
  }
	
	  
	  
	  
	if(file_exists($cacheFile) ){
	    if(false === ($this->requireFile($cacheFile)) ){
			if(file_exists($cacheFile)){
				unlink($cacheFile);
			}
			return false;	
		}
	  	//return true;	
		return class_exists($class, false);
	}elseif(isset($code) && is_string($code)){
		/*
		$code =ltrim($code, '<?php');
		$code =rtrim($code, '?php>');	
		eval($code);
		*/
		//$tmpfile = tmpfile();
		$tmpfile = tempnam($this->cacheDir, 'autoloaded-file.'.sha1($code)); 	      
		
		
		          $ShutdownTasks = \frdlweb\Thread\ShutdownTasks::mutex();
                  $ShutdownTasks(function($tmpfile){		
					 if(file_exists($tmpfile)){
						unlink($tmpfile); 
					 }
				  }, $tmpfile);		
		
			
		if(false === ($this->requireFile($tmpfile)) ){
			if(file_exists($tmpfile)){
				unlink($tmpfile);
			}
			return false;	
		}else{	
			unlink($tmpfile);		
			return class_exists($class, false);
		}
	}else{
	      throw new \Exception('Cannot write/load source for class '.$class.' in '.$cacheFile);
	   }
			
  }
	
}
