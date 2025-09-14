<?php
/* 子テーマのfunctions.phpは、親テーマのfunctions.phpより先に読み込まれることに注意してください。 */


/**
 * 親テーマのfunctions.phpのあとで読み込みたいコードはこの中に。
 */
// add_filter('after_setup_theme', function(){
// }, 11);


/**
 * 子テーマでのファイルの読み込み
 */
add_action('wp_enqueue_scripts', function() {

    $timestamp=date('Ymdgis', filemtime(get_stylesheet_directory() . '/style.css'));
    wp_enqueue_style('child_style', get_stylesheet_directory_uri() .'/style.css', [], $timestamp);

    /* その他の読み込みファイルはこの下に記述 */

    // トップページレッスンカード用CSS
    wp_enqueue_style('top-lesson-card-style',
      get_stylesheet_directory_uri() . '/assets/css/top-lesson-card.css',
      [],
      '1.0'
    );

  }

  , 11);

// 子テーマのcustom.jsを読み込む
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_script('my-custom-js',
      get_stylesheet_directory_uri() . '/assets/js/custom.js',
      [],
      '1.0',
      true);
  }

  , 20);

// フォーム用CSSの読み込み
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('form-lesson-suita-style',
      get_stylesheet_directory_uri() . '/assets/css/form-lesson-suita-style.css',
      [],
      '1.0'
    );
  }

  , 20);

// ヘッダー電話番号表示専用CSSの読み込み
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('header-tel-style',
      get_stylesheet_directory_uri() . '/assets/css/header-tel.css',
      [],
      '1.0'
    );
  }

  , 20);

// インストラクター紹介セクション用CSSの読み込み
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('instructor-description-style',
      get_stylesheet_directory_uri() . '/assets/css/instructor-description.css',
      [],
      '1.0'
    );
  }

  , 20);

// 新規追加CSS群の読み込み
add_action('wp_enqueue_scripts', function() {
    // 講師関連スタイル（更新時刻をバージョンにしてキャッシュ回避）
    wp_enqueue_style('instructor-styles',
      get_stylesheet_directory_uri() . '/assets/css/instructor-styles.css',
      [],
      date('Ymdgis', filemtime(get_stylesheet_directory() . '/assets/css/instructor-styles.css'))
    );

    // モーダル関連スタイル
    wp_enqueue_style('modal-styles',
      get_stylesheet_directory_uri() . '/assets/css/modal-styles.css',
      [],
      '1.0'
    );

    // コンタクトフォーム関連スタイル
    wp_enqueue_style('contact-form-styles',
      get_stylesheet_directory_uri() . '/assets/css/contact-form.css',
      [],
      '1.0'
    );



    // 固定ページ固有スタイル
    wp_enqueue_style('page-specific-styles',
      get_stylesheet_directory_uri() . '/assets/css/page-specific.css',
      [],
      '1.0'
    );

			// 汎用スタイル
			wp_enqueue_style('general-styles',
				get_stylesheet_directory_uri() . '/assets/css/general-styles.css',
				[],
				'1.0'
			);

			// トップページメインビジュアル用スタイル
			wp_enqueue_style('top-mv-styles',
				get_stylesheet_directory_uri() . '/assets/css/top-mv.css',
				[],
				'1.0'
			);
			// トップページレッスンについて用スタイル
			wp_enqueue_style('top-about-lesson-styles',
				get_stylesheet_directory_uri() . '/assets/css/top-about-lesson.css',
				[],
				'1.0'
			);

//詳細ページレッスン用スタイル
wp_enqueue_style('single-lesson-styles',
get_stylesheet_directory_uri() . '/assets/css/single-lesson.css',
[],
'1.0'
);
//価格表用スタイル
wp_enqueue_style('price-table-styles',
get_stylesheet_directory_uri() . '/assets/css/price-table.css',
[],
'1.0'
);
//レッスン詳細ページ共通セクション用スタイル
wp_enqueue_style('lesson-common-sections-styles',
get_stylesheet_directory_uri() . '/assets/css/lesson-common-sections.css',
[],
'1.0'
);
//レッスンアーカイブページ用スタイル
wp_enqueue_style('archive-lesson-styles',
get_stylesheet_directory_uri() . '/assets/css/archive-lesson.css',
[],
'1.0'
);
	//講師アーカイブページ用スタイル（更新時刻をバージョンにしてキャッシュ回避）
	wp_enqueue_style('archive-instructor-styles',
	get_stylesheet_directory_uri() . '/assets/css/archive-instructor.css',
	[],
	date('Ymdgis', filemtime(get_stylesheet_directory() . '/assets/css/archive-instructor.css'))
	);
	//講師個別ページ用スタイル
	wp_enqueue_style('single-instructor-styles',
	get_stylesheet_directory_uri() . '/assets/css/single-instructor.css',
	[],
	'1.0'
	);
	//トップページ講師カード用スタイル
	wp_enqueue_style('top-instructor-styles',
	get_stylesheet_directory_uri() . '/assets/css/top-instructor.css',
	[],
	'1.0'
	);
	//講師タクソノミーページ用スタイル（更新時刻をバージョンにしてキャッシュ回避）
	wp_enqueue_style('tax-instructor-styles',
	get_stylesheet_directory_uri() . '/assets/css/tax-instructor.css',
	[],
	date('Ymdgis', filemtime(get_stylesheet_directory() . '/assets/css/tax-instructor.css'))
	);
	//ヘッダー下ウィジェットエリア用スタイル
	wp_enqueue_style('header-sns-styles',
	get_stylesheet_directory_uri() . '/assets/css/header-sns.css',
	[],
	'1.0'
	);
	//リンク修正用スタイル
	wp_enqueue_style('link-fix-styles',
	get_stylesheet_directory_uri() . '/assets/css/link-fix.css',
	[],
	'1.0'
	);
	
	//ヘッダー修正用スタイル
	wp_enqueue_style('header-fix-styles',
	get_stylesheet_directory_uri() . '/assets/css/header-fix.css',
	[],
	date('Ymdgis', filemtime(get_stylesheet_directory() . '/assets/css/header-fix.css'))
	);

  }
  , 25);

