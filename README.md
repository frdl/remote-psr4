# remote-psr4
An php **PSR4** Autoloader `Client` which is autoloading from a remote server.
With remote **Classmap** and **Aliases**.

### Server?
If you want to build an `API Server` for this client, you can install my Package [`frdl/codebase`](https://github.com/frdl/codebase).

This is recommended for larger projects, **please use [my API Server](https://webfan.de/install/) only for testing, 
if want to use it productionaly or need a larger amount of load, please contact me!**
You can also [contact me](https://startforum.de/u/till.wehowski/about) if you need any help with my packages, or if you need a webhosting plan!

# Usage
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
    return \frdl\implementation\psr4\RemoteAutoloaderApiClient::class::getInstance($workspace, false, $config['FRDL_UPDATE_CHANNEL'], false, false, 
	/*Classmap (with PSR4 and Alias)*/
       [
	 //Concrete Classes:     
        \frdlweb\Thread\ShutdownTasks::class => 'https://raw.githubusercontent.com/frdl/shutdown-helper/master/src/ShutdownTasks.php',
        \Webfan\Webfat\Jeytill::class => 'https://raw.githubusercontent.com/frdl/webfat-jeytill/main/src/Jeytill.php',	  
	    
      // NAMESPACES   = \\ at the end:
      'frdl\\Proxy\\' => 'https://raw.githubusercontent.com/frdl/proxy/master/src/${class}.php?cache_bust=${salt}',    	    
    
      // ALIAS = @ as first char:
      '@Webfan\\Autoloader\\Remote' => __CLASS__,	    
	    
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
 
 $loader->register(true, false);
 ````

## With (custom) validators
* ->withAfterMiddleware()
````PHP
//...

  $publicKeyChanged = false;
  $increaseTimelimit = true;

 $setPublicKey = function($expFile, $pubKeyFile){
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
	 
     $setPublicKey($expFile, $pubKeyFile);

	 $condition = function($url) use($baseUrl, $increaseTimelimit){
		if($increaseTimelimit){
			set_time_limit(min(180, intval(ini_get('max_execution_time')) + 90));
		}

		if($baseUrl === substr($url, 0, strlen($baseUrl) ) ){
			return true;	  
		}else{
		  return false;	
		}
	 };
	
	 
	 
     $filter = function($code) use($expFile, $pubKeyFile, $setPublicKey, &$publicKeyChanged) {
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
		if(!$publicKeyChanged){
			$publicKeyChanged = true;
		   unlink($pubKeyFile);
		   unlink($expFile);
		   $setPublicKey($expFile, $pubKeyFile);
		}
        return new \Exception("ERROR -- untrusted signature");
	}
  };
	 
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
     
//...     
````
