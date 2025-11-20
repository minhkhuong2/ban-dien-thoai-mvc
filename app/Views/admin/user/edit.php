<h2><?php echo $data['title']; ?></h2>

<form action="<?php echo URLROOT; ?>/admin/editUser/<?php echo $data['user']['id']; ?>" method="POST" style="max-width: 400px;">

    <div style="margin-bottom: 20px;">
        <p><strong>Email:</strong> <?php echo htmlspecialchars($data['user']['email']); ?></p>
    </div>

    <div style="margin-bottom: 20px;">
        <label style="font-weight: bold; display: block; margin-bottom: 10px;">Vai trò:</label>
        <label for="is_admin">
            <input type="checkbox" id="is_admin" name="is_admin" value="1"
                <?php echo ($data['user']['is_admin'] == 1) ? 'checked' : ''; ?>>
            Là Quản trị viên (Admin)?
        </label>
    </div>

    <button type="submit" class="btn btn-primary">Cập nhật Vai trò</button>
    <a href="<?php echo URLROOT; ?>/admin/users" class="btn btn-secondary">Hủy</a>

</form>
