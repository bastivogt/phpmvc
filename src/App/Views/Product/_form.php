<label for="name">Name:</label>
<input type="text" id="name" name="name" value="<?php echo $name ?? ''; ?>" required>
<br>
<label for="description">Description:</label>
<textarea id="description" name="description" required><?php echo $description ?? ''; ?></textarea>
