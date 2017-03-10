<option value="">Please choose one</option>
<?php foreach ($category_ids as $key => $value): ?>
    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
<?php endforeach; ?>