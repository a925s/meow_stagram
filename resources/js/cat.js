///////////////////////////////////////
// いいね！用のJavaScript
///////////////////////////////////////

$(function () {
    // いいね！がクリックされたとき
    $('.js-like').click(function () {
        const this_obj = $(this);
        const like_id = $(this).data('like-id');
        const like_count_obj = $(this).parent().find('.js-like-count');
        let like_count = Number(like_count_obj.html());

        if (like_id) {
            // いいね！取り消し
            // いいね！カウントを減らす
            like_count--;
            like_count_obj.html(like_count);
            this_obj.data('like-id', null);

            // いいね！ボタンの色をデフォルトに変更
            $(this).find('img').attr('src', 'url("../img/like.png")');
        } else {
            // いいね！付与
            // いいね！カウントを増やす
            like_count++;
            like_count_obj.html(like_count);
            this_obj.data('like-id', true);

            // いいね！ボタンの色を赤色に変更
            $(this).find('img').attr('src', '../img/like-red.png');
        }
    });
})