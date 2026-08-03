<?php

class Student
{
    // Data pribadi siswa (disimpan private agar aman)
    private $id;
    private $nis;
    private $nama;
    private $kelas;
    private $jurusan;
    private $email;
    private $nilai;

    // Saat objek siswa dibuat, langsung isi semua datanya
    public function __construct($id, $nis, $nama, $kelas, $jurusan, $email, $nilai)
    {
        $this->id = $id;
        $this->nis = $nis;
        $this->nama = $nama;
        $this->kelas = $kelas;
        $this->jurusan = $jurusan;
        $this->email = $email;
        $this->nilai = $nilai;
    }

    // ==========================================
    // GETTER - Fungsi untuk MENGAMBIL data siswa
    // ==========================================

    public function getId()
    {
        return $this->id;
    }

    public function getNis()
    {
        return $this->nis;
    }

    public function getNama()
    {
        return $this->nama;
    }

    public function getKelas()
    {
        return $this->kelas;
    }

    public function getJurusan()
    {
        return $this->jurusan;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getNilai()
    {
        return $this->nilai;
    }

    // ==========================================
    // SETTER - Fungsi untuk MENGUBAH data siswa
    // ==========================================

    public function setNis($nis)
    {
        $this->nis = $nis;
    }

    public function setNama($nama)
    {
        $this->nama = $nama;
    }

    public function setKelas($kelas)
    {
        $this->kelas = $kelas;
    }

    public function setJurusan($jurusan)
    {
        $this->jurusan = $jurusan;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setNilai($nilai)
    {
        $this->nilai = $nilai;
    }

    // ==========================================
    // UPDATE - Ubah semua data siswa sekaligus
    // ==========================================

    public function update($data)
    {
        $this->nis = $data['nis'];
        $this->nama = $data['nama'];
        $this->kelas = $data['kelas'];
        $this->jurusan = $data['jurusan'];
        $this->email = $data['email'];
        $this->nilai = $data['nilai'];
    }

    // ==========================================
    // CEK KELULUSAN - Lulus jika nilai >= 75
    // ==========================================

    public function isPassed()
    {
        return $this->nilai >= 75;
    }

    // ==========================================
    // GRADE - Ubah angka jadi huruf (A/B/C/D/E)
    // ==========================================

    public function getGrade()
    {
        if ($this->nilai >= 90) {
            return "A";
        }
        if ($this->nilai >= 80) {
            return "B";
        }
        if ($this->nilai >= 70) {
            return "C";
        }
        if ($this->nilai >= 60) {
            return "D";
        }
        return "E";
    }

    // ==========================================
    // PREDIKAT - Terjemahkan grade jadi kata
    // ==========================================

    public function getPredicate()
    {
        switch ($this->getGrade()) {
            case "A":
                return "Sangat Baik";
            case "B":
                return "Baik";
            case "C":
                return "Cukup";
            case "D":
                return "Kurang";
            default:
                return "Sangat Kurang";
        }
    }

    // ==========================================
    // KONVERSI KE ARRAY - Bungkus semua jadi array
    // ==========================================

    public function toArray()
    {
        return [
            'id' => $this->id,
            'nis' => $this->nis,
            'nama' => $this->nama,
            'kelas' => $this->kelas,
            'jurusan' => $this->jurusan,
            'email' => $this->email,
            'nilai' => $this->nilai,
            'grade' => $this->getGrade(),
            'predikat' => $this->getPredicate(),
            'lulus' => $this->isPassed()
        ];
    }
}
