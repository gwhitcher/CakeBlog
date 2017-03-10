<?php 
if(!empty($page->metadescription)) {
	$this->assign('metadescription', $page->metadescription);
}
if(!empty($page->metakeywords)) {
	$this->assign('metakeywords', $page->metakeywords);
}
?>
<h2><?php echo $page->title; ?></h2>
<?php echo $page->body; ?>