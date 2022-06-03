function changeShortcode(id) {
    openShortcodeWindow();
}

function openShortcodeWindow() {
    document.body.setAttribute('overflow', 'hidden');
    let windowId = document.getElementById('shortcode-editor-admin-panel-change-window');
    if(!windowId) {
        document.body.append('<div>TEST</div>');
    }
}

window.onload = function() {
    
}