///////////////////////////////////////
// フォロー用のJavaScript
///////////////////////////////////////

$(function () {
    $('.js-follow').click(function () {
        const this_obj = $(this);
        const followed_user_id = $(this).data('followed-user-id');
        const follow_id = $(this).data('follow-id');
        const follow_count_obj = $(this).parents().find('.js-follow-count');
        let follow_count = Number(follow_count_obj.html());
        cache: false
        if (follow_id) {
            // フォロー取り消し
            $.ajax({
                headers: { //HTTPヘッダ情報をヘッダ名と値のマップで記述
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                }, 
                url: '/follow',
                type: 'POST',
                data: {
                    'follow_id': follow_id
                },
                timeout: 10000
            })
                // 取り消し成功
                .done(() => {
                    // フォロワーカウントを減らす
                    follow_count--;
                    follow_count_obj.html(follow_count);
                    // フォローボタンを白にする
                    this_obj.removeClass('btn-reverse');
                    // フォローボタンの文言変更
                    this_obj.text('フォローする');
                    // フォローIDを削除
                    this_obj.data('follow-id', null);
                })
                // 取り消し失敗
                .fail((data) => {
                    alert('処理中にエラーが発生しました。');
                    console.log(data);
                });
        } else {
            // フォローする
            $.ajax({
                headers: { //HTTPヘッダ情報をヘッダ名と値のマップで記述
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                }, 
                url: '/follow',
                type: 'POST',
                data: {
                    'followed_user_id': followed_user_id
                },
                timeout: 10000
            })
                // フォロー成功
                .done((data) => {
                    // フォローカウントを増やす
                    follow_count++;
                    follow_count_obj.html(follow_count);
                    // フォローボタンを茶色にする
                    this_obj.addClass('btn-reverse');
                    // フォローボタンの文言変更
                    this_obj.text('フォローを外す');
                    // フォローIDを付与
                    this_obj.data('follow-id', data['follow_id']);
                })
                // フォロー失敗
                .fail((data) => {
                    alert('処理中にエラーが発生しました。');
                    console.log(data);
                });
        }
    })
});