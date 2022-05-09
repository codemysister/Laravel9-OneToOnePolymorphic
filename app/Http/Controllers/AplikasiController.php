<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Beasiswa;
use Illuminate\Http\Request;

class AplikasiController extends Controller
{
    public function all()
    {
        echo "## Dosen ## <br>";
        $dosens = Dosen::all();
        foreach ($dosens as $dosen) {
            echo "$dosen->nama <br>";
        }

        echo "<hr>";

        echo "## Mahasiswa ## <br>";
        $mahasiswas = Mahasiswa::all();
        foreach ($mahasiswas as $mahasiswa) {
            echo "$mahasiswa->nama | $mahasiswa->jurusan <br>";
        }
    }

    public function inputBeasiswa1()
    {
        $dosen = Dosen::where('nama', 'Shania Pertiwi M.Sc')->first();

        $beasiswa = new Beasiswa;
        $beasiswa->nama = "Beasiswa Unggulan Dosen Indonesia";
        $beasiswa->jumlah_dana = 50000000;

        $dosen->beasiswa()->save($beasiswa);
        echo "$dosen->nama dapat beasiswa $beasiswa->nama";
    }

    public function inputBeasiswa2()
    {
        $mahasiswa = Mahasiswa::where('nama', 'Yuliana Nurdiyanti')->first();

        $beasiswa = new Beasiswa;
        $beasiswa->nama = "Beasiswa PPA";
        $beasiswa->jumlah_dana = 20000000;

        $mahasiswa->beasiswa()->save($beasiswa);
        echo "$mahasiswa->nama dapat beasiswa $beasiswa->nama <br>";

        $mahasiswa = Mahasiswa::where('nama', 'Kambali Prasetya')->first();

        $beasiswa = new Beasiswa;
        $beasiswa->nama = "Beasiswa Pertamina";
        $beasiswa->jumlah_dana = 33000000;

        $mahasiswa->beasiswa()->save($beasiswa);
        echo "$mahasiswa->nama dapat beasiswa $beasiswa->nama";
    }

    public function tampilBeasiswa1()
    {
        $dosen = Dosen::where('nama', 'Shania Pertiwi M.Sc')->first();
        echo "Dosen $dosen->nama mengambil beasiswa {$dosen->beasiswa->nama}";
    }

    public function tampilBeasiswa2()
    {
        $mahasiswas = Mahasiswa::has('beasiswa')->get();
        foreach ($mahasiswas as $mahasiswa) {
            echo "$mahasiswa->nama | {$mahasiswa->beasiswa->nama} <br>";
        }
    }

    public function tampilBeasiswa3()
    {
        $beasiswa = Beasiswa::find(2);
        echo "Yang dapat $beasiswa->nama adalah {$beasiswa->beasiswaable->nama}";
    }

    public function tampilBeasiswa4()
    {
        $beasiswas = Beasiswa::all();
        foreach ($beasiswas as $beasiswa) {
            echo "$beasiswa->nama | {$beasiswa->beasiswaable->nama} <br>";
        }
    }

    public function wherehasmorph1()
    {
        $beasiswas = Beasiswa::whereHasMorph(
            'beasiswaable',
            'App\Models\Mahasiswa'
        )->get();

        foreach ($beasiswas as $beasiswa) {
            echo "$beasiswa->nama | {$beasiswa->beasiswaable->nama} <br>";
        }
    }

    public function wherehasmorph2()
    {
        $beasiswas = Beasiswa::whereHasMorph(
            'beasiswaable',
            ['App\Models\Mahasiswa', 'App\Models\Dosen']
        )->get();

        foreach ($beasiswas as $beasiswa) {
            echo "$beasiswa->nama | {$beasiswa->beasiswaable->nama} <br>";
        }
    }

    public function updateBeasiswa1()
    {
        $mahasiswa = Mahasiswa::where('nama', 'Kambali Prasetya')->first();
        echo "Sebelum update: $mahasiswa->nama mendapatkan
 {$mahasiswa->beasiswa->nama}";

        echo "<hr>";

        $mahasiswa->beasiswa()->update([
            'nama' => 'Beasiswa Telkom'
        ]);

        $mahasiswa = Mahasiswa::where('nama', 'Kambali Prasetya')->first();
        echo "Setelah update: $mahasiswa->nama mendapatkan
 {$mahasiswa->beasiswa->nama}";
    }

    public function updateBeasiswa2()
    {
        $beasiswa = Beasiswa::where('nama', 'Beasiswa PPA')->first();
        echo "Sebelum update: $beasiswa->nama diambil oleh
 {$beasiswa->beasiswaable->nama}";

        echo "<hr>";

        $mahasiswa = Mahasiswa::where('nama', 'Pia Nasyidah')->first();
        $beasiswa->beasiswaable_id = $mahasiswa->id;
        $beasiswa->push();

        $beasiswa = Beasiswa::where('nama', 'Beasiswa PPA')->first();
        echo "Setelah update: $beasiswa->nama diambil oleh
 {$beasiswa->beasiswaable->nama}";
    }

    public function delete()
    {
        $dosen = Dosen::where('nama', 'Shania Pertiwi M.Sc')->first();
        $dosen->delete();
        $dosen->beasiswas()->delete();

        echo "Beasiswa $dosen->nama sudah dihapus";
    }
}
