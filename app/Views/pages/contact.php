<div class="contact-page">
    <h1>Liên hệ với chúng tôi</h1>
    <p class="subtitle">Chúng tôi luôn sẵn sàng hỗ trợ bạn. Hãy liên hệ để được tư vấn tốt nhất về các sản phẩm điện thoại!</p>

    <div class="contact-info-boxes">
        <div class="contact-info-box">
            <div class="contact-info-box-icon"><svg viewBox="0 0 24 24" class="icon">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                    <circle cx="12" cy="10" r="3"></circle>
                </svg></div>
            <h4>Địa chỉ cửa hàng</h4>
            <p>123 Nguyễn Huệ, Quận 1, TP.HCM</p>
            <p>Thứ 2 - Chủ nhật: 8:00 - 22:00</p>
        </div>
        <div class="contact-info-box">
            <div class="contact-info-box-icon"><svg viewBox="0 0 24 24" class="icon">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.63A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg></div>
            <h4>Hotline</h4>
            <p>1900 1234</p>
            <p>Phím 1: Mua hàng, Phím 2: Hỗ trợ</p>
        </div>
        <div class="contact-info-box">
            <div class="contact-info-box-icon"><svg viewBox="0 0 24 24" class="icon">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,13 2,6"></polyline>
                </svg></div>
            <h4>Email</h4>
            <p>info@mobilestore.test</p>
            <p>Phản hồi trong 24 giờ</p>
        </div>
        <div class="contact-info-box">
            <div class="contact-info-box-icon"><svg viewBox="0 0 24 24" class="icon">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg></div>
            <h4>Giờ làm việc</h4>
            <p>8:00 - 22:00</p>
            <p>Tất cả các ngày trong tuần</p>
        </div>
    </div>

    <div class="contact-layout">

        <div class="contact-form-section">
            <h3>Gửi tin nhắn cho chúng tôi</h3>

            <?php if (!empty($data['success_message'])) : ?>
                <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                    <?php echo $data['success_message']; ?>
                </div>
            <?php endif; ?>

            <form action="<?php echo URLROOT; ?>/page/contact" method="POST">
                <div class="form-grid-half">
                    <div class="form-group">
                        <label for="name">Họ và tên <sup>*</sup></label>
                        <input type="text" name="name" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại <sup>*</sup></label>
                        <input type="text" name="phone" id="phone" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email <sup>*</sup></label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="form-group">
                    <label for="subject">Chủ đề <sup>*</sup></label>
                    <select name="subject" id="subject" required>
                        <option value="">-- Chọn chủ đề --</option>
                        <option value="Tư vấn mua hàng">Tư vấn mua hàng</option>
                        <option value="Hỗ trợ kỹ thuật">Hỗ trợ kỹ thuật</option>
                        <option value="Khiếu nại, góp ý">Khiếu nại, góp ý</option>
                        <option value="Khác">Khác</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="message">Nội dung tin nhắn <sup>*</sup></label>
                    <textarea name="message" id="message" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="font-size: 1rem; padding: 12px 20px;">Gửi tin nhắn</button>
            </form>
        </div>

        <div class="contact-sidebar-section">
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.44717109787!2d106.70228081533087!3d10.77699549232078!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f483c6b24d9%3A0x7d28e7dec72d80d2!2zTmd1ecOqbiBIdeG7hywgQuG6v24gTmdow6ksIFF14bqtbiAxLCBUaMOgbmggcGjhu5EgSOG7kyBDaMOtIE1pbmgsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1678888888888!5m2!1svi!2s"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div class="services-widget">
                <h4>Dịch vụ của chúng tôi</h4>
                <div class="service-item">
                    <div class="service-item-icon"><svg viewBox="0 0 24 24" class="icon">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        </svg></div>
                    <div><strong>Bảo hành chính hãng</strong><br><small>12-24 tháng nhà sản xuất</small></div>
                </div>
                <div class="service-item">
                    <div class="service-item-icon"><svg viewBox="0 0 24 24" class="icon">
                            <rect x="1" y="3" width="15" height="13"></rect>
                            <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                            <circle cx="5.5" cy="18.5" r="2.5"></circle>
                            <circle cx="18.5" cy="18.5" r="2.5"></circle>
                        </svg></div>
                    <div><strong>Giao hàng miễn phí</strong><br><small>Đơn hàng từ 2 triệu</small></div>
                </div>
                <div class="service-item">
                    <div class="service-item-icon"><svg viewBox="0 0 24 24" class="icon">
                            <polyline points="23 4 23 10 17 10"></polyline>
                            <polyline points="1 20 1 14 7 14"></polyline>
                            <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                        </svg></div>
                    <div><strong>Đổi trả dễ dàng</strong><br><small>7 ngày nếu có lỗi</small></div>
                </div>
                <div class="service-item">
                    <div class="service-item-icon"><svg viewBox="0 0 24 24" class="icon">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg></div>
                    <div><strong>Hỗ trợ 24/7</strong><br><small>Đội ngũ chuyên nghiệp</small></div>
                </div>
            </div>
        </div>
    </div>

    <div class="faq-section">
        <h2 class="section-title">Câu hỏi thường gặp</h2>
        <div class="faq-item">
            <h5>Làm thế nào để kiểm tra bảo hành?</h5>
            <p>Bạn có thể kiểm tra bảo hành bằng cách nhập số IMEI trên website hoặc liên hệ hotline 1900 1234.</p>
        </div>
        <div class="faq-item">
            <h5>Chính sách đổi trả như thế nào?</h5>
            <p>Chúng tôi hỗ trợ đổi trả trong 7 ngày đầu với điều kiện sản phẩm còn nguyên vẹn và đầy đủ phụ kiện.</p>
        </div>
        <div class="faq-item">
            <h5>Có hỗ trợ trả góp không?</h5>
            <p>Có, chúng tôi hỗ trợ trả góp 0% lãi suất qua các ngân hàng và công ty tài chính uy tín.</p>
        </div>
    </div>

</div>
