<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員登録</title>
    <!-- お問い合わせフォームで整えた隙間（余白）付きのCSSを読み込みます -->
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}?v={{ time() }}">
</head>
<body>
    <div class="form-container">
        <div class="form-inner">
            <h2 class="confirm-title">Register</h2>

            <!-- 入力エラー（パスワードが短いなど）があれば赤文字で表示 -->
            @if ($errors->any())
                <div style="color: red; text-align: center; margin-bottom: 20px;">
                    <ul style="list-style: none; padding: 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.perform') }}" method="POST">
                @csrf

                <!-- ① 名前 -->
                <div class="form-group">
                    <label class="form-label">お名前</label>
                    <input type="text" name="name" class="form-input" value="{{ old('name') }}" required>
                </div>

                <!-- ② メールアドレス -->
                <div class="form-group">
                    <label class="form-label">メールアドレス</label>
                    <input type="email" name="email" class="form-input" value="{{ old('email') }}" required>
                </div>

                <!-- ③ パスワード -->
                <div class="form-group">
                    <label class="form-label">パスワード</label>
                    <input type="password" name="password" class="form-input" required>
                </div>
             

                <div class="confirm-buttons">
                    <button type="submit" class="submit-button">登録</button>
                </div>
            </form>
            
            
        </div>
    </div>
</body>
</html>