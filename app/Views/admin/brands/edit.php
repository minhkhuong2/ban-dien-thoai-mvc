<h2><?php echo $data['title']; ?></h2>
<div class="card" style="max-width: 500px;">
    <form action="<?php echo URLROOT; ?>/admin/editBrand/<?php echo $data['brand']['id']; ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Tên Thương hiệu</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($data['brand']['name']); ?>" required class="form-control">
        </div>
        <div class="form-group">
            <label>Logo hiện tại</label><br>
            <img src="<?php echo URLROOT; ?>/images/brands/<?php echo $data['brand']['logo']; ?>" style="height: 50px; margin-bottom: 10px;">
            <input type="hidden" name="current_logo" value="<?php echo $data['brand']['logo']; ?>">
            <input type="file" name="logo" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
