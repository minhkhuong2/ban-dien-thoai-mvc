<div class="mb-4">
    <h2 class="card-title" style="font-size: 1.5rem;"><?php echo $data['title']; ?></h2>
</div>

<div class="card" style="max-width: 1000px;">
    <div class="card-header">
        <h4 class="card-title">Chỉnh sửa bài viết</h4>
    </div>
    <form action="<?php echo URLROOT; ?>/admin/editPost/<?php echo $data['post']['id']; ?>" method="POST" enctype="multipart/form-data">
        <div style="padding: 24px;">
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;">
                <div class="form-group">
                    <label class="form-label">Tiêu đề bài viết <span style="color: var(--danger-color);">*</span></label>
                    <input type="text" name="title" required value="<?php echo htmlspecialchars($data['post']['title']); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label">Danh mục <span style="color: var(--danger-color);">*</span></label>
                    <select name="category_id" required class="form-control">
                        <option value="">-- Chọn danh mục --</option>
                        <?php foreach ($data['categories'] as $cat): ?>
                            <option value="<?php echo $cat['id']; ?>"
                                <?php echo ($cat['id'] == $data['post']['category_id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($cat['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group" style="margin-top: 24px;">
                <label class="form-label">Ảnh đại diện (Để trống nếu không muốn đổi)</label>
                <div style="display: flex; align-items: flex-start; gap: 16px;">
                    <img src="<?php echo URLROOT . '/uploads/' . $data['post']['image']; ?>" alt="" style="width: 120px; height: 120px; object-fit: cover; border-radius: var(--radius-md); border: 1px solid var(--border-color);">
                    <div style="flex: 1;">
                        <input type="file" name="image" accept="image/*" class="form-control" style="padding: 6px;">
                        <input type="hidden" name="current_image" value="<?php echo $data['post']['image']; ?>">
                        <small style="color: var(--text-light); display: block; margin-top: 8px;">Tải lên ảnh mới để thay thế ảnh hiện tại.</small>
                    </div>
                </div>
            </div>

            <div class="form-group" style="margin-top: 24px;">
                <label class="form-label">Nội dung <span style="color: var(--danger-color);">*</span></label>
                <textarea name="content" id="post_content_editor"><?php echo $data['post']['content']; ?></textarea>
            </div>
            
            <input type="hidden" name="slug" value="<?php echo $data['post']['slug']; ?>">
        </div>

        <div style="padding: 24px; border-top: 1px solid var(--border-color); background-color: var(--bg-color); border-radius: 0 0 var(--radius-lg) var(--radius-lg); display: flex; gap: 16px;">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Cập nhật
            </button>
            <a href="<?php echo URLROOT; ?>/admin/posts" class="btn btn-secondary">Hủy</a>
        </div>
    </form>
</div>

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
