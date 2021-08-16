<?php
namespace frdl\implementation\firstRunThisFileBootstrap{

$sourcesRaces=[
	'https://cdn.frdl.io/@webfan3/stubs-and-fixtures/classes/frdl/implementation/psr4/RemoteAutoloader',
	'https://cdn.webfan.de/@webfan3/stubs-and-fixtures/classes/frdl/implementation/psr4/RemoteAutoloader',
	'https://03.webfan.de/install/?salt='.sha1(mt_rand(1000,9999)).'&source=\frdl\implementation\psr4\RemoteAutoloader',
//	__FILE__
];

return call_user_func(function($SourcesRaces){

   $oldc = file_get_contents(__FILE__);
   $links_hint=[];
   $trys=[];
   $code=false;
	while(($code===false || empty($code) ) && count($SourcesRaces) > 0){
		array_push($trys, array_shift($SourcesRaces) );
		$current=$trys[count($trys)-1];
		   try{
	                  $code =    @file_get_contents($current);		
		   }catch(\Exception $e){		   
			   $code=false; 
		   }
		if(($code===false || empty($code) ) && $current!==__FILE__){
			array_push($links_hint,  $current );
		}
	}
  
   try{
	 
 if(false===$code || empty($code)){
     throw new \Exception(sprintf('Could not load %s from %s', \frdl\implementation\psr4\RemoteAutoloader::class, print_r($links_hint,true)));
 }else{
        file_put_contents(__FILE__, $code);
        return require __FILE__;
 }
	   
// return require __FILE__;

}catch(\Exception $e){
     file_put_contents(__FILE__, $oldc);
     throw $e;
  }
}, $sourcesRaces);


}
