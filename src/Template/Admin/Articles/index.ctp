<div class="row">
    <div class="col-md-10">
        <h1 class="page-header">Articles</h1>
    </div>
    <div class="col-md-2 cog-list">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></a>
        <ul class="dropdown-menu">
            <li><a href="<?php echo BASE_URL; ?>/admin/articles/add">Add Article</a></li>
        </ul>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($articles as $article) {
            echo '<tr>';
            echo '<td>'.$article->id.'</td>';
            echo '<td>'.$article->title.'</td>';
            echo '<td><a class="btn btn-warning" href="'.BASE_URL.'/admin/articles/edit/'.$article->id.'">Edit</a></td>';
            echo '<td><a class="delete btn btn-danger" href="'.BASE_URL.'/admin/articles/delete/'.$article->id.'">Delete</a></td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</div>
<ul class="pagination">
    <?php
    echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
    echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
    echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
    ?>
</ul>