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

<form action="<?php echo URLROOT; ?>/admin/addPost" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label>Danh mục <sup>*</sup></label>
        <select name="category_id" required>
            <option value="">-- Chọn danh mục --</option>
            <?php foreach ($data['categories'] as $cat): ?>
                <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="title">Tiêu đề bài viết <sup>*</sup></label>
        <input type="text" name="title" required>
    </div>
    <div class="form-group">
        <label for="image">Ảnh đại diện <sup>*</sup></label>
        <input type="file" name="image" accept="image/*" required>
    </div>
    <div class="form-group">
        <label for="content">Nội dung <sup>*</sup></label>
        <textarea name="content" id="post_content_editor"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Đăng bài</button>
    <a href="<?php echo URLROOT; ?>/admin/posts" class="btn btn-secondary">Hủy</a>
</form>
<script>
    tinymce.init({
        selector: 'textarea#post_content_editor', // Kích hoạt cho ID ở trên
        plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
        menubar: 'file edit view insert format tools table help',
        toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media link anchor codesample | ltr rtl',
        autosave_ask_before_unload: true,
        autosave_interval: '30s',
        height: 500, // Chiều cao
        image_caption: true,
        quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
        noneditable_class: 'mceNonEditable',
        contextmenu: 'link image table',
    });
</script>
