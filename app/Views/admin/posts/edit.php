<style>
    /* CSS tạm thời cho form */
    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-group input[type="text"],
    .form-group textarea {
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .form-group textarea {
        min-height: 250px;
    }
</style>

<h2><?php echo $data['title']; ?></h2>
<form action="<?php echo URLROOT; ?>/admin/editPost/<?php echo $data['post']['id']; ?>" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label>Danh mục <sup>*</sup></label>
        <select name="category_id" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
            <option value="">-- Chọn danh mục --</option>
            <?php foreach ($data['categories'] as $cat): ?>
                <option value="<?php echo $cat['id']; ?>"
                    <?php echo ($cat['id'] == $data['post']['category_id']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($cat['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="title">Tiêu đề bài viết <sup>*</sup></label>
        <input type="text" name="title" required value="<?php echo htmlspecialchars($data['post']['title']); ?>">
    </div>

    <div class="form-group">
        <label for="image">Ảnh đại diện (Để trống nếu không muốn đổi)</label>
        <input type="file" name="image" accept="image/*">
        <input type="hidden" name="current_image" value="<?php echo $data['post']['image']; ?>">
        <br>
        <img src="<?php echo URLROOT . '/uploads/' . $data['post']['image']; ?>" alt="" style="width: 150px; margin-top: 10px; border-radius: 5px;">
    </div>

    <div class="form-group">
        <label for="content">Nội dung <sup>*</sup></label>
        <textarea name="content" id="post_content_editor"><?php echo $data['post']['content']; ?></textarea>
    </div>

    <input type="hidden" name="slug" value="<?php echo $data['post']['slug']; ?>">

    <button type="submit" class="btn btn-primary">Cập nhật</button>
    <a href="<?php echo URLROOT; ?>/admin/posts" class="btn btn-secondary">Hủy</a>

</form>

<script>
    tinymce.init({
        selector: 'textarea#post_content_editor',
        plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
        menubar: 'file edit view insert format tools table help',
        toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media link anchor codesample | ltr rtl',
        height: 500,
        setup: function(editor) {
            // Đảm bảo dữ liệu được lưu khi submit form
            editor.on('change', function() {
                editor.save();
            });
        }
    });
</script>
