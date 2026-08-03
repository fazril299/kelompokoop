<?php

class StudentManager
{
    /** @var Validator */
    private $validator;

    /**
     * Master Jurusan
     * @var string[]
     */
    private $jurusanList = [
        "PPLG",
        "TJKT",
        "DKV",
        "MPLB",
        "AKL",
        "BDP"
    ];

    /**
     * Master Kelas
     * @var string[]
     */
    private $kelasList = [
        "X PPLG 1",
        "X PPLG 2",
        "XI PPLG 1",
        "XI PPLG 2",
        "XII PPLG 1",
        "XII PPLG 2",

        "X TJKT 1",
        "XI TJKT 1",
        "XII TJKT 1",

        "X DKV 1",
        "XI DKV 1",
        "XII DKV 1",

        "X AKL 1",
        "XI AKL 1",
        "XII AKL 1",

        "X BDP 1",
        "XI BDP 1",
        "XII BDP 1"
    ];

    /**
     * Default jumlah data per halaman
     * @var int
     */
    private $perPage = 5;

    public function __construct()
    {
        $this->validator = new Validator();
    }

    /**
     * Mengambil seluruh data dari session
     * @return Student[]
     */
    private function load()
    {
        return $_SESSION['students'] ?? [];
    }

    /**
     * Menyimpan data ke session
     * @param Student[] $students
     * @return void
     */
    private function save($students)
    {
        $_SESSION['students'] = $students;
    }

    /**
     * Generate ID otomatis
     * @return string
     */
    private function generateId()
    {
        return uniqid("STD");
    }

    /**
     * Flash Message
     * @param string $message
     * @return void
     */
    private function flash($message)
    {
        $_SESSION['flash'] = $message;
    }

    /**
     * Redirect
     * @param string $url
     * @return void
     */
    private function redirect($url = "index.php")
    {
        header("Location: " . $url);
        exit;
    }

    /**
     * Ambil satu data
     * @param string $id
     * @return Student|null
     */
    public function find($id)
    {
        foreach ($this->load() as $student) {

            if ($student->getId() == $id) {
                return $student;
            }
        }

        return null;
    }

    /**
     * Total Data
     * @return int
     */
    public function totalStudent()
    {
        return count($this->load());
    }

    /**
     * Nilai rata-rata
     * @return float|int
     */
    public function averageScore()
    {
        $students = $this->load();

        if (count($students) == 0) {
            return 0;
        }

        $total = 0;

        foreach ($students as $student) {

            $total += $student->getNilai();
        }

        return round($total / count($students), 2);
    }

    /**
     * Nilai tertinggi
     * @return int|float
     */
    public function highestScore()
    {
        $students = $this->load();

        if (empty($students)) {
            return 0;
        }

        $nilai = [];

        foreach ($students as $student) {

            $nilai[] = $student->getNilai();
        }

        return max($nilai);
    }

    /**
     * Nilai terendah
     * @return int|float
     */
    public function lowestScore()
    {
        $students = $this->load();

        if (empty($students)) {
            return 0;
        }

        $nilai = [];

        foreach ($students as $student) {

            $nilai[] = $student->getNilai();
        }

        return min($nilai);
    }

    /**
     * Mengambil semua data
     * @param string $keyword
     * @param string $sort
     * @return Student[]
     */
    public function getAll($keyword = "", $sort = "")
    {

        $students = $this->load();

        /*
        ========================
        SEARCH
        ========================
        */

        if ($keyword != "") {

            $students = array_filter($students, function ($student) use ($keyword) {

                return
                    stripos($student->getNama(), $keyword) !== false
                    ||
                    stripos($student->getNis(), $keyword) !== false
                    ||
                    stripos($student->getJurusan(), $keyword) !== false;
            });
        }

        /*
        ========================
        SORT
        ========================
        */

        switch ($sort) {

            case "nama_asc":

                usort($students, function ($a, $b) {

                    return strcmp(
                        $a->getNama(),
                        $b->getNama()
                    );
                });

                break;

            case "nama_desc":

                usort($students, function ($a, $b) {

                    return strcmp(
                        $b->getNama(),
                        $a->getNama()
                    );
                });

                break;

            case "nilai_asc":

                usort($students, function ($a, $b) {

                    return $a->getNilai() <=> $b->getNilai();
                });

                break;

            case "nilai_desc":

                usort($students, function ($a, $b) {

                    return $b->getNilai() <=> $a->getNilai();
                });

                break;

            case "kelas":

                usort($students, function ($a, $b) {

                    return strcmp(
                        $a->getKelas(),
                        $b->getKelas()
                    );
                });

                break;
        }

        return $students;
    }

    /**
     * Simpan data baru
     * @param array $data
     * @return void
     */
    public function store($data)
    {

        $students = $this->load();

        $errors = $this->validator->validate(
            $data,
            $students
        );

        if (!empty($errors)) {

            $this->setErrors($errors);
            $this->setOld($data);

            header("Location:index.php?action=create");
            exit;
        }


        $students[] = new Student(

            $this->generateId(),

            $data['nis'],

            $data['nama'],

            $data['kelas'],

            $data['jurusan'],

            $data['email'],

            $data['nilai']

        );

        $this->save($students);

        $this->flash("Data berhasil ditambahkan.");

        $this->redirect();
    }

