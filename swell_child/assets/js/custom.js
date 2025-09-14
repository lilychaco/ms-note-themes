console.log("custom.js読み込まれてるよ");

// PDFリンクと外部リンクの遷移問題を修正
document.addEventListener('DOMContentLoaded', function() {
    //外部リンク（PDFリンク、Googleフォームなど）を強制的に新しいタブで開く
    const externalLinks = document.querySelectorAll('a[href*=".pdf"], a[href*="docs.google.com"], a[href*="ms-note.com"]');

    externalLinks.forEach(function(link) {
        link.setAttribute('target', '_blank');
        link.setAttribute('rel', 'noopener noreferrer');

        //クリックイベントを完全にオーバーライド
        link.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();

            //強制的にリンクを開く
            if (this.href) {
                window.open(this.href, '_blank', 'noopener,noreferrer');
            }
            return false;
        }, true); // キャプチャフェーズで実行

        //念のためマウスダウンイベントも制御
        link.addEventListener('mousedown', function(e) {
            e.stopPropagation();
        }, true);
    });

    //吹奏楽ページ特有の問題に対応
    if (document.body.classList.contains('single-lesson') || document.querySelector('body').className.includes('postid-108')) {
        //すべての外部リンクを再チェック（講師カードリンクは除外）
        setTimeout(function() {
            const allLinks = document.querySelectorAll('a[href^="http"]:not(.p-postList__item-link)');
            allLinks.forEach(function(link) {
                //現在のドメイン以外のリンク
                if (!link.href.includes(window.location.hostname)) {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        window.open(this.href, '_blank', 'noopener,noreferrer');
                        return false;
                    }, true);
                }
            });
        }, 1000);
    }

    //教室名リンク無効化機能は削除

});

// ==========================
// 講師名の括弧前改行処理（即座実行）
// ==========================
function formatInstructorNames() {
  console.log("講師名改行処理開始");

  // より確実なセレクタで講師タイトルを取得
  const instructorTitles = document.querySelectorAll(".p-postList__title");
  console.log("講師タイトル要素数:", instructorTitles.length);

  instructorTitles.forEach(function (title, index) {
    let titleText = title.textContent || title.innerText;
    console.log(`タイトル${index}:`, titleText);

    // 括弧の前で改行を挿入
    if (titleText.includes("（")) {
      const formattedText = titleText.replace(/（/, "\n（");
      title.textContent = formattedText;
      console.log(`変更後${index}:`, formattedText);
    }
  });
}

// DOM読み込み完了後とページ読み込み完了後の両方で実行
document.addEventListener("DOMContentLoaded", formatInstructorNames);
setTimeout(formatInstructorNames, 1000); // 1秒後にも実行

// ==========================
// Swiperの設定
// ==========================
if (typeof Swiper !== "undefined") {
  new Swiper(".lesson-swiper", {
    slidesPerView: 4,
    spaceBetween: 20,
    loop: true,
    speed: 7000,
    autoplay: {
      delay: 0,
      disableOnInteraction: false,
    },
    navigation: {
      nextEl: ".lesson-swiper .swiper-button-next",
      prevEl: ".lesson-swiper .swiper-button-prev",
    },
    pagination: {
      el: ".lesson-swiper .swiper-pagination",
      clickable: true,
    },
  });
}

// ==========================
// モーダルの設定
// ==========================
window.onload = function () {
  const openButtons = document.querySelectorAll(".open-modal");

  openButtons.forEach(function (btn) {
    const targetId = btn.getAttribute("data-target");
    const modal = document.getElementById(targetId);

    // クローズボタン
    const closeBtn = modal
      ? modal.querySelector(".modal-access__close, .close")
      : null;

    // 開く
    btn.addEventListener("click", function (e) {
      e.preventDefault();
      modal.style.display = "block";
    });

    // 閉じる（×ボタン）
    if (closeBtn) {
      closeBtn.addEventListener("click", function () {
        modal.style.display = "none";
      });
    }

    // モーダル外クリックで閉じる
    window.addEventListener("click", function (event) {
      if (event.target === modal) {
        modal.style.display = "none";
      }
    });
  });
};
