<?php

return [
    'model'       => '',
    'permissions' => [

    ],
    'exceptions'  => [

    ],
    'validations' => [

    ],
    'enum'        => [
        'type' => [
            'about_us' => 'About Us'
        ]
    ],

    'pages' => [
        'about_us'         => 'Om os',
        'about_restaurant' => 'Om Restaurant',
        'about'            => [
            'services' => [
                'service1' => [
                    'title' => 'maden er altid frisk',
                    'desc'  => 'Den mad, vi vælger, er altid frisk og omhyggeligt kontrolleret inden forarbejdning.',
                ],
                'service2' => [
                    'title' => 'Luksus rum og musik',
                    'desc'  => 'Hvad er bedre end at nyde lækker mad og musik på samme tid.',
                ],
                'service3' => [
                    'title' => 'Diverse madmenu',
                    'desc'  => 'Maden i restauranten er lækker og varieret',
                ],
            ]
        ],

        'menu' => [
            'page_title' => 'vores menuer',
            'breadcrumb' => 'menu liste',
        ],

        'portfolio' => [
            'list' => [
                'page_title' => 'vores porteføljer',
                'breadcrumb' => 'portefølje liste',
            ],

            'detail' => [
                'page_title' => 'portefølje detaljer',
                'breadcrumb' => 'portefølje detaljer',
                'sidebar'    => [
                    'text'       => 'detalje',
                    'categories' => 'Kategorier',
                    'name'       => 'navn',
                    'date'       => 'dato',
                ],
            ],
        ],

        'blog' => [
            'list'   => [
                'page_title' => 'nye indlæg',
                'breadcrumb' => 'blog liste',
                'button'     => 'læs mere',
            ],
            'detail' => [
                'page_title' => 'blog detaljer',
                'breadcrumb' => 'blog detaljer',
                'sidebar'    => [
                    'text' => 'SENESTE OPSLAG',
                ]
            ],
        ],

        'gallery' => [
            'list'   => [
                'page_title' => 'liste over kunstgallerier',
                'breadcrumb' => 'galleri liste',
            ],
            'detail' => [
                'page_title' => 'galleri',
                'breadcrumb' => 'galleri',
            ],
        ],

        'contact' => [
            'page_title' => 'kontakt os',
            'breadcrumb' => 'kontakt os',
            'info'       => [
                'text-1' => 'Kontakt os',
                'text-2' => 'Adresse her',
                'text-3' => 'Åbningstider',
            ],
            'form'       => [
                'title'        => 'bare smid en linje!',
                'subtitle'     => 'Giv os et kald eller kig forbi når som helst, vi bestræber os på at besvare alle henvendelser inden for 24 timer på hverdage. Vi svarer gerne på dine spørgsmål.',
                'button'       => 'sende besked',
                'placeholders' => [
                    'name'    => 'Navn',
                    'phone'   => 'Telefon',
                    'email'   => 'E-mail',
                    'message' => 'Besked',
                ]
            ]
        ]
    ],
];
