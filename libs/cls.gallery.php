<?php
class CLS_GALLERY{
	private $pro=array( 'ID'=>'-1',
						'AlbumID'=>'',
						'IMG'=>'',
						'Name'=>'',
						'Intro'=>'',
						'isActive'=>1);
	private $objmysql=NULL;
	public function CLS_GALLERY(){
		$this->objmysql=new CLS_MYSQL;
	}
	// property set value
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo ('Can not found $proname member');
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo ("Can not found $proname member");
			return;
		}
		return $this->pro[$proname];
	}
	public function getList($where='',$order=' ORDER BY id DESC, `album_id` DESC '){
		$sql="SELECT * FROM `tbl_gallery` where 1=1 ".$where.$order;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	function getNameById($id=0) {
		$sql="SELECT id,name FROM tbl_album WHERE isactive=1 AND id=$id";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$rows=$objdata->Fetch_Assoc();
		return $rows['name'];
	}
	function getListAlbum($name='') {
		$sql="SELECT id,name FROM tbl_album WHERE isactive=1";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$arr = array(); $i=0;
		while($rows=$objdata->Fetch_Assoc()){
			$arr[$i]['id'] = $rows['id'];
			$arr[$i]['name'] = $rows['name'];
			$i++;
		}
		return $arr;
	}
	function ListAlbum($strwhere="",$no_id=0){
		if($no_id>0) $sql = "SELECT * FROM tbl_album WHERE isactive=1 AND id<>$no_id ORDER BY id ASC";
		else $sql="SELECT * FROM tbl_album WHERE isactive=1 ORDER BY id ASC";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		while($rows=$objdata->Fetch_Assoc())
		{	
			$id=$rows['id'];
			$ablum=stripslashes($rows['name']);
			$img=$rows['img'];
			if($img!='') { 
				$img = strpos($img,'http')!==false?$img:ROOTHOST.$img; 
			}
			$intro = stripslashes($rows['intro']);
			echo '<div class="item-gallery">
					<h3><a class="detail" href="/du-an/'.$id.'">'.$ablum.'</a></h3>
					<a rel="example_group" title="'.$intro.'" href="'.$img.'" class="vlightbox">
					<div class="logo-mark">&nbsp;</div>
					<img src="'.$img.'" alt="" align="" border="0px"></a>
					<a class="detail" href="/du-an/'.$id.'" class="readmore">Xem thêm <span class="glyphicon glyphicon-play-circle"></span></a>
				</div>';
		}
	}
	function ListGallery($strwhere="",$order=" ORDER BY `order` ASC, id DESC"){
		$sql="SELECT g.*,a.name as ablum FROM tbl_gallery as g INNER JOIN tbl_album as a WHERE g.album_id = a.id ".$strwhere.$order;
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		while($rows=$objdata->Fetch_Assoc())
		{	
			$id=$rows['id'];
			$ablum=$rows['ablum'];
			$img=$rows['img'];
			if($img!='') { 
				$img = strpos($img,'http')!==false?$img:ROOTHOST.$img; 
			}
			$intro = stripslashes($rows['intro']);
			$name = stripslashes($rows['name']);
			$link = ROOTHOST.'du-an/'.$id.'/'.un_unicode($name).'.html';
			echo '<div class="item-gallery">
				<a rel="example_group" title="'.$name.'" href="'.$img.'" class="vlightbox">
				<div class="logo-mark">&nbsp;</div>
				<img src="'.$img.'" alt="" align="" border="0px"></a>
				<div class="intro"><strong><a href="'.$link.'">'.$name.'</a></strong><br>'.$intro.'</div>
				</div>';
		}
	}
	public function setVisited($id){
		$sql="UPDATE tbl_gallery SET `visited`=`visited`+1 WHERE `id`='".$id."'";
		return $this->objmysql->Query($sql);
	}
	function strip_html_tags( $text )
	{
	// Remove invisible content
		$text = preg_replace(
			array(
				//ADD a (') before @<head ON NEXT LINE. Why? see below
				'@<head[^>]*?>.*?</head>@siu',
				'@<style[^>]*?>.*?</style>@siu',
				'@<script[^>]*?.*?</script>@siu',
				'@<object[^>]*?.*?</object>@siu',
				'@<embed[^>]*?.*?</embed>@siu',
				'@<applet[^>]*?.*?</applet>@siu',
				'@<noframes[^>]*?.*?</noframes>@siu',
				'@<noscript[^>]*?.*?</noscript>@siu',
				'@<noembed[^>]*?.*?</noembed>@siu',
			  // Add line breaks before and after blocks
				'@</?((address)|(blockquote)|(center)|(del))@iu',
				'@</?((div)|(h[1-9])|(ins)|(isindex)|(p)|(pre))@iu',
				'@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
				'@</?((table)|(th)|(td)|(caption))@iu',
				'@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
				'@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
				'@</?((frameset)|(frame)|(iframe))@iu',
			),
			array(
				' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',
				"\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0",
				"\n\$0", "\n\$0",
			),
			$text );
		return strip_tags( $text );
	}
}
?>