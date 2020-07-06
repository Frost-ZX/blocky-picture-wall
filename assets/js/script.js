/* 全屏 */

// 进入全屏
function fullscreenEnter() {
    $('#fullscreen').html('退出');
    var docElm = document.documentElement;
    if (docElm.requestFullscreen) {
        // W3C
        docElm.requestFullscreen();
    } else if (docElm.mozRequestFullScreen) {
        // FireFox
        docElm.mozRequestFullScreen();
    } else if (docElm.webkitRequestFullScreen) {
        // Chrome 等
        docElm.webkitRequestFullScreen();
    } else if (elem.msRequestFullscreen) {
        // IE11
        elem.msRequestFullscreen();
    }
}

// 退出全屏
function fullscreenExit() {
    $('#fullscreen').html('全屏');
    if (document.exitFullscreen) {
        document.exitFullscreen();
    } else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
    } else if (document.webkitCancelFullScreen) {
        document.webkitCancelFullScreen();
    } else if (document.msExitFullscreen) {
        document.msExitFullscreen();
    }
}

// 绑定事件
$('#fullscreen').on('click', function () {
    $(this).html() == '全屏' ? fullscreenEnter() : fullscreenExit();
})
