# remote-psr4
An php psr4 Autoloader which is autoloading from a remote server.

If you are developing a Frdlweb-Project you should use ~~<s>`webfan3/frdl-module-remote-psr4` instead</s>~~ ...[`frdl/codebase`](https://github.com/frdl/codebase)

## Usage
````php
   $loader = \Webfan\Psr4Loader\RemoteFromWebfan::getInstance('03.webfan.de', true, 'latest', true);
````

...or...

````php
  $loader = \frdl\implementation\psr4\RemoteAutoloader::getInstance('03.webfan.de', true, 'latest', true);
````

...or...

````php
$config = [
    'FRDL_UPDATE_CHANNEL' => 'latest',  // stable | latest
    'FRDL_REMOTE_PSR4_CACHE_DIR'=> \sys_get_temp_dir().\DIRECTORY_SEPARATOR. \get_current_user()
				                       .\DIRECTORY_SEPARATOR.'.frdl'.\DIRECTORY_SEPARATOR.'runtime'.\DIRECTORY_SEPARATOR.'cache'.\DIRECTORY_SEPARATOR
			                         .'classes'.\DIRECTORY_SEPARATOR.'psr4'.\DIRECTORY_SEPARATOR,    
     'FRDL_REMOTE_PSR4_CACHE_LIMIT'=>	24 * 60 * 60,                                
];

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
 
 $loader->register();
 ````


## PHP CDN
To use the the package `frdl/remote-psr4` in a project, you can use e.g. [*php CDN*](https://webfan.de/install/) and autoload php classes on demand from one or more remote servers. Further you can map namespaces to remote-folders, etc... .
