console.log('custom.js読み込まれてるよ');

// // ==========================
// Swiperの設定
// ==========================
if (typeof Swiper !== 'undefined') {
    new Swiper('.lesson-swiper', {
        slidesPerView: 4,
        spaceBetween: 20,
        loop: true,
        speed: 7000,
        autoplay: {
            delay: 0,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.lesson-swiper .swiper-button-next',
            prevEl: '.lesson-swiper .swiper-button-prev',
        },
        pagination: {
            el: '.lesson-swiper .swiper-pagination',
            clickable: true,
        },
    });
}

// ==========================
// モーダルの設定
// ==========================
window.onload = function () {
    const openButtons = document.querySelectorAll('.open-modal');

    openButtons.forEach(function (btn) {
        const targetId = btn.getAttribute('data-target');
        const modal = document.getElementById(targetId);

        // クローズボタン
        const closeBtn = modal.querySelector('.close');

        // 開く
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            modal.style.display = 'block';
        });

        // 閉じる（×ボタン）
        closeBtn.addEventListener('click', function () {
            modal.style.display = 'none';
        });

        // モーダル外クリックで閉じる
        window.addEventListener('click', function (event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    });
};
