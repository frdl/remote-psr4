<?php
/**
* Bundled from https://github.com/frdl/codebase/tree/main/src/Frdlweb/Contract/Autoload
* @ToDo: How could I "preload" this better/from github-sources?
**/
namespace Frdlweb\Contract\Autoload{
 if (!interface_exists(Psr4GeneratorInterface::class)) {	
	interface Psr4GeneratorInterface {		
		public function addNamespace($prefix, $resourceOrLocation, $prepend = false);
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
	   public function register(bool $prepend = false);
	}
 }
}//ns Frdlweb\Contract\Autoload

namespace frdl\implementation\psr4{

class RemoteAutoloaderApiClient implements \Frdlweb\Contract\Autoload\LoaderInterface, 
	\Frdlweb\Contract\Autoload\ResolverInterface,
	\Frdlweb\Contract\Autoload\ClassLoaderInterface,
	\Frdlweb\Contract\Autoload\Psr4GeneratorInterface 
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
        \Webfan\Webfat\Jeytill::class => 'https://raw.githubusercontent.com/frdl/webfat-jeytill/main/src/Jeytill.php',	  
	    
      // NAMESPACES   = \\ at the end:
      'frdl\\Proxy\\' => 'https://raw.githubusercontent.com/frdl/proxy/master/src/${class}.php?cache_bust=${salt}',   
      'DI\\Definition\\' => 'https://raw.githubusercontent.com/PHP-DI/PHP-DI/6.0-release/src/Definition/${class}.php?cache_bust=${salt}',    	    
    
      // ALIAS = @ as first char:
      '@Webfan\\Autoloader\\Remote' => __CLASS__,	    
	    
      //Versions at Webfan:
	  // Default/Fallback Versions Server:
	\webfan\hps\Format\DataUri::class => 'https://webfan.de/install/?salt=${salt}&source=webfan\hps\Format\DataUri',	    
	 // Stable/Current Versions Server:   
        //\webfan\hps\Format\DataUri::class => 'https://webfan.de/install/stable/?salt=${salt}&source=webfan\hps\Format\DataUri',	    
	// Latest/Beta Versions Server:    
	// \webfan\hps\Format\DataUri::class => 'https://webfan.de/install/latest/?salt=${salt}&source=webfan\hps\Format\DataUri',

	    
	    
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
	    
    //Concrete Classes	    
    \Webfan\cta\HashType\HashTypeInterface::class => 'https://raw.githubusercontent.com/frdl/cta/main/src/HashTypeInterface.php',	
    \Webfan\cta\HashType\XHashSha1::class => 'https://raw.githubusercontent.com/frdl/cta/main/src/XHashSha1.php',	
    \Webfan\cta\Storage\StorageInterface::class => 'https://raw.githubusercontent.com/frdl/cta/main/src/StorageInterface.php',
	    
     //misc...
     //You can have functions autoloading
        'GuzzleHttp\choose_handler' => 'https://webfan.de/install/?salt=${salt}&version=${version}&source=GuzzleHttp\choose_handler',
    \GuzzleHttp\LoadGuzzleFunctionsForFrdl::class => 'https://webfan.de/install/?salt=${salt}&version=${version}&source=GuzzleHttp\LoadGuzzleFunctionsForFrdl',

