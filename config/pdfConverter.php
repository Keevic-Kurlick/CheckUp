<?php

return [
    'pdf_renderer'          => PhpOffice\PhpWord\Settings::PDF_RENDERER_DOMPDF,
    'renderer_library_path' => base_path() . '/vendor/dompdf/dompdf',
    'defaultFontName'       => 'DejaVu Sans',
];