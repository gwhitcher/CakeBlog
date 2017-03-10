<h1 class="page-header">Edit Article</h1>
<?php
echo $this->Form->create($article, array('enctype'=>'multipart/form-data'));

echo '<div class="form-group">';
echo $this->Form->input('post_type_id', array('class' => 'form-control', 'id' => 'post_type_id', 'empty' => 'Please choose', 'options' => $post_type_ids));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->input('category_id', array('class' => 'form-control', 'id' => 'category_id', 'empty' => 'Please choose', 'options' => $category_ids, 'value' => $selected_categories, 'multiple' => true));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->input('title', array('class' => 'form-control', 'id' => 'title', 'type' => 'text'));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->input('body', array('class' => 'form-control', 'id' => 'body', 'type' => 'textarea'));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->input('featured', array('class' => 'form-control', 'id' => 'featured', 'type' => 'text'));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->input('metadescription', array('class' => 'form-control', 'label' => 'Meta Description', 'id' => 'metadescription', 'type' => 'text'));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->input('metakeywords', array('class' => 'form-control', 'label' => 'Meta Keywords', 'id' => 'metakeywords', 'type' => 'text'));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->input('slider', array('class' => 'form-control', 'id' => 'slider', 'type' => 'select', 'options' => array(0 => 'No', 1 => 'Yes')));
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->input('status', array('class' => 'form-control', 'id' => 'status', 'type' => 'select', 'options' => array(0 => 'Draft', 1 => 'Published')));
echo '</div>';

echo $this->Form->submit('Submit', array('class' => 'btn btn-primary', 'title' => 'Submit'));
echo $this->Form->end();
?>
<script type="text/javascript">
    $(function() {
        $("#post_type_id").bind("change", function() {
            $.ajax({
                type: "GET",
                url: "<?php echo BASE_URL;?>/admin/articles/load_categories",
                data: "post_type_id="+$("#post_type_id").val(),
                success: function(html) {
                    $("#category_id").html(html);
                }
            });

        });
    });
</script>