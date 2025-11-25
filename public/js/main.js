// File: public/js/main.js

document.addEventListener("DOMContentLoaded", function () {
  // ============================================================
  // 1. CÁC HÀM HELPER (Hỗ trợ)
  // ============================================================

  // Hàm hiển thị thông báo Toast
  window.showToast = function (message, isError = false) {
    // Xóa toast cũ nếu có
    const oldToast = document.querySelector(".ajax-toast");
    if (oldToast) oldToast.remove();

    const toast = document.createElement("div");
    toast.className = "ajax-toast" + (isError ? " error" : "");
    toast.textContent = message;
    document.body.appendChild(toast);

    // Animation
    requestAnimationFrame(() => {
      toast.style.opacity = 1;
      toast.style.transform = "translateY(0)";
    });

    setTimeout(() => {
      toast.style.opacity = 0;
      toast.style.transform = "translateY(20px)";
      setTimeout(() => toast.remove(), 300);
    }, 3000);
  };

  // Format tiền tệ
  const fmtMoney = (amount) =>
    new Intl.NumberFormat("vi-VN").format(amount) + " ₫";

  // Cập nhật giao diện Giỏ hàng (Badge, Tổng tiền...)
  function updateCartUI(data) {
    // 1. Cập nhật Badge trên Header
    const badge = document.getElementById("cart-count-badge");
    if (badge) badge.innerText = data.cartCount;

    // 2. Cập nhật các số liệu trong trang Giỏ hàng (nếu đang đứng ở đó)
    const subTotal = document.getElementById("cart-subtotal");
    if (subTotal) subTotal.innerText = fmtMoney(data.subtotal);

    const grandTotal = document.getElementById("cart-grand-total");
    if (grandTotal) grandTotal.innerText = fmtMoney(data.grandTotal);

    // Cập nhật dòng giảm giá
    const discountRow = document.getElementById("cart-discount-row");
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

    // Cập nhật số lượng dòng sản phẩm hiển thị
    const pageCount = document.getElementById("cart-page-count");
    if (pageCount)
      pageCount.innerText = document.querySelectorAll(".cart-item-row").length;

    // Nếu giỏ hàng trống thì reload để hiện giao diện trống
    if (document.querySelector(".cart-page-layout") && data.cartCount === 0) {
      location.reload();
    }
  }

  // ============================================================
  // 2. XỬ LÝ MUA HÀNG (QUAN TRỌNG NHẤT)
  // Dùng Event Delegation để bắt mọi nút submit form có class .add-to-cart-form
  // ============================================================

  document.body.addEventListener("submit", function (e) {
    // Kiểm tra xem phần tử được submit có phải là form mua hàng không
    if (e.target && e.target.classList.contains("add-to-cart-form")) {
      e.preventDefault(); // <--- CHẶN TRANG ĐEN NGAY LẬP TỨC

      const form = e.target;

      // Kiểm tra tính hợp lệ (cho trang chi tiết sản phẩm)
      if (form.getAttribute("data-valid") === "false") {
        showToast("Vui lòng chọn phiên bản sản phẩm!", true);
        return;
      }

      // Xác định nút nào được nhấn (Mua ngay hay Thêm giỏ)
      // e.submitter là nút kích hoạt sự kiện submit (Browser hiện đại)
      let isBuyNow = false;
      if (
        e.submitter &&
        (e.submitter.name === "buy_now" || e.submitter.value === "1")
      ) {
        isBuyNow = true;
      }

      const formData = new FormData(form);
      const actionUrl = form.action;

      // Gửi Ajax
      fetch(actionUrl, {
        method: "POST",
        body: formData,
        headers: { Accept: "application/json" },
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.success) {
            // Cập nhật số lượng trên icon
            const badge = document.getElementById("cart-count-badge");
            if (badge) badge.innerText = data.cartCount;

            if (isBuyNow) {
              window.location.href = URLROOT + "/checkout";
            } else {
              showToast(data.message); // Hiện thông báo xanh
            }
          } else {
            showToast(data.message, true); // Hiện lỗi đỏ
          }
        })
        .catch((err) => {
          console.error(err);
          showToast("Lỗi kết nối server!", true);
        });
    }

    // Xử lý Form Voucher
    if (e.target && e.target.id === "voucher-form") {
      e.preventDefault();
      const form = e.target;
      const formData = new FormData(form);

      fetch(form.action, {
        method: "POST",
        body: formData,
        headers: { Accept: "application/json" },
      })
        .then((res) => res.json())
        .then((data) => {
          updateCartUI(data);

          const voucherMsg = document.getElementById(
            "voucher-message-container"
          );
          if (voucherMsg) {
            voucherMsg.innerHTML = "";
            if (data.success) {
              showToast(data.message);
              if (!data.voucherError)
                voucherMsg.innerHTML = `<p style="color:green; font-size:0.9em; margin-top:5px;">Đang dùng mã: <strong>${data.voucherCode}</strong></p>`;
            } else {
              showToast(data.voucherError || data.message, true);
              voucherMsg.innerHTML = `<p style="color:red; font-size:0.9em; margin-top:5px;">${data.voucherError}</p>`;
            }
          }
        });
    }
  });

  // ============================================================
  // 3. LOGIC TRANG CHI TIẾT (Product Detail - Chọn màu/Dung lượng)
  // ============================================================

  const variantsElement = document.getElementById("variants-json");
  if (variantsElement) {
    const variants = JSON.parse(variantsElement.textContent);

    // DOM Elements
    const colorItems = document.querySelectorAll(".color-item");
    const storageItems = document.querySelectorAll(".storage-item");
    const priceEl = document.getElementById("display-price");
    const oldPriceEl = document.getElementById("display-old-price");
    const badgeEl = document.getElementById("display-badge");
    const textColorEl = document.getElementById("text-color");
    const mainForm = document.getElementById("add-cart-form");
    const errorMsg = document.getElementById("error-msg");
    const btns = document.querySelectorAll(".btn-cart, .btn-buy");
    const mainTrack = document.getElementById("main-track");
    const thumbItems = document.querySelectorAll(".thumb-item");
    const mainImgStatic = document.getElementById("main-img");

    // Hàm cập nhật UI khi chọn biến thể
    function updateVariantUI() {
      const selectedColorBtn = document.querySelector(".color-item.active");
      const selectedStorageBtn = document.querySelector(".storage-item.active");

      // Nếu trang không có nút chọn (sản phẩm đơn), bỏ qua check
      if (!selectedColorBtn && !selectedStorageBtn && variants.length > 0) {
        // Trường hợp sản phẩm chỉ có 1 biến thể duy nhất -> Tự chọn luôn
        const v = variants[0];
        if (mainForm) {
          mainForm.action = URLROOT + "/cart/add/" + v.id;
          mainForm.setAttribute("data-valid", "true");
        }
        return;
      }

      if (!selectedColorBtn || !selectedStorageBtn) return;

      const color = selectedColorBtn.getAttribute("data-val");
      const storage = selectedStorageBtn.getAttribute("data-val");

      if (textColorEl) textColorEl.innerText = color;

      const variant = variants.find(
        (v) => v.color === color && v.storage === storage
      );

      // Update trạng thái các nút dung lượng
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

      if (variant && variant.stock_quantity > 0) {
        // -- CÓ HÀNG --
        if (errorMsg) errorMsg.style.display = "none";
        if (mainForm) {
          mainForm.action = URLROOT + "/cart/add/" + variant.id;
          mainForm.setAttribute("data-valid", "true");
        }

        // Đổi ảnh slider theo màu
        if (variant.color && typeof slideToColor === "function")
          slideToColor(variant.color);
        // Đổi ảnh tĩnh nếu ko dùng slider
        if (mainImgStatic && variant.image)
          mainImgStatic.src = URLROOT + "/uploads/" + variant.image;

        // Giá
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

        btns.forEach((b) => {
          b.disabled = false;
          b.style.opacity = 1;
          b.style.cursor = "pointer";
        });
      } else {
        // -- HẾT HÀNG --
        if (priceEl) priceEl.innerText = "Liên hệ";
        if (oldPriceEl) oldPriceEl.style.display = "none";
        if (badgeEl) badgeEl.style.display = "none";
        if (errorMsg) {
          errorMsg.style.display = "block";
          errorMsg.innerText = "Phiên bản này đang tạm hết hàng.";
        }
        if (mainForm) mainForm.setAttribute("data-valid", "false");
        btns.forEach((b) => {
          b.disabled = true;
          b.style.opacity = 0.5;
          b.style.cursor = "not-allowed";
        });
      }
    }

    // Event Listeners
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

    // --- LOGIC SLIDER ẢNH ---
    let currentSlideIndex = 0;
    let galleryInterval;
    const slides = document.querySelectorAll(".slider-single-img");

    window.goToSlide = function (index) {
      if (!mainTrack || index < 0 || index >= slides.length) return;
      currentSlideIndex = index;
      mainTrack.style.transform = `translateX(-${index * 100}%)`;
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
    window.slideToColor = function (colorName) {
      for (let i = 0; i < slides.length; i++) {
        if (slides[i].getAttribute("data-color") === colorName) {
          goToSlide(i);
          break;
        }
      }
    };

    const gPrev = document.getElementById("gallery-prev");
    const gNext = document.getElementById("gallery-next");
    if (gPrev && gNext) {
      gPrev.addEventListener("click", prevSlide);
      gNext.addEventListener("click", nextSlide);
      resetGalleryTimer();
    }

    // Tab chuyển đổi
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

    window.updateQty = function (change) {
      const input = document.getElementById("qty");
      if (input) {
        let val = parseInt(input.value) + change;
        if (val < 1) val = 1;
        input.value = val;
      }
    };

    updateVariantUI();
  }

  // ============================================================
  // 4. LOGIC TRANG GIỎ HÀNG (Xóa / Cập nhật số lượng)
  // ============================================================

  document.body.addEventListener("click", function (e) {
    // Nút +/- số lượng
    if (e.target.classList.contains("cart-qty-change")) {
      const btn = e.target;
      const row = btn.closest(".cart-item-row");
      const variantId = row.dataset.variantId;
      const input = row.querySelector(`input[name="quantity[${variantId}]"]`);

      let newQty = parseInt(input.value);
      if (btn.classList.contains("qty-plus")) newQty++;
      if (btn.classList.contains("qty-minus")) newQty--;
      if (newQty < 1) newQty = 0;

      input.value = newQty;

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
    }

    // Nút Xóa (Thùng rác)
    // Tìm thẻ a có class remove-from-cart-ajax hoặc thẻ i bên trong nó
    const deleteLink = e.target.closest(".remove-from-cart-ajax");
    if (deleteLink) {
      e.preventDefault();
      if (!confirm("Xóa sản phẩm này?")) return;
      const row = deleteLink.closest(".cart-item-row");

      fetch(deleteLink.href, { headers: { Accept: "application/json" } })
        .then((res) => res.json())
        .then((data) => {
          if (data.success) {
            row.remove();
            updateCartUI(data);
            showToast(data.message);
          }
        });
    }
  });

  // ============================================================
  // 5. LOGIC KHÁC (SLIDER RELATED, MENU, THANH TOÁN)
  // ============================================================

  const relTrack = document.getElementById("related-track");
  const relPrev = document.getElementById("rel-prev");
  const relNext = document.getElementById("rel-next");
  if (relTrack && relPrev && relNext) {
    let scrollAmount = 0;
    const cardWidth = 260;
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

    let relAuto = setInterval(() => relNext.click(), 4000);
    relTrack.parentElement.addEventListener("mouseenter", () =>
      clearInterval(relAuto)
    );
    relTrack.parentElement.addEventListener(
      "mouseleave",
      () => (relAuto = setInterval(() => relNext.click(), 4000))
    );
  }

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

  const shippingRadios = document.querySelectorAll(
    'input[name="shipping_method"]'
  );
  if (shippingRadios.length > 0) {
    shippingRadios.forEach((radio) => {
      radio.addEventListener("change", function () {
        const feeEl = document.getElementById("checkout-shipping-fee");
        const totalEl = document.getElementById("checkout-total");
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
        totalEl.innerText = fmtMoney(subtotal - discount + fee);
      });
    });
  }
});
