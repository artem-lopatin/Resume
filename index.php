<?php
include_once 'data.php';

//var_dump($data);

$content= '';
$h1arr = array();
function RezFromArr($arr,$level=0){
    global  $content;
    global $h1arr;

    if(is_array($arr)){
        if(!isset($arr[0])){
            foreach ($arr as $key => $value){
                if(gettype($value)=='array')$content .= '<h3>'.$key.'</h3>';
                RezFromArr($value,$level+1);
            }
        }else{
            foreach ($arr as $item){
                if($level==0)$content .= '<ul>';
                RezFromArr($item,$level+1);
            }
        }
    }else{
        if($level==1){
            array_push($h1arr,$arr);
            //array_unique($h1arr);
            if($arr==$h1arr[0]) {
                $content .= '<h1>' . $arr . /*'|' . $level . */'</h1>';
            }elseif($arr==$h1arr[1]) {
                $content .= '<h2>' . $arr . /*'|' . $level . */'</h2>';
            }else{
                $content .= '<hr><p>'.$arr./*'|'.$level.*/'</p><hr>';
            }

        }elseif($level==2){
            $content .= '<li>'.$arr./*'|'.$level.*/'</li>';
        }elseif($level==3){
            $content .= $arr./*.'|'.$level*/'<br>';
        }
    }
    //var_dump($h1arr);
    return $content;
}

RezFromArr($data);

include_once 'default_layout.html';