@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde@2.9.0/dist/easymde.min.css">
    <link href="{{ theme_asset('css/modernity.css') }}" rel="stylesheet">
@endpush

@push('footer-scripts')
    <script src="https://cdn.jsdelivr.net/npm/easymde@2.9.0/dist/easymde.min.js"></script>
    <script>
        const markdownArea = document.querySelector('textarea');

        if (markdownArea) {
            new EasyMDE({
                element: markdownArea,
                autoDownloadFontAwesome: false,
                minHeight: '{{ $editorMinHeight ?? 300 }}px',
                promptURLs: true,
                spellChecker: false,
                showIcons: ['strikethrough', 'code', 'horizontal-rule', 'undo', 'redo'],
                status: false,
            });
        }
    </script>
@endpush