     \Wehowski\Gist\Http\Response\Helper::class =>
    'https://gist.githubusercontent.com/wehowski/d762cc34d5aa2b388f3ebbfe7c87d822/raw/5c3acdab92e9c149082caee3714f0cf6a7a9fe0b/Wehowski%255CGist%255CHttp%255CResponse%255CHelper.php?cache_bust=${salt}',
    
	    
    ];

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
    protected $cacheDir;
    protected $cacheLimit = 0;
    protected static $instances = [];
    protected $alias = [];
    protected static $classmap = [];
    protected static $existsCache = [];
		
    protected $salt;
	
	
    public function withWebfanWebfatDefaultSettings(string $dir = null){
	    if(null===$dir){
		  $dir=  (is_dir($this->cacheDir)) ? $this->cacheDir :  \sys_get_temp_dir().\DIRECTORY_SEPARATOR;		    
	    }
		    
	   $publicKeyChanged = false;
  $increaseTimelimit = true;

 $setPublicKey = function($baseUrl, $expFile, $pubKeyFile){
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
		  	$opts =[
        'http'=>[
            'method'=>'GET',
            //'header'=>"Accept-Encoding: deflate, gzip\r\n",
            ],
	
			];
		  $context = stream_context_create($opts);
		  $key = file_get_contents($baseUrl.'source=@server.key', false, $context);
		  foreach($http_response_header as $i => $header){				
            $h = explode(':', $header);
			if('x-frdlweb-source-expires' === strtolower(trim($h[0]))){
				file_put_contents($expFile, trim($h[1]) );
				break;
			}           
         }
		  
		  file_put_contents($pubKeyFile, $key);
	  }
	 
 };

 $getDefaultValidatorForUrl = function($baseUrl, $cacheDir, $increaseTimelimit = true) use($setPublicKey, &$publicKeyChanged) {
     $expFile =  rtrim($cacheDir, '\\/ ') .	\DIRECTORY_SEPARATOR.'validator-'.sha1($baseUrl).strlen($baseUrl).'.expires.txt';
	 $pubKeyFile =  rtrim($cacheDir, '\\/ ') .	\DIRECTORY_SEPARATOR.'validator-'.sha1($baseUrl).strlen($baseUrl).'.public-key.txt';
	 
     $setPublicKey($baseUrl, $expFile, $pubKeyFile);

	 $condition = function($url, &$loader, $class) use($baseUrl, $increaseTimelimit){
		if($increaseTimelimit){
			set_time_limit(min(180, intval(ini_get('max_execution_time')) + 90));
		}

		if($baseUrl === substr($url, 0, strlen($baseUrl) ) ){
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
        $public_key = file_get_contents($pubKeyFile);
		 
    list($plain_data,$sigdata) = explode(base64_decode($sep), $my_signed_data, 2);
    list($nullVoid,$old_sig_1) = explode("----SIGNATURE:----", $sigdata, 2);
    list($old_sig,$ATTACHMENT) = explode("----ATTACHMENT:----", $old_sig_1, 2);
	 $old_sig = base64_decode($old_sig);	 
	 $ATTACHMENT = base64_decode($ATTACHMENT);
    if(empty($old_sig)){
      return new \Exception("ERROR -- unsigned data");
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


 $getDefaultValidators = function($cacheDir, $increaseTimelimit = true) use($getDefaultValidatorForUrl) {
    return [
         $getDefaultValidatorForUrl('https://startdir.de/install/?', $cacheDir, $increaseTimelimit),
         $getDefaultValidatorForUrl('https://webfan.de/install/stable/?', $cacheDir, $increaseTimelimit),
         $getDefaultValidatorForUrl('https://webfan.de/install/latest/?', $cacheDir, $increaseTimelimit),
	 $getDefaultValidatorForUrl('https://webfan.de/install/?', $cacheDir, $increaseTimelimit),
    ];
 };
	    
	        
	    foreach($getDefaultValidators($dir, true) as $validator){	  
		    $this->withAfterMiddleware($validator[0], $validator[1]);   
	    }			
	    
	    
	  /* some dirty workaround patches... */
	  $this->withBeforeMiddleware(function($class, &$loader) use ($dir) {
	       switch($class){
		       case \DI\Compiler\Compiler::class :
			       $aDir = dirname($loader->file($class));
			       if(!is_dir($aDir)){
				  mkdir($aDir, 0755, true);       
			       }
			       $aFile = $aDir.\DIRECTORY_SEPARATOR.'Template.php';
			       if(!file_exists($aFile)){
				    file_put_contents($aFile, file_get_contents('https://raw.githubusercontent.com/PHP-DI/PHP-DI/6d4ac8be4b0322200a55a0fbf5d32b2be3c1062b/src/Compiler/Template.php'));      
			       }
			       return true;
			   break;			
		       case \Webfan\Webfat\App\ContainerAppKernel::class :       
		       case \DI\ContainerBuilder::class :
		       case '\DI\\' === substr($class, 4) : 
			       $aDir = dirname($dir).\DIRECTORY_SEPARATOR.'autoload-files-conditional'.\DIRECTORY_SEPARATOR.'php-di';
			       if(!is_dir($aDir)){
				  mkdir($aDir, 0775, true);       
			       }
			       $aFile = $aDir.\DIRECTORY_SEPARATOR.'functions.php';
			       if(!file_exists($aFile)){
				    file_put_contents($aFile, file_get_contents('https://raw.githubusercontent.com/PHP-DI/PHP-DI/6.0-release/src/functions.php'));      
			       }
			       if (!in_array($aFile, get_included_files())) {
			           require $aFile;
			       }
			       
			       return true;
			   break;
		       default:
			    return true;
			  break;
	       }
	   
	    /*   return true;  return false to skip this autoloader, return any/VOID to continue */
          });     
	    
	return $this;
    }
   //end default-patches
	
	
	
	
	
	
    public function withBeforeMiddleware( \callable | \closure $Middleware){
	    $this->beforeMiddlewares[]= $Middleware;	   
	return $this;
    }
	
    public function withAfterMiddleware(\callable | \closure | string $condition, \callable | \closure $filter){
	    $this->afterMiddlewares[]= [$condition, $filter];	   
	return $this;
    }
    public static function getInstance(
        $server =  'https://webfan.de/install/stable/?source={{class}}&salt={{salt}}',
        $register = true,
        $version = 'latest',
        $allowFromSelfOrigin = false,
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
        $allowFromSelfOrigin = false,
        $salted = false,
        $classMap = null,
        $cacheDirOrAccessLevel = self::ACCESS_LEVEL_SHARED,
        $cacheLimit = null,
        $password = null
    ) {
	  
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
                //    || is_dir(dirname($CacheDir))
                    //|| is_dir(dirname(dirname($CacheDir)))
                    // ||
                //    $valCacheDir($r, false, false, $CacheDir)
                //    )
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
        $_self = (isset($_SERVER['SERVER_NAME'])) ? $_SERVER['SERVER_NAME'] 
	       : ( (isset($_SERVER['HTTP_HOST']) && \php_sapi_name() !== 'cli' ) ? $_SERVER['HTTP_HOST'] : 'dev.localhost');
        $h = explode('.', $_self);
        $dns = array_reverse($h);
        $this->selfDomain = $dns[1].'.'.$dns[0];

    if(is_string($this->server)){
        $h = explode('.', $this->server);
        $dns = array_reverse($h);
        $this->domain = $dns[1].'.'.$dns[0];
    }

        if(!$this->allowFromSelfOrigin && $this->domain === $this->selfDomain){
          $register = false;
        }



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

    public function addNamespace($prefix, $resourceOrLocation, $prepend = false){
	return $this->withNamespace($prefix, $resourceOrLocation, $prepend);	
    }
    public function withNamespace($prefix, $server, $prepend = false)
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
    }

    public function str_contains($haystack, $needle, $ignoreCase = false)
    {
        if ($ignoreCase) {
        $haystack = strtolower($haystack);
        $needle   = strtolower($needle);
        }
        $needlePos = strpos($haystack, $needle);
        return ($needlePos === false ? false : ($needlePos+1));
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
           return  (true === $parseVars && is_string($url)) ?  $this->replaceUrlVars($url, $salt, $class, $version) : $url;
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
             $url = $this->getUrl($class, self::$classmap[$class], $salt);
             $url =  $this->replaceUrlVars($url, $salt, $class, $this->version); 
		         
		if(is_string($url) && $this->exists($url) ){              
		   return $url;           
		}
        }

         if (isset($this->prefixes[$prefix]) ) {
        // look through base directories for this namespace prefix
        foreach ($this->prefixes[$prefix] as $server) {

            $url = $this->getUrl($relative_class, $server, $salt);
            $url =  $this->replaceUrlVars($url, $salt, $relative_class, $this->version); 
		
            if(is_string($url) && $this->exists($url) ){
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

    public function withClassmap(array $classMap = null)
    {
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

    public function withAlias(string $alias, string $rewrite)
    {
        $this->alias[ltrim($alias, '@')] = $rewrite;
    }

    public function withSalt(bool $salted = null)
    {
        if(null !== $salted){
         $this->salted = $salted;
         }

        return $this->salted;
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
		self::$existsCache[$source] = is_file($source) && file_exists($source) && is_readable($source);
             return self::$existsCache[$source];
        }

        $options = [
        'http' => [
           'method'  => 'HEAD',
            'ignore_errors' => true,

           ]
        ];
        $context  = stream_context_create($options);
        $res = @file_get_contents($source, false, $context);
        $exists = false !== $res;
	    
	self::$existsCache[$source] = $exists;
      return $exists;
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
   /*	
	     $url =  $this->url( $class );
	     $withSaltedUrl = (true === $this->str_contains($this->loadClass($class, $salt), '${salt}', false)) ? true : false;
*/
        $options = [
        'http' => [
           'method'  => 'GET',
            'ignore_errors' => true,
            'header'=> "X-Source-Encoding: b64\r\n"
               // . "Content-Length: " . strlen($data) . "\r\n"
				,
           ]
        ];
        $context  = stream_context_create($options);
        $code = @file_get_contents($url, false, $context);

	    
		if(false === $code){
		     $urlOld = $url;
		     $url=preg_replace('/(\/stable\/)/', '/', $url);
		     $url=preg_replace('/(\/latest\/)/', '/', $url);	
		     if($urlOld !== $url){
		        $context  = stream_context_create($options);
		        $code = @file_get_contents($url, false, $context);
		     }
			if(false===$code){
			   return false;	
			}
		}
		
			    
          $json = false;
          $base64 = false;
			
			
        foreach($http_response_header as $i => $header){
           $h = explode(':', $header);
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
		   error_log('Invalid checksums while fetching source code for '.$class.' from '.$url, \E_USER_NOTICE);
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
	
    public function register(/* $throw = true,*/bool $prepend = false)
    {
	$args = func_get_args();
	if(count($args)>=2 && is_bool($args[1])){
	  $prepend = $args[1];	
	}
	$throw = true; //Always true as false is deprecated in SPL!        
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

    protected function getLoader()
    {
        return [$this, 'Autoload'];
    }

    public function pruneCache()
    {
        if($this->cacheLimit !== 0
           && $this->cacheLimit !== -1){

                 $ShutdownTasks = \frdlweb\Thread\ShutdownTasks::mutex();
                  $ShutdownTasks(function($CacheDir, $maxCacheTime){
                          @\ignore_user_abort(true);
                          @\webfan\hps\patch\Fs::pruneDir($CacheDir, $maxCacheTime, true,  'tmp' !== basename($CacheDir));

                  }, $this->cacheDir, $this->cacheLimit);

        }
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

        //  $withSaltedUrl = (true === $this->str_contains($url, '${salt}', false)) ? true : false;
          $url =  $this->replaceUrlVars($url, $salt, $class, $this->version);		
	  return $url;
	}	
	
	
    public function Autoload(string $class):bool|string
    {
	    
		
	foreach($this->beforeMiddlewares as $middleware){
	    if(false === call_user_func_array($middleware, [$class, &$this]) ){
	      return false;	
	    }        
	}	    
	    
        $cacheFile = $this->file($class);
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



        $code = $this->fetchCode($class, $this->salt);
	if(false===$code){
	   return false;
	}else if(true === $code){
              return true;
        }elseif(false !==$code){
        if(!is_dir(dirname($cacheFile))){
          mkdir(dirname($cacheFile), 0775, true);
        }

        if(!file_put_contents($cacheFile, $code)){
          throw new \Exception('Cannot write source for class '.$class.' to '.$cacheFile);
           }

           }elseif(false ===$code && !file_exists($cacheFile)){
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
