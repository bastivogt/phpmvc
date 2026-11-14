<p>
    <label for="title">Title</label>
    <input type="text" name="title" id="title" value="<?php echo old('title', $todo->title) ?? ''; ?>">
</p>
<p>
    <label for="description">Description</label>
    <textarea name="description" id="description"><?php echo old('description', $todo->description) ?? ''; ?></textarea>
</p>
<p>
    <label for="done">Done</label>
    <input type="checkbox" name="done" id="done" <?php if (!empty(old('done', $todo->done))) { echo 'checked'; } ?>>
</p>