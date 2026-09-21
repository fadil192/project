@include('errors.base', [
    'code' => 429,
    'title' => 'Terlalu Banyak Permintaan',
    'message' => 'Anda terlalu sering mengirim permintaan. Silakan tunggu beberapa saat lalu coba lagi.',
])