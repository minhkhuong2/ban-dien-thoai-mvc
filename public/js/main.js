// File: public/js/main.js

// --- 1. CÁC HÀM HELPER (Dùng chung) ---

// Hàm hiển thị thông báo (Toast)
function showToast(message, isError = false) {
  const toast = document.createElement("div");
  toast.className = "ajax-toast" + (isError ? " error" : "");
  toast.textContent = message;
  document.body.appendChild(toast);

  // Tự động xóa sau 3 giây
  setTimeout(() => {
    toast.remove();
  }, 3000);
}

// Hàm cập nhật giao diện Trang Chi tiết Sản phẩm (Biến thể)
function initializeProductDetail() {
  // Lấy dữ liệu variants từ thẻ script (json)
  const variantsDataElement = document.getElementById("variants-data");
  if (!variantsDataElement) return; // Thoát nếu không phải trang chi tiết

  const variants = JSON.parse(variantsDataElement.textContent);

  // Lấy các phần tử DOM cần cập nhật
  const mainImage = document.getElementById("main-product-image");
  const priceSaleEl = document.getElementById("dynamic-price-sale");
  const priceOriginalEl = document.getElementById("dynamic-price-original");
  const discountBadgeEl = document.getElementById("dynamic-discount-badge");
  const mainCartForm = document.getElementById("main-cart-form");
  const selectedStorageEl = document.getElementById("selected-storage");
  const selectedColorEl = document.getElementById("selected-color");
  const thumbnailContainer = document.querySelector(".thumbnail-images");

  const storageOptions = document.querySelectorAll(".storage-option");
  const colorOptions = document.querySelectorAll(".color-option");

  // Hàm cập nhật hiển thị dựa trên lựa chọn
  function updateVariantDisplay() {
    const selectedStorage = document.querySelector(".storage-option.active")
      .dataset.value;
    const selectedColor = document.querySelector(".color-option.active").dataset
      .value;

    // Tìm biến thể phù hợp trong mảng dữ liệu
    const foundVariant = variants.find(
      (v) => v.storage === selectedStorage && v.color === selectedColor
    );

    if (foundVariant) {
      // TÌM THẤY -> Cập nhật giao diện
      selectedStorageEl.textContent = foundVariant.storage;
      selectedColorEl.textContent = foundVariant.color;

      // Cập nhật ảnh chính
      mainImage.src = URLROOT + "/uploads/" + foundVariant.image;

      // Cập nhật giá và tag giảm giá
      if (foundVariant.price_sale && foundVariant.price_sale > 0) {
        priceSaleEl.textContent =
          new Intl.NumberFormat("vi-VN").format(foundVariant.price_sale) +
          " VNĐ";
        priceOriginalEl.textContent =
          new Intl.NumberFormat("vi-VN").format(foundVariant.price) + " VNĐ";
        priceOriginalEl.style.display = "inline";

        const percent = Math.round(
          ((foundVariant.price - foundVariant.price_sale) /
            foundVariant.price) *
            100
        );
        discountBadgeEl.textContent = "-" + percent + "%";
        discountBadgeEl.style.display = "block";
      } else {
        priceSaleEl.textContent =
          new Intl.NumberFormat("vi-VN").format(foundVariant.price) + " VNĐ";
        priceOriginalEl.style.display = "none";
        discountBadgeEl.style.display = "none";
      }

      // Cập nhật action của form để thêm đúng ID biến thể vào giỏ
      mainCartForm.action = URLROOT + "/cart/add/" + foundVariant.id;
    } else {
      // KHÔNG TÌM THẤY
      priceSaleEl.textContent = "Không có phiên bản này";
      priceOriginalEl.style.display = "none";
      discountBadgeEl.style.display = "none";
      mainCartForm.action = "#"; // Vô hiệu hóa form
    }
  }

  // Hàm cập nhật ảnh thumbnail (Lọc theo màu đang chọn)
  function updateThumbnails() {
    if (!thumbnailContainer) return;
    const selectedColor = document.querySelector(".color-option.active").dataset
      .value;
    const colorVariants = variants.filter((v) => v.color === selectedColor);

    thumbnailContainer.innerHTML = ""; // Xóa cũ

    // Lọc ảnh duy nhất
    const uniqueImages = [
      ...new Map(colorVariants.map((item) => [item["image"], item])).values(),
    ];

    uniqueImages.forEach((variant, index) => {
      const img = document.createElement("img");
      img.src = URLROOT + "/uploads/" + variant.image;
      if (index === 0) img.classList.add("active"); // Ảnh đầu tiên active

      // Thêm sự kiện click vào thumbnail để đổi ảnh chính
      img.addEventListener("click", function () {
        document
          .querySelectorAll(".thumbnail-images img")
          .forEach((i) => i.classList.remove("active"));
        this.classList.add("active");
        mainImage.src = this.src;
      });

      thumbnailContainer.appendChild(img);
    });
  }

  // Gán sự kiện click cho nút Dung lượng
  storageOptions.forEach((btn) => {
    btn.addEventListener("click", function () {
      storageOptions.forEach((b) => b.classList.remove("active"));
      this.classList.add("active");
      updateVariantDisplay();
    });
  });

  // Gán sự kiện click cho nút Màu sắc
  colorOptions.forEach((btn) => {
    btn.addEventListener("click", function () {
      colorOptions.forEach((b) => b.classList.remove("active"));
      this.classList.add("active");
      updateVariantDisplay();
      updateThumbnails(); // Cập nhật thumbnail theo màu
    });
  });

  // Chạy lần đầu khi tải trang
  updateVariantDisplay();
  updateThumbnails();
}

