<p>
    <label for="title">Title</label>
    <input type="text" name="title" id="title" value="<?php echo esc($todo->title) ?? ''; ?>">
</p>
<p>
    <label for="description">Description</label>
    <textarea name="description" id="description"><?php echo esc($todo->description) ?? ''; ?></textarea>
</p>
<p>
    <label for="done">Done</label>
    <input type="checkbox" name="done" id="done" <?php if ($todo->done) { echo 'checked'; } ?>>
</p>