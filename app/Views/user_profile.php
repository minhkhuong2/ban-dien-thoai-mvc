<style>
    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: 600;
    }

    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid var(--border-color);
        border-radius: 5px;
        box-sizing: border-box;
    }

    .form-group textarea {
        min-height: 100px;
        resize: vertical;
    }

    .success-message {
        background: #d4edda;
        color: #155724;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }
</style>

<div class="static-page-container" style="max-width: 700px; margin: 20px auto;">
    <h1><?php echo $data['title']; ?></h1>
    <p>Quản lý thông tin cá nhân của bạn để chúng tôi phục vụ bạn tốt hơn.</p>

    <?php if (!empty($data['success_message'])) : ?>
        <div class="success-message">
            <?php echo $data['success_message']; ?>
        </div>
    <?php endif; ?>

    <form action="<?php echo URLROOT; ?>/user/profile" method="POST">
        <div class="form-group">
            <label for="email">Email (Không thể thay đổi)</label>
            <input type="email" name="email" id="email"
                value="<?php echo htmlspecialchars($data['user']['email']); ?>" disabled>
        </div>
        <div class="form-group">
            <label for="full_name">Họ và Tên <sup>*</sup></label>
            <input type="text" name="full_name" id="full_name"
                value="<?php echo htmlspecialchars($data['user']['full_name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="phone">Số điện thoại</label>
            <input type="text" name="phone" id="phone"
                value="<?php echo htmlspecialchars($data['user']['phone']); ?>">
        </div>
        <div class="form-group">
            <label for="address">Địa chỉ</label>
            <textarea name="address" id="address"><?php echo htmlspecialchars($data['user']['address']); ?></textarea>
            <small>Nhập địa chỉ đầy đủ (số nhà, đường, phường/xã, quận/huyện, tỉnh/TP) để tiện cho việc giao hàng.</small>
        </div>

        <button type="submit" class="btn btn-primary" style="font-size: 1rem; padding: 12px 20px;">Cập nhật thông tin</button>
    </form>
</div>
