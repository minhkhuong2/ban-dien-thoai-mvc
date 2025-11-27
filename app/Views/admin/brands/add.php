<h2><?php echo $data['title']; ?></h2>
<div class="card" style="max-width: 500px;">
    <form action="<?php echo URLROOT; ?>/admin/addBrand" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Tên Thương hiệu</label>
            <input type="text" name="name" required class="form-control">
        </div>
        <div class="form-group">
            <label>Logo (Ảnh)</label>
            <input type="file" name="logo" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
</div>
