///////////////////////////////////////
// ブックマーク用のJavaScript
///////////////////////////////////////
$(function () {
    // ブックマークがクリックされたとき
    $('.js-bookmark').click(function () {
        const this_obj = $(this);
        const post_id = $(this).data('post-id');
        const bookmark_id = $(this).data('bookmark-id');

        if (bookmark_id) {
            // ブックマーク取り消し
            // 非同期通信
            $.ajax({
                headers: { //HTTPヘッダ情報をヘッダ名と値のマップで記述
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                }, 
                url: '/bookmark',
                type: 'POST',
                data: {
                    'bookmark_id': bookmark_id
                },
                timeout: 10000
            })
                // 取り消しが成功
                .done(() => {
                    this_obj.data('bookmark-id', null);

                    // ブックマークボタンをデフォルトに変更
                    $(this).find('img').attr('src', '/img/bookmark.svg');
                })
                .fail((data) => {
                    alert('処理中にエラーが発生しました。');
                    console.log(data);
                });
        } else {
            // ブックマーク付与
            // 非同期通信
            $.ajax({
                headers: { //HTTPヘッダ情報をヘッダ名と値のマップで記述
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                },
                url: '/bookmark',
                type: 'POST',
                data: {
                    'post_id': post_id
                },
                timeout: 10000
            })
                // ブックマークが成功
                .done((data) => {
                    this_obj.data('bookmark-id', data['bookmark_id']);

                    // ブックマークボタンの色を黒に変更
                    $(this).find('img').attr('src', '/img/bookmark-black.svg');
                })
                .fail((data) => {
                    alert('処理中にエラーが発生しました。');
                    console.log(data);
                });
        }
    });
})