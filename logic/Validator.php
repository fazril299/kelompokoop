<?php

class Validator
{
    /**
     * @param array $data
     * @param Student[] $students
     * @param string|null $ignoreId
     * @return array
     */
    public function validate($data, $students, $ignoreId = null)
    {
        $errors = [];

        if (trim($data['nis']) == '') {
            $errors[] = "NIS wajib diisi.";
        }

        if (trim($data['nama']) == '') {
            $errors[] = "Nama wajib diisi.";
        }

        if (trim($data['kelas']) == '') {
            $errors[] = "Kelas wajib diisi.";
        }

        if (trim($data['jurusan']) == '') {
            $errors[] = "Jurusan wajib dipilih.";
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email tidak valid.";
        }

        if (!is_numeric($data['nilai'])) {
            $errors[] = "Nilai harus berupa angka.";
        } else {

            if ($data['nilai'] < 0 || $data['nilai'] > 100) {
                $errors[] = "Nilai harus antara 0 - 100.";
            }

        }

        foreach ($students as $student) {

            if (
                $student->getNis() == $data['nis']
                &&
                $student->getId() != $ignoreId
            ) {
                $errors[] = "NIS sudah digunakan.";
                break;
            }

        }

        return $errors;
    }
}