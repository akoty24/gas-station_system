<?php

if( !function_exists('adminurl') ){
    function adminurl(){
        return auth()->guard('admin')->user();
    }
}