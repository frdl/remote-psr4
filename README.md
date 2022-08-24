# remote-psr4
An php psr4 Autoloader which is autoloading from a remote server.

If you are developing a Frdlweb-Project you should use ~~<s>`webfan3/frdl-module-remote-psr4` instead</s>~~ ...[`frdl/codebase`](https://github.com/frdl/codebase)

## Usage
````php
   $loader = \Webfan\Psr4Loader\RemoteFromWebfan::getInstance('startdir.de', true, 'latest', true);
````

...or...

````php
  $loader = \frdl\implementation\psr4\RemoteAutoloader::getInstance('startdir.de', true, 'latest', true);
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
    return \frdl\implementation\psr4\RemoteAutoloaderApiClient::class::getInstance($workspace, false, $config['FRDL_UPDATE_CHANNEL'],
                                                                                    false, false, null/*Classmap:[]*/,
                                                                                    $config['FRDL_REMOTE_PSR4_CACHE_DIR'],
                                                                                    $config['FRDL_REMOTE_PSR4_CACHE_LIMIT']);
 }, $config,'https://webfan.de/install/'. $config['FRDL_UPDATE_CHANNEL'].'/?source=${class}&salt=${salt}&source-encoding=b64');
 
 $loader->register();
 ````


## PHP CDN
To use the the package `frdl/remote-psr4` in a project, you can use e.g. [*php CDN*](https://webfan.de/install/) and autoload php classes on demand from one or more remote servers. Further you can map namespaces to remote-folders, etc... .
