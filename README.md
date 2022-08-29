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

 // $workspace is the DEFAULT Psr4 Server
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

