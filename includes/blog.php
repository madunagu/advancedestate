<?php
class Blog extends Item {
  static $tableName='blog';
  public static $base_sql = "SELECT * FROM blog";#for now
  public $avatar = "img/featured-post-1.jpg";
  public static $thumb_sizes= ['featured_post'=>[122,122],'full_cover'=>[1200,528]];
  public function poster(){
    $admin=  User::find_by_id($this->uploader);
    return $admin;
  }
  public function link(){
    return  Pagination::url('page',$this->id,'blogpost.php');

  }
  public function time(){
    return "10,3";
  }
  public function body($strlen = 200){
    return substr($this->body, 0,$strlen);
  }
}
