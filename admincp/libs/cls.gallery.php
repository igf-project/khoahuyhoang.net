<?php
class CLS_GALLERY{
	private $pro=array( 'ID'=>'-1',
						'AlbumID'=>'',
						'IMG'=>'',
						'Name'=>'',
						'Intro'=>'',
						'Order'=>'',
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
	public function getList($where='',$limit=''){
		$sql="SELECT * FROM `tbl_gallery` where 1=1 ".$where.' ORDER BY id DESC, `album_id` DESC'.$limit;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	function listAlbum($curid=0) {
		$sql="SELECT id,name FROM tbl_album WHERE isactive=1 ORDER BY id DESC";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		while($rows=$objdata->Fetch_Assoc())
		{
			if($rows['id']== $curid)
				echo '<option value="'.$rows['id'].'" selected="selected">'.$rows['name'].'</option>';
			else echo '<option value="'.$rows['id'].'">'.$rows['name'].'</option>';
		}
	}
	function listTable($strwhere="",$page=1){
		$star=0; if($page>1) $star=($page-1)*MAX_ROWS;
		$leng=MAX_ROWS;
		$sql="SELECT g.*,a.name as ablum  FROM tbl_gallery as g INNER JOIN tbl_album as a WHERE g.album_id = a.id ".$strwhere." ORDER BY `order` ASC, id DESC LIMIT $star,$leng";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$i=0;
		while($rows=$objdata->Fetch_Assoc())
		{	$i++;
			$id=$rows['id'];
			$ablum=$rows['ablum'];
			$img=$rows['img'];
			if($img!='') { 
				$img = strpos($img,'http')!==false?$img:'http://'.$_SERVER['HTTP_HOST'].$img; 
				$img = '<img src="'.$img.'" height="100"/>'; 
			}
			$intro=stripslashes($rows['intro']);
			$name=stripslashes($rows['name']);
			$visited = $rows['visited'];
			
			echo "<tr name='trow'>";
			echo "<td width='30' align='center'>$i</td>";
			echo "<td width='30' align='center'><label>";
			echo "<input type='checkbox' name='chk' id='chk' onclick='docheckonce(\"chk\");' value='$id' />";
			echo "</label></td>";
			echo "<td>$ablum</td>";
			echo '<td align="center">'.$img."</td>";
			echo "<td>$name &nbsp;</td>";
			echo "<td>$intro &nbsp;</td>";
			echo "<td align=\"center\">$visited &nbsp;</td>";
			echo "<td align=\"center\"><input type='text' value='".$rows['order']."' name='txt_order'/></td>";
			echo "<td width='50' align='center'>";
				echo "<a href='index.php?com=".COMS."&amp;task=active&amp;id=$id'>";
				showIconFun('publish',$rows["isactive"]);
				echo "</a>";
			echo "</td>";
			echo "<td width='50' align='center'>";
				echo "<a href='index.php?com=".COMS."&amp;task=edit&amp;id=$id'>";
				showIconFun('edit','');
				echo "</a>";
			echo "</td>";
			echo "<td width='50' align='center'>";
				echo "<a href='javascript:detele_field(\"index.php?com=".COMS."&amp;task=delete&amp;id=$id\")'>";
				showIconFun('delete','');
				echo "</a>";
			echo "</td>";
		  	echo "</tr>";
		}
	}
	function Add_new(){
		$sql=" INSERT INTO `tbl_gallery`(`album_id`,`img`,`name`,`intro`,`isactive`) VALUES";
		$sql.="('".$this->AlbumID."','".$this->IMG."',N'".$this->Name."',N'".$this->Intro."','".$this->isActive."')";
		return $this->objmysql->Exec($sql);
	}
	function Update(){
		$sql = "UPDATE tbl_gallery SET `IMG`='".$this->IMG."',`album_id`='".$this->AlbumID."',`name`=N'".$this->Name."',`intro`=N'".$this->Intro."',`order`=".$this->Order.",`isactive`='".$this->pro["isActive"]."' WHERE id='".$this->ID."'";
		return $this->objmysql->Exec($sql);
	}
	function setActive($ids,$status=''){
		$sql="UPDATE `tbl_gallery` SET `isactive`='$status' WHERE `id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_gallery` SET `isactive`=if(`isactive`=1,0,1) WHERE `id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	function Order($arr_id,$arr_quan){
		$n=count($arr_id); 
		for($i=0;$i<$n;$i++){
			$sql="UPDATE `tbl_gallery` SET `order`='".$arr_quan[$i]."' WHERE `id` = '".$arr_id[$i]."' ";
			$this->objmysql->Exec($sql);
		}
	}
	function Delete($id){
		$sql="DELETE FROM `tbl_gallery` WHERE `id` in ('$id')";
		return $this->objmysql->Exec($sql);
	}
}
?>