<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}?v={{ time() }}">
    <style>
        
        .site-title {
            font-family: Georgia, serif;
            font-size: 34px;
            color: #837264;
            font-weight: normal;
            text-align: center;
            margin-top: 40px;
            margin-bottom: 20px;
        }
        .page-title {
            font-size: 26px;
            color: #837264;
            font-weight: normal;
            text-align: center;
            margin-bottom: 50px;
        }
        .form-buttons {
            text-align: center;
            margin-top: 40px;
        }
        .submit-button {
            background-color: #837264;
            color: #ffffff;
            border: none;
            border-radius: 2px;
            padding: 14px 65px;
            font-size: 14px;
            cursor: pointer;
            font-weight: bold;
        }
        .submit-button:hover {
            background-color: #726255;
        }

        
        .form-input-row {
            display: flex !important;
            flex: 1 !important;
            width: 100% !important;
        }
        .form-input-row .form-input,
        .form-input-row textarea {
            width: 100% !important;
            max-width: none !important;
            box-sizing: border-box !important;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <div class="form-inner">
            
            <h1 class="site-title">FashionablyLate</h1>
            <h2 class="page-title">Contact</h2>

            @if ($errors->any())
                <div class="alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('contact.confirm') }}" method="POST" class="contact-form">
                @csrf

                <!-- 1. お名前 -->
                <div class="form-group">
                    <label class="form-label">お名前 <span class="required">※</span></label>
                    <div class="form-input-row name-inputs">
                        <input type="text" name="last_name" class="form-input" value="{{ old('last_name') }}" placeholder="例: 山田" required>
                        <input type="text" name="first_name" class="form-input" value="{{ old('first_name') }}" placeholder="例: 太郎" required>
                    </div>
                </div>

                <!-- 2. 性別 -->
                <div class="form-group">
                    <label class="form-label">性別 <span class="required">※</span></label>
                    <div class="form-input-row gender-options">
                        <label class="gender-item">
                            <input type="radio" name="gender" value="男性" {{ old('gender', '男性') === '男性' ? 'checked' : '' }}> 男性
                        </label>
                        <label class="gender-item">
                            <input type="radio" name="gender" value="女性" {{ old('gender') === '女性' ? 'checked' : '' }}> 女性
                        </label>
                        <label class="gender-item">
                            <input type="radio" name="gender" value="その他" {{ old('gender') === 'その他' ? 'checked' : '' }}> その他
                        </label>
                    </div>
                </div>

                <!-- 3. メールアドレス -->
                <div class="form-group">
                    <label class="form-label">メールアドレス <span class="required">※</span></label>
                    <div class="form-input-row">
                        <input type="email" name="email" class="form-input" value="{{ old('email') }}" placeholder="例: test@example.com" required>
                    </div>
                </div>

                <!-- 4. 電話番号 -->
                <div class="form-group">
                    <label class="form-label">電話番号 <span class="required">※</span></label>
                    <div class="form-input-row tel-inputs">
                        <input type="text" name="tel_1" class="form-input text-center" value="{{ old('tel_1') }}" placeholder="080" required>
                        <span class="tel-dash">-</span>
                        <input type="text" name="tel_2" class="form-input text-center" value="{{ old('tel_2') }}" placeholder="1234" required>
                        <span class="tel-dash">-</span>
                        <input type="text" name="tel_3" class="form-input text-center" value="{{ old('tel_3') }}" placeholder="5678" required>
                    </div>
                </div>

                <!-- 5. 住所 -->
                <div class="form-group">
                    <label class="form-label">住所 <span class="required">※</span></label>
                    <div class="form-input-row">
                        <input type="text" name="address" class="form-input" value="{{ old('address') }}" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" required>
                    </div>
                </div>

                <!-- 6. 建物名 -->
                <div class="form-group">
                    <label class="form-label">建物名</label>
                    <div class="form-input-row">
                        <input type="text" name="building" class="form-input" value="{{ old('building') }}" placeholder="例: 千駄ヶ谷マンション101">
                    </div>
                </div>

                <!-- 7. お問い合わせの種類 -->
                <div class="form-group">
                    <label class="form-label">お問い合わせの種類 <span class="required">※</span></label>
                    <div class="form-input-row select-wrapper">
                        <select name="detail_type" class="form-input select-custom" required>
                            <option value="" disabled {{ old('detail_type') === null ? 'selected' : '' }} hidden>選択してください</option>
                            <option value="商品の交換について" {{ old('detail_type') === '商品の交換について' ? 'selected' : '' }}>商品の交換について</option>
                            <option value="お届けについて" {{ old('detail_type') === 'お届けについて' ? 'selected' : '' }}>お届けについて</option>
                            <option value="その他" {{ old('detail_type') === 'その他' ? 'selected' : '' }}>その他</option>
                        </select>
                    </div>
                </div>

                <!-- 8. お問い合わせ内容 -->
                <div class="form-group align-top">
                    <label class="form-label">お問い合わせ内容 <span class="required">※</span></label>
                    <div class="form-input-row">
                        <textarea name="content" class="form-input textarea-custom" rows="6" placeholder="お問い合わせ内容をご記載ください" required></textarea>
                    </div>
                </div>

                <!-- 9. ボタンエリア -->
                <div class="form-buttons">
                    <button type="submit" class="submit-button">確認画面</button>
                </div>

            </form>
        </div>
    </div>

</body>
</html>