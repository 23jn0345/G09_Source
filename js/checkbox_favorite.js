const checkbox = document.getElementById('favorite');

checkbox.addEventListener('change', async function(event) {
    if (event.target.checked) {
        try {
            // セッション情報を確認するAPIを呼び出し
            const response = await fetch('http://localhost/G09_Source/check_session.php');
            const data = await response.json();
            console.log('ログインは　',data);

            if (!data.isLoggedIn) {
                // ログインしていない場合はメッセージを表示し、
                // ログイン画面へリダイレクト
                
                // 現在のURLをクエリパラメータとして付加（ログイン後の戻り先として）
                const currentPage = encodeURIComponent(window.location.href);
                const redirectUrl = `${data.redirectUrl}?redirect=${currentPage}`;
                
                // 少し待ってからリダイレクト
                setTimeout(() => {
                    window.location.href = redirectUrl;
                }, 1000);
            } else {
                // ログイン済みの場合の処理
                // ここに追加の処理を記述
                console.log('ログイン済み');
                // value属性の値を取得
                const checkboxSubID = this.value
                 // ログイン済みの場合、お気に入り登録処理を実行
                 const favoriteResponse = await fetch('./add_favorite.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        subID: checkboxSubID  // ここには実際のsubIDを設定
                    })
                });
                const data = await favoriteResponse.json();
                console.log('insert 完了', data.success);

            }
        } catch (error) {
            console.error('エラーが発生しました:', error);
            // エラー時はチェックを外す
            checkbox.checked = false;
        }
    } else {
        // セッション情報を確認するAPIを呼び出し
        const response = await fetch('./check_session.php');
        const data = await response.json();
        console.log('ログインは　',data);

        if (!data.isLoggedIn) {
            // ログインしていない場合はメッセージを表示し、
            // ログイン画面へリダイレクト
            
            // 現在のURLをクエリパラメータとして付加（ログイン後の戻り先として）
            const currentPage = encodeURIComponent(window.location.href);
            const redirectUrl = `${data.redirectUrl}?redirect=${currentPage}`;
            
            // 少し待ってからリダイレクト
            setTimeout(() => {
                window.location.href = redirectUrl;
            }, 1000);
        } else {
            // ログイン済みの場合の処理
            // ここに追加の処理を記述
            console.log('ログイン済み');
            // value属性の値を取得
            const checkboxSubID = this.value
             // ログイン済みの場合、お気に入り登録処理を実行
             const favoriteResponse = await fetch('./del_favorite.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    subID: checkboxSubID  // ここには実際のsubIDを設定
                })
            });
            const data = await favoriteResponse.json();
            console.log('delete 完了', data.success);

        }


    }
});