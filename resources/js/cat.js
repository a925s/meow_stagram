///////////////////////////////////////
// いいね！用のJavaScript
///////////////////////////////////////

$(function () {
    // いいね！がクリックされたとき
    $('.js-like').click(function () {
        const this_obj = $(this);
        const post_id = $(this).data('post-id');
        const like_id = $(this).data('like-id');
        const like_count_obj = $(this).parent().parent().find('.js-like-count');
        let like_count = Number(like_count_obj.html());

        if (like_id) {
            // いいね！取り消し
            // 非同期通信
            $.ajax({
                headers: { //HTTPヘッダ情報をヘッダ名と値のマップで記述
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                }, 
                url: '/like',
                type: 'POST',
                data: {
                    'like_id': like_id
                },
                timeout: 10000
            })
                // 取り消しが成功
                .done(() => {
                    // いいね！カウントを減らす
                    like_count--;
                    like_count_obj.html(like_count);
                    this_obj.data('like-id', null);

                    // いいね！ボタンをデフォルトに変更
                    $(this).find('img').attr('src', '/img/like.png');
                })
                .fail((data) => {
                    alert('処理中にエラーが発生しました。');
                    console.log(data);
                });
        } else {
            // いいね！付与
            // 非同期通信
            $.ajax({
                headers: { //HTTPヘッダ情報をヘッダ名と値のマップで記述
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                },
                url: '/like',
                type: 'POST',
                data: {
                    'post_id': post_id
                },
                timeout: 10000
            })
                // いいね！が成功
                .done((data) => {
                    // いいね！カウントを増やす
                    like_count++;
                    like_count_obj.html(like_count);
                    this_obj.data('like-id', data['like_id']);

                    // いいね！ボタンの色を赤に変更
                    $(this).find('img').attr('src', '/img/like-red.png');
                })
                .fail((data) => {
                    alert('処理中にエラーが発生しました。');
                    console.log(data);
                });
        }
    });
})