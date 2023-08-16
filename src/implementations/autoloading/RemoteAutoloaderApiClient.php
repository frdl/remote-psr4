<?php
/**
* Bundled from https://github.com/frdl/codebase/tree/main/src/Frdlweb/Contract/Autoload
* @ToDo: How could I "preload" this better/from github-sources?
* https://raw.githubusercontent.com/frdlweb/webfat/main/public/index.php
* @ToDo StubModuleBuilder
**/
namespace Frdlweb\Contract\Autoload{
	

if (!\interface_exists(CodebaseInterface::class, false)) {	
    interface CodebaseInterface
 { 
   const ALL_CHANNELS = '*';
   const ENDPOINT_DEFAULT = 'RemoteApiBaseUrl';
   const ENDPOINT_PROVIDER_IDENTITY_CENTRAL = 'io4.pid.central';
   const ENDPOINT_WEBFAT_CENTRAL = 'io4.webfat.central';
   const ENDPOINT_REMOTE_PUBLIC = 'io4.workspace.public';
   const ENDPOINT_REMOTE_PRIVATE = 'io4.workspace.private';
   const ENDPOINT_WORKSPACE_REMOTE = 'io4.workspace.remote';
   const ENDPOINT_INSTALLER_REMOTE = 'io4.installer.remote';
   const ENDPOINT_PROXY_OBJECT_REMOTE = 'io4.proxy-object.remote';
   const ENDPOINT_CONTAINER_REMOTE = 'io4.container.remote';
   const ENDPOINT_CONFIG_REMOTE = 'io4.config.remote';
   const ENDPOINT_MODULES_WEBFANSCRIPT_REMOTE = 'RemoteModulesBaseUrl';
   const ENDPOINT_AUTOLOADER_PSR4_REMOTE = 'RemotePsr4UrlTemplate';
   const ENDPOINT_UDAP = 'io4.udap';
   const ENDPOINT_RDAP = 'io4.rdap';
   const ENDPOINT_OIDIP = 'io4.rdap';

   const CHANNEL_LATEST = 'latest';
   const CHANNEL_STABLE = 'stable';
   const CHANNEL_FALLBACK = 'fallback';
   const CHANNEL_TEST = 'test';
   const CHANNELS =[
        self::CHANNEL_LATEST => self::CHANNEL_LATEST,
        self::CHANNEL_STABLE => self::CHANNEL_STABLE,
        self::CHANNEL_FALLBACK => self::CHANNEL_FALLBACK,
        self::CHANNEL_TEST => self::CHANNEL_TEST,
	];
   const DEFAULT_ENDPOINT_NAMES =[
        self::ENDPOINT_DEFAULT,
	self::ENDPOINT_PROVIDER_IDENTITY_CENTRAL,
        self::ENDPOINT_WEBFAT_CENTRAL,
	self::ENDPOINT_REMOTE_PUBLIC,
	self::ENDPOINT_REMOTE_PRIVATE, 
        self::ENDPOINT_WORKSPACE_REMOTE,
        self::ENDPOINT_INSTALLER_REMOTE,
        self::ENDPOINT_MODULES_WEBFANSCRIPT_REMOTE,
        self::ENDPOINT_PROXY_OBJECT_REMOTE,
	self::ENDPOINT_CONTAINER_REMOTE,
        self::ENDPOINT_AUTOLOADER_PSR4_REMOTE,
        self::ENDPOINT_UDAP,
        self::ENDPOINT_RDAP,
	self::ENDPOINT_OIDIP,
	self::ENDPOINT_CONFIG_REMOTE,
   ];
     
   public function loadUpdateChannel(mixed $StubRunner = null) : string;     
   public function getRemoteApiBaseUrl(?string $serviceEndpoint = self::ENDPOINT_DEFAULT) : string|bool;
   public function setUpdateChannel(string $channel);	 
   public function getUpdateChannel() : string;	  
   public function getRemotePsr4UrlTemplate() : string;	  
   public function getRemoteModulesBaseUrl() : string;
   public function getServiceEndpoints() : array;	 
   public function getServiceEndpointNames() : array;	  	 	 	 
   public function setServiceEndpoints(array $serviceEndpoints) : CodebaseInterface;	 
   public function setServiceEndpoint(string $serviceEndpointName,
									 string|\Closure|\callable $baseUrl, 
									 ?string $channel = self::ALL_CHANNELS) : CodebaseInterface;
 }
} 
}

namespace Webfan {
 if (!interface_exists(Wayneable::class)) {	
	 interface Wayneable {				
		 
	}	
  }	  
}

namespace Webfan\Wayne {
 if (!interface_exists(Unsaneable::class)) {	
	 interface Unsaneable extends \Webfan\Wayneable {				
		 
	}	
  }	  
}
namespace Webfan\Wayne {
 if (!interface_exists(Insaneable::class)) {	
	 interface Insaneable  extends \Webfan\Wayneable {				
		 
	}	
  }	  
}

namespace Frdlweb\Contract\Autoload{
 if (!interface_exists(ClassmapGeneratorInterface::class)) {	
	 interface ClassmapGeneratorInterface {				
		public function addDirectory(string $dir); 
	}	
  }	  
}//ns Frdlweb\Contract\Autoload	


namespace Frdlweb\Contract\Autoload {
 if (!interface_exists(SourceCodeGeneratorInterface::class)) {	     
  interface SourceCodeGeneratorInterface
   {
     public function file(string $className):string;
     public function source(string $className):string;
     public function bundle(array $classes):string;   
   }
  }     
}

namespace Frdlweb\Contract\Autoload{
  if (!interface_exists(GeneratorInterface::class)) {		
	interface GeneratorInterface {	
	   public function withContext(Context $Context); 		
	   public function withPackage(string | array | object $urlPackageNameOrComposerJson ); 			
	   public function withDirectory($dir); 
	   public function withAlias(string $alias, string $rewrite); 
	   public function withClassmap(array $classMap = null); 
	   public function withNamespace($prefix, $server, $prepend = false);
	}
  }	  
}//ns Frdlweb\Contract\Autoload	
    
namespace Frdlweb\Contract\Autoload{
 if (!interface_exists(Psr4GeneratorInterface::class)) {	
	interface Psr4GeneratorInterface {		
		public function addNamespace($prefix, $resourceOrLocation, $prepend = false);
	}
 }
}//ns Frdlweb\Contract\Autoload

namespace Frdlweb\Contract\Autoload{
 if (!interface_exists(ClassmapGeneratorApiInterface::class)) {	
	interface ClassmapGeneratorApiInterface {	
	   public function getClassmapCachefileFor(string $app, string $version, string $phpVersion = \PHP_VERSION) : string;		
	   // $cache = true : load from cache if exists
           // $cache = int :  load from cache if it is newer than $cache seconds
	   // $cache = false : invalidate cache for the classmap and load from implementation/API
	   public function getClassmapFor(string $app, string $version, string $phpVersion = \PHP_VERSION, int | bool $cache = true) : array | bool;	
	   public function withClassmapFor(string $app, string $version, string $phpVersion = \PHP_VERSION, int | bool $cache = true) : bool;
	}
 }
}//ns Frdlweb\Contract\Autoload

namespace Frdlweb\Contract\Autoload{
 if (!interface_exists(RemoteClassmapGeneratorInterface::class)) {	
	interface RemoteClassmapGeneratorInterface {		
	   public function withClassmap(array $classMap = null);
	}
 }
}//ns Frdlweb\Contract\Autoload


namespace Frdlweb\Contract\Autoload{
 if (!interface_exists(AliasMapGeneratorInterface::class)) {	
	interface AliasMapGeneratorInterface {		
	   public function withAlias(string $alias, string $rewrite);
	}
 }
}//ns Frdlweb\Contract\Autoload


namespace Frdlweb\Contract\Autoload{
if (!interface_exists(ClassLoaderInterface::class)) {		
	interface ClassLoaderInterface {
		public function Autoload(string $class):bool|string;
	}	
}
}//ns Frdlweb\Contract\Autoload

namespace Frdlweb\Contract\Autoload{	
if (!interface_exists(ResolverInterface::class)) {		
     interface ResolverInterface {
        public function resolve(string $class):bool|string;
        public function file(string $class):bool|string; //local or cache
        public function url(string $class):bool|string;  //remote or ...?
     }
}
}//ns Frdlweb\Contract\Autoload

namespace Frdlweb\Contract\Autoload{ 
 if (!interface_exists(LoaderInterface::class)) {		
	interface LoaderInterface {
	  // public const HAS_ALWAYS_CORRECT_STACK_ORDER = false;
	   public function register(bool $prepend = false);
	}
 }
}//ns Frdlweb\Contract\Autoload

namespace Frdlweb\Contract\Autoload{ 
 if (!interface_exists(UnloadableInterface::class)) {		
	interface UnloadableInterface {
	   public function unregister();
	}
 }
	
}//ns Frdlweb\Contract\Autoload


