<?php

namespace App\Controllers;

class ErrorController
{
    /**
     * 404 not found
     * 
     * @param string $message
     * @return void
     */
    public static function notFound($message = '资源不存在!')
    {
      http_response_code(404);
      
      loadView('error',[
        'status'=>'404',
        'message'=>$message
      ]);
    }

    /*
     * 403 无权限错误
     * 
     * @return void
     */
    public static function unauthorized($message = '你并没有访问该资源的权限！')
    {
        http_response_code(403);

        loadView('error',[
            'status'=>'403',
            'message'=>$message
        ]);
    }
}