// SP版ヘッダー下電話番号表示用ウィジェットエリアの登録
add_action('widgets_init', function() {
    register_sidebar([ 'name'=> 'SP版ヘッダー下',
      'id'=> 'sp_header_bottom',
      'description'=> 'SP版でヘッダーとメインビジュアルの間に表示されます。PCでは非表示。',
      'before_widget'=> '<div id="%1$s" class="w-spHeaderBottom sp_ %2$s">',
      'after_widget'=> '</div>',
      'before_title'=> '<div class="w-spHeaderBottom__title">',
      'after_title'=> '</div>',
      ]);
  }

);

// SP版ヘッダー下ウィジェットエリアの出力は header.php で直接実装


// Swiper未使用のため読込は削除

// lesson_slider は未使用のため削除



/**
 * 投稿タイプとlist_typeに応じてSWELLの投稿リストテンプレートを切り替える
 */
add_filter('swell_post_list_template', function($template_name, $args) {

    // 通常の投稿（post）の場合のみ処理
    if (isset($args['post_id']) && get_post_type($args['post_id'])==='post') {
        // list_typeが明示的に指定されている場合はそれを優先
        if (isset($args['list_type']) && $args['list_type'] !=='auto') {
          return 'style-'. $args['list_type'];
        }
        // 通常のpostはシンプル型に
        return 'style-simple';
    }

    // その他の投稿タイプ（instructor含む）はデフォルトのテンプレートを使用
    return $template_name;
}, 10, 2);


// モーダル表示：阪急（BEM記法・完全版）
function modal_hankyu_html() {
  ob_start();
  echo '<div class="instructor-archive">';
  $modal_hankyu_path=get_stylesheet_directory() . '/parts/modal-hankyu.php';

  if (file_exists($modal_hankyu_path)) {
    include $modal_hankyu_path;
  }

  return ob_get_clean();
}

add_shortcode('modal_hankyu', 'modal_hankyu_html');

// モーダル表示：JR（BEM記法・完全版）
function modal_jr_html() {
  ob_start();
  // parts/modal-jr.phpを読み込む
  $modal_jr_path=get_stylesheet_directory() . '/parts/modal-jr.php';

  if (file_exists($modal_jr_path)) {
    include $modal_jr_path;
  }

  return ob_get_clean();
}

