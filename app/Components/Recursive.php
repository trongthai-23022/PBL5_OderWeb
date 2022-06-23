<?php
namespace App\Components;
use \App\Models\Category;
class Recursive{
    private $data;
    private $htmlSelect;
    public function __construct($data)
    {
        $this->data = $data;
        $this->htmlSelect = '';
    }

    public function selectRecursion($parent_id,$id = 0, $text = '', $onlyParent=false){
        foreach ($this->data as $value){
            if($value['parent_id'] == $id){
                if(!empty($parent_id) && $parent_id == $value['id']){
                    $this->htmlSelect .= "<option selected value='". $value['id'] . "'>" . $text . $value['name'] . "</option>";
                }
                else{
                    $this->htmlSelect .= "<option value='". $value['id'] . "'>" . $text . $value['name'] . "</option>";
                }
                if(!$onlyParent){
                    $this->selectRecursion($parent_id,$value['id'], $text. '--');
                }
            }
        }
        return $this->htmlSelect;
    }
}
