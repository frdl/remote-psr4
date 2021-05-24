# remote-psr4
An php psr4 Autoloader which is autoloading from a remote server.

If you are developing a Frdlweb-Project you should use [this package](https://github.com/webfan3/frdl-module-remote-psr4) instead!

## Usage
````php
   $loader = \Webfan\Psr4Loader\RemoteFromWebfan::getInstance('frdl.webfan.de', true, 'latest', true);
````

...or...

````php
  $loader = \frdl\implementation\psr4\RemoteAutoloader::getInstance('frdl.webfan.de', true, 'latest', true);
````

## PHP CDN
To use the the package `frdl/remote-psr4` in a project, you can use [*php CDN*](https://frdl.io/cdn/php) and autoload php classes on demand from one or more remote servers. Further you can map namespaces to remote-folders, etc... .