add_shortcode('modal_jr', 'modal_jr_html');

// モーダル表示：タイムズ（BEM記法・完全版）
function modal_times_html() {
  ob_start();
  $modal_times_path=get_stylesheet_directory() . '/parts/modal-times.php';

  if (file_exists($modal_times_path)) {
    include $modal_times_path;
  }

  return ob_get_clean();
}

add_shortcode('modal_times', 'modal_times_html');

// ↓↓↓ この1行を必ず追加してください
remove_filter('the_content', 'wpautop');

// Contact Form 7の自動改行（<br>タグ自動挿入）を無効にする
add_filter('wpcf7_autop_or_not', '__return_false');







// タクソノミーページのカスタマイズ
// 1. タクソノミーページのタイトルから「-tax-」を削除
if ( ! function_exists( 'swl_parts__term_title' ) ) :
	function swl_parts__term_title( $args ) {
		$term_id   = $args['term_id'] ?? 0;
		$has_inner = $args['has_inner'] ?? false;
		if ( ! $term_id ) return;

		$term = get_term( $term_id );
		$archive_data = SWELL_Theme::get_archive_data();

		// カスタムタイトルがあればそれを使用、なければ通常のタイトル
		$title = get_term_meta( $term_id, 'swell_term_meta_ttl', 1 ) ?: $archive_data['title'];

		// サブタイトルは空にして「-tax-」を非表示にする
		$subtitle = '';

		// instructor_schoolタクソノミーの場合は「担当講師一覧」をサブタイトルに
		if ( $term && $term->taxonomy === 'instructor_school' ) {
			$subtitle = '担当講師一覧';
		}

		SWELL_Theme::pluggable_parts( 'page_title', [
			'title'     => $title,
			'subtitle'  => $subtitle,
			'has_inner' => $has_inner,
		] );
	}
endif;

// 2. 投稿メタ情報（日時等）の表示制御
add_filter( 'swell_get_setting', function( $value, $key ) {
	// タクソノミーページで更新日時を非表示
	if ( is_tax('instructor_school') || is_tax('instructor_subject') ) {
		if ( $key === 'show_meta_posted' || $key === 'show_meta_modified' ) {
			return false;
		}
	}
	return $value;
}, 10, 2 );

// 3. instructor投稿タイプの投稿リストで日時を非表示
add_action( 'wp', function() {
	if ( is_tax('instructor_school') || is_tax('instructor_subject') ) {
		// 投稿リストのメタ情報から日時を除去
		add_filter( 'swell_post_list_meta_items', function( $items ) {
			// 日時関連の項目を削除
			if ( isset($items['date']) ) {
				unset($items['date']);
			}
			if ( isset($items['modified']) ) {
				unset($items['modified']);
			}
			return $items;
		});
	}
});

