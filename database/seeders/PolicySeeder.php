<?php

namespace Database\Seeders;

use App\Models\Ministry;
use App\Models\Policy;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kemenkes = Ministry::where('slug', 'kementerian-kesehatan')->first();
        $kominfo = Ministry::where('slug', 'kementerian-komunikasi-dan-informatika')->first();
        $kemdikbud = Ministry::where('slug', 'kementerian-pendidikan-kebudayaan-riset-dan-teknologi')->first();
        $kemenkumham = Ministry::where('slug', 'kementerian-hukum-dan-ham')->first();

        $policies = [
            [
                'ministry_id' => $kemenkes->id ?? null,
                'title' => 'RUU Sistem Kesehatan Nasional 2024',
                'summary' => 'Pembaruan komprehensif terhadap infrastruktur kesehatan publik, berfokus pada digitalisasi rekam medis dan pemerataan fasilitas layanan tingkat pertama di daerah tertinggal.',
                'status' => 'public_evaluation',
                'document_url' => 'https://drive.google.com/file/d/1FQGnkjDuzhLB194tD-0jTOGLXdUax-5g/view?usp=drive_link',
                'deadline_date' => Carbon::now()->addDays(14),
                'points' => [
                    ['icon' => 'medical_services', 'title' => 'Fasilitas Merata', 'description' => 'Pemerataan faskes tingkat pertama di seluruh pelosok desa.'],
                    ['icon' => 'computer', 'title' => 'Digitalisasi Medis', 'description' => 'Integrasi rekam medis secara nasional dalam satu platform terpusat.']
                ]
            ],
            [
                'ministry_id' => $kominfo->id ?? null,
                'title' => 'RUU Perlindungan Data Pribadi (RUU PDP)',
                'summary' => 'Menjamin hak dasar warga negara terkait pelindungan diri dan data pribadi mereka di era digital, termasuk kewajiban korporasi melaporkan kebocoran data.',
                'status' => 'public_evaluation',
                'document_url' => 'https://drive.google.com/file/d/1FQGnkjDuzhLB194tD-0jTOGLXdUax-5g/view?usp=drive_link',
                'deadline_date' => Carbon::now()->addDays(21),
                'points' => [
                    ['icon' => 'shield_person', 'title' => 'Hak Subjek Data', 'description' => 'Masyarakat berhak mengakses, memperbaiki, dan menghapus data pribadi mereka.'],
                    ['icon' => 'gavel', 'title' => 'Sanksi Tegas', 'description' => 'Penerapan sanksi administratif hingga pidana bagi penyalahguna data.']
                ]
            ],
            [
                'ministry_id' => $kemdikbud->id ?? null,
                'title' => 'Revisi Kurikulum Merdeka Terpadu',
                'summary' => 'Penyesuaian indikator pencapaian siswa berbasis proyek, integrasi kemampuan literasi digital sejak sekolah dasar, dan fleksibilitas jam mengajar bagi tenaga pendidik.',
                'status' => 'draft',
                'document_url' => 'https://drive.google.com/file/d/1FQGnkjDuzhLB194tD-0jTOGLXdUax-5g/view?usp=drive_link',
                'deadline_date' => Carbon::now()->addDays(5),
                'points' => [
                    ['icon' => 'school', 'title' => 'Literasi Digital', 'description' => 'Mata pelajaran literasi digital diwajibkan sejak jenjang SD.'],
                ]
            ],
            [
                'ministry_id' => $kemenkumham->id ?? null,
                'title' => 'RUU Perampasan Aset Koruptor',
                'summary' => 'Regulasi baru untuk mempercepat proses perampasan aset hasil tindak pidana korupsi, termasuk aset yang diparkir di luar negeri melalui kerja sama internasional.',
                'status' => 'approved',
                'document_url' => 'https://drive.google.com/file/d/1FQGnkjDuzhLB194tD-0jTOGLXdUax-5g/view?usp=drive_link',
                'deadline_date' => Carbon::now()->subDays(1),
                'points' => [
                    ['icon' => 'account_balance', 'title' => 'Aset Luar Negeri', 'description' => 'Mekanisme pelacakan dan penyitaan aset koruptor yang disembunyikan di luar negeri.']
                ]
            ],
        ];

        foreach ($policies as $data) {
            $policy = Policy::firstOrCreate(
                ['slug' => Str::slug($data['title'])],
                [
                    'ministry_id' => $data['ministry_id'],
                    'title' => $data['title'],
                    'summary' => $data['summary'],
                    'status' => $data['status'],
                    'document_url' => $data['document_url'],
                    'deadline_date' => $data['deadline_date'],
                ]
            );

            if (isset($data['points']) && $policy->wasRecentlyCreated) {
                foreach ($data['points'] as $point) {
                    $policy->points()->create($point);
                }
            }
        }
    }
}
