<table align="center">
<?php
$select = "SELECT * FROM register where r_bid='".$_SESSION["id"]."' order by `name` ";
$result = mysql_query($select) or die(mysql_error());
$res = mysql_query("select * from regi_balic where b_id='".$_SESSION["id"]."'");
$row1=mysql_fetch_array($res);
$i=1;
echo'<thead><tr align="center">
<th width=3%><font size=3><strong>No.</strong></font></th>
<th width=10%><font size=3><strong>IC</strong></font></th>
<th width=12%><font size=3><strong>Name</strong></font></th>
<th width=12%><font size=3><strong>Reference</strong></font></th>
<th width=2%><font size=3><strong>Age</strong></font></th>
<th width=12%><font size=3><strong>Occupatin</strong></font></th>
<th width=5%><font size=3><strong>Mobile No</strong></font></th>
<th width=2%><font size=3><strong>Delete</strong></font></th>
</tr></thead>';
while($row = mysql_fetch_array($result))
{
echo '<tbody><tr>
<td width="3%" align="center" ><font size=3>'.$i.'</font></td>
<td width="10%"><font size=3>'.$row1['name'].'</font></td>
<td width="12%" align="left" ><font size=3>
<a href="edit_detail.phpid='.$row["r_id"].'
&cand_id='.$_SESSION["id"].'&email='.$row["email"].'">'.$row['name'].'</a></font></td>
<td width="12%" align="center" ><font size=3>'.$row['reference'].'</font></td>
<td width="2%" align="right" style="padding-right:8px" >
<fontsize=3>'.$row['age'].'</font></td>
<td width="12%" align="right" style="padding-right:8px"><font
size=3>'.$row['occupation'].'</font></td>
<td width="5%" align="right"><font size=3>'.$row['mob_no'].'</font></td>
<td width="2%"><a href="process_del_client.php?id='.$row['r_id'].'" onClick="return
ConfirmSubmit(\'Are You sure ?\')"><img src = "images/delete.png"></a></td>
</tr></tbody>';
$i++;
}
echo '</table></div></center>';
?>
</div>
