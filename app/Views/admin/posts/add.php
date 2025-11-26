<div class="mb-4">
    <h2 class="card-title" style="font-size: 1.5rem;"><?php echo $data['title']; ?></h2>
</div>

<div class="card" style="max-width: 1000px;">
    <div class="card-header">
        <h4 class="card-title">Soạn thảo bài viết mới</h4>
    </div>
    <form action="<?php echo URLROOT; ?>/admin/addPost" method="POST" enctype="multipart/form-data">
        <div style="padding: 24px;">
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;">
                <div class="form-group">
                    <label class="form-label">Tiêu đề bài viết <span style="color: var(--danger-color);">*</span></label>
                    <input type="text" name="title" required class="form-control" placeholder="Nhập tiêu đề bài viết...">
                </div>
                <div class="form-group">
                    <label class="form-label">Danh mục <span style="color: var(--danger-color);">*</span></label>
                    <select name="category_id" required class="form-control">
                        <option value="">-- Chọn danh mục --</option>
                        <?php foreach ($data['categories'] as $cat): ?>
                            <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group" style="margin-top: 24px;">
                <label class="form-label">Ảnh đại diện <span style="color: var(--danger-color);">*</span></label>
                <input type="file" name="image" accept="image/*" required class="form-control" style="padding: 6px;">
            </div>

            <div class="form-group" style="margin-top: 24px;">
                <label class="form-label">Nội dung <span style="color: var(--danger-color);">*</span></label>
                <textarea name="content" id="post_content_editor"></textarea>
            </div>
        </div>

        <div style="padding: 24px; border-top: 1px solid var(--border-color); background-color: var(--bg-color); border-radius: 0 0 var(--radius-lg) var(--radius-lg); display: flex; gap: 16px;">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-paper-plane"></i> Đăng bài
            </button>
            <a href="<?php echo URLROOT; ?>/admin/posts" class="btn btn-secondary">Hủy</a>
        </div>
    </form>
</div>

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