// --- 2. SỰ KIỆN DOM CONTENT LOADED (Chính) ---
document.addEventListener("DOMContentLoaded", function () {
  // A. XỬ LÝ SỐ LƯỢNG TRÊN TRANG CHI TIẾT (Chỉ chạy trong .product-info)
  const detailQuantitySelectors = document.querySelectorAll(
    ".product-info .quantity-selector"
  );
  detailQuantitySelectors.forEach((selector) => {
    const input = selector.querySelector('input[name="quantity"]');
    const btnMinus = selector.querySelector(".qty-minus");
    const btnPlus = selector.querySelector(".qty-plus");

    if (!input || !btnMinus || !btnPlus) return;

    btnPlus.addEventListener("click", function () {
      let currentValue = parseInt(input.value);
      if (isNaN(currentValue)) currentValue = 1;
      input.value = currentValue + 1;
    });

    btnMinus.addEventListener("click", function () {
      let currentValue = parseInt(input.value);
      if (!isNaN(currentValue) && currentValue > 1) {
        input.value = currentValue - 1;
      }
    });
  });

  // B. XỬ LÝ AJAX THÊM VÀO GIỎ (VÀ MUA NGAY)
  const allAddToCartForms = document.querySelectorAll(".add-to-cart-form");
  allAddToCartForms.forEach((form) => {
    form.addEventListener("submit", function (event) {
      event.preventDefault();

      // Kiểm tra xem người dùng nhấn nút nào?
      const isBuyNow =
        event.submitter && event.submitter.classList.contains("btn-buy-now");

      const formData = new FormData(this);
      const actionUrl = this.getAttribute("action");

      if (actionUrl === "#") {
        showToast("Vui lòng chọn phiên bản hợp lệ.", true);
        return;
      }

      fetch(actionUrl, {
        method: "POST",
        body: formData,
        headers: { Accept: "application/json" },
      })
        .then((response) => {
          if (!response.ok)
            return response.json().then((err) => {
              throw new Error(err.message);
            });
          return response.json();
        })
        .then((data) => {
          if (data.success) {
            // Cập nhật badge giỏ hàng
            const cartBadge = document.getElementById("cart-count-badge");
            if (cartBadge) cartBadge.textContent = data.cartCount;

            if (isBuyNow) {
              // NẾU MUA NGAY -> Chuyển sang trang thanh toán
              window.location.href = URLROOT + "/checkout";
            } else {
              // NẾU THÊM GIỎ -> Hiện thông báo
              showToast(data.message);
            }
          }
        })
        .catch((error) => {
          showToast(error.message || "Đã xảy ra lỗi. Vui lòng thử lại.", true);
        });
    });
  });

  // C. XỬ LÝ CHUYỂN TAB (Trang chi tiết)
  const tabHeaders = document.querySelectorAll(".tab-header");
  const tabContents = document.querySelectorAll(".tab-content");
  tabHeaders.forEach((header) => {
    header.addEventListener("click", function () {
      const tabId = this.getAttribute("data-tab");
      tabHeaders.forEach((h) => h.classList.remove("active"));
      this.classList.add("active");
      tabContents.forEach((content) => {
        content.classList.remove("active");
        if (content.id === tabId) content.classList.add("active");
      });
    });
  });

  // D. KHỞI TẠO LOGIC BIẾN THỂ (Nếu đang ở trang chi tiết)
  initializeProductDetail();

  // --- E. XỬ LÝ AJAX CHO TRANG GIỎ HÀNG (CẬP NHẬT & XÓA) ---

  // Hàm helper cập nhật UI giỏ hàng
  function updateCartUI(data) {
    // Header badge
    const cartBadge = document.getElementById("cart-count-badge");
    if (cartBadge) cartBadge.textContent = data.cartCount;

    // Tóm tắt đơn hàng
    const subTotalEl = document.getElementById("cart-subtotal");
    if (subTotalEl)
      subTotalEl.textContent =
        new Intl.NumberFormat("vi-VN").format(data.subtotal) + " VNĐ";

    const grandTotalEl = document.getElementById("cart-grand-total");
    if (grandTotalEl)
      grandTotalEl.textContent =
        new Intl.NumberFormat("vi-VN").format(data.grandTotal) + " VNĐ";

    // Voucher
    const discountRow = document.getElementById("cart-discount-row");
    if (discountRow) {
      if (data.discount > 0) {
        document.getElementById("cart-voucher-code").textContent =
          data.voucherCode;
        document.getElementById("cart-discount").textContent =
          "- " + new Intl.NumberFormat("vi-VN").format(data.discount) + " VNĐ";
        discountRow.style.display = "flex";
      } else {
        discountRow.style.display = "none";
      }
    }

    // Thông báo voucher
    const voucherMsgContainer = document.getElementById(
      "voucher-message-container"
    );
    if (voucherMsgContainer) {
      voucherMsgContainer.innerHTML = "";
      if (data.voucherError) {
        voucherMsgContainer.innerHTML = `<p style="color: red; font-size: 0.9em;">${data.voucherError}</p>`;
      } else if (data.voucherCode) {
        voucherMsgContainer.innerHTML = `<p style="color: green; font-size: 0.9em;">✓ Áp dụng mã <strong>${data.voucherCode}</strong> thành công!</p>`;
      }
    }
  }

  // 1. Xử lý nút +/- trong Giỏ hàng (.cart-item-info)
  document
    .querySelectorAll(".cart-item-info .cart-qty-change")
    .forEach((button) => {
      button.addEventListener("click", function () {
        const row = this.closest(".cart-item-row");
        if (!row) return;

        const variantId = row.dataset.variantId;
        // Tìm input chính xác bằng name="quantity[id]"
        const input = row.querySelector(`input[name="quantity[${variantId}]"]`);
        const btnMinus = row.querySelector(".qty-minus");
        const btnPlus = row.querySelector(".qty-plus");

        // Logic cập nhật
        function updateCartQuantity(newQuantity) {
          input.value = newQuantity;
          const formData = new FormData();
          formData.append(`quantity[${variantId}]`, newQuantity);

          fetch(URLROOT + "/cart/update", {
            method: "POST",
            body: formData,
            headers: { Accept: "application/json" },
          })
            .then((response) => response.json())
            .then((data) => {
              if (data.success) {
                updateCartUI(data);

                // Cập nhật giá riêng của item này
                if (
                  data.itemTotals &&
                  data.itemTotals[variantId] !== undefined
                ) {
                  const itemTotalEl = document.getElementById(
                    `item-total-${variantId}`
                  );
                  if (data.itemTotals[variantId] === 0) {
                    row.remove(); // Xóa hàng nếu SL = 0

                    // *** THÊM: Cập nhật lại số lượng "Sản phẩm đã chọn (X)" ***
                    const pageCountEl =
                      document.getElementById("cart-page-count");
                    if (pageCountEl) {
                      pageCountEl.textContent =
                        document.querySelectorAll(".cart-item-row").length;
                    }

                    if (data.cartCount === 0) location.reload(); // Reload nếu giỏ trống
                  } else {
                    if (itemTotalEl)
                      itemTotalEl.textContent =
                        new Intl.NumberFormat("vi-VN").format(
                          data.itemTotals[variantId]
                        ) + " VNĐ";
                  }
                }
              } else {
                showToast(data.message, true);
                location.reload(); // Reset nếu lỗi
              }
            })
            .catch(() => location.reload());
        }

        // Nút +
        if (this.classList.contains("qty-plus")) {
          let quantity = parseInt(input.value) + 1;
          updateCartQuantity(quantity);
        }
        // Nút -
        if (this.classList.contains("qty-minus")) {
          let quantity = parseInt(input.value) - 1;
          if (quantity < 0) quantity = 0;
          updateCartQuantity(quantity);
        }
      });
    });

  // 2. Xử lý nút Xóa (Link)
  document.querySelectorAll(".remove-from-cart-ajax").forEach((link) => {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      if (!confirm("Bạn có chắc muốn xóa sản phẩm này?")) return;

      const row = this.closest(".cart-item-row");

      fetch(this.href, {
        method: "GET",
        headers: { Accept: "application/json" },
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            row.remove();

            // *** THÊM: Cập nhật lại số lượng "Sản phẩm đã chọn (X)" ***
            const pageCountEl = document.getElementById("cart-page-count");
            if (pageCountEl) {
              pageCountEl.textContent =
                document.querySelectorAll(".cart-item-row").length;
            }

            updateCartUI(data);
            showToast(data.message);
            if (data.cartCount === 0) location.reload();
          } else {
            showToast(data.message, true);
          }
        });
    });
  });

  // 3. Xử lý Voucher
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
        .then((response) => response.json())
        .then((data) => {
          updateCartUI(data);
          if (data.success) showToast(data.message);
          else showToast(data.voucherError, true); // Hiện lỗi voucher nếu có
        });
    });
  }
  // --- 6. XỬ LÝ CẬP NHẬT PHÍ VẬN CHUYỂN & TỔNG TIỀN (Code Chuẩn) ---
  const shippingRadios = document.querySelectorAll(
    'input[name="shipping_method"]'
  );
  const elSubtotal = document.getElementById("checkout-subtotal");
  const elDiscount = document.getElementById("checkout-discount");
  const elShippingFee = document.getElementById("checkout-shipping-fee");
  const elTotal = document.getElementById("checkout-total");

  if (shippingRadios.length > 0 && elTotal) {
    // Hàm chuyển đổi chuỗi tiền (vd: "38.000.000 VNĐ") thành số (38000000)
    function parseCurrency(str) {
      if (!str) return 0;
      // Xóa tất cả ký tự không phải số
      return parseInt(str.replace(/\D/g, "")) || 0;
    }

    // Hàm tính toán lại tổng tiền
    function recalculateCheckoutTotal() {
      // 1. Lấy Tạm tính
      const subtotal = parseCurrency(elSubtotal.textContent);

      // 2. Lấy Giảm giá (nếu có)
      const discount = parseCurrency(elDiscount ? elDiscount.textContent : "0");

      // 3. Lấy Phí ship dựa trên radio đang chọn
      let shippingFee = 0;
      const selectedShipping = document.querySelector(
        'input[name="shipping_method"]:checked'
      );

      if (selectedShipping && selectedShipping.value === "fast") {
        shippingFee = 30000;
        // Cập nhật hiển thị text phí ship
        elShippingFee.textContent = "30.000 VNĐ";
        elShippingFee.style.color = "#333";
      } else {
        shippingFee = 0;
        elShippingFee.textContent = "Miễn phí";
        elShippingFee.style.color = "green";
      }

      // 4. Tính Tổng cộng
      const total = subtotal - discount + shippingFee;

      // 5. Cập nhật hiển thị Tổng cộng
      elTotal.textContent =
        new Intl.NumberFormat("vi-VN").format(total) + " VNĐ";
    }

    // Gán sự kiện khi chọn radio
    shippingRadios.forEach((radio) => {
      radio.addEventListener("change", recalculateCheckoutTotal);
    });

    // Chạy 1 lần lúc mới vào trang để đảm bảo đúng
    recalculateCheckoutTotal();
  }
  // --- 7. XỬ LÝ MENU MOBILE (MỚI) ---
  const mobileMenuBtn = document.getElementById("mobile-menu-btn");
  const mobileMenu = document.getElementById("mobile-menu-container");
  const mobileOverlay = document.getElementById("mobile-menu-overlay");
  const closeMenuBtn = document.getElementById("close-mobile-menu");

  function toggleMobileMenu() {
    if (mobileMenu && mobileOverlay) {
      mobileMenu.classList.toggle("active");
      mobileOverlay.classList.toggle("active");
    }
  }

  // Sự kiện mở menu
  if (mobileMenuBtn) {
    mobileMenuBtn.addEventListener("click", function (e) {
      e.preventDefault();
      toggleMobileMenu();
    });
  }

  // Sự kiện đóng menu (nút X)
  if (closeMenuBtn) {
    closeMenuBtn.addEventListener("click", toggleMobileMenu);
  }

  // Sự kiện đóng khi bấm ra ngoài (overlay)
  if (mobileOverlay) {
    mobileOverlay.addEventListener("click", toggleMobileMenu);
  }
}); // END DOMContentLoaded
