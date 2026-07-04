<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理画面 - FashionablyLate</title>
    
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

    <div class="container">
        <!-- ヘッダーエリア -->
        <div class="header-area">
            <div class="header-title">FashionablyLate</div>
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="btn-logout">logout</button>
            </form>
        </div>

        <div class="page-title">Admin</div>

        
        <div class="search-box">
            <form action="{{ route('contact.admin') }}" method="GET" class="search-form">
                <input type="text" name="keyword" value="{{ request('keyword') }}" class="input-keyword" placeholder="名前やメールアドレスを入力してください">
                
                <select name="gender" class="select-gender">
                    <option value="all">性別</option>
                    <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                    <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                    <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
                </select>

                <select name="detail_type" class="select-type">
                    <option value="all">お問い合わせの種類</option>
                    <option value="商品の交換について" {{ request('detail_type') == '商品の交換について' ? 'selected' : '' }}>商品の交換について</option>
                    <option value="お届けについて" {{ request('detail_type') == 'お届けについて' ? 'selected' : '' }}>お届けについて</option>
                    <option value="その他" {{ request('detail_type') == 'その他' ? 'selected' : '' }}>その他</option>
                </select>

                <input type="date" name="date" value="{{ request('date') }}" class="input-date">

                <button type="submit" class="btn-search">検索</button>
                <a href="{{ route('contact.admin') }}" class="btn-reset">リセット</a>
            </form>
        </div>

        
        <div class="action-bar">
            <button class="btn-export">エクスポート</button>
            
            
            <div class="pagination-wrapper">
                {{ $contacts->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
        </div>

        
        <table class="admin-table">
            <thead>
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td>
                        {{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}
                    </td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->detail_type }}</td>
                    <td>
                        <button type="button" class="btn-detail" 
                                data-id="{{ $contact->id }}"
                                data-name="{{ $contact->name }}"
                                data-gender="{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}"
                                data-email="{{ $contact->email }}"
                                data-type="{{ $contact->detail_type }}"
                                data-content="{{ $contact->content }}">
                            詳細
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 30px; color: #999;">該当するデータが見つかりませんでした。</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- 🖼️ 詳細ポップアップ（モーダルウィンドウ） -->
    <div id="detailModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" id="closeModal">&times;</span>
            <table class="modal-table">
                <tr>
                    <th>お名前</th>
                    <td id="modalName"></td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td id="modalGender"></td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td id="modalEmail"></td>
                </tr>
                <tr>
                    <th>お問い合わせの種類</th>
                    <td id="modalType"></td>
                </tr>
                <tr>
                    <th>お問い合わせ内容</th>
                    <td id="modalContent" style="white-space: pre-wrap;"></td>
                </tr>
            </table>
            
        <div style="text-align: center; margin-top: 30px;">
            <form id="deleteForm" method="POST" action="">
                @csrf
                @method('DELETE') 
                <button type="submit" class="btn-delete" onclick="return confirm('本当に削除しますか？')">削除</button>
            </form>
        </div>
        </div>
    </div>

    <!-- モーダルの開閉を制御するJavaScript -->
    <script>
        document.querySelectorAll('.btn-detail').forEach(button => {
            button.addEventListener('click', () => {
                document.getElementById('modalName').innerText = button.dataset.name;
                document.getElementById('modalGender').innerText = button.dataset.gender;
                document.getElementById('modalEmail').innerText = button.dataset.email;
                document.getElementById('modalType').innerText = button.dataset.type;
                document.getElementById('modalContent').innerText = button.dataset.content;
                
                const contactId = button.dataset.id;
                document.getElementById('deleteForm').action = `/admin/delete/${contactId}`;
                
                document.getElementById('detailModal').style.display = 'block';
            });
        });

        document.getElementById('closeModal').addEventListener('click', () => {
            document.getElementById('detailModal').style.display = 'none';
        });

        window.addEventListener('click', (event) => {
            const modal = document.getElementById('detailModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    </script>
</body>
</html>