<h1 class="page-header">Search</h1>
<?php
echo $this->Form->create('Search', array('type' => 'get', 'enctype'=>'multipart/form-data'));

if(!empty($this->request->query['keyword'])) { $keyword = $this->request->query['keyword']; } else { $keyword = ''; }
echo '<div class="form-group">';
echo $this->Form->input('keyword', array('class' => 'form-control', 'type' => 'text', 'placeholder' => 'Keyword', 'default' => $keyword, 'required' => true));
echo '</div>';

echo '<div class="form-group">';

echo '<label for="category" class="control-label input-group">Category</label>';
if(empty($this->request->query['category'])) {
    $this->request->query['category'] = '';
}
foreach($category_array as $category_array_item) {
    if($category_array_item[0] == $this->request->query['category']) { $selected = 'checked'; } else { $selected = '';}
    echo '<label class="btn btn-default"><input name="category" value="'.$category_array_item[0].'" type="radio" '.$selected.'> '.$category_array_item[1].' </label> ';
}
echo '</div>';

echo '<div class="form-group">';
echo $this->Form->submit('Send', array('class' => 'btn btn-primary', 'title' => 'Submit'));
echo '</div>';

echo $this->Form->end();

if(!empty($this->request->query['category'])) {
    echo '<h1 class="page_header">Search Results</h1>';
    $category = $this->request->query['category'];

    echo '<ul>';
    foreach($category_array as $cat_array) {
        if($cat_array[0] == $category) {
            if(!empty($cat_array[2])) {
                if($search_results->count() > 0) {
                    foreach ($search_results as $search_result) {
                        echo '<li><a href="' . BASE_URL . '/' . $search_result->id . '/' . $search_result->slug . '">' . $search_result->title . '</a></li>';
                    }
                } else {
                    echo '<li>No results to show.</li>';
                }
            } else {
                if($search_results->count() > 0) {
                    foreach ($search_results as $search_result) {
                        echo '<li><a href="' . BASE_URL . '/' . $search_result->id . '/' . $search_result->slug . '">' . $search_result->title . '</a></li>';
                    }
                } else {
                    echo '<li>No results to show.</li>';
                }
            }
        }
    }
    echo '</ul>';
}
