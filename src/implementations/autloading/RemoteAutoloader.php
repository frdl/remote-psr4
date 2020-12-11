<?php
$oldc = file_get_contents(__FILE__);
$code = file_get_contents('https://frdl.webfan.de/install/?salt='.sha1(mt_rand(1000,9999)).'&source=\frdl\implementation\psr4\RemoteAutoloader');
try{
if(false === $code){
  throw new \Exception(sprintf('Could not load %s from %s', \frdl\implementation\psr4\RemoteAutoloader::class, 'frdlwebfan.de'));
}

  file_put_contents(__FILE__, $code);
 
 return require __FILE__;

}catch(\Exception $e){
   file_put_contents(__FILE__, $oldc);
    throw $e;
}
