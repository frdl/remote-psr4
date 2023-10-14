# remote-psr4
An php **PSR-4**[[?]](https://www.php-fig.org/psr/psr-4/) Autoloader `Client` which is autoloading from one or more remote servers.
With remote **Classmap** and **Aliases**.

### Server?
If you want to build an `API Server` for this client, you can install my Package [`frdl/codebase`](https://github.com/frdl/codebase).

This is recommended for larger projects, **please use [my API Server](https://webfan.de/install/) only for testing, 
if want to use it productionaly or need a larger amount of load, please contact me!**
You can also [contact me](https://startforum.de/u/till.wehowski/about) if you need any help with my packages, or if you need a [webhosting plan](https://domainundhomepagespeicher.de/)!

Optionaly you can [configure the client](#with-custom-configuration), e.g. to load from githubs **without a central server**.

## Usage
````php
  $loader = \frdl\implementation\psr4\RemoteAutoloader::getInstance('03.webfan.de', true, 'latest', true);
````
...or...
## With (custom) configuration
* Classmap (with PSR4 and Alias)
* Cache Settings
````php
$config = [
    'FRDL_UPDATE_CHANNEL' => 'latest',  // stable | latest
    'FRDL_REMOTE_PSR4_CACHE_DIR'=> \sys_get_temp_dir().\DIRECTORY_SEPARATOR. \get_current_user()
				                       .\DIRECTORY_SEPARATOR.'.frdl'.\DIRECTORY_SEPARATOR.'runtime'.\DIRECTORY_SEPARATOR.'cache'.\DIRECTORY_SEPARATOR
			                         .'classes'.\DIRECTORY_SEPARATOR.'psr4'.\DIRECTORY_SEPARATOR,    
     'FRDL_REMOTE_PSR4_CACHE_LIMIT'=>	24 * 60 * 60,                                
];

 // $workspace is the DEFAULT Psr4 Server
 // e.g.: $workspace = 'https://webfan.de/install/'. $config['FRDL_UPDATE_CHANNEL'].'/?source=${class}&salt=${salt}&source-encoding=b64'
 $loader =  call_user_func(function($config,$workspace){
    return \frdl\implementation\psr4\RemoteAutoloaderApiClient::getInstance($workspace, false, $config['FRDL_UPDATE_CHANNEL'], false, false, 
	/*Classmap (with PSR4 and Alias)*/
       [
       // (CLASSMAP) Concrete Classes:     
        \frdlweb\Thread\ShutdownTasks::class => 'https://raw.githubusercontent.com/frdl/shutdown-helper/master/src/ShutdownTasks.php',
        \Webfan\Webfat\Jeytill::class => 'https://raw.githubusercontent.com/frdl/webfat-jeytill/main/src/Jeytill.php',	  
	    
       // (PSR4) NAMESPACES   = \\ at the end:
      'frdl\\Proxy\\' => 'https://raw.githubusercontent.com/frdl/proxy/master/src/${class}.php?cache_bust=${salt}',    	    
    
      // ALIAS = @ as first char:
      '@Webfan\\Autoloader\\Remote' => __CLASS__,	 
      // ALIAS works with PSR4-Namespace too:   
      '@BetterReflection\\'=>'Roave\BetterReflection\\',  
      
      //Versions at Webfan:
	  // Default/Fallback Versions Server:
	\webfan\hps\Format\DataUri::class => 'https://webfan.de/install/?salt=${salt}&source=webfan\hps\Format\DataUri',	    
	 // Stable/Current Versions Server:   
        //\webfan\hps\Format\DataUri::class => 'https://webfan.de/install/stable/?salt=${salt}&source=webfan\hps\Format\DataUri',	    
	// Latest/Beta Versions Server:    
	// \webfan\hps\Format\DataUri::class => 'https://webfan.de/install/latest/?salt=${salt}&source=webfan\hps\Format\DataUri',
   ],
    $config['FRDL_REMOTE_PSR4_CACHE_DIR'],
    $config['FRDL_REMOTE_PSR4_CACHE_LIMIT']
  );
 }, $config,'https://webfan.de/install/'. $config['FRDL_UPDATE_CHANNEL'].'/?source=${class}&salt=${salt}&source-encoding=b64');
 ````
 *more examples...*
 ````php
 /** More Examples: */
 $loader->withClassmap([
//Alias:
		'@'.\BetterReflection\Reflection\ReflectionFunction::class => \Roave\BetterReflection\BetterReflection::class,   
		'@'.\BetterReflection\SourceLocator\Exception\TwoClosuresOneLine::class => 
		    \Roave\BetterReflection\SourceLocator\Exception\TwoClosuresOnSameLine::class,   		    
   	        \Webfan\Webfat\MainModule::class => 
		    'https://raw.githubusercontent.com/frdl/recommendations/master/src/Webfan/Webfat/MainModule.php?cache_bust=${salt}',
//Conrete class AND namespace: ORDER matters!
//Classmaps SHOULD be sorted DESC in most cases, CLASS should be listed BEFORE namespace if equal FQN.
		\Webfan\Webfat\Module::class => 'https://raw.githubusercontent.com/frdl/recommendations/master/src/Webfan/Webfat/Module.php?cache_bust=${salt}',
		'Webfan\Webfat\Module\\' => 'https://raw.githubusercontent.com/frdl/recommendations/master/src/Webfan/Webfat/Module/${class}.php?cache_bust=${salt}', 
		'Webfan\Webfat\Intent\\' => 'https://raw.githubusercontent.com/frdl/recommendations/master/src/Webfan/Webfat/Intent/${class}.php?cache_bust=${salt}',    		 \Pimple::class => 'https://raw.githubusercontent.com/silexphp/Pimple/1.1/lib/Pimple.php',
		'Task\Plugin\Console\\' => 'https://github.com/taskphp/console/blob/00bfa982c4502938ca0110d2f23c5cd04ffcbcc3/src/${class}.php?cache_bust=${salt}',
		'Task\\' => 'https://raw.githubusercontent.com/taskphp/task/7618739308ba484b5f90a83d5e1a44e1d90968d2/src/${class}.php?cache_bust=${salt}',
		'@BetterReflection\\'=>'Roave\BetterReflection\\',    
	    ]); 
 ````
 
### Register Autoloader
````php
$loader->register(false);
// Prepend autoloader to autoloader-stack:
// $loader->register(true);
 ````
**Prepend Autoloader:** If you like to prepend the autoloader you have to set the public static variable *allwaysAppendAutoloader* to *false*, **before** registering the autoloader!
````PHP
public static $alwaysAppendLoader = true;
````
````PHP
\frdl\implementation\psr4\RemoteAutoloader::$alwaysAppendLoader = $loader::$alwaysAppendLoader = false;
$loader->register(true);
````
This is **not recommended** as this loader loads from remote, for performance you should prefer your local classes (in production e.g.).

## With (custom) validators
[See methods:](https://github.com/frdl/remote-psr4/blob/master/src/implementations/autoloading/RemoteAutoloaderApiClient.php)
* ->withBeforeMiddleware()
* ->withAfterMiddleware()
* ->withWebfanWebfatDefaultSettings()
````PHP
//...

  $publicKeyChanged = false;
  $increaseTimelimit = true;

 $setPublicKey = function($baseUrl,$expFile, $pubKeyFile){
	 if(file_exists($expFile)){
          $expires = intval(file_get_contents($expFile));
	 }else{
           $expires = 0;
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
	 
     $setPublicKey($baseUrl,$expFile, $pubKeyFile);

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
         $getDefaultValidatorForUrl('https://webfan.de/install/stable/?', $cacheDir, $increaseTimelimit),
         $getDefaultValidatorForUrl('https://webfan.de/install/latest/?', $cacheDir, $increaseTimelimit),
  	 $getDefaultValidatorForUrl('https://webfan.de/install/?', $cacheDir, $increaseTimelimit),
    ];
 };


     foreach($getDefaultValidators($cacheDir, $increaseTimelimit) as $validator){
	    $loader->withAfterMiddleware($validator[0], $validator[1]);
     }		
     
     	  $loader->withBeforeMiddleware(function($class, &$loader){
	       switch($class){
		       case \DI\Compiler\Compiler::class :
			       $aDir = dirname($loader->file($class));
			       if(!is_dir($aDir)){
				  mkdir($aDir, 0755, true);       
			       }
			       $aFile = $aDir.\DIRECTORY_SEPARATOR.'Template.php';
			       if(!file_exists($aFile)){
				  file_put_contents($aFile, file_get_contents('https://raw.githubusercontent.com/PHP-DI/PHP-DI/master/src/Compiler/Template.php'));     
			       }
			       return true;
			   break;
		       default:
			    return true;
			  break;
	       }
	   
	    /*   return true;  return false to skip this autoloader, return any/VOID to continue */
          });     
//...     
````
