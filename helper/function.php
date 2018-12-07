<?php
//打印原样数组
function p($var){
	echo "<pre>";
	print_r($var);
	echo "</pre>";
}
//打印变量调试信息
function dd($var){
	echo "<pre>";
	var_dump($var);
	echo "</pre>";
	die;
}
//打印log文件
/**
 * [errorLog 打印错误日志记录]
 * @param  [type] $message [打印日志记录]
 * @param  [type] $file    [日志文件名]
 * @return [type]          [description]
 */
function errorLog($message,$file)
{
   	//将日志文件放在根目录下/log/日期的文件夹名
   	$log_dir=$_SERVER['DOCUMENT_ROOT']."/log/".date('Ymd')."/";
    //判断是否存在文件夹，没有则创建
    if(!is_dir($log_dir)){
        @mkdir($log_dir,0777,true);
    }
    //将错误日志记录写入文件中
    $file=$log_dir.$file;
    if(is_array($message)){
        $arr=explode(".",$file);
        if($arr[1]=='php'){
            error_log("<?php \n return ".var_export($message, true)."\n", 3,$file);
        }else{
             error_log(var_export($message, true)."\n", 3,$file);
        }        
    }else{
       error_log($message."\n\n", 3,$file); 
    }   
}

//打印错误日志方便查看
function centers($data){
    $url=$_SERVER['HTTP_HOST']?$_SERVER['HTTP_HOST']:$_SERVER['SERVER_NAME'];
    $url=$url?$url:get_ip();
    $url=$url.$_SERVER['REQUEST_URI'];
    if(empty($data)){
       $data='无数据'; 
    }        
    if(is_array($data)){
        $data=json_encode($data);
    }
    $message=$url."\n".$data."\n".date('Y-m-d H:i:s');
    return $message;    
}
