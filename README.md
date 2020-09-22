# remote-psr4
An php psr4 Autoloader which is autoloading from a remote server.

If you are developing a Frdlweb-Project you should use `[this package](https://github.com/webfan3/frdl-module-remote-psr4)` instead!

## Usage
````php
 $loader = \Webfan\Psr4Loader\RemoteFromWebfan::getInstance('frdl.webfan.de', true, 'latest', true);
````
