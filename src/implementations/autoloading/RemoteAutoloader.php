<?php
namespace frdl\implementation\firstRunThisFileBootstrap{

$sourcesRaces=[
	'https://startdir.de/install/?bundle=frdl\implementation\psr4\RemoteAutoloader', 
	'https://webfan.de/install/stable/?bundle=frdl\implementation\psr4\RemoteAutoloader', 
	'https://webfan.de/install/latest/?bundle=frdl\implementation\psr4\RemoteAutoloader', 
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
