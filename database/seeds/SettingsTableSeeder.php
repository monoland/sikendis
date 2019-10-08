<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $model = new Setting();
        $model->id = 'company';
        $model->name = '<span class="headline font-weight-light">SI</span><span class="headline font-weight-bold">KENDIS</span>';
        $model->title = '<div class="d-block display-1 text-uppercase"><span class="font-weight-light">biro umum</span><span class="font-weight-bold"> setda banten</span></div>';
        $model->quote = '<span class="d-block text-justify">SIKENDIS (Sistem Informasi Kendaraan Dinas) merupakan aplikasi Hybrid yang dapat ditransformasikan menjadi kode native pada platform iOS, Android, Windows, Linux dan MacOS untuk mencatat pengajuan, persetujuan dan pelaporan perawatan kendaraan dinas di lingkungan SETDA Provinsi Banten.</span>';
        $model->logo = '/images/logo-holder.png';
        $model->background = '/images/back-holder.jpg';
        $model->height = '120px';
        $model->width = '120px';
        $model->save();
    }
}
