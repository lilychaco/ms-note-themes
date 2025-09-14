<div class="form-table">

	<!-- お名前 -->
	<div class="form-row">
		<label for="your-name-shimamoto">お名前 <span class="required">※必須</span></label>
		[text* your-name-shimamoto id:your-name-shimamoto class:form-input placeholder "お名前を入力してください"]
	</div>

	<!-- フリガナ -->
	<div class="form-row">
		<label for="your-furigana-shimamoto">フリガナ <span class="required">※必須</span></label>
		[text* your-furigana-shimamoto id:your-furigana-shimamoto class:form-input placeholder "フリガナを入力してください"]
	</div>

	<!-- ご年齢 -->
	<div class="form-row">
		<label for="your-age-shimamoto">ご年齢 <span class="required">※必須</span></label>
		[select* your-age-shimamoto id:your-age-shimamoto class:form-select include_blank
		"0歳" "1歳" "2歳" "3歳前半" "3歳後半" "4歳" "5歳" "6歳" "7歳" "8歳" "9歳"
		"10歳" "11歳" "12歳" "13歳" "14歳" "15歳" "16歳" "17歳" "18歳" "19歳"
		"20代" "30代" "40代" "50代" "60代" "70代" "80代"]
	</div>

	<!-- 性別 -->
	<div class="form-row">
		<label for="your-gender-shimamoto">性別 </label>
		[radio your-gender-shimamoto id:your-gender-shimamoto class:form-radio use_label_element "男性" "女性"]
	</div>

	<!-- 電話番号 -->
	<div class="form-row">
		<label for="your-phone-shimamoto">電話番号(半角) <span class="required">※必須</span></label>
		[tel* your-phone-shimamoto id:your-phone-shimamoto class:form-input placeholder "例：06-1234-5678"]
	</div>

	<!-- メールアドレス -->
	<div class="form-row">
		<label for="your-email-shimamoto">メールアドレス(半角) <span class="required">※必須</span></label>
		[email* your-email-shimamoto id:your-email-shimamoto class:form-input placeholder "例：example@example.com"]
	</div>

	<!-- 郵便番号 -->
	<div class="form-row">
		<label for="your-zip-shimamoto">郵便番号</label>
		[text your-zip-shimamoto id:your-zip-shimamoto class:form-input placeholder "例：123-4567"]
	</div>

	<!-- ご住所 -->
	<div class="form-row">
		<label for="your-address-shimamoto">ご住所</label>
		[text your-address-shimamoto id:your-address-shimamoto class:form-input placeholder "例：大阪府島本町..."]
	</div>

	<!-- お申込み校 -->
	<div class="form-row">
		<label for="your-school-shimamoto">お申込み校 <span class="required">※必須</span> </label>
		[radio your-school-shimamoto class:form-radio use_label_element "島本校"]
		<small>※島本校専用の申込みフォームです</small>
	</div>

	<!-- 体験レッスン希望日 -->
	<div class="form-row">
		<label>体験レッスン希望日 <span class="required">※必須</span></label>

		<!-- 第一希望 -->
		<div class="date-group">
			<strong>第一希望日</strong> <span class="required">※必須</span>
			<div class="date-select-container">
				<div class="date-select-item">
					[select* shimamoto-first-year include_blank "2024" "2025"]
					<div class="date-label">年</div>
				</div>
				<div class="date-select-item">
					[select* shimamoto-first-month include_blank "1" "2" "3" "4" "5" "6" "7" "8" "9" "10" "11" "12"]
					<div class="date-label">月</div>
				</div>
				<div class="date-select-item">
					[select* shimamoto-first-day include_blank "1" "2" "3" "4" "5" "6" "7" "8" "9" "10" "11" "12" "13" "14" "15"
					"16" "17"
					"18"
					"19" "20" "21" "22" "23" "24" "25" "26" "27" "28" "29" "30" "31"]
					<div class="date-label">日</div>
				</div>
				<div class="date-select-item">
					[select* shimamoto-first-time include_blank "午前(10:00～12:00)" "午後(12:00～17:00)" "夜間(17:00～21:00)"]
					<div class="date-label">コース</div>
				</div>
			</div>
		</div>

		<!-- 第二希望 -->
		<div class="date-group">
			<strong>第二希望日</strong> <span class="required">※必須</span>
			<div class="date-select-container">
				<div class="date-select-item">
					[select* shimamoto-second-year include_blank "2024" "2025"]
					<div class="date-label">年</div>
				</div>
				<div class="date-select-item">
					[select* shimamoto-second-month include_blank "1" "2" "3" "4" "5" "6" "7" "8" "9" "10" "11" "12"]
					<div class="date-label">月</div>
				</div>
				<div class="date-select-item">
					[select* shimamoto-second-day include_blank "1" "2" "3" "4" "5" "6" "7" "8" "9" "10" "11" "12" "13" "14" "15"
					"16" "17"
					"18"
					"19" "20" "21" "22" "23" "24" "25" "26" "27" "28" "29" "30" "31"]
					<div class="date-label">日</div>
				</div>
				<div class="date-select-item">
					[select* shimamoto-second-time include_blank "午前(10:00～12:00)" "午後(12:00～17:00)" "夜間(17:00～21:00)"]
					<div class="date-label">コース</div>
				</div>
			</div>
		</div>

		<!-- 第三希望 -->
		<div class="date-group">
			<strong>第三希望日</strong> <span class="required">※必須</span>
			<div class="date-select-container">
				<div class="date-select-item">
					[select* shimamoto-third-year include_blank "2024" "2025"]
					<div class="date-label">年</div>
				</div>
				<div class="date-select-item">
					[select* shimamoto-third-month include_blank "1" "2" "3" "4" "5" "6" "7" "8" "9" "10" "11" "12"]
					<div class="date-label">月</div>
				</div>
				<div class="date-select-item">
					[select* shimamoto-third-day include_blank "1" "2" "3" "4" "5" "6" "7" "8" "9" "10" "11" "12" "13" "14" "15"
					"16" "17"
					"18"
					"19" "20" "21" "22" "23" "24" "25" "26" "27" "28" "29" "30" "31"]
					<div class="date-label">日</div>
				</div>
				<div class="date-select-item">
					[select* shimamoto-third-time include_blank "午前(10:00～12:00)" "午後(12:00～17:00)" "夜間(17:00～21:00)"]
					<div class="date-label">コース</div>
				</div>
			</div>
		</div>
		<p><small>※ご希望いただく体験レッスン候補日は、実際にご入会となった場合に通える曜日でお知らせください。</small></p>
	</div>

	<!-- 希望コース -->
	<div class="form-row">
		<label for="lesson-course-shimamoto">体験レッスン希望コース <span class="required">※必須</span></label>
		[radio lesson-course-shimamoto class:form-radio use_label_element "ピアノ" "ピアノ（ジャズ/英語/ラテン・インターナショナル）" "弾き語りピアノ"
		"ボーカル（ポピュラー）"
		"ボーカル（声楽・オペラ）" "ボーカル（ジャズ）" "音感改善ボーカル" "フルート"]<p><small><span
					class="required">※必須</span>（打楽器のその他をご選択の方は楽器名を必ず備考欄にお願いいたします。）</small></p>
	</div>

	<!-- ご経験 -->
	<div class="form-row">
		<label for="your-experience-shimamoto">ご経験 <span class="required">※必須</span></label>[radio your-experience-shimamoto
		class:form-radio
		use_label_element "なし" "初心者" "3年～5年" "5年以上"]
	</div>

	<!-- 楽器持参 -->
	<div class="form-row">
		<label for="instrument-bring-shimamoto">楽器持参 <span class="required">※必須</span></label>
		[checkbox* instrument-bring-shimamoto id:instrument-bring-shimamoto class:form-checkbox use_label_element "なし" "あり"
		"レンタルしたい"]
	</div>

	<!-- 備考 -->
	<div class="form-row">
		<label for="your-remarks-shimamoto">備考</label>
		[textarea your-remarks-shimamoto id:your-remarks-shimamoto class:form-textarea cols:50 rows:5
		"レッスンに関するご希望、ご要望、またご希望の曲やお好きなジャンル、やってみたいことなどご記入ください"]
	</div>

	<!-- 送信 -->
	<div class="form-row">
		[submit class:form-submit "送信"]
	</div>

</div>
