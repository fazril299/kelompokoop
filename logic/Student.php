<?php

class Student
{
    private $id;
    private $nis;
    private $nama;
    private $kelas;
    private $jurusan;
    private $email;
    private $nilai;

    public function __construct(
        $id,
        $nis,
        $nama,
        $kelas,
        $jurusan,
        $email,
        $nilai
    ) {
        $this->id = $id;
        $this->nis = $nis;
        $this->nama = $nama;
        $this->kelas = $kelas;
        $this->jurusan = $jurusan;
        $this->email = $email;
        $this->nilai = $nilai;
    }

    /* ==========================
       Getter
    ========================== */

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

    /* ==========================
       Setter
    ========================== */

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

    /* ==========================
       Update seluruh data
    ========================== */

    public function update($data)
    {
        $this->nis = $data['nis'];
        $this->nama = $data['nama'];
        $this->kelas = $data['kelas'];
        $this->jurusan = $data['jurusan'];
        $this->email = $data['email'];
        $this->nilai = $data['nilai'];
    }

    /* ==========================
       Status Kelulusan
    ========================== */

    public function isPassed()
    {
        return $this->nilai >= 75;
    }

    /* ==========================
       Grade
    ========================== */

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

    /* ==========================
       Predikat
    ========================== */

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

    /* ==========================
       Konversi ke Array
    ========================== */

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