// 4. タクソノミーページ専用のメタ情報表示制御
add_action( 'wp_head', function() {
	if ( is_tax('instructor_school') || is_tax('instructor_subject') ) {
		?>
<style>
/* タクソノミーページで日時を非表示 */
.p-postList__times,
.c-postTimes,
.c-postTimes__posted,
.c-postTimes__modified,
.icon-posted,
.icon-modified,
.p-entryItem__meta .c-postMeta__item:has(.c-postMeta__date),
.c-postMeta__date,
.c-postMeta__item:has(.icon-clock),
.icon-clock {
	display: none !important;
}
</style>
<?php
	}
});



	// 管理画面の講師一覧に追加していたカスタム列（教室・担当科目）は紛らわしいため削除




	// 講師ページで関連記事のタイトルを「他講師」に変更
	add_action( 'wp_head', 'instructor_related_title_change_start' );
	add_action( 'wp_footer', 'instructor_related_title_change_end' );

	function instructor_related_title_change_start() {
	if ( is_single() && get_post_type() === 'instructor' ) {
	ob_start( 'instructor_replace_related_title' );
	}
	}

	function instructor_related_title_change_end() {
	if ( is_single() && get_post_type() === 'instructor' ) {
	ob_end_flush();
	}
	}

	function instructor_replace_related_title( $buffer ) {
	// 関連記事のタイトルを置換
	$buffer = str_replace(
	'<h2 class="l-articleBottom__title c-secTitle">関連記事</h2>',
	'<h2 class="l-articleBottom__title c-secTitle">他講師</h2>',
	$buffer
	);
	return $buffer;
	}

	// トップページレッスンカード用ショートコード
	function show_lesson_cards_part() {
	ob_start();
	get_template_part('parts/top-lesson-cardList'); // ← 拡張子「.php」は不要
	return ob_get_clean();
	}
	add_shortcode('lesson_cards', 'show_lesson_cards_part');

	// ACF/SCF 通知は不要のため削除


	// アクションフックでロゴを出力する（メインビジュアル内に直接出力）
	add_action( 'swell_inner_main_visual', function() {
	if ( is_front_page() ) {
	echo '<div class="p-mainVisual__logo">';
		echo '<img
			src="' . esc_url( get_stylesheet_directory_uri() . '/img/musicnote_logo_white_outline_thickest.png' ) . '"
			alt="ロゴ">';
		echo '</div>';
	}
	} );


	// レッスンページで関連記事のタイトルを「他レッスン」に変更
	add_action( 'wp_head', 'lesson_related_title_change_start' );
	add_action( 'wp_footer', 'lesson_related_title_change_end' );

	function lesson_related_title_change_start() {
	if ( is_single() && get_post_type() === 'lesson' ) {
	ob_start( 'lesson_replace_related_title' );
	}
	}

	function lesson_related_title_change_end() {
	if ( is_single() && get_post_type() === 'lesson' ) {
	ob_end_flush();
	}
	}

	function lesson_replace_related_title( $buffer ) {
	// 関連記事のタイトルを置換
	$buffer = str_replace(
	'<h2 class="l-articleBottom__title c-secTitle">関連記事</h2>',
	'<h2 class="l-articleBottom__title c-secTitle">他レッスン</h2>',
	$buffer
	);
	return $buffer;
	}


	// レッスンには担当科目タクソノミーを紐づけない運用に統一



// 学校別レッスン一覧ショートコード [school_lessons school="suita|shimamoto"]
function shortcode_school_lessons( $atts = [] ) {
  $atts = shortcode_atts([
    'school'   => '',
    'taxonomy' => '', // 例: category / instructor_school / lesson_school
  ], $atts, 'school_lessons');

  $school_slug = sanitize_key( $atts['school'] );
  $attr_taxonomy = sanitize_key( $atts['taxonomy'] );

  if ( empty( $school_slug ) ) {
    if ( function_exists('is_page_template') && is_page_template('page-school-suita.php') ) {
      $school_slug = 'suita';
    } elseif ( function_exists('is_page_template') && is_page_template('page-school-shimamoto.php') ) {
      $school_slug = 'shimamoto';
    }
  }

  $query_args = [
    'post_type'      => 'lesson',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
  ];

  if ( ! empty( $school_slug ) ) {
    // 優先順位: 明示指定taxonomy > 用語が存在するtax > lessonが紐づくcategory
    $taxonomy_to_use = '';

    if ( $attr_taxonomy && function_exists('taxonomy_exists') && taxonomy_exists( $attr_taxonomy ) ) {
      $taxonomy_to_use = $attr_taxonomy;
    }

    if ( ! $taxonomy_to_use && function_exists('get_object_taxonomies') && function_exists('term_exists') ) {
      $candidate_taxonomies = get_object_taxonomies( 'lesson' );
      foreach ( (array) $candidate_taxonomies as $tax ) {
        if ( term_exists( $school_slug, $tax ) ) {
          $taxonomy_to_use = $tax;
          break;
        }
      }
    }

    if ( ! $taxonomy_to_use && function_exists('is_object_in_taxonomy') && is_object_in_taxonomy( 'lesson', 'category' ) ) {
      $taxonomy_to_use = 'category';
    }

    if ( $taxonomy_to_use ) {
      $query_args['tax_query'] = [[
        'taxonomy' => $taxonomy_to_use,
        'field'    => 'slug',
        'terms'    => [ $school_slug ],
      ]];
    }
  }

  $q = new WP_Query( $query_args );

  ob_start();
  if ( $q->have_posts() ) :
    echo '<div class="school-lesson-list">';
    while ( $q->have_posts() ) : $q->the_post();
      $thumb_url = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
      echo '<a href="' . esc_url( get_permalink() ) . '" class="school-lesson-list__item">';
      if ( $thumb_url ) {
        echo '<img class="school-lesson-list__image" src="' . esc_url( $thumb_url ) . '" alt="' . esc_attr( get_the_title() ) . '" loading="lazy" />';
      }
      echo '<p class="school-lesson-list__title">' . esc_html( get_the_title() ) . '</p>';
      echo '</a>';
    endwhile;
    echo '</div>';
  else:
    echo '<p>現在、公開中のレッスンはありません。</p>';
  endif;
  wp_reset_postdata();

  return ob_get_clean();
}
add_shortcode( 'school_lessons', 'shortcode_school_lessons' );