    /**
     * Update data
     * @param string $id
     * @param array $data
     * @return void
     */
    public function update($id, $data)
    {
        $students = $this->load();

        $errors = $this->validator->validate(
            $data,
            $students,
            $id
        );

        if (!empty($errors)) {

            $this->setErrors($errors);
            $this->setOld($data);

            header("Location:index.php?action=edit&id=" . $id);
            exit;
        }

        foreach ($students as $student) {

            if ($student->getId() == $id) {

                $student->update($data);

                break;
            }
        }

        $this->save($students);

        $this->flash("Data berhasil diubah.");

        $this->redirect();
    }

    /**
     * Hapus data
     * @param string $id
     * @return void
     */
    public function delete($id)
    {
        $students = [];

        foreach ($this->load() as $student) {

            if ($student->getId() != $id) {
                $students[] = $student;
            }
        }

        $this->save($students);

        $this->flash("Data berhasil dihapus.");

        $this->redirect();
    }

    /**
     * Filter berdasarkan jurusan
     * @param Student[] $students
     * @param string $jurusan
     * @return Student[]
     */
    public function filterJurusan($students, $jurusan)
    {
        if ($jurusan == "") {
            return $students;
        }

        return array_filter($students, function ($student) use ($jurusan) {

            return $student->getJurusan() == $jurusan;
        });
    }

    /**
     * Filter berdasarkan kelas
     * @param Student[] $students
     * @param string $kelas
     * @return Student[]
     */
    public function filterKelas($students, $kelas)
    {
        if ($kelas == "") {
            return $students;
        }

        return array_filter($students, function ($student) use ($kelas) {

            return $student->getKelas() == $kelas;
        });
    }

    /**
     * Pagination
     * @param Student[] $students
     * @param int $page
     * @param int|null $perPage
     * @return array
     */
    public function pagination($students, $page = 1, $perPage = null)
    {
        if ($perPage == null) {
            $perPage = $this->perPage;
        }

        $totalData = count($students);

        $totalPage = max(1, ceil($totalData / $perPage));

        if ($page < 1) {
            $page = 1;
        }

        if ($page > $totalPage) {
            $page = $totalPage;
        }

        $offset = ($page - 1) * $perPage;

        return [
            "data" => array_slice($students, $offset, $perPage),
            "currentPage" => $page,
            "totalPage" => $totalPage,
            "totalData" => $totalData,
            "perPage" => $perPage
        ];
    }

    /**
     * Ambil seluruh jurusan unik
     * @return string[]
     */
    public function getJurusanList()
    {
        return $this->jurusanList;
    }

    /**
     * Ambil seluruh kelas unik
     * @return string[]
     */
    public function getKelasList()
    {
        return $this->kelasList;
    }

    /**
     * Hapus seluruh data
     * @return void
     */
    public function clear()
    {
        $_SESSION['students'] = [];

        $this->flash("Semua data berhasil dihapus.");

        $this->redirect();
    }

    /**
     * Seed data contoh
     * @return void
     */
    public function seed()
    {
        if (count($_SESSION['students']) > 0) {
            return;
        }

        $nama = [
            "Andi",
            "Budi",
            "Citra",
            "Dewi",
            "Eko",
            "Farhan",
            "Galih",
            "Hasna",
            "Indra",
            "Joko",
            "Kevin",
            "Lina",
            "Maya",
            "Nanda",
            "Oki",
            "Putri",
            "Rizki",
            "Salsa",
            "Tono",
            "Yusuf"
        ];

        for ($i = 0; $i < 20; $i++) {

            $_SESSION['students'][] = new Student(

                $this->generateId(),

                "2025" . rand(1000, 9999),

                $nama[$i],

                $this->kelasList[array_rand($this->kelasList)],

                $this->jurusanList[array_rand($this->jurusanList)],

                strtolower($nama[$i]) . "@gmail.com",

                rand(70, 100)

            );
        }
    }

    /**
     * Ambil flash message
     * @return string
     */
    public function getFlash()
    {
        $message = $_SESSION['flash'] ?? "";

        $_SESSION['flash'] = "";

        return $message;
    }

    /**
     * Menyimpan error validasi
     * @param array $errors
     * @return void
     */
    private function setErrors($errors)
    {
        $_SESSION['errors'] = $errors;
    }

    /**
     * Mengambil error validasi
     * @return array
     */
    public function getErrors()
    {
        $errors = $_SESSION['errors'] ?? [];
        unset($_SESSION['errors']);

        return $errors;
    }

    /**
     * Menyimpan old input
     * @param array $data
     * @return void
     */
    private function setOld($data)
    {
        $_SESSION['old'] = $data;
    }

    /**
     * Mengambil old input
     * @return array
     */
    public function getOld()
    {
        $old = $_SESSION['old'] ?? [];
        unset($_SESSION['old']);

        return $old;
    }
}

