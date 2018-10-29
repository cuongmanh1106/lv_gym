<?php 
// require("../admin/models/m_permission.php");
function stripUnicode($str) {
   if(!$str) return false;
   $unicode = array(
      'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
      'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
      'd'=>'đ',
      'D'=>'Đ',
      'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
      'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
      'i'=>'í|ì|ỉ|ĩ|ị',
      'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
      'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
      'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
      'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
      'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
      'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
      'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
      '' =>'?|(|)|[|]|{|}|#|%|-|<|>|,|:|;|.|&|–|/'
   );

   foreach ($unicode as $khongdau=>$codau) {
      $arr=explode("|",$codau);
      $str = str_replace($arr,$khongdau,$str);
   }
   return $str;
}

function changeTitle($str) {
   $str = trim($str);
   if ($str=="") return "";
   $str =str_replace('"','',$str);
   $str =str_replace("'",'',$str);
   $str = stripUnicode($str);
      $str = mb_convert_case($str,MB_CASE_LOWER,'utf-8');    // MB_CASE_UPPER / MB_CASE_TITLE / MB_CASE_LOWER
      $str = str_replace(' ','-',$str);
      
      return $str;
   }

   function cate_parent($data, $parent = 0,$str = "--") {
      $dem = 0;
      foreach($data as $val) {
         $id = $val->id;
         $name = $val->name;
         if($val->parent_id == $parent) {
         $dem++;//nếu tìm thấy 1 lần thì tăng 1 cấp rồi ngưng.
         if($dem == 1)
            $str .= "----";
         if($parent == 0) //bỏ hai dòng rồi biết tại sao mới thêm
         $str = "--";
         echo "<option value = '$id'>$str $name</option>";
         cate_parent($data,$id,$str);
      } 
   }
}

function cate_parent_edit($data,  $parent = 0,$str = "--", $select) {
   $dem = 0;
   foreach($data as $val) {
      $id = $val->id;
      $name = $val->name;
      if($val->parent_id == $parent) {
         $dem++;//nếu tìm thấy 1 lần thì tăng 1 cấp rồi ngưng.
         if($dem == 1)
            $str .= "----";
         if($parent == 0) //bỏ hai dòng rồi biết tại sao mới thêm
         $str = "--";
         if($select != 0 && $id == $select) {
            echo "<option value = '$id' selected='selected' >$str $name</option>";
         } else {
            echo "<option value = '$id' >$str $name</option>";
         }
         cate_parent_edit($data,$id,$str,$select);
      }
   }
}

function newImage($str) {
   $tmp = explode('.', $str);
   $new_img = "$tmp[0]".time()."."."$tmp[1]";
   return $new_img;
}

// function check_permission($controller){
      
//       var_dump("ABC"); die();
//       $m_per = new M_permission;

//       // return $m_per->check_per($controller);
      
//    }


function get_message() {
   return "You don't have permission to do that action";
}