// 学校別講師一覧ショートコード（シンプル版） [school_instructors school="suita|shimamoto"]
function shortcode_school_instructors( $atts = [] ) {
  $atts = shortcode_atts([
    'school' => '',
  ], $atts, 'school_instructors');

  $school_slug = sanitize_key( $atts['school'] );

  if ( empty( $school_slug ) ) {
    if ( function_exists('is_page_template') && is_page_template('page-school-suita.php') ) {
      $school_slug = 'suita';
    } elseif ( function_exists('is_page_template') && is_page_template('page-school-shimamoto.php') ) {
      $school_slug = 'shimamoto';
    }
  }

  if ( empty( $school_slug ) ) {
    return '<p>教室の指定がありません。</p>';
  }

  $school_term = function_exists('get_term_by') ? get_term_by( 'slug', $school_slug, 'instructor_school' ) : null;
  if ( ! $school_term || is_wp_error( $school_term ) ) {
    return '<p>指定された教室が見つかりませんでした。</p>';
  }

  $q = new WP_Query([
    'post_type'      => 'instructor',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'tax_query'      => [[
      'taxonomy' => 'instructor_school',
      'field'    => 'term_id',
      'terms'    => $school_term->term_id,
    ]],
  ]);

  ob_start();
  echo '<div class="instructor-archive">';
  if ( $q->have_posts() ) {
    echo '<div class="p-postList -instructor">';
    while ( $q->have_posts() ) { $q->the_post();
      $classes = implode( ' ', get_post_class( '', get_the_ID() ) );
      echo '<article class="p-postList__item ' . esc_attr( $classes ) . '">';
      echo '<a href="' . esc_url( get_permalink( get_the_ID() ) ) . '" class="p-postList__item-link">';
      if ( has_post_thumbnail( get_the_ID() ) ) {
        echo '<div class="p-postList__thumb">';
        echo get_the_post_thumbnail( get_the_ID(), 'medium' );
        echo '</div>';
      }
      echo '<h3 class="p-postList__title">' . esc_html( get_the_title() ) . '</h3>';
      $schools = get_the_terms( get_the_ID(), 'instructor_school' );
      if ( $schools && ! is_wp_error( $schools ) ) {
        echo '<div class="p-postList__schools">';
        foreach ( $schools as $school ) {
          echo '<span class="p-postList__school-tag">' . esc_html( $school->name ) . '</span>';
        }
        echo '</div>';
      }
      echo '</a>';
      echo '</article>';
    }
    echo '</div>';
  } else {
    echo '<p>担当講師が見つかりませんでした。</p>';
  }
  echo '</div>';
  wp_reset_postdata();

  return ob_get_clean();
}
add_shortcode( 'school_instructors', 'shortcode_school_instructors' );

// instructor_schoolタクソノミー関連のカスタマイズ（削除済み）

// パンくずリストからinstructor_schoolタクソノミーを除外
add_filter( 'swell_breadcrumb_list_data', function( $list_data ) {
    // instructor投稿の詳細ページでのみ実行
    if ( is_single() && get_post_type() === 'instructor' ) {
        $filtered_list = [];

        foreach ( $list_data as $item ) {
            // instructor_schoolタクソノミーのリンクが含まれている項目をスキップ
            if ( isset( $item['url'] ) && strpos( $item['url'], '/instructor_school/' ) !== false ) {
                continue;
            }
            $filtered_list[] = $item;
        }

        return $filtered_list;
    }

    return $list_data;
});
