require('./bootstrap');

/**
 * 
 * @param {event} event Js event
 * @param {element} el Reply element
 */
window.comment_reply = function (event, CommentId, authorName) {
    event.preventDefault();
    $('form#post_comment input[name=parent_id]').val(CommentId);
    $('.post-comment-reply strong').html(authorName);
    $('.post-comment-reply').removeClass('d-none');
    $([document.documentElement, document.body]).animate({
        scrollTop: $("form#post_comment").parents('.card').offset().top - 10
    }, 500);
}

window.comment_reply_cancel = function (event) {
    event.preventDefault();
    $('form#post_comment input[name=parent_id]').val('');
    $('.post-comment-reply').addClass('d-none');
}
