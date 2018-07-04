<?php
//公共函数库

/*函数说明
 * 
 *为一张图片添加上一个logo图片水印（以保存的方式实现）
 *@param string $picname 被处理的图像源
 *@param string  $ogo 水印图片
 *@param string $pre 缩放后的图片名的前缀名
 *@return  string 返回缩放后的图片名称(带路径) ，如：a.jpg=>n_a.jpg
 * 
 * 图片的处理函数在手册 GD and Image中，很多，掌握一些常见的就好了。
 */

function imageUpdateLogo($picname,$logo,$pre="n_"){
  //1、 getimagesize();获取图片大小
  $picnameinfo = getimagesize($picname);//获取图像源的基本信息
  $logoinfo = getimagesize($logo);//获取logo图像的基本信息
  var_dump($logoinfo);
   //获取图片的类型创建对应的图片资源
   switch($picnameinfo[2]){
   	case 1://gif格式
   	$im =imagecreatefromgif($picname);
   	break;
   	case 2://jpg格式
   	 $im =imagecreatefromjpeg($picname);
   	 	break;
   	case 3://png 格式
   	$im =imagecreatefrompng($picname);
   		break;
   	default:
   	 die("图片类型错误"	);
   }
   
   //获取图片的类型创建对应的图片资源
   switch($logoinfo[2]){
   	case 1://gif格式
   	$logoim =imagecreatefromgif($logo);
   	break;
   	case 2://jpg格式
   	 $logoim =imagecreatefromjpeg($logo);
   	 	break;
   	case 3://png 格式
   	$logoim =imagecreatefrompng($logo);
   		break;
   	default:
   	 die("图片类型错误"	);
   }
   //执行图片水印处理
   imagecopyresampled($im,$logoim,$picnameinfo[0]-$logoinfo[0],$picnameinfo[1]-$logoinfo[1],0,0,$logoinfo[0],$logoinfo[1],$logoinfo[0],$logoinfo[1]);
   //输出图像 （根据原图像的类型输出为对应的类型）输到浏览器上，而是输到一个资源中去
   //输出的路径：./img/s_1.jpg
   //pathinfo()函数 返回文件路径的信息
   $picinfo = pathinfo($picname);//解析原图像的路径，名字
   $newpicname= $picinfo["dirname"]."/".$pre.$picinfo["basename"];
   switch($picnameinfo[2]){
   	case 1://gif格式
   	 imagegif($im,$newpicname);
   	break;
   	case 2://jpg格式
   	  	 imagejpeg($im,$newpicname);
   	 	break;
   	case 3://png 格式
     	 imagepng($im,$newpicname);
   		break;
   
  }
  //关闭（释放）图片资源
  imagedestroy($im);
  imagedestroy($logoim);
  //返回结果
  return $newpicname;
}

//测试  PHP中函数调用不区分大小写
//echo imageUpdateSize("./img/1.jpg");
echo imageupdatelogo("./img/1.jpg","./img/ss_1.jpg");
?>