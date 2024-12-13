<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'title',
        'slug',
        'details',
        'image_id',
        'parent_id',
        'level',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'created_at',
        'updated_at',
        'is_enable',
        'is_featured',
        'sort',
        'alt',
    ];

    // Relationship to itself for parent-child relationship
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function image()
    {
        return $this-> belongsTo(Filemanager::class, 'image_id');
    }

    public static function get_category_dropdown(){

        $html = "";

        foreach(Category::all() as $category){
        
           $subcats = $category->children; 

           $html .="  <option value='".$category->id."'>".$category->title." </option> ";

                    foreach($subcats as $child){
       
                        $html .=" <option  
                         value='".$child->id."'>---- ".$child->title."</option>";

                        foreach($child->children as $subchild){
                            $html .= "<option  value='".$subchild->id."' >--------- ".$subchild->title."</option>";
                        }

                    }   

        }

        return $html;

    }

    public static function get_categories_options (){

        $html = "";
        foreach(Category::where('is_enable',1)->get() as $category){

          $subcats = $category->children;
          $level = count($subcats) ? "sub-level" : '';
        

          $html .=" <li class='level1 ".$level."'>
            <a href='#;' class='site-nav'> ".$category->title."</a>";

                if(count($subcats)){
                    $html .= '<ul class="sublinks">';
                        foreach($subcats as $child){
                            $html .=  '<li class="level2" >';
                            $html .=  ' <a href="#" class="site-nav"> '.$child->title.'</a>';
                                if(count($child->children)){
                                    $html .=  '<ul>';
                                        foreach($child->children as $subchild){
                                            $html .=   '<li>'.$subchild->title.'</li>';
                                        }
                                        $html .=  '</ul>';
                                }
                                $html .=  '</li>';
                        }
                        $html .=  '</ul>';
                }

                $html .=  '</li>' ;
        }


        return $html;

    }



   
}
