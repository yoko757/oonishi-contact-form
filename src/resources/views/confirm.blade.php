<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm - FashionablyLate</title>
    
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}?v={{ time() }}">
    <style>
        /*
            確認画面（Confirm）
            */
        .confirm-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 50px;
            background-color: #ffffff;
        }

        
        .confirm-table th {
            width: 260px;
            background-color: #bfb0a8;
            color: #ffffff;
            text-align: left;
            padding: 20px 30px;
            font-weight: normal;
            font-size: 14px;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #ffffff;
            white-space: nowrap;
        }

        
        .confirm-table td {
            padding: 20px 30px;
            border-bottom: 1px solid #f2ece9;
            line-height: 1.6;
            font-size: 14px;
            color: #333333;
            word-break: break-all;
        }

        
        .confirm-buttons {
            display: flex;
            justify-content: center; 
            align-items: center;
            gap: 40px;
            margin-top: 40px;
        }

        
        .confirm-buttons .submit-button {
            background-color: #837264;
            color: #ffffff;
            border: none;
            border-radius: 2px;
            padding: 12px 55px;
            font-size: 14px;
            letter-spacing: 1px;
            cursor: pointer;
            font-weight: normal;
            order: 1; 
        }

        
        .confirm-buttons .back-button {
            background: none;
            border: none;
            color: #bfb0a8;
            font-size: 14px;
            text-decoration: underline;
            cursor: pointer;
            padding: 12px 10px;
            font-weight: normal;
            order: 2; 
        }
    </style>
</head>
<body>
ß
    <div class="form-container">
        <div class="form-inner">
            
            <h1 class="site-title">FashionablyLate</h1>
            <h2 class="page-title">Confirm</h2>

            <form action="{{ route('contact.send') }}" method="POST">
                @csrf

                <table class="confirm-table">
                    
                    <tr>
                        <th>名前</th>
                        <td>
                            @if(isset($inputs['last_name']) || isset($inputs['first_name']))
                                {{ $inputs['last_name'] ?? '' }}　{{ $inputs['first_name'] ?? '' }}
                            @else
                                {{ $inputs['name'] ?? '—' }}
                            @endif
                            <input type="hidden" name="name" value="{{ ($inputs['last_name'] ?? '') . ' ' . ($inputs['first_name'] ?? '') }}">
                        </td>
                    </tr>
                    
                    <tr>
                        <th>メールアドレス</th>
                        <td>
                            {{ $inputs['email'] ?? '—' }}
                            <input type="hidden" name="email" value="{{ $inputs['email'] ?? '' }}">
                        </td>
                    </tr>
                    
                    <tr>
                        <th>電話番号</th>
                        <td>
                            @if(isset($inputs['tel_1']) && isset($inputs['tel_2']) && isset($inputs['tel_3']))
                                {{ $inputs['tel_1'] }}{{ $inputs['tel_2'] }}{{ $inputs['tel_3'] }}
                            @else
                                {{ $inputs['tel'] ?? '—' }}
                            @endif
                            <input type="hidden" name="tel_1" value="{{ $inputs['tel_1'] ?? '' }}">
                            <input type="hidden" name="tel_2" value="{{ $inputs['tel_2'] ?? '' }}">
                            <input type="hidden" name="tel_3" value="{{ $inputs['tel_3'] ?? '' }}">
                        </td>
                    </tr>
                    
                    <tr>
    <th>性別</th>
    <td>
        {{ $inputs['gender'] ?? '—' }}
        
        
        @if(($inputs['gender'] ?? '') === '男性')
            <input type="hidden" name="gender" value="1">
        @elseif(($inputs['gender'] ?? '') === '女性')
            <input type="hidden" name="gender" value="2">
        @elseif(($inputs['gender'] ?? '') === 'その他')
            <input type="hidden" name="gender" value="3">
        @else
            
            <input type="hidden" name="gender" value="{{ $inputs['gender'] ?? '' }}">
        @endif
    </td>
</tr>
                    
                    <tr>
                        <th>建物名・部屋番号</th>
                        <td>
                            {{ $inputs['building'] ?? '—' }}
                            <input type="hidden" name="building" value="{{ $inputs['building'] ?? '' }}">
                        </td>
                    </tr>
                    
                    <tr>
                        <th>お問い合わせの種類</th>
                        <td>
                            {{ $inputs['detail_type'] ?? '—' }}
                            <input type="hidden" name="detail_type" value="{{ $inputs['detail_type'] ?? '' }}">
                        </td>
                    </tr>
                    
                    <tr>
                        <th style="vertical-align: top;">お問い合わせ内容</th>
                        <td>
                            @if(isset($inputs['content']))
                                {!! nl2br(e($inputs['content'])) !!}
                            @else
                                —
                            @endif
                            <input type="hidden" name="content" value="{{ $inputs['content'] ?? '' }}">
                        </td>
                    </tr>
                </table>

                
                <div class="confirm-buttons">
                    <button type="submit" name="action" value="submit" class="submit-button">送信</button>
                    <button type="submit" name="action" value="back" class="back-button">修正</button>
                </div>

            </form>
        </div>
    </div>

</body>
</html>