<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanks - FashionablyLate</title>
    
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}?v={{ time() }}">
</head>
<body>

    
    <div class="thanks-wrapper">
        
        
        <div class="thanks-bg-text">Thank you</div>
        
        
        <div class="thanks-content">
            <p class="thanks-message">お問い合わせありがとうございました</p>
            
            
            <a href="{{ route('contact.index') }}" class="thanks-home-btn">HOME</a>
        </div>

    </div>

</body>
</html>

