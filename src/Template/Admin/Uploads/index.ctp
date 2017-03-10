<?php
if(!empty($_GET['folder'])) {
    $add_file = '?folder='.$_GET['folder'];
} else {
    $add_file = '';
}
?>
<div class="row">
    <div class="col-md-10">
        <h1 class="page-header">Upload Manager</h1>
    </div>
    <div class="col-md-2 cog-list">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></a>
        <ul class="dropdown-menu">
            <li><a href="<?php echo BASE_URL; ?>/admin/uploads/add<?php echo $add_file;?>">Add File</a></li>
            <li><a href="<?php echo BASE_URL; ?>/admin/uploads/folder<?php echo $add_file;?>">Add Folder</a></li>
        </ul>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>File</th>
            <th>Preview</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        //Folders
        foreach($files as $file) {
            if(!empty($_GET['folder'])) { $folder = trim($_GET['folder'], "/"); } else { $folder = ''; };
            $folder_path = $folder.'/'.$file;
            $dir = './uploads/'.$folder_path;
            $file_parts = pathinfo($dir.'/'.$folder_path);
            if (empty($file_parts['extension'])) {
                echo '<tr>';
                echo '<td><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> '.$file.'</td>';
                echo '<td><a href="'.BASE_URL.'/admin/uploads?folder='.$folder_path.'" class="btn btn-info btn-md"">View Folder</button></td>';
                echo '<td>&nbsp;</td>';
                echo '</tr>';
            }
        }

        //Files
        $i = 0;
        foreach($files as $file) {
            if(!empty($_GET['folder'])) { $folder = trim($_GET['folder'], "/"); } else { $folder = '/'; };
            $file_path = $folder.'/'.$file;
            $dir = './uploads/'.$folder;
            $file_parts = pathinfo($dir.'/'.$file);
            if (!empty($file_parts['extension'])) {
                $i++;
                echo '<tr>';
                echo '<td><span class="glyphicon glyphicon-file" aria-hidden="true"></span> '.$file.'</td>';
                echo '<td><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal'.$i.'">Preview</button></td>';
                echo '<td><a class="delete btn btn-danger" href="'.BASE_URL.'/upload/delete?file='.$file_path.'">Delete</a></td>';
                echo '</tr>';
                $file_ext = pathinfo($file, PATHINFO_EXTENSION);
                if($file_ext == 'jpg' OR $file_ext == 'gif' OR $file_ext == 'png') {
                    $file_display = '<img class="img-responsive center-block" src="'.BASE_URL.'/uploads/'.$file_path.'" />';
                } else {
                    $file_display = '<a class="btn btn-lg btn-primary center-block" href="'.BASE_URL.'/uploads/'.$folder.'/'.$file.'" target="_blank">Open File</a>';
                }
                echo '<!-- Modal -->
<div id="myModal'.$i.'" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">'.$file.'</h4>
      </div>
      <div class="modal-body">
      <div class="form-group">
        '.$file_display.'
        </div>
        <div class="form-group">
        <label>URL:</label>
        <input class="form-control" value="'.BASE_URL.'/uploads/'.$folder.'/'.$file.'"/>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>';
            }
        }
        ?>
        </tbody>
    </table>
</div>