namespace Frdlweb\Contract\Autoload{ 
 if (!interface_exists(StackOrderAwareLoaderInterface::class)) {		
	interface StackOrderAwareLoaderInterface {
	   public const HAS_ALWAYS_CORRECT_STACK_ORDER = true;
	   public function register(bool $prepend = false);
	}
 }
}//ns Frdlweb\Contract\Autoload




namespace frdl\implementation\psr4{
	
use Frdlweb\Contract\Autoload\CodebaseInterface as CodebaseInterface;
	
class RemoteAutoloaderApiClient implements
	\Frdlweb\Contract\Autoload\LoaderInterface, 
	\Frdlweb\Contract\Autoload\StackOrderAwareLoaderInterface, 
	\Frdlweb\Contract\Autoload\UnloadableInterface,
	\Frdlweb\Contract\Autoload\ResolverInterface,
	\Frdlweb\Contract\Autoload\ClassLoaderInterface,
	\Frdlweb\Contract\Autoload\Psr4GeneratorInterface,
	\Frdlweb\Contract\Autoload\RemoteClassmapGeneratorInterface,
	\Frdlweb\Contract\Autoload\ClassmapGeneratorApiInterface,
	\Frdlweb\Contract\Autoload\AliasMapGeneratorInterface
{
    
    public const HASH_ALGO = 'sha1';
    public const ACCESS_LEVEL_SHARED = 0;
    public const ACCESS_LEVEL_PUBLIC = 1;
    public const ACCESS_LEVEL_OWNER = 2;
    public const ACCESS_LEVEL_PROJECT = 4;
    public const ACCESS_LEVEL_BUCKET = 8;
    public const ACCESS_LEVEL_CONTEXT = 16;
   


    public const CLASSMAP_DEFAULTS = [   
	    
      //Concrete Classes:     
        \frdlweb\Thread\ShutdownTasks::class => 'https://raw.githubusercontent.com/frdl/shutdown-helper/master/src/ShutdownTasks.php',
	    
      // NAMESPACES   = \\ at the end:
      'frdl\\Proxy\\' => 'https://raw.githubusercontent.com/frdl/proxy/master/src/${class}.php?cache_bust=${salt}',   	    
     // 'DI\\Definition\\' => 'https://raw.githubusercontent.com/PHP-DI/PHP-DI/6.0-release/src/Definition/${class}.php?cache_bust=${salt}',    	    
    
      // ALIAS = @ as first char:
      '@Webfan\\Autoloader\\Remote' => __CLASS__,
      '@'.\Webfat\Keychain::class => \Webfan\KeychainOld::class,    	    
      '@'.\frdl\Facades::class => \Webfan\FacadesManager::class,//\Statical\Manager::class,       
      //Versions at Webfan:
	  // Default/Fallback Versions Server:
	\webfan\hps\Format\DataUri::class => 'https://webfan.de/install/?salt=${salt}&source=${class}',
	 // Stable/Current Versions Server:   
        //\webfan\hps\Format\DataUri::class => 'https://webfan.de/install/stable/?salt=${salt}&source=webfan\hps\Format\DataUri',	    
	// Latest/Beta Versions Server:    
	// \webfan\hps\Format\DataUri::class => 'https://webfan.de/install/latest/?salt=${salt}&source=webfan\hps\Format\DataUri',

	
	    
    //Concrete Classes	    
   // \Webfan\cta\HashType\HashTypeInterface::class => 'https://raw.githubusercontent.com/frdl/cta/main/src/HashTypeInterface.php',	
   // \Webfan\cta\HashType\XHashSha1::class => 'https://raw.githubusercontent.com/frdl/cta/main/src/XHashSha1.php',	
   // \Webfan\cta\Storage\StorageInterface::class => 'https://raw.githubusercontent.com/frdl/cta/main/src/StorageInterface.php',
	    
     //misc...
     //You can have functions autoloading
    'GuzzleHttp\choose_handler' => 'https://webfan.de/install/?salt=${salt}&version=${version}&source=GuzzleHttp\choose_handler',
    \GuzzleHttp\LoadGuzzleFunctionsForFrdl::class => 'https://webfan.de/install/?salt=${salt}&version=${version}&source=GuzzleHttp\LoadGuzzleFunctionsForFrdl',

     \Wehowski\Gist\Http\Response\Helper::class =>
    'https://gist.githubusercontent.com/wehowski/d762cc34d5aa2b388f3ebbfe7c87d822/raw/5c3acdab92e9c149082caee3714f0cf6a7a9fe0b/Wehowski%255CGist%255CHttp%255CResponse%255CHelper.php?cache_bust=${salt}',
    
  
    ];



   public static $alwaysAppendLoader = true;
	
    protected $salted = false;
    protected $selfDomain;
    protected $server;
    protected $domain;
    protected $version;
    protected $allowFromSelfOrigin = false;
    protected $prefixes = [];

    /**
      $afterMiddleware = [
        "/(example\.com)/",
	function($code){
	   //....
	   
	   return $code;
	}
      ];
      $afterMiddleware = [
	function($url){
	   //....
	   
	   return true; //or false to en-/disable middleware
	},
	function($code){
	   //....
	   
	   return $code; /  * validated/transformed code, invalidate with not string (e.g. bool or Excpetion) *  /
	}
      ];
      
      ->withAfterMiddleware($afterMiddleware[0], $afterMiddleware[1])
      
      $beforeMiddleware = function($class, &$loader){
	   //....
	   
	   return false; /  * return false to skip this autoloader, return any/VOID to continue *  /
      };     
	
	->withBeforeMiddleware($beforeMiddleware)
    */
    protected $afterMiddlewares = [];
    protected $beforeMiddlewares = [];
    protected $urlRewriterMiddlewares = [];
    protected $cacheDir;
    protected $cacheLimit = 0;
    protected static $instances = [];
    protected $alias = [];
    protected static $classmap = [];
    protected static $existsCache = [];
		
    protected $salt;
		
    protected $httTimeout = 90;
    public static $increaseTimelimit = true;
    protected $userAgent = null;		
    protected $_TRANSPORTS = [
	    //'http',
	   // 'tor',
    ];		
     protected $transport = 'http';
		
     protected $_calledWIthDefaultMethods = [];
		
     protected $ApiManager = null;//CodebaseInterface

     public function setManager(CodebaseInterface $Manager)  {
        $this->ApiManager = $Manager;
     }
     public function getManager(?bool $foce =false)  : CodebaseInterface {
	 if(null === $this->ApiManager && true===$foce){
            
	 }
       return $this->ApiManager;
     }
     protected function _forceManager()  : CodebaseInterface|bool {
	 if(\class_exists(\Webfan\FacadesManager::class)){
          // return IO4::
		 // $this->ApiManager
	 }
	return $this->ApiManager;
     }	
    public function withTransport(string $schema, array | \callable | \Closure $handler){
        $this->_TRANSPORTS[$schema] = $handler;
    }			

    public function withTimeout(int $timeout){
       $this->httTimeout = $timeout;
    }
		
    public function setTransport(string $transport){
       if(!isset($this->_TRANSPORTS[$transport])){
	  throw new \Exception(sprintf('%sTransport is not set in %s. Use withTransport to define a callable for it!', ucfirst($transport), __METHOD__));
       }
	$this->transport = $transport;    
    }
		
		
    public function withUserAgent(string $userAgent){
       $this->userAgent = $userAgent;
    }		
	//$urlRewriterMiddlewares
    public function withUrlRewriterMiddleware( \callable | \closure $Middleware){
	    $this->urlRewriterMiddlewares[]= $Middleware;	   
	return $this;
    }
		
    public function withBeforeMiddleware( \callable | \closure $Middleware){
	    $this->beforeMiddlewares[]= $Middleware;	   
	return $this;
    }
	
    public function withAfterMiddleware(\callable | \closure | string $condition, \callable | \closure $filter){
	    $this->afterMiddlewares[]= [$condition, $filter];	   
	return $this;
    }
		
    public function addNamespace($prefix, $resourceOrLocation, $prepend = false){
	return $this->withNamespace($prefix, $resourceOrLocation, $prepend);	
    }
    public function withNamespace($prefix, $server, $prepend = false)
    {
        $this->_withNamespace($prefix, $server, $prepend, true);
    }

    protected function _withNamespace($prefix, $server, $prepend = false, bool $sort = true)
    {
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
	    
	  if($sort){
	     krsort($this->prefixes);   
	  }
    }		

    public function withClassmap(array $classMap = null)
    {
	 
        krsort(self::$classmap);  
	    
        if(null !== $classMap){
           foreach($classMap as $class => $server){
           if('@' === substr($class, 0, 1) && is_string($server)){
               $this->_withAlias($class, $server, false);
           }elseif('\\' === substr($class, -1)){
		 $this->_withNamespace($class, $server, false, false);  
           }else{
                self::$classmap[$class] = $server;
           }

           }
         }
	    
	krsort($this->alias);       
	krsort($this->prefixes);   
        return self::$classmap;
    }

    public function withAlias(string $alias, string $rewrite)
    {
        $this->_withAlias($alias, $rewrite, true);
    }
    protected function _withAlias(string $alias, string $rewrite, bool $sort = true)
    {
        $this->alias[ltrim($alias, '@')] = $rewrite;
	  if($sort){		 
	      krsort($this->alias);   
	  }
    }
		
    public function withSalt(bool $salted = null)
    {
        if(null !== $salted){
         $this->salted = $salted;
         }

        return $this->salted;
    }	
	
	   //ClassmapGeneratorApiInterface	
	   public function getClassmapCachefileFor(string $app, string $version, string $phpVersion = \PHP_VERSION) : string {
		$dir=  (is_string($this->cacheDir)) ? rtrim($this->cacheDir, \DIRECTORY_SEPARATOR.' \\/ ').\DIRECTORY_SEPARATOR :  \sys_get_temp_dir().\DIRECTORY_SEPARATOR;   
		$dir.= '~application-classmaps-caches'.  \DIRECTORY_SEPARATOR;
		$dir.= 'remote-mapping-' . \substr(sha1($app), 0, 4).  \DIRECTORY_SEPARATOR;   
		$dir.= preg_replace("/[^A-Za-z0-9\-\.\_]/", '-', $app).\DIRECTORY_SEPARATOR;   
		$dir.= sha1($version).strlen($version) .  \DIRECTORY_SEPARATOR;   
		$dir.= 'php-'.$phpVersion.  \DIRECTORY_SEPARATOR;  
		return $dir.'remote-classmap.php';
	   }
	   protected function _isClassmapfileCacheExpired($file, $cache) : bool {
		  switch($cache){
		      case false :
			    return true;	  
		          break;
		      case true :
			    return !file_exists($file);	  
		         break;
		      case \is_int($cache) :
			   return !file_exists($file) || ($cache > 0 && filemtime($file) < time() - $cache);	  
		          break;
		    default :
		      return !file_exists($file);
		     break;
		  }
	   }
	   //ClassmapGeneratorApiInterface		
	   // $cache = true : load from cache if exists
           // $cache = int :  load from cache if it is newer than $cache seconds
	   // $cache = false : invalidate cache for the classmap and load from implementation/API
	   public function getClassmapFor(string $app, string $version, string $phpVersion = \PHP_VERSION, int | bool $cache = true) : array | bool {
		$file = $this->getClassmapCachefileFor($app, $version, $phpVersion);
		   
	        if(!$this->_isClassmapfileCacheExpired($file, $cache)){
		   return require $file;
		}
		   
		   $userAgent = 'Webfan/Fusio-Plugin-0.0.1'
				  .' Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML,like Gecko) Chrome/107.0.0.0 Safari/537.36';
		   $this->withUserAgent($userAgent);
	     
		   $url = sprintf('https://api.webfan.de/v1/install/generate/%s/%s/autoloading/remote-mapping/%s/classmap', $app, $version, $phpVersion);
		   
		   $httpResult = $this->transport($url, 'GET', [		 
	
		   ], [		          		
			   // 'ignore_errors' => false,	   		
			   'timeout' =>$this->httTimeout * 3,	
		   ]);

                  if($httpResult != '200'){
                    return false;
		  }
	 
		   $json = $httpResult->body;		   
		   $classMap = \json_decode($json);
		   $classMap = (array)$classMap;
		 //  $classMap = (array)$classMap['result'];
		   $exp = \var_export($classMap, true);
		   $phpCode = <<<PHPCODE
<?php
 return $exp;
PHPCODE;		   
		
		  if(!is_dir(dirname($file))){
		    \mkdir(dirname($file), 0775, true);	  
		  }
		   \file_put_contents($file, $phpCode);
		return $classMap;
	   }	
		
	   //ClassmapGeneratorApiInterface		
	   public function withClassmapFor(string $app, string $version, string $phpVersion = \PHP_VERSION, int | bool $cache = true) : bool {
		 $classMapInfo = $this->getClassmapFor($app, $version, $phpVersion, $cache);
		 if(is_bool($classMapInfo)){
                   return $classMapInfo;
		 }elseif(is_array($classMapInfo)){
		   $classMap =!isset($classMap['result']) ? $classMap : $classMap['result'];
		   $this->withClassmap($classMap);
		 }else{
			return false; 
		 }
		 
	    return true;
	   }
		
		
    public function withDefaultValidators(string $dir = null,bool $increaseTimelimit = null){
	    
	    if(\in_array(__METHOD__, $this->_calledWIthDefaultMethods)){
		return;    
	    }
	    $this->_calledWIthDefaultMethods[] = __METHOD__;
	    
	    if(null===$dir){
		  $dir=  (is_dir($this->cacheDir)) ? $this->cacheDir :  \sys_get_temp_dir().\DIRECTORY_SEPARATOR;		    
	    }
	   $httTimeout = $this->httTimeout;
	   $publicKeyChanged = false; 
	   $increaseTimelimit = is_null($increaseTimelimit) ? self::$increaseTimelimit : $increaseTimelimit; 
	    
	    $me = &$this;

 $setPublicKey = function($baseUrl, $expFile, $pubKeyFile) use($httTimeout, $increaseTimelimit, $me) {
	 if(file_exists($expFile)){       
		 $expires = intval(file_get_contents($expFile));
	 }else{      
		 $expires = 0;
	 }	 
			if(!is_dir(dirname($expFile))){
			   mkdir(dirname($expFile), 0755, true);	
			}
			
			if(!is_dir(dirname($pubKeyFile))){
			   mkdir(dirname($pubKeyFile), 0755, true);	
			}

	   if($expires > 0 && ($expires === time() || ($expires > time() - 3 && $expires < time() + 3))){
		   sleep(3);
	   }
      if($expires <= time()  || !file_exists($pubKeyFile) ){
	      
		if($increaseTimelimit){			
		  set_time_limit(max(max($httTimeout,240), intval(ini_get('max_execution_time')) + max($httTimeout,240)));
		}
	      
	  $httpResult = $me->transport($baseUrl.'source='.urlencode('@server.key'), 'GET', [
		 
	 ], [		          
		// 'ignore_errors' => false,	   
		 'timeout' =>$this->httTimeout * 4,  
	 ]);
	    $key = $httpResult->body;
	      
	      	  if(false === $key || empty($key) ){
			throw new \Exception('Cannot get '.  $baseUrl.'source=@server.key in '.__METHOD__);
		      return;
		  }					    
		
	   foreach($httpResult->headers as $i => $header){				
            $h = explode(':', $header);
			if('x-frdlweb-source-expires' === strtolower(trim($h[0]))){
				file_put_contents($expFile, trim($h[1]) );
				break;
			}           
           }
		  
		  file_put_contents($pubKeyFile, $key);
	}//keyfile expired and refetched
	 
 };

 $getDefaultValidatorForUrl = function($baseUrl, $cacheDir, $increaseTimelimit = true) use($httTimeout, $setPublicKey, &$publicKeyChanged) {
      $parsedUrl = parse_url($baseUrl);
      $host = is_array($parsedUrl) && isset($parsedUrl['host']) ? $parsedUrl['host'] : 'DNS_PROBE_FINISHED_NXDOMAIN';
      $expFile =  rtrim($cacheDir, '\\/ ') .	\DIRECTORY_SEPARATOR.'validator-'.$host.'-'.sha1($baseUrl).strlen($baseUrl).'.expires.txt';
      $pubKeyFile =  rtrim($cacheDir, '\\/ ') .	\DIRECTORY_SEPARATOR.'validator-'.$host.'-'.sha1($baseUrl).strlen($baseUrl).'.public-key.txt';
	 
  
	 $condition = function($url, &$loader, $class) use($httTimeout, $baseUrl, $increaseTimelimit){
		if($baseUrl === substr($url, 0, strlen($baseUrl) ) && $class !== \PhpParser\PrettyPrinter\Standard::class ){
		         if($increaseTimelimit){			
		            set_time_limit(max(max($httTimeout,120), intval(ini_get('max_execution_time')) + max($httTimeout,120)));
		         }			
			return true;	  
		}else{
		  return false;	
		}
	 };
	
	 
     $cb = null; 
     $filter = function($code, &$loader, $class, $c = 0) use(&$cb, $baseUrl, $expFile, $pubKeyFile, $setPublicKey, &$publicKeyChanged) {
	        $c++;
		$sep = 'X19oYWx0X2NvbXBpbGVyKCk7'; 
        $my_signed_data=$code;
	     
	     $setPublicKey($baseUrl, $expFile, $pubKeyFile);
	     
	   	    
	     if(!file_exists($pubKeyFile)){
		   return new \Exception("ERROR -- missing public key for ".$class." at ".$baseUrl.": ".htmlentities(substr($code, 0, 1024).'...'));   
	     }
	     
        $public_key = file_get_contents($pubKeyFile);
		 
      list($plain_data,$sigdata) = explode(base64_decode($sep), $my_signed_data, 2);
	if(empty($sigdata) || empty($plain_data)){
		 return new \Exception("ERROR -- unsigned data for ".$class." at ".$baseUrl.": ".htmlentities(substr($code, 0, 1024).'...'));     
	}

    list($nullVoid,$old_sig_1) = explode("----SIGNATURE:----", $sigdata, 2);
    list($old_sig,$ATTACHMENT) = explode("----ATTACHMENT:----", $old_sig_1, 2);
	 $old_sig = $old_sig ? base64_decode($old_sig) : '';	 
	 $ATTACHMENT = $ATTACHMENT ? base64_decode($ATTACHMENT) : '';
    if(empty($old_sig)){
       return new \Exception("ERROR -- unsigned data for ".$class." at ".$baseUrl.": ".htmlentities(substr($code, 0, 1024).'...'));     
    }
    \openssl_public_decrypt($old_sig, $decrypted_sig, $public_key);
    $data_hash = sha1($plain_data.$ATTACHMENT).substr(str_pad(strlen($plain_data.$ATTACHMENT).'', 128, strlen($plain_data.$ATTACHMENT) % 10, \STR_PAD_LEFT), 0, 128);
    if($decrypted_sig === $data_hash && strlen($data_hash)>0){
        return $plain_data;
	}else{
		if(!$publicKeyChanged && $c <= 1){
		   $publicKeyChanged = true;
		   unlink($pubKeyFile);
		   unlink($expFile);
		   $setPublicKey($baseUrl, $expFile, $pubKeyFile);
		   return $cb($code, $loader, $class, $c);	
		}
           return new \Exception("ERROR -- untrusted signature");
	}
  };
    $cb = $filter;	 
   return [$condition, $filter];
 };


 $getDefaultValidators = function($cacheDir,bool $increaseTimelimit = null) use($getDefaultValidatorForUrl) {

    return [            
	 $getDefaultValidatorForUrl('https://latest.software-download.frdlweb.de/?', $cacheDir, $increaseTimelimit),
         $getDefaultValidatorForUrl('https://stable.software-download.frdlweb.de/?', $cacheDir, $increaseTimelimit),
         $getDefaultValidatorForUrl('https://startdir.de/install/latest/?', $cacheDir, $increaseTimelimit),
         $getDefaultValidatorForUrl('https://startdir.de/install/stable/?', $cacheDir, $increaseTimelimit),
         $getDefaultValidatorForUrl('https://startdir.de/install/?', $cacheDir, $increaseTimelimit),
         $getDefaultValidatorForUrl('https://webfan.de/install/stable/?', $cacheDir, $increaseTimelimit),
         $getDefaultValidatorForUrl('https://webfan.de/install/latest/?', $cacheDir, $increaseTimelimit),
	 $getDefaultValidatorForUrl('https://webfan.de/install/?', $cacheDir, $increaseTimelimit),
    ];
 };
	    
	        
	    foreach($getDefaultValidators($dir, $increaseTimelimit) as $validator){	  
		    $this->withAfterMiddleware($validator[0], $validator[1]);   
	    }		
	    
	return $this;    
    }
		

    public function file_get_contents($url){
	$transport = $this->transport($url);  
	return $transport->body;
    }
		
    public function withWebfanWebfatDefaultSettings(string $dir = null,bool $increaseTimelimit = null){
	    if(\in_array(__METHOD__, $this->_calledWIthDefaultMethods)){
		return;    
	    }
	    $this->_calledWIthDefaultMethods[] = __METHOD__;	    
	    
	    if(null===$dir){
		  $dir=  (is_dir($this->cacheDir)) ? $this->cacheDir :  \sys_get_temp_dir().\DIRECTORY_SEPARATOR;		    
	    }
		    
	    
	  /* some dirty workaround patches... */
	  $this->withBeforeMiddleware(function($class, &$loader){
	        $dir = dirname($loader->file('Foo'));
	       switch($class){
		       case \Embed\OEmbed::class :
			         $classFile = $loader->file($class);
			         $dirName = dirname($classFile).\DIRECTORY_SEPARATOR.'resources';
			       if(!is_dir($dirName)){
				  mkdir($dirName, 0775, true);       
			       }
			       $aFile = $dirName.\DIRECTORY_SEPARATOR.'oembed.php';
			       if(!file_exists($aFile)){
				    file_put_contents($aFile, $loader->file_get_contents('https://raw.githubusercontent.com/oscarotero/Embed/530593af5ef7c6701a075eee1be58aa5aaa17c95/src/resources/oembed.php?cache_bust='.time()));      
			       }


			       $aFile = $dirName.\DIRECTORY_SEPARATOR.'suffix.php';
			       if(!file_exists($aFile)){
				    file_put_contents($aFile, $loader->file_get_contents('https://raw.githubusercontent.com/oscarotero/Embed/530593af5ef7c6701a075eee1be58aa5aaa17c95/src/resources/suffix.php?cache_bust='.time()));      
			       }		        
			       
			       return true;
			   break;	
		       case \ActivityPhp\Version::class : 
			         $classFile = $loader->file($class);
			         $dirName = dirname(dirname(dirname($classFile)));
			         $jsonFile =  $dirName.\DIRECTORY_SEPARATOR.'composer.json';
			       if(!file_exists($jsonFile)){
			         $theJson = $loader->file_get_contents('https://raw.githubusercontent.com/landrok/activitypub/f30b8f726cf1a196337ec065536eba2d66a4b329/composer.json');
				  file_put_contents($jsonFile, $theJson);
			       }
			      break;
		       case \Smarty::class :
			       $aDir = dirname($dir).\DIRECTORY_SEPARATOR.'autoload-files-conditional'.\DIRECTORY_SEPARATOR.'smarty-php';
			       if(!is_dir($aDir)){
				  mkdir($aDir, 0775, true);       
			       }
			       $aFile = $aDir.\DIRECTORY_SEPARATOR.'functions.php';
			       if(!file_exists($aFile)){
				    file_put_contents($aFile, $loader->file_get_contents('https://raw.githubusercontent.com/smarty-php/smarty/v4.3.0/libs/functions.php?cache_bust='.time()));      
			       }
			       if (!in_array($aFile, get_included_files())) {
			           require_once $aFile;
			       }
			       
			       return true;
			   break;	
		       case \DI\Compiler\Compiler::class :
			       $aDir = dirname($loader->file($class));
			       if(!is_dir($aDir)){
				  mkdir($aDir, 0755, true);       
			       }
			       $aFile = $aDir.\DIRECTORY_SEPARATOR.'Template.php';
			       if(!file_exists($aFile)){
				    file_put_contents($aFile, 
					$loader->file_get_contents('https://raw.githubusercontent.com/PHP-DI/PHP-DI/6d4ac8be4b0322200a55a0fbf5d32b2be3c1062b/src/Compiler/Template.php?cache_bust='.time()));      
			       }
			       return true;
			   break;			
		       case \Webfan\Webfat\App\ContainerAppKernel::class :       
		       case \DI\ContainerBuilder::class :
		       case 'DI\\' === substr($class,0 , 3) :  
			       $aDir = dirname($dir).\DIRECTORY_SEPARATOR.'autoload-files-conditional'.\DIRECTORY_SEPARATOR.'php-di';
			       if(!is_dir($aDir)){
				  mkdir($aDir, 0775, true);       
			       }
			       $aFile = $aDir.\DIRECTORY_SEPARATOR.'functions.php';
			       if(!file_exists($aFile)){
				    file_put_contents($aFile, $loader->file_get_contents('https://raw.githubusercontent.com/PHP-DI/PHP-DI/6.0-release/src/functions.php?cache_bust='.time()));      
			       }
			       if (!in_array($aFile, get_included_files())) {
			           require_once $aFile;
			       }
			       
			       return true;
			   break;
		       case \Amp\Dns\Resolver::class : 
		       case 'Amp\Dns\\' === substr($class, 0, strlen('Amp\Dns\\') ) :   
			       $aDir = dirname($dir).\DIRECTORY_SEPARATOR.'autoload-files-conditional'.\DIRECTORY_SEPARATOR.'amp-dns';
			       if(!is_dir($aDir)){
				  mkdir($aDir, 0775, true);       
			       }
			       $aFile = $aDir.\DIRECTORY_SEPARATOR.'functions.php';
			       if(!file_exists($aFile)){
				    file_put_contents($aFile, $loader->file_get_contents('https://raw.githubusercontent.com/amphp/dns/v1.2.3/lib/functions.php?cache_bust='.time()));      
			       }
			       if (!in_array($aFile, get_included_files())) {
			           require_once $aFile;
			       }
			       
			       return true;
			   break;
		       case \Amp\Loop::class : 
		       case 'Amp\\' === substr($class, 0, strlen('Amp\\') ) && 'Amp\Dns\\' !== substr($class, 0, strlen('Amp\Dns\\') ) : 
			      foreach(['functions.php', 'Internal/functions.php'] as $file){
			         $aDir = dirname($dir).\DIRECTORY_SEPARATOR.'autoload-files-conditional'.\DIRECTORY_SEPARATOR.'amp-amp'
					 .\DIRECTORY_SEPARATOR. dirname(str_replace('/', \DIRECTORY_SEPARATOR, $file));
			         if(!is_dir($aDir)){
				     mkdir($aDir, 0775, true);       
			          }
			          $aFile = $aDir.\DIRECTORY_SEPARATOR.'functions.php';
			           if(!file_exists($aFile)){
				       file_put_contents($aFile, $loader->file_get_contents('https://raw.githubusercontent.com/amphp/amp/v2.6.2/lib/'.$file.'?cache_bust='.time()));      
			          }
			          if (!in_array($aFile, get_included_files())) {
			             require_once $aFile;
			          }
			      }
			       return true;
			   break;
		       case \Webfan\Webfat\EventModule::class :       
		       case \Webfan\Webfat\App\Router::class :       
		       case \Webfan\Router::class : 
		       case 'Opis\Closure\\' === substr($class, 0, strlen('Opis\Closure\\') ) : 
			       $aDir = dirname($dir).\DIRECTORY_SEPARATOR.'autoload-files-conditional'.\DIRECTORY_SEPARATOR.'opis-closure';
			       if(!is_dir($aDir)){
				  mkdir($aDir, 0775, true);       
			       }
			       $aFile = $aDir.\DIRECTORY_SEPARATOR.'functions.php';
			       if(!file_exists($aFile)){
				    //file_put_contents($aFile, file_get_contents('https://raw.githubusercontent.com/opis/closure/3.6.3/functions.php?cache_bust='.time()));   
				       file_put_contents($aFile, $loader->file_get_contents('https://raw.githubusercontent.com/opis/closure/3.5.5/functions.php?cache_bust='.time()));   
			       }
			       if (!in_array($aFile, get_included_files())) {
			           require_once $aFile;
			       }
			       
			       return true;
			   break; 
		       case 'Spatie\\Once\\' === substr($class, 0, strlen('Spatie\\Once\\') ) :
			       $aDir = dirname($dir).\DIRECTORY_SEPARATOR.'autoload-files-conditional'.\DIRECTORY_SEPARATOR.'spatie-once';
			       if(!is_dir($aDir)){
				  mkdir($aDir, 0775, true);       
			       }
			       $aFile = $aDir.\DIRECTORY_SEPARATOR.'functions.php';
			       if(!file_exists($aFile)){
				  file_put_contents($aFile, $loader->file_get_contents('https://raw.githubusercontent.com/spatie/once/3.1.0/src/functions.php?cache_bust='.time()));   
			       }
			       if (!in_array($aFile, get_included_files())) {
			           require_once $aFile;
			       }
			       
			       return true;
			   break;             		     
		       case 'Guzzle' === substr($class, 0, strlen('Guzzle') ) :
			       $aDir = dirname($dir).\DIRECTORY_SEPARATOR.'autoload-files-conditional'.\DIRECTORY_SEPARATOR.'guzzle-http';
			       if(!is_dir($aDir)){
				     mkdir($aDir, 0775, true);       
			       }
			       $aFile = $aDir.\DIRECTORY_SEPARATOR.'functions.php';
			       $aFile_2 = $aDir.\DIRECTORY_SEPARATOR.'functions_2.php';
			       $aFile_3 = $aDir.\DIRECTORY_SEPARATOR.'functions_3.php';
			       if(!file_exists($aFile)){
				      file_put_contents($aFile, base64_decode($loader->file_get_contents(
					  'https://webfan.de/install/?source=GuzzleHttp\Psr7\stream_for&salt='.time())
					  ));   
			       }
			       if(!file_exists($aFile_2)){
				      file_put_contents($aFile_2, base64_decode( $loader->file_get_contents(
					  'https://webfan.de/install/?source=GuzzleHttp\choose_handler&salt='.time())
															   )
									   );   
			       }
			       if(!file_exists($aFile_3)){
				      file_put_contents($aFile_3, $loader->file_get_contents(
					  'https://raw.githubusercontent.com/guzzle/promises/b94b2807d85443f9719887892882d0329d1e2598/src/functions.php')
					  );   
			       }
				   
			       if (!in_array($aFile, \get_included_files())) {
			           require_once $aFile;
			       }
			       if (!in_array($aFile_2, \get_included_files())) {
			           require_once $aFile_2;
			       }			       
			       if (!in_array($aFile_3, \get_included_files())) {
			           require_once $aFile_3;
			       }
			       return true;
			   break;
		       default:
			    return true;
			  break;
	       }
	   
	    /*   return true;  return false to skip this autoloader, return any/VOID to continue */
          });     
		    

	    $this->withClassmapFor('default', 'latest', \PHP_VERSION, $this->cacheLimit);
	       
	    /*
	    $this->withUrlRewriterMiddleware(function($url){
		$now = new \DateTimeImmutable();    
		if( intval($now->format('Y')) <= 2023 ){
		   $p = \parse_url($url);
		   if('webfan.de' === $p['host']){
			$p['host'] = 'startdir.de';
			 $url = \frdl\implementation\psr4\RemoteAutoloaderApiClient::unparse_url( $url, $p, false );  
		   }
		}
		   return $url;
	    });
	    */
	return $this;
    }
   //end default-patches
	
	
	
	
	
		
		
    public static function getInstance(
        $server =  'https://webfan.de/install/stable/?source={class}&salt={salt}',
        $register = true,
        $version = 'latest',
        $allowFromSelfOrigin = true,
        $salted = false,
        $classMap = null,
        $cacheDirOrAccessLevel = self::ACCESS_LEVEL_SHARED,
        $cacheLimit = null,
        $password = null
    ) {
        $key = static::ik();

          if(is_array($server)){
         // $arr = [];
          foreach($server as $s){
           //  $arr[]=
                 self::getInstance($s['server'], $s['register'], $s['version'], $s['allowFromSelfOrigin'], $s['salted'], $s['classmap'], $s['cacheDirOrAccessLevel'], $s['cacheLimit'], $s['password']);
          }

        //    if(2 > count(func_get_args()) ){
        //    return self::$instances[count(self::$instances)-1];
        //    }

        $server = 'file://'.getcwd().\DIRECTORY_SEPARATOR;
        ///$key = sha1(getcwd()).'.localhost';
          }//elseif(is_callable($server)){
        //    $key = \spl_object_id($server);
        //  }elseif(is_string($server)){
        //    $key = $server;
        //  }

          if(!isset(self::$instances[static::ik()])){
         // self::$instances[$key] =
              new self($server, $register, $version, $allowFromSelfOrigin, $salted, $classMap, $cacheDirOrAccessLevel, $cacheLimit, $password);
          }

         return self::$instances[static::ik()];
    }

    public static function ik()
    {
        return \getmypid();
    }

    public function __construct(
        $server = 'https://webfan.de/install/stable/?source={{class}}&salt={{salt}}',
        $register = true,
        $version = 'latest',
        $allowFromSelfOrigin = true,
        $salted = false,
        $classMap = null,
        $cacheDirOrAccessLevel = self::ACCESS_LEVEL_SHARED,
        $cacheLimit = null,
        $password = null
    ) {
	$this->withTransport('http', [$this, 'fetchHttp']);
	$this->setTransport('http');    
	$this->salt = mt_rand(10000000,99999999);       
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
	        $defauoltcacheLimit = $defauoltcacheLimit > 0 ? \max($defauoltcacheLimit, 5 * 60) : 24 * 60 * 60;	   
               break;
           }

        $this->cacheLimit = (is_int($cacheLimit)) ? $cacheLimit 
		: ((isset($_ENV['FRDL_HPS_PSR4_CACHE_LIMIT']))? $_ENV['FRDL_HPS_PSR4_CACHE_LIMIT'] : $defauoltcacheLimit);


           $this->cacheDir =/* (is_string($cacheDirOrAccessLevel)
			       && is_dir($cacheDirOrAccessLevel) && is_readable($cacheDirOrAccessLevel) && is_writeable($cacheDirOrAccessLevel)
			     ) */
	    is_string($cacheDirOrAccessLevel)	   
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
	           is_dir($CacheDir)
               &&  is_writable($CacheDir)
               && is_readable($CacheDir)
                )
             )

             && true === $checked
                ? true
                : false
            ;
        });

          if(!is_dir($this->cacheDir)){
            mkdir($this->cacheDir, 0775,true);
          }else{
	    chmod($this->cacheDir, 0775);	  
	  }

         if(!$valCacheDir($this->cacheDir,false,false) ){
           throw new \Exception('Bootstrap error in '.basename(__FILE__).' '.__LINE__.' for '.$this->cacheDir);
         }
       
           if(!is_array($classMap)){
             $classMap = self::CLASSMAP_DEFAULTS;
           }

            $this->withSalt($salted);
            $this->withClassmap($classMap);
        $this->allowFromSelfOrigin = $allowFromSelfOrigin;
        $this->version=$version;
        $this->server = $server;
        $_self = (isset($_SERVER['SERVER_NAME'])) ? $_SERVER['SERVER_NAME'] 
	       : ( (isset($_SERVER['HTTP_HOST']) && \php_sapi_name() !== 'cli' ) ? $_SERVER['HTTP_HOST'] : \php_uname("n"));
        $h = explode('.', $_self);
        $dns = array_reverse($h);
        $this->selfDomain = $dns[1].'.'.$dns[0];

    if(is_string($this->server)){
        $h = explode('.', $this->server);
        $dns = array_reverse($h);
        $this->domain = $dns[1].'.'.$dns[0];
    }

        if(true === $register && !$this->allowFromSelfOrigin && $this->domain === $this->selfDomain){
	   $message = 'Autoloading from remote at this domain at self local server is disabled in '.__METHOD__;
	   throw new \Exception($message);
          //$register = false;
        }

        $this->withDefaultValidators($this->cacheDir,null);

        if(true === $register){
           $this->register();
        }
    }

    public function generateHash(array $chunks = [], $key = null, $algo = 'sha1', $delimiter = '-', &$ctx = null)
    {
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


		
    public function str_contains($haystack, $needle, $ignoreCase = false)
    {
        if ($ignoreCase) {
           $haystack = strtolower($haystack);
           $needle   = strtolower($needle);
        }
        $needlePos = strpos($haystack, $needle);
      //  return ($needlePos === false ? false : ($needlePos+1));
		return $needlePos === false ? false : true;
    }

    public function str_parse_vars($string, $start = '[', $end = '/]', $variableDelimiter = '=')
    {
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

    public function getUrl($class, $server, $salt = null, $parseVars = false)
    {
        if(!is_string($salt))$salt=$this->salt;
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
         }/*elseif(preg_match("/^([a-z0-9]+)\.webfan\.de$/", $server, $m) && false !== strpos($server, '.') ){
         $url = 'https://'.$m[1].'.webfan.de/install/?salt=${salt}&source=${class}&version=${version}';
         }*/elseif(preg_match("/^([\w\.^\/]+)(\/[.*]+)?$/", $server, $m) && false !== strpos($server, '.') ){
         $url = 'https://'.$m[1].((isset($m[2])) ? $m[2] : '/');
         }//else{
          
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
           return  (true === $parseVars && is_string($url)) ?  $this->replaceUrlVars($url, $salt, $class, $this->version) : $url;
    }

    public function replaceUrlVars($url, $salt, $class, $version)
    {
		if(empty($salt)){
		  $salt = $this->salt;	
		}
		
		  $url = preg_replace('/(\$\{class\})/',str_replace('\\', '/', $class), $url);
		  $url = preg_replace('/(\$\{salt\})/', $salt, $url);
		  $url = preg_replace( '/(\$\{version\})/',$version, $url);
	 
		return $url; 
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
       if(!is_string($salt)){
           $salt = $this->salt;
        }	    
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
            if ($mapped_file && $this->exists($mapped_file) ) {
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
        if(!is_string($salt)){
           $salt = $this->salt;
        }	    
	    
        $url = false;
        $class = $prefix.$relative_class;

        //if(isset($this->alias[$class]) ){
        //    \webfan\hps\Format\DataUri
        //    die(__LINE__.$class.' Alias: '.$this->alias[$class]);
        //    }
        $pfx = !isset($this->alias[$prefix]) && substr($prefix,-1) === '\\' ? substr($prefix, 0, -1) : $prefix;



        if(isset($this->alias[$pfx]) ){
        //    \webfan\hps\Format\DataUri
            $originalClass = substr($this->alias[$pfx],-1) === '\\' ? substr($this->alias[$pfx], 0, -1) : $this->alias[$pfx];
            $originalClass .= '\\'.$relative_class;
            $alias = $class;

        //    die($classOrInterfaceExists.' <br />'.$alias.' <br />rc: '.$originalClass.'<br />'.$datUri);
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
             $url = $this->getUrl($class, self::$classmap[$class], $salt, true);
             $url =  $this->replaceUrlVars($url, $salt, $class, $this->version); 
		         
		if(is_string($url) && $this->exists($url) ){              
		   return $url;           
		}
        }

         if (isset($this->prefixes[$prefix]) ) {
        // look through base directories for this namespace prefix
        foreach ($this->prefixes[$prefix] as $server) {

            $url = $this->getUrl($relative_class, $server, $salt, true);
            $url =  $this->replaceUrlVars($url, $salt, $relative_class, $this->version); 
		
            if(is_string($url) && $this->exists($url) ){
                return $url;
            }
        }
         }
        // never found it
           return $this->getUrl($class, $this->server, $salt, true);
    }

    /**
     * If a file exists, require it from the file system.
     *
     * @param string $file The file to require.
     * @return bool True if the file exists, false if not.
     */
    protected function requireFile($file)
    {
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

    public static function __callStatic($name, $arguments)
    {
        $me = (count(self::$instances)) ? self::$instances[0] : self::getInstance();
           return call_user_func_array([$me, $name], $arguments);
    }

    public function __call($name, $arguments)
    {
        if(!in_array($name, ['fetch', 'fetchCode', '__invoke', 'register', 'getLoader', 'Autoload'])){
          throw new \Exception('Method '.$name.' not allowed in '.__METHOD__);
           }
           return call_user_func_array([$this, $name], $arguments);
    }

    protected function fetch()
    {
        return call_user_func_array([$this, 'fetchCode'], func_get_args());
    }

    public function exists($source)
    {
	    
	if(isset(self::$existsCache[$source])){
	   return self::$existsCache[$source];	
	}
	    
	    
        if('http://'!==substr($source, 0, strlen('http://'))
           && 'https://'!==substr($source, 0, strlen('https://'))
	  ){
		$exists =  is_file($source) && file_exists($source) && is_readable($source);
		if(true === $exists){
		   self::$existsCache[$source] = $exists;	
		}
             return $exists;
        }

   			 
	    $httpResult = $this->transport($source, 'HEAD', null, [		          	
				     'ignore_errors' => false,	   	
				     'timeout' => max(1, floor($this->httTimeout / 2)),  	
			     ]);				    
	    $res = $httpResult->body;
	    
        $exists = false !== $res;
	    
	self::$existsCache[$source] = $exists;
      return $exists;
    }

    public function fetchHttp(string $url, string $method = 'GET', array $headers = null, array $options = null, array $httpOpts= null){
        $httpOptions = [
        'http' => [
            'method'  => $method,
            'ignore_errors' => false,
	    'timeout' => $this->httTimeout,  
	    'follow_location' => true,	
            'header'=> ""// "X-Source-Encoding: b64\r\n"
               // . "Content-Length: " . strlen($data) . "\r\n"
				,
           ]
        ];	 
	 if(is_array($httpOpts)){
	   $httpOptions = array_merge($httpOptions, $httpOpts);	 
	 } 
	 if(is_array($options)){
	   $httpOptions['http'] = array_merge($httpOptions['http'], $options);	 
	 }
	 if(!is_array($headers)){
	   $headers = [			   	
	      'X-Source-Encoding' => 'b64',
	   ];	 
	 }
	    if(is_string($this->userAgent)){
		$headers['User-Agent'] = $this->userAgent;    
	    }
	    
	    foreach($headers as $key => $value){
		$httpOptions['http']['header'].= $key.": ". $value .  "\r\n";    
	    }
	    
	$httpOptions['http']['method'] = $method;   
	
	$transport = new \stdclass;    
        $transport->context  = stream_context_create($httpOptions);
        $transport->body = @file_get_contents($url, false, $transport->context);	
	  $transport->headers = array_merge([], is_array($http_response_header) ? $http_response_header : []);
	    if(isset($transport->headers[0])){	 
		  preg_match('{HTTP\/\S*\s(\d{3})}', $transport->headers[0], $match);		
		  $transport->status = (isset($match[1])) ? $match[1] : (\is_string($transport->body) ? '200' : '404');
	    }else{
		   $transport->status = \is_string($transport->body) ? 200 : 404;  			
		 //   error_log('Wrong status code for '.$url.' in '.__METHOD__, \is_string($transport->body) ? \E_USER_NOTICE : \E_USER_WARNING);
		//    error_log('Wrong status code for '.$url.' in '.__METHOD__, \E_USER_NOTICE);
	    }
	return $transport;    
    }
 
    /*
    by kibblewhite+php at live dot com https://www.php.net/manual/en/function.parse-url.php#125844
   $test_url = 'http://usr:pss@example.com:81/mypath/myfile.html?a=b&b[]=2&b[]=3&z=9#myfragment';

    $new_url_01_overwrite_query_params = self::unparse_url( $test_url, array(
        'host' => 'new-hostname.tld',
        'query' => array(
            'test' => 'Hello World',
            'a'    => array( 'c', 'd' ),
            'z'    => 8
        ),
        'fragment' => 'new-fragment-value'
    ), false );

    $new_url_02_mergewith_query_params = self::unparse_url( $test_url, array(
        'query' => array(
            'test' => 'Hello World',
            'a'    => array( 'c', 'd' ),
            'z'     => 8
        ),
        'fragment' => 'new-fragment-value'
    ), true );    
    */
    public static function unparse_url( string $url, array $overwrite_parsed_url_array = null, bool $merge_query_parameters = null ) : string {

		$merge_query_parameters = is_bool($merge_query_parameters) ? $merge_query_parameters : true;
		$overwrite_parsed_url_array = is_array($overwrite_parsed_url_array) ? $overwrite_parsed_url_array : [];
		
		
        $parsed_url_array = \parse_url( $url );
        $parsed_url_keys_array = [
            'scheme'        => null,
            'abempty'       => isset( $parsed_url_array['scheme'] ) ? '://' : null,
            'user'          => null,
            'authcolon'     => isset( $parsed_url_array['pass'] ) ? ':' : null,
            'pass'          => null,
            'authat'        => isset( $parsed_url_array['user'] ) ? '@' : null,
            'host'          => null,
            'portcolon'     => isset( $parsed_url_array['port'] ) ? ':' : null,
            'port'          => null,
            'path'          => null,
            'param'         => isset( $parsed_url_array['query'] ) ? '?' : null,
            'query'         => null,
            'hash'          => isset( $parsed_url_array['fragment'] ) ? '#' : null,
            'fragment'      => null,
        ];

	    if(is_string($overwrite_parsed_url_array['query'])){
	      parse_str( $overwrite_parsed_url_array['query'], $overwrite_parsed_url_array['query'] );
	    }
	    
        if ( isset( $overwrite_parsed_url_array['query'] ) && $merge_query_parameters === true ) {
            $overwrite_parsed_url_array['query'] = \array_merge_recursive( $overwrite_parsed_url_array['query'], $overwrite_parsed_url_array['query'] );
        }elseif ( isset( $overwrite_parsed_url_array['query'] ) && $merge_query_parameters !== true ) {
            $overwrite_parsed_url_array['query'] = \array_merge( $overwrite_parsed_url_array['query'], $overwrite_parsed_url_array['query'] );
        }

        $query_parameters = \http_build_query( $overwrite_parsed_url_array['query'], null, '&', \PHP_QUERY_RFC1738 );
        $overwrite_parsed_url_array['query'] = \urldecode( preg_replace( '/%5B[0-9]+%5D/simU', '%5B%5D', $query_parameters ) );

        $fully_parsed_url_array = \array_filter( \array_merge( $parsed_url_keys_array, $parsed_url_array, $overwrite_parsed_url_array ) );
        return \implode( null, $fully_parsed_url_array );
    }		
		
    public function transport(string $url, string $method = 'GET', array $headers = null, array $options = null, array $httpOpts= null){
	    
	 foreach($this->urlRewriterMiddlewares as $rewriter){
		$url = \call_user_func_array($rewriter, [$url]); 
	 }
	    
	 $callable =  isset($this->_TRANSPORTS[$this->transport]) ? $this->_TRANSPORTS[$this->transport] : false;
	 if(false === $callable){
	     throw new \Exception(sprintf('%sTransport is not set in %s. Use withTransport to define a callable for it!', ucfirst($this->transport), __METHOD__));	 
	 }
			
	    if(is_array($callable) && !is_callable($callable)){			
		    $fn = (\Closure::fromCallable($callable))->bindTo($this, \get_class($this));			
		    $callable = $fn;		    
	    }elseif(true !== $callable instanceof \Closure){			
		    $fn = (\Closure::fromCallable($callable))->bindTo($this);			
		    $callable = $fn;		
	    }	  
	    
		
	    if(true === self::$increaseTimelimit){		 
		    set_time_limit(max(max($this->httTimeout,240), intval(ini_get('max_execution_time')) + max($this->httTimeout,240)));		
	    }    
	    
	  $transport = \call_user_func_array($callable, func_get_args());    
		$status = ((string)$transport->status).'';
		if('3' === substr($status,0, 1)){
		
			foreach($transport->headers as $i => $header){          
				$h = explode(':', $header, 2);           
				$k = strtolower(trim($h[0]));          
				$v =  (isset($h[1])) ? trim($h[1]) : $header;                 
				if('location' === $k){                          
				   return $this->transport($v,  $method ,  $headers,  $options ,  $httpOpts);
				}      
			}
		}
		
     return $transport;
    }
		
		
		
    protected function fetchCode($class, $salt = null)
    {
	 
        if(!is_string($salt)){
           $salt = $this->salt;
        }
          $url = $this->loadClass($class, $salt);
          if(is_bool($url)){
             return $url;
          }
          $withSaltedUrl = (true === $this->str_contains($url, '${salt}', false)) ? true : false;
          $url =  $this->replaceUrlVars($url, $salt, $class, $this->version);
   
		if(self::$increaseTimelimit){			
		  set_time_limit(max(max($this->httTimeout,240), intval(ini_get('max_execution_time')) + max($this->httTimeout,240)));
		}	    

	 $httpResult = $this->transport($url, 'GET', [
		 'X-Source-Encoding'=>'b64',
	 ], [		          
		// 'ignore_errors' => true,	   
		 'timeout' => $this->httTimeout,  		
	 ]);
	    $code = $httpResult->body;
	    
		
		
			
		if((false === $code || 200 != $httpResult->status)
		   && (true === $this->str_contains($url, '/latest/', false) || true === $this->str_contains($url, '/stable/', false))
		  ){
		     $urlOld = $url;
			 if(true === $this->str_contains($url, '/stable/', false)){
				 $url=preg_replace('/(\/stable\/)/', '/latest/', $url);
			 }elseif(true === $this->str_contains($url, '/latest/', false)){
				   $url=preg_replace('/(\/latest\/)/', '/stable/', $url);
			 } 
		     
		   	
		     if($urlOld !== $url){	
			     $httpResult = $this->transport($url, 'GET', [		
				     'X-Source-Encoding'=>'b64',	
			     ], [		          	
				   //  'ignore_errors' => false,	   	
				     'timeout' => $this->httTimeout,  		
			     ]);	  
			     $code = $httpResult->body;
		     }
			//if(false===$code){
			  // return false;	
			//}
		}
		
		
		if((false === $code || 200 != $httpResult->status)
		   && (true === $this->str_contains($url, '/latest/', false) || true === $this->str_contains($url, '/stable/', false))
		  ){
		     $urlOld = $url;
		     $url=preg_replace('/(\/stable\/)/', '/', $url);
		     $url=preg_replace('/(\/latest\/)/', '/', $url);	
		 
			
		     if($urlOld !== $url){	
			     $httpResult = $this->transport($url, 'GET', [		
				     'X-Source-Encoding'=>'b64',	
			     ], [		          	
				   //  'ignore_errors' => false,	   	
				     'timeout' => $this->httTimeout,  		
			     ]);	  
			     $code = $httpResult->body;
		     }
			if(false===$code){
			   return false;	
			}
		}
		
			    
          $json = false;
          $base64 = false;
			
			
        foreach($httpResult->headers as $i => $header){
           $h = explode(':', $header, 2);
           $k = strtolower(trim($h[0]));
           $v =  (isset($h[1])) ? trim($h[1]) : $header;
           
            if('x-content-hash' === $k){
               $hash = $v;
            }elseif('x-user-hash' ===$k){
               $userHash = $v;
           }elseif('content-type' ===$k && 'application/json'===$v){
               $json = true;
           }elseif('x-data-encoding' ===$k && 'base64'===$v){
               $base64 = true;
           }
        }
	
		
		
		
        
	
	if(true === $json){
              $theJson =json_decode($code);			  
		$code = $theJson;
              $code=(array)$code;
              $code = $code['contents'];
			  
		if(isset($theJson['X-Content-Hash'])){
			 $hash = $theJson['X-Content-Hash'];
		}
	
		if(isset($theJson['X-User-Hash'])){
			 $userHash = $theJson['X-User-Hash'];
		}						  
	    
     }


           if(true === $base64){
              $code = base64_decode($code);
           }
     
     	

	    	
		
     if(false===$code
         || !is_string($code)
         || (true === $withSaltedUrl && true === $this->withSalt() && (!isset($hash) || !isset($userHash)))

        ){
          //  throw new \Exception('Missing checksums while fetching source code for '.$class.' from '.$url);
		   error_log('Missing checksums while fetching source code for '.$class.' from '.$url, \E_USER_NOTICE);
		   return false;
          }


          $oCode =$code;

         if(is_string($salt) && true === $withSaltedUrl && true === $this->withSalt() ){
           $hash_check = strlen($oCode).'.'.sha1($oCode);
           $userHash_check = sha1($salt .$hash_check);

           if($hash_check !== $hash || $userHash_check !== $userHash){
         //  throw new \Exception('Invalid checksums while fetching source code for '.$class.' from '.$url);
		   error_log('Invalid checksums while fetching source code for '.$class.' from '.$url
			     .' However: ->withSalt() is DEPRECTATED, use ->withAfterMiddleware validators instead!', \E_USER_NOTICE);
		   return false;
           }
         }
 
	    if($this->is_base64($code) ){  
		    $code = base64_decode($code); 
	    }
	    
      //    $code = trim($code);

		
		
	foreach($this->afterMiddlewares as $middleware){
		  if(( \is_callable($middleware[0]) || ('object' === gettype($middleware[0]) && $middleware[0] instanceof \Closure) ) 
		   && true !== \call_user_func_array($middleware[0], [$url, &$this, $class]) ){
		   continue;	
		}elseif(is_string($middleware[0]) && !preg_match($middleware[0], $url)){
		   continue;	
		}
		$code = call_user_func_array($middleware[1], [$code, &$this, $class]);
		if(!is_string($code)){
		    error_log('Untrusted source code for '.$class.' from '.$url.': INVALID SIGNATURE FOR: ' .htmlentities($code) , \E_USER_WARNING);
		    if('object'===gettype($code) && $code instanceof \Exception){
			throw $code;    
		    }
		    return false;	
		}
       }	
		
		
		
        if(!$this->str_contains($code, '<?', false)){
          //    throw new \Exception('Invalid source code for '.$class.' from '.$url.': ' .htmlentities($code)  );
		   error_log('Invalid source code for '.$class.' from '.$url.': ' .htmlentities($code) , \E_USER_NOTICE);
		   return false;
        }


          if('<?php' === substr($code, 0, strlen('<?php')) ){
          $code = substr($code, strlen('<?php'), strlen($code));
          }
        $code = trim($code, '<?php> ');
          $codeWithStartTags = "<?php "."\n".$code;

        return $codeWithStartTags;
    }

    public function __invoke()
    {
        return call_user_func_array($this->getLoader(), func_get_args());
    }
 
    public function is_base64($s){
      // Check if there are valid base64 characters
      if (!preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $s)) return false;

      // Decode the string in strict mode and check the results
      $decoded = base64_decode($s, true);
      if(false === $decoded) return false;

      // Encode the string again
      if(base64_encode($decoded) != $s) return false;

      return true;
   }
	
    public function register(bool $prepend = false)
    {
	if($this->isLoaderRegistered($isInOrder, $prepend) ) {
          return true;
	}
	$args = func_get_args();
	//if(count($args)>=2 && is_bool($args[1])){
	//  $prepend = $args[1];	
	//}
	$throw = $prepend; /* Always FALSE as false is deprecated in SPL!      This parameter is ignored as of PHP 8.0.0 !!! */   
        $res = false;


     //    if(!$this->allowFromSelfOrigin && $this->domain === $this->selfDomain){
       //     throw new \Exception('You should not autoload from remote where you have local access to the source (remote server = host)');
     //    }

     //   $aFuncs = \spl_autoload_functions();
     //    if(!is_array($aFuncs) || !in_array($this->getLoader(), $aFuncs) ){
      //      $res =  \spl_autoload_register($this->getLoader(), $throw, $prepend);
     //   }
           $res = $this->enable($prepend);

            if( false !== $res  ){
              //  Change: Use a seperate process (or setup): $this->pruneCache(); 
            }else{
                 throw new \Exception(sprintf('Cannot register Autoloader of "%s" with cachedir "%s"', __METHOD__, $this->cacheDir));
            }



        return $res;
    }
  //https://github.com/johnstevenson/statical/blob/master/src/AliasManager.php	
  protected function enable(?bool $prepend = false)
    { 
	if(self::$alwaysAppendLoader === true){
            $prepend = false;
	}
	$isRegistered = $this->isLoaderRegistered($isInOrder, $prepend);
        if (true===$isRegistered) {
            if ($isInOrder) {
                return $isRegistered;
            }

          //  $this->disable();
        }

	    if (version_compare(\PHP_VERSION, '8.0.0') >= 0) { 
		$isRegistered =true!==$prepend ? spl_autoload_register($this->getLoader(), true, $prepend) : spl_autoload_register($this->getLoader(), true, $prepend);    
	    }else{
               $isRegistered = $prepend ? spl_autoload_register($this->getLoader(), true, $prepend) : spl_autoload_register($this->getLoader(), true, $prepend);
	    }
       
       return $isRegistered;
    }
 
    protected function disable()
    {
        spl_autoload_unregister($this->getLoader());
    }
    /**
    * Disables static proxying.
    *
    * @return void
    */
    public function unregister()
    {
       $this->disable();
    }
   //https://github.com/johnstevenson/statical/blob/master/src/AliasManager.php	
   protected function isLoaderRegistered(&$isInOrder, ?bool $prepend = false) : bool
    {
        $registered = false;
        $isInOrder = false;

        if ($funcs = \spl_autoload_functions()) {
            $index = array_search($this->getLoader(), $funcs, true);

            if (false !== $index) {
                $registered = true;
                $isInOrder = true !== $prepend
			? $index === count($funcs) - 1
			: $index === 0;
            }
        }

        return $registered;
    }
	
    protected function getLoader()
    {
        return [$this, 'Autoload'];
    }

    public function pruneCache()
    {
        if($this->cacheLimit !== 0
           && $this->cacheLimit !== -1){
                  $ShutdownTasks = \frdlweb\Thread\ShutdownTasks::mutex();
                  $ShutdownTasks(function($loader, int $cacheLimit){
                          @\ignore_user_abort(true);
                          @\call_user_func_array([$loader, 'prune'], [$cacheLimit]);
                  }, $this, $this->cacheLimit);		
        }
    }
    public function prune(int $cacheLimit)
    {
	\webfan\hps\patch\Fs::pruneDir($this->cacheDir, $cacheLimit, true,  'tmp' !== basename($this->cacheDir));
    }
		
	public function resolve(string $class):bool|string{
	    $cacheFile = $this->file($class);
	    $url =  $this->url( $class );
	    if($this->exists($cacheFile)){
		return $cacheFile;    
	    }elseif(!is_bool($url) && $this->exists($url)){
		return $url;    
	    }elseif( is_bool($url) ){
		return $url;    
	    }else{
		return false;    
	    }		
	}
		
        public function file(string $class):bool|string{
	  return rtrim($this->cacheDir, \DIRECTORY_SEPARATOR.'/\\ '). \DIRECTORY_SEPARATOR. str_replace('\\', \DIRECTORY_SEPARATOR, $class). '.php';
	}
		
        public function url(string $class):bool|string{
        
           $salt = $this->salt;         

          $url = $this->loadClass($class, $salt);

          if(is_bool($url)){
             return $url;
          }

          $url =  $this->replaceUrlVars($url, $salt, $class, $this->version);		
	  return $url;
	}	
	
	
    public function Autoload(string $class):bool|string
    {
	    
		
	foreach($this->beforeMiddlewares as $middleware){
	    if(false === \call_user_func_array($middleware, [$class, &$this]) ){
	      return false;	
	    }        
	}	    
	    
        $cacheFile = $this->file($class);

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



        $code = $this->fetchCode($class, $this->salt);
	if(false===$code){
	   return false;
	}else if(true === $code){
              return true;
        }elseif(false !==$code){
           if(!is_dir(dirname($cacheFile))){
              @mkdir(dirname($cacheFile), 0755, true);
           }

           if(!file_put_contents($cacheFile, $code)){
               throw new \Exception('Cannot write source for class '.$class.' to '.$cacheFile);
            }

        
	}elseif(false ===$code && !file_exists($cacheFile)){
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
           return class_exists($class, false);
        }elseif(isset($code) && is_string($code) && \frdlweb\Thread\ShutdownTasks::class !== $class ){

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

}//ns frdl\implementation\psr4
