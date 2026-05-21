<?php

namespace Database\Seeders;

use App\Models\Media;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    public function run(): void
    {
        $files = glob(storage_path('app/public/uploads/*'));
        $count = 0;

        foreach ($files as $file) {
            if (!is_file($file)) continue;
            $filename = basename($file);

            if (Media::where('filename', $filename)->exists()) continue;

            Media::create([
                'filename' => $filename,
                'url' => '/storage/uploads/' . $filename,
                'alt' => $filename,
                'size' => filesize($file),
                'mime_type' => mime_content_type($file) ?: 'image/jpeg',
            ]);
            $count++;
        }

        echo "$count media kaydı oluşturuldu.\n";
    }
}
