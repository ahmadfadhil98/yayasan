<?php

return [
    'default_paginate_item' => 50,

    // 'baseUrl' => 'http://103.7.14.55/',
    'baseUrl' => 'http://lph-api.halal.go.id/',

    'status' => [
        'Ajuan' => 'Ajuan',
        'Biaya' => 'Biaya',
        'Periksa' => 'Periksa',
        'Fatwa' => 'Fatwa'
    ],

    'status_update' => [
        10010 => 'Ajuan',
        10020 => 'Biaya',
        10030 => 'Periksa',
        10040 => 'Fatwa'
    ],

    'status_permohonan' => [
        10010 => 'Dikirim ke LPH',
        10020 => 'Penetapan Biaya',
        10030 => 'Proses Di LPH',
        10040 => 'Selesai Proses LPH/Pendamping PPH'
    ],


];
