// File: public/js/main.js

document.addEventListener("DOMContentLoaded", function () {
  // ============================================================
  // 1. CÁC HÀM HELPER (DÙNG CHUNG)
  // ============================================================

  // Hiển thị thông báo Toast (Góc phải màn hình)
  window.showToast = function (message, isError = false) {
    const toast = document.createElement("div");
    toast.className = "ajax-toast" + (isError ? " error" : "");
    toast.textContent = message;
    document.body.appendChild(toast);

    // Animation vào
    setTimeout(() => (toast.style.opacity = 1), 10);

    // Tự động xóa sau 3s
    setTimeout(() => {
      toast.style.opacity = 0;
      setTimeout(() => toast.remove(), 300);
    }, 3000);
  };

  // Format tiền Việt Nam
  const fmtMoney = (amount) =>
    new Intl.NumberFormat("vi-VN").format(amount) + " ₫";

  // ============================================================
  // 2. LOGIC TRANG CHI TIẾT SẢN PHẨM (PRODUCT DETAIL)
  // ============================================================

  const variantsElement = document.getElementById("variants-json");

  if (variantsElement) {
    const variants = JSON.parse(variantsElement.textContent);

    // --- A. KHAI BÁO DOM ELEMENTS ---
    const colorItems = document.querySelectorAll(".color-item");
    const storageItems = document.querySelectorAll(".storage-item");
    const priceEl = document.getElementById("display-price");
    const oldPriceEl = document.getElementById("display-old-price");
    const badgeEl = document.getElementById("display-badge");
    const textColorEl = document.getElementById("text-color");
    const form = document.getElementById("add-cart-form");
    const errorMsg = document.getElementById("error-msg");
    const btns = document.querySelectorAll(".btn-cart, .btn-buy");
    const mainTrack = document.getElementById("main-track");
    const thumbItems = document.querySelectorAll(".thumb-item");

    // --- B. LOGIC CHỌN BIẾN THỂ (UPDATE UI) ---
    function updateVariantUI() {
      const selectedColorBtn = document.querySelector(".color-item.active");
      const selectedStorageBtn = document.querySelector(".storage-item.active");

      if (!selectedColorBtn || !selectedStorageBtn) return;

      const color = selectedColorBtn.getAttribute("data-val");
      const storage = selectedStorageBtn.getAttribute("data-val");

      // 1. Cập nhật text màu sắc đang chọn
      if (textColorEl) textColorEl.innerText = color;

      // 2. Tìm biến thể khớp với lựa chọn
      const variant = variants.find(
        (v) => v.color === color && v.storage === storage
      );

      // 3. Cập nhật giá hiển thị trên từng nút Dung lượng (Dựa theo màu đang chọn)
      storageItems.forEach((item) => {
        const sVal = item.getAttribute("data-val");
        const vTemp = variants.find(
          (v) => v.color === color && v.storage === sVal
        );
        const spanPrice = item.querySelector(".storage-price");

        if (vTemp && vTemp.stock_quantity > 0) {
          spanPrice.innerText = fmtMoney(
            vTemp.price_sale > 0 ? vTemp.price_sale : vTemp.price
          );
          item.classList.remove("disabled");
        } else {
          spanPrice.innerText = "Hết hàng";
          item.classList.add("disabled");
        }
      });

      // 4. Xử lý hiển thị chính
      if (variant && variant.stock_quantity > 0) {
        // -- CÓ HÀNG --
        if (errorMsg) errorMsg.style.display = "none";
        form.action = URLROOT + "/cart/add/" + variant.id;
        form.setAttribute("data-valid", "true");

        // Slide tới ảnh có màu tương ứng
        if (variant.color) slideToColor(variant.color);

        // Cập nhật giá lớn
        const finalPrice =
          variant.price_sale > 0 ? variant.price_sale : variant.price;
        if (priceEl) priceEl.innerText = fmtMoney(finalPrice);

        if (variant.price_sale > 0) {
          if (oldPriceEl) {
            oldPriceEl.innerText = fmtMoney(variant.price);
            oldPriceEl.style.display = "inline-block";
          }
          if (badgeEl) {
            const percent = Math.round(
              ((variant.price - variant.price_sale) / variant.price) * 100
            );
            badgeEl.innerText = "Giảm " + percent + "%";
            badgeEl.style.display = "inline-block";
          }
        } else {
          if (oldPriceEl) oldPriceEl.style.display = "none";
          if (badgeEl) badgeEl.style.display = "none";
        }

        // Mở khóa nút mua
        btns.forEach((b) => {
          b.disabled = false;
          b.style.opacity = 1;
          b.style.cursor = "pointer";
        });
      } else {
        // -- HẾT HÀNG HOẶC KHÔNG TỒN TẠI --
        if (priceEl) priceEl.innerText = "Liên hệ";
        if (oldPriceEl) oldPriceEl.style.display = "none";
        if (badgeEl) badgeEl.style.display = "none";

        if (errorMsg) {
          errorMsg.style.display = "block";
          errorMsg.innerText = "Phiên bản này đang tạm hết hàng.";
        }
        form.setAttribute("data-valid", "false");

        // Khóa nút mua
        btns.forEach((b) => {
          b.disabled = true;
          b.style.opacity = 0.5;
          b.style.cursor = "not-allowed";
        });
      }
    }

    // Gán sự kiện click cho nút Màu & Dung lượng
    colorItems.forEach((btn) => {
      btn.addEventListener("click", function () {
        colorItems.forEach((b) => b.classList.remove("active"));
        this.classList.add("active");
        updateVariantUI();
      });
    });

    storageItems.forEach((btn) => {
      btn.addEventListener("click", function () {
        if (this.classList.contains("disabled")) return;
        storageItems.forEach((b) => b.classList.remove("active"));
        this.classList.add("active");
        updateVariantUI();
      });
    });

    // --- C. LOGIC SLIDER ẢNH CHÍNH (MAIN GALLERY) ---
    let currentSlideIndex = 0;
    let galleryInterval;
    const slides = document.querySelectorAll(".slider-single-img");

    window.goToSlide = function (index) {
      if (!mainTrack || index < 0 || index >= slides.length) return;
      currentSlideIndex = index;
      mainTrack.style.transform = `translateX(-${index * 100}%)`;

      // Active thumbnail
      thumbItems.forEach((t) => t.classList.remove("active"));
      if (thumbItems[index]) thumbItems[index].classList.add("active");

      resetGalleryTimer();
    };

    function nextSlide() {
      let newIndex = currentSlideIndex + 1;
      if (newIndex >= slides.length) newIndex = 0;
      goToSlide(newIndex);
    }

    function prevSlide() {
      let newIndex = currentSlideIndex - 1;
      if (newIndex < 0) newIndex = slides.length - 1;
      goToSlide(newIndex);
    }

    function resetGalleryTimer() {
      clearInterval(galleryInterval);
      galleryInterval = setInterval(nextSlide, 4000);
    }

    function slideToColor(colorName) {
      for (let i = 0; i < slides.length; i++) {
        if (slides[i].getAttribute("data-color") === colorName) {
          goToSlide(i);
          break;
        }
      }
    }

    // Kích hoạt nút Slider Ảnh Chính
    const gPrev = document.getElementById("gallery-prev");
    const gNext = document.getElementById("gallery-next");
    if (gPrev && gNext) {
      gPrev.addEventListener("click", prevSlide);
      gNext.addEventListener("click", nextSlide);
      resetGalleryTimer(); // Auto run
    }

    // --- D. LOGIC SLIDER SẢN PHẨM LIÊN QUAN (RELATED PRODUCTS) ---
    const relTrack = document.getElementById("related-track");
    const relPrev = document.getElementById("rel-prev");
    const relNext = document.getElementById("rel-next");

    if (relTrack && relPrev && relNext) {
      let scrollAmount = 0;
      const cardWidth = 260; // Width card + gap
      const maxScroll = relTrack.scrollWidth - relTrack.clientWidth;

      relNext.addEventListener("click", () => {
        if (Math.abs(scrollAmount) >= maxScroll) scrollAmount = 0;
        else scrollAmount -= cardWidth;
        relTrack.style.transform = `translateX(${scrollAmount}px)`;
      });

      relPrev.addEventListener("click", () => {
        if (scrollAmount === 0) return;
        else scrollAmount += cardWidth;
        if (scrollAmount > 0) scrollAmount = 0;
        relTrack.style.transform = `translateX(${scrollAmount}px)`;
      });

      // Auto play related slider
      let relAuto = setInterval(() => relNext.click(), 4000);
      relTrack.parentElement.addEventListener("mouseenter", () =>
        clearInterval(relAuto)
      );
      relTrack.parentElement.addEventListener(
        "mouseleave",
        () => (relAuto = setInterval(() => relNext.click(), 4000))
      );
    }

    // --- E. TAB CHUYỂN ĐỔI (MÔ TẢ / THÔNG SỐ / ĐÁNH GIÁ) ---
    window.openTab = function (tabName) {
      const contents = document.getElementsByClassName("tab-content");
      for (let i = 0; i < contents.length; i++)
        contents[i].style.display = "none";

      const links = document.getElementsByClassName("tab-link");
      for (let i = 0; i < links.length; i++)
        links[i].classList.remove("active");

      document.getElementById("tab-" + tabName).style.display = "block";
      if (event && event.currentTarget)
        event.currentTarget.classList.add("active");
    };

    // --- F. TĂNG GIẢM SỐ LƯỢNG (Trang Chi tiết) ---
    window.updateQty = function (change) {
      const input = document.getElementById("qty");
      if (input) {
        let val = parseInt(input.value) + change;
        if (val < 1) val = 1;
        input.value = val;
      }
    };

    // Chạy lần đầu để cập nhật UI đúng trạng thái
    updateVariantUI();
  }

  // ============================================================
  // 3. LOGIC GIỎ HÀNG & AJAX (CART ACTIONS)
  // ============================================================

  // 1. Submit Form Thêm vào giỏ (Trang chi tiết)
  const addCartForm = document.getElementById("add-cart-form");
  if (addCartForm) {
    addCartForm.addEventListener("submit", function (e) {
      e.preventDefault();

      if (this.getAttribute("data-valid") === "false") {
        showToast("Vui lòng chọn phiên bản hợp lệ", true);
        return;
      }

      const isBuyNow = e.submitter && e.submitter.value === "1";
      const formData = new FormData(this);

      fetch(this.action, {
        method: "POST",
        body: formData,
        headers: { Accept: "application/json" },
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.success) {
            const badge = document.getElementById("cart-count-badge");
            if (badge) badge.innerText = data.cartCount;

            if (isBuyNow) {
              window.location.href = URLROOT + "/checkout";
            } else {
              showToast(data.message);
            }
          } else {
            showToast(data.message, true);
          }
        })
        .catch((err) => showToast("Lỗi kết nối, vui lòng thử lại", true));
    });
  }

  // 2. Cập nhật số lượng trong trang Cart (+/-)
  document.querySelectorAll(".cart-qty-change").forEach((btn) => {
    btn.addEventListener("click", function () {
      const row = this.closest(".cart-item-row");
      const variantId = row.dataset.variantId;
      const input = row.querySelector(`input[name="quantity[${variantId}]"]`);

      let newQty = parseInt(input.value);
      if (this.classList.contains("qty-plus")) newQty++;
      if (this.classList.contains("qty-minus")) newQty--;
      if (newQty < 1) newQty = 0;

      input.value = newQty;

      // Ajax update
      const formData = new FormData();
      formData.append(`quantity[${variantId}]`, newQty);

      fetch(URLROOT + "/cart/update", {
        method: "POST",
        body: formData,
        headers: { Accept: "application/json" },
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.success) {
            if (newQty === 0) row.remove();
            updateCartUI(data);
            if (data.itemTotals && data.itemTotals[variantId]) {
              const itemTotal = document.getElementById(
                `item-total-${variantId}`
              );
              if (itemTotal)
                itemTotal.innerText = fmtMoney(data.itemTotals[variantId]);
            }
          } else {
            showToast(data.message, true);
            location.reload();
          }
        });
    });
  });

  // 3. Xóa sản phẩm khỏi giỏ
  document.querySelectorAll(".remove-from-cart-ajax").forEach((link) => {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      if (!confirm("Xóa sản phẩm này?")) return;
      const row = this.closest(".cart-item-row");

      fetch(this.href, { headers: { Accept: "application/json" } })
        .then((res) => res.json())
        .then((data) => {
          if (data.success) {
            row.remove();
            updateCartUI(data);
            showToast(data.message);
          }
        });
    });
  });

  // 4. Áp dụng Voucher
  const voucherForm = document.getElementById("voucher-form");
  if (voucherForm) {
    voucherForm.addEventListener("submit", function (e) {
      e.preventDefault();
      const formData = new FormData(this);
      fetch(this.action, {
        method: "POST",
        body: formData,
        headers: { Accept: "application/json" },
      })
        .then((res) => res.json())
        .then((data) => {
          updateCartUI(data);
          if (data.success) showToast(data.message);
          else showToast(data.voucherError || data.message, true);
        });
    });
  }

  // Helper: Cập nhật giao diện Giỏ hàng
  function updateCartUI(data) {
    const badge = document.getElementById("cart-count-badge");
    if (badge) badge.textContent = data.cartCount;

    const subTotal = document.getElementById("cart-subtotal");
    if (subTotal) subTotal.innerText = fmtMoney(data.subtotal);

    const grandTotal = document.getElementById("cart-grand-total");
    if (grandTotal) grandTotal.innerText = fmtMoney(data.grandTotal);

    const discountRow = document.getElementById("cart-discount-row");
    const voucherMsg = document.getElementById("voucher-message-container");

    if (discountRow) {
      if (data.discount > 0) {
        discountRow.style.display = "flex";
        document.getElementById("cart-discount").innerText =
          "- " + fmtMoney(data.discount);
        document.getElementById("cart-voucher-code").innerText =
          data.voucherCode;
      } else {
        discountRow.style.display = "none";
      }
    }

    if (voucherMsg) {
      voucherMsg.innerHTML = "";
      if (data.voucherError)
        voucherMsg.innerHTML = `<p style="color:red; font-size:0.9em; margin-top:5px;">${data.voucherError}</p>`;
      if (data.voucherCode && !data.voucherError)
        voucherMsg.innerHTML = `<p style="color:green; font-size:0.9em; margin-top:5px;">Đang dùng mã: <strong>${data.voucherCode}</strong></p>`;
    }

    // Cập nhật số lượng dòng sản phẩm
    const pageCount = document.getElementById("cart-page-count");
    if (pageCount)
      pageCount.innerText = document.querySelectorAll(".cart-item-row").length;

    if (data.cartCount === 0) location.reload();
  }

  // ============================================================
  // 4. LOGIC THANH TOÁN (CHECKOUT)
  // ============================================================
  const shippingRadios = document.querySelectorAll(
    'input[name="shipping_method"]'
  );
  if (shippingRadios.length > 0) {
    shippingRadios.forEach((radio) => {
      radio.addEventListener("change", function () {
        const feeEl = document.getElementById("checkout-shipping-fee");
        const totalEl = document.getElementById("checkout-total");

        // Lấy số tiền từ chuỗi (bỏ chữ 'VNĐ' và dấu phẩy)
        const subtotal = parseInt(
          document
            .getElementById("checkout-subtotal")
            .innerText.replace(/\D/g, "")
        );
        const discountEl = document.getElementById("checkout-discount");
        const discount = discountEl
          ? parseInt(discountEl.innerText.replace(/\D/g, ""))
          : 0;

        let fee = 0;
        if (this.value === "fast") {
          fee = 30000;
          feeEl.innerText = "30.000 ₫";
          feeEl.style.color = "#333";
        } else {
          fee = 0;
          feeEl.innerText = "Miễn phí";
          feeEl.style.color = "green";
        }

        const total = subtotal - discount + fee;
        totalEl.innerText = fmtMoney(total);
      });
    });
  }

  // ============================================================
  // 5. MENU MOBILE (TOGGLE)
  // ============================================================
  const mobileMenuBtn = document.getElementById("mobile-menu-btn");
  const mobileMenu = document.getElementById("mobile-menu-container");
  const mobileOverlay = document.getElementById("mobile-menu-overlay");
  const closeMenuBtn = document.getElementById("close-mobile-menu");

  function toggleMenu() {
    if (mobileMenu) mobileMenu.classList.toggle("active");
    if (mobileOverlay) mobileOverlay.classList.toggle("active");
  }

  if (mobileMenuBtn)
    mobileMenuBtn.addEventListener("click", (e) => {
      e.preventDefault();
      toggleMenu();
    });
  if (closeMenuBtn) closeMenuBtn.addEventListener("click", toggleMenu);
  if (mobileOverlay) mobileOverlay.addEventListener("click", toggleMenu);
});
