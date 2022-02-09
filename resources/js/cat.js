$('.post-box').hover(
    function() {
        const hover_id = $(this).data('hover-id');
        //マウスカーソルが重なった時の処理
        $('.hover-box-' + hover_id).delay(1000).css('display', 'block');
        
    },
    function() {
        const hover_id = $(this).data('hover-id');
        //マウスカーソルが離れた時の処理
        $('.hover-box-' + hover_id).css('display', 'none');
        
    }
);

$('.modal-name').click(function () {
    const user_id = $(this).data('user-id');
    const post_user_id = $(this).data('post-user-id');
    if(user_id == post_user_id){
        window.location.href = '/mypage/post';
    }else{
        window.location.href = '/user/' + post_user_id;
    }
});