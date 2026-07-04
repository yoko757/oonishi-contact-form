<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}?v={{ time() }}">
</head>
<body>
    <div class="form-container">
        <div class="form-inner">
            <h2 class="confirm-title">Login</h2>

            <!-- パスワード間違いなどのエラー表示 -->
            @if ($errors->any())
                <div style="color: red; text-align: center; margin-bottom: 20px;">
                    <ul style="list-style: none; padding: 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login.perform') }}" method="POST">
                @csrf

                <!-- ① メールアドレス -->
                <div class="form-group">
                    <label class="form-label">メールアドレス</label>
                    <input type="email" name="email" class="form-input" value="{{ old('email') }}" required>
                </div>

                <!-- ② パスワード -->
                <div class="form-group">
                    <label class="form-label">パスワード</label>
                    <input type="password" name="password" class="form-input" required>
                </div>

                <div class="confirm-buttons">
                    <button type="submit" class="submit-button">ログイン</button>
                </div>
            </form>
            
            
        </div>
    </div>
</body>
</html>
