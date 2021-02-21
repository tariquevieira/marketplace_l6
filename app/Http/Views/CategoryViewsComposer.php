<?php 

namespace App\Http\Views;

use App\Category;

/**
  * 
  */
 class CategoryViewsComposer
 {
 	private $category;

 	public function __construct(Category $category)
 	{
 		$this->category = $category;
 	}
 	public function compose($view)
 	{
 		return $view->with('categories',$this->category->all(['name','slug']));
 	}
 } 