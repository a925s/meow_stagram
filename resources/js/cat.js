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