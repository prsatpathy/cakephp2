<h2>Tree behaviour with example</h2>
<?php
echo $this->html->link("Add Category",array('action'=>'add'));
echo "<ul>";
foreach($Categorylist as $key=>$value){
    $editurl = $this->html->link("Edit", array('action'=>'edit', $key),array('style'=>'font-weight:lighter;font-size:9px;color:green;','title'=>'Edit This Node'));
    $upurl = $this->html->link("Up", array('action'=>'moveup', $key),array('style'=>'font-weight:lighter;font-size:9px;color:green;','title'=>'Move Up the Tree'));
    $downurl = $this->html->link("Down", array('action'=>'movedown', $key),array('style'=>'font-weight:lighter;font-size:9px;color:green;','title'=>'Move Down the Tree'));
    $deleteurl = $this->html->link("Delete", array('action'=>'delete', $key),array('style'=>'font-weight:lighter;font-size:9px;color:green;','title'=>'Delete the Node from the Tree','onClick'=>'return confirm("Are you sure you want to delete")'));
    $removeurl =$this->html->link("Remove From Tree",array('action'=>'removeNode',$key),array('style'=>'font-weight:lighter;font-size:9px;color:#b3b3b3;','title'=>'Remove the Node from the Tree','onClick'=>'return confirm("Are you sure you want to remove")'));
    echo "<li><sub>-$editurl-$upurl-$downurl-$deleteurl- </sub><span style='color:red;'>$value</span> <sup>$removeurl</sup></li>";
}
echo "</ul>";
?>