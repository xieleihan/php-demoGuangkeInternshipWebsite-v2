<?php

/**
 * @param string $path
*  @return string
 */
    
function basePath($path = '')
{
    return __DIR__. '/' .$path;
}    

/**
 * @param string $name
*  @return string
 */
function loadPartial($name){
    $partialPath = basePath("App/views/partials/{$name}.php");
    if(file_exists($partialPath)){
        require $partialPath;
    }else{
        echo "{$name}部分视图不存在";
    }

}

/**
 * @param string $name
 * @param array $data
*  @return string
 */
function loadView($name,$data = []){
    $viewPath = basePath("App/views/{$name}.view.php");

    if(file_exists($viewPath)){
            extract($data);
            require $viewPath;
        }else{
            echo "{$viewPath}视图不存在";
        }
}


/**
 * 
 * @param mixed $value
 * @return void
 */
function inspect($value){
    echo '<pre>';
    var_dump($value);
    echo '<pre>';
}

/**
 * @param mixed $name
 * @return void
 */
function inspectAndDie($value){
    echo '<pre>';
    die(var_dump($value));
    echo '<pre>';
}

/**
 * 清洗数据
 * 
 * @param string $dirty 
 * @return string
 */
function sanitize($dirty)
{
    return filter_var(trim($dirty),FILTER_SANITIZE_SPECIAL_CHARS);
}