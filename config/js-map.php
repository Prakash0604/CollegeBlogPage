<?php

return [

    'admin' => [
        'summernote' => [

            'script' => [
                'https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js',
            ],

            'style' => [
                'https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css',
            ]
        ],

        'select2' => [

            'script' => [
                'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js'
            ],

            'style' => [
                'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css'
            ]
        ],

        'datatable' => [

            'script' => [

                'https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js'
            ],

            'style' => [
                'https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css'
            ]
        ],

        'chartjs' => [
            'https://cdn.jsdelivr.net/npm/chart.js'
        ],

        'buttons' => [
            'script'=>[
                // {{-- Datatable Button --}}
                'https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js',

                // <!-- HTML5 Export (for CSV, Excel, PDF) -->
                'https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js',

                // <!-- Print Button -->
                'https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js',

                // <!-- JSZip (for Excel) -->
                'https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js',

                // <!-- pdfmake (for PDF) -->
                'https://cdn.jsdelivr.net/npm/pdfmake@0.2.7/build/pdfmake.min.js',
                'https://cdn.jsdelivr.net/npm/pdfmake@0.2.7/build/vfs_fonts.js',
            ],
            'style'=>[
                'https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css'
            ]
        ]
    ],

];
