const SimpleMDE = require('simplemde')

$('.markdown-editor').each(function() {
    new SimpleMDE({
        element: this,
        status: false,
        hideIcons: ['guide', 'side-by-side', 'fullscreen'],
    }).render()
})
