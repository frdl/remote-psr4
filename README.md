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

## PHP CDN
To use the the package `frdl/remote-psr4` in a project, you can use e.g. [*php CDN*](https://webfan.de/install/) and autoload php classes on demand from one or more remote servers. Further you can map namespaces to remote-folders, etc... .
