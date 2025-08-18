<?php

use App\Models\Category;

    function getCategories(){
        return Category::orderBy('name','ASC')->where('showHome','yes')->where('status',1)->get();
    }
?>