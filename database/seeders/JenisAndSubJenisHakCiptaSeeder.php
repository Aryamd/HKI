<?php

namespace Database\Seeders;

use App\Models\JenisHakCipta;
use App\Models\SubJenisHakCipta;
use Illuminate\Database\Seeder;

class JenisAndSubJenisHakCiptaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hc1 = JenisHakCipta::create(['nama' => 'Karya Fotografi']);
        SubJenisHakCipta::create(['nama' => 'Karya fotografi', 'jenis_hak_cipta_id' => $hc1->id]);
        SubJenisHakCipta::create(['nama' => 'Potret', 'jenis_hak_cipta_id' => $hc1->id]);

        $hc2 = JenisHakCipta::create(['nama' => 'Komposisi Musik']);
        SubJenisHakCipta::create(['nama' => 'Aransemen', 'jenis_hak_cipta_id' => $hc2->id]);
        SubJenisHakCipta::create(['nama' => 'Karya Rekaman Suara atau Bunyi', 'jenis_hak_cipta_id' => $hc2->id]);
        SubJenisHakCipta::create(['nama' => 'Lagu (music dengan teks)', 'jenis_hak_cipta_id' => $hc2->id]);
        SubJenisHakCipta::create(['nama' => 'Musik', 'jenis_hak_cipta_id' => $hc2->id]);
        SubJenisHakCipta::create(['nama' => 'Musik Blues', 'jenis_hak_cipta_id' => $hc2->id]);
        SubJenisHakCipta::create(['nama' => 'Musik Country', 'jenis_hak_cipta_id' => $hc2->id]);
        SubJenisHakCipta::create(['nama' => 'Musik Dangdut', 'jenis_hak_cipta_id' => $hc2->id]);
        SubJenisHakCipta::create(['nama' => 'Musik Elektronik', 'jenis_hak_cipta_id' => $hc2->id]);
        SubJenisHakCipta::create(['nama' => 'Musik Funk', 'jenis_hak_cipta_id' => $hc2->id]);
        SubJenisHakCipta::create(['nama' => 'Musik Gospel', 'jenis_hak_cipta_id' => $hc2->id]);
        SubJenisHakCipta::create(['nama' => 'Musik Hip Hop, Rap, Rapcore', 'jenis_hak_cipta_id' => $hc2->id]);
        SubJenisHakCipta::create(['nama' => 'Musik Jazz', 'jenis_hak_cipta_id' => $hc2->id]);
        SubJenisHakCipta::create(['nama' => 'Musik Karawitan, Klasik, Latin, Metal, Pop, Rythem and Blues, Rock, Ska, Reggae, Dub, Tanpa Teks', 'jenis_hak_cipta_id' => $hc2->id]);
        SubJenisHakCipta::create(['nama' => 'Musik tradisional', 'jenis_hak_cipta_id' => $hc2->id]);

        $hc3 = JenisHakCipta::create(['nama' => 'Karya Tulis']);
        SubJenisHakCipta::create(['nama' => 'Atlas', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Biografi', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Booklet', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Buku', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Buku Mewarnai', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Buku Panduan/Petunjuk', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Buku Pelajaran', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Buku Saku', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Bunga Rampai', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Cerita Bergambar', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Diktat', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Dongeng', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'e-Book', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Ensiklopedia', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Jurnal', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Kamus', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Karya Ilmiah', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Karya Tulis', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Artikel', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Karya Tulis, Disertasi, Tesis, Skripsi, Karya Tulis Lainnya', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Komik', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Laporan Penelitian', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Majalah', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Makalah', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Modul', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Naskah Drama/Pertunjukan', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Naskah Film', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Naskah Karya Siaran', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Novel', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Perwajahan Karya Tulis', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Proposal Penelitian', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Puisi', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Resensi', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Resume/Ringkasan', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Synopsis', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Tafsir', 'jenis_hak_cipta_id' => $hc3->id]);
        SubJenisHakCipta::create(['nama' => 'Terjemahan', 'jenis_hak_cipta_id' => $hc3->id]);

        $hc4 = JenisHakCipta::create(['nama' => 'Karya Seni']);
        SubJenisHakCipta::create(['nama' => 'Alat Peraga', 'jenis_hak_cipta_id' => $hc4->id]);
        SubJenisHakCipta::create(['nama' => 'Arsitektur', 'jenis_hak_cipta_id' => $hc4->id]);
        SubJenisHakCipta::create(['nama' => 'Baliho', 'jenis_hak_cipta_id' => $hc4->id]);
        SubJenisHakCipta::create(['nama' => 'Banner', 'jenis_hak_cipta_id' => $hc4->id]);
        SubJenisHakCipta::create(['nama' => 'Brosur', 'jenis_hak_cipta_id' => $hc4->id]);
        SubJenisHakCipta::create(['nama' => 'Diorama', 'jenis_hak_cipta_id' => $hc4->id]);
        SubJenisHakCipta::create(['nama' => 'Flyer', 'jenis_hak_cipta_id' => $hc4->id]);
        SubJenisHakCipta::create(['nama' => 'Kaligrafi', 'jenis_hak_cipta_id' => $hc4->id]);
        SubJenisHakCipta::create(['nama' => 'Karya Seni Batik', 'jenis_hak_cipta_id' => $hc4->id]);
        SubJenisHakCipta::create(['nama' => 'Karya Seni Rupa', 'jenis_hak_cipta_id' => $hc4->id]);
        SubJenisHakCipta::create(['nama' => 'Kolase', 'jenis_hak_cipta_id' => $hc4->id]);
        SubJenisHakCipta::create(['nama' => 'Leaflet', 'jenis_hak_cipta_id' => $hc4->id]);
        SubJenisHakCipta::create(['nama' => 'Motif Sasaringan', 'jenis_hak_cipta_id' => $hc4->id]);
        SubJenisHakCipta::create(['nama' => 'Motif Tapis', 'jenis_hak_cipta_id' => $hc4->id]);
        SubJenisHakCipta::create(['nama' => 'Motif Tenun Ikat', 'jenis_hak_cipta_id' => $hc4->id]);
        SubJenisHakCipta::create(['nama' => 'Motif Ulos', 'jenis_hak_cipta_id' => $hc4->id]);
        SubJenisHakCipta::create(['nama' => 'Pamflet', 'jenis_hak_cipta_id' => $hc4->id]);
        SubJenisHakCipta::create(['nama' => 'Peta', 'jenis_hak_cipta_id' => $hc4->id]);
        SubJenisHakCipta::create(['nama' => 'Poster', 'jenis_hak_cipta_id' => $hc4->id]);
        SubJenisHakCipta::create(['nama' => 'Seni Gambar', 'jenis_hak_cipta_id' => $hc4->id]);
        SubJenisHakCipta::create(['nama' => 'Seni Ilustrasi', 'jenis_hak_cipta_id' => $hc4->id]);
        SubJenisHakCipta::create(['nama' => 'Seni Lukis', 'jenis_hak_cipta_id' => $hc4->id]);
        SubJenisHakCipta::create(['nama' => 'Seni Motif', 'jenis_hak_cipta_id' => $hc4->id]);
        SubJenisHakCipta::create(['nama' => 'Seni Motif Lainnya', 'jenis_hak_cipta_id' => $hc4->id]);
        SubJenisHakCipta::create(['nama' => 'Seni Rupa', 'jenis_hak_cipta_id' => $hc4->id]);
        SubJenisHakCipta::create(['nama' => 'Seni Songket', 'jenis_hak_cipta_id' => $hc4->id]);
        SubJenisHakCipta::create(['nama' => 'Seni Terapan', 'jenis_hak_cipta_id' => $hc4->id]);
        SubJenisHakCipta::create(['nama' => 'Seni Umum', 'jenis_hak_cipta_id' => $hc4->id]);
        SubJenisHakCipta::create(['nama' => 'Senjata Tradisional', 'jenis_hak_cipta_id' => $hc4->id]);
        SubJenisHakCipta::create(['nama' => 'Sketsa', 'jenis_hak_cipta_id' => $hc4->id]);
        SubJenisHakCipta::create(['nama' => 'Spanduk', 'jenis_hak_cipta_id' => $hc4->id]);
        SubJenisHakCipta::create(['nama' => 'Ukiran', 'jenis_hak_cipta_id' => $hc4->id]);

        $hc5 = JenisHakCipta::create(['nama' => 'Karya Audio Visual']);
        SubJenisHakCipta::create(['nama' => 'Film', 'jenis_hak_cipta_id' => $hc5->id]);
        SubJenisHakCipta::create(['nama' => 'Film Cerita', 'jenis_hak_cipta_id' => $hc5->id]);
        SubJenisHakCipta::create(['nama' => 'Film Dokumenter', 'jenis_hak_cipta_id' => $hc5->id]);
        SubJenisHakCipta::create(['nama' => 'Film Kartun', 'jenis_hak_cipta_id' => $hc5->id]);
        SubJenisHakCipta::create(['nama' => 'Film Iklan', 'jenis_hak_cipta_id' => $hc5->id]);
        SubJenisHakCipta::create(['nama' => 'Karya Rekaman Video', 'jenis_hak_cipta_id' => $hc5->id]);
        SubJenisHakCipta::create(['nama' => 'Karya Siaran (Media Radio, Media TV, Film, Video)', 'jenis_hak_cipta_id' => $hc5->id]);
        SubJenisHakCipta::create(['nama' => 'Karya Sinematografi', 'jenis_hak_cipta_id' => $hc5->id]);
        SubJenisHakCipta::create(['nama' => 'Kuliah', 'jenis_hak_cipta_id' => $hc5->id]);
        SubJenisHakCipta::create(['nama' => 'Reportase', 'jenis_hak_cipta_id' => $hc5->id]);

        $hc6 = JenisHakCipta::create(['nama' => 'Karya Drama & Koreografi']);
        SubJenisHakCipta::create(['nama' => 'Drama/Pertunjukan', 'jenis_hak_cipta_id' => $hc6->id]);
        SubJenisHakCipta::create(['nama' => 'Drama Musikal', 'jenis_hak_cipta_id' => $hc6->id]);
        SubJenisHakCipta::create(['nama' => 'Ketoprak', 'jenis_hak_cipta_id' => $hc6->id]);
        SubJenisHakCipta::create(['nama' => 'Komedi/Lawak', 'jenis_hak_cipta_id' => $hc6->id]);
        SubJenisHakCipta::create(['nama' => 'Koreografi', 'jenis_hak_cipta_id' => $hc6->id]);
        SubJenisHakCipta::create(['nama' => 'Lenong', 'jenis_hak_cipta_id' => $hc6->id]);
        SubJenisHakCipta::create(['nama' => 'Ludruk', 'jenis_hak_cipta_id' => $hc6->id]);
        SubJenisHakCipta::create(['nama' => 'Opera', 'jenis_hak_cipta_id' => $hc6->id]);
        SubJenisHakCipta::create(['nama' => 'Pantomim', 'jenis_hak_cipta_id' => $hc6->id]);
        SubJenisHakCipta::create(['nama' => 'Pentas Musik', 'jenis_hak_cipta_id' => $hc6->id]);
        SubJenisHakCipta::create(['nama' => 'Pewayangan', 'jenis_hak_cipta_id' => $hc6->id]);
        SubJenisHakCipta::create(['nama' => 'Seni Akrobat', 'jenis_hak_cipta_id' => $hc6->id]);
        SubJenisHakCipta::create(['nama' => 'Seni Pertunjukan', 'jenis_hak_cipta_id' => $hc6->id]);
        SubJenisHakCipta::create(['nama' => 'Sirkus', 'jenis_hak_cipta_id' => $hc6->id]);
        SubJenisHakCipta::create(['nama' => 'Sulat', 'jenis_hak_cipta_id' => $hc6->id]);
        SubJenisHakCipta::create(['nama' => 'Tari (Sendra Tari)', 'jenis_hak_cipta_id' => $hc6->id]);

        $hc7 = JenisHakCipta::create(['nama' => 'Karya Rekaman']);
        SubJenisHakCipta::create(['nama' => 'Ceramah', 'jenis_hak_cipta_id' => $hc7->id]);
        SubJenisHakCipta::create(['nama' => 'Khotbah', 'jenis_hak_cipta_id' => $hc7->id]);
        SubJenisHakCipta::create(['nama' => 'Pidato', 'jenis_hak_cipta_id' => $hc7->id]);

        $hc8 = JenisHakCipta::create(['nama' => 'Karya Lainnya']);
        SubJenisHakCipta::create(['nama' => 'Basis Data', 'jenis_hak_cipta_id' => $hc8->id]);
        SubJenisHakCipta::create(['nama' => 'Kompilasi Ciptaan/Data', 'jenis_hak_cipta_id' => $hc8->id]);
        SubJenisHakCipta::create(['nama' => 'Permainan Video', 'jenis_hak_cipta_id' => $hc8->id]);
        SubJenisHakCipta::create(['nama' => 'Program Komputer', 'jenis_hak_cipta_id' => $hc8->id]);
    }
}
