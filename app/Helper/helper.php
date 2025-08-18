<?php

use App\Models\Category;

    function getCategoies(){
        return Category::orderBy('name','ASC')->where('showHome','yes')->get();
    }
?>