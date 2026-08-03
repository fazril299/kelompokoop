<?php

$isEdit = $student !== null;

$title = $isEdit ? "Edit Data Siswa" : "Tambah Data Siswa";

$action = $isEdit
    ? "index.php?action=update&id=" . urlencode($student->getId())
    : "index.php?action=store";

$old = $manager->getOld();
$errors = $manager->getErrors();

require_once __DIR__ . '/../layout/header.php';

function oldValue($key, $old, $student = null)
{
    if (isset($old[$key])) {
        return htmlspecialchars($old[$key]);
    }

    if ($student !== null) {

        switch ($key) {

            case 'nis':
                return htmlspecialchars($student->getNis());

            case 'nama':
                return htmlspecialchars($student->getNama());

            case 'kelas':
                return htmlspecialchars($student->getKelas());

            case 'jurusan':
                return htmlspecialchars($student->getJurusan());

            case 'email':
                return htmlspecialchars($student->getEmail());

            case 'nilai':
                return htmlspecialchars($student->getNilai());
        }
    }

    return '';
}

?>

<div class="row justify-content-center">

    <div class="col-lg-8">

        <div class="card shadow">

            <div class="card-header bg-primary text-white">

                <h4 class="mb-0"><?= $title ?></h4>

            </div>

            <div class="card-body">

                <?php if (!empty($errors)): ?>

                    <div class="alert alert-danger">

                        <strong>Terjadi kesalahan:</strong>

                        <ul class="mb-0 mt-2">

                            <?php foreach ($errors as $error): ?>

                                <li><?= htmlspecialchars($error) ?></li>

                            <?php endforeach; ?>

                        </ul>

                    </div>

                <?php endif; ?>


                <form action="<?= $action ?>" method="POST">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                NIS

                            </label>

                            <input
                                type="text"
                                name="nis"
                                required
                                class="form-control"
                                value="<?= oldValue('nis', $old, $student) ?>">

                        </div>


                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Nama

                            </label>

                            <input
                                type="text"
                                name="nama"
                                required
                                class="form-control"
                                value="<?= oldValue('nama', $old, $student) ?>">

                        </div>


                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Email

                            </label>

                            <input
                                type="email"
                                name="email"
                                required
                                class="form-control"
                                value="<?= oldValue('email', $old, $student) ?>">

                        </div>


                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Nilai

                            </label>

                            <input
                                type="number"
                                name="nilai"
                                required
                                min="0"
                                max="100"
                                class="form-control"
                                value="<?= oldValue('nilai', $old, $student) ?>">

                        </div>


                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Jurusan

                            </label>

                            <select
                                name="jurusan"
                                required
                                class="form-select">

                                <option value="">-- Pilih Jurusan --</option>

                                <?php foreach ($jurusanList as $item): ?>

                                    <option
                                        value="<?= htmlspecialchars($item) ?>"
                                        <?= oldValue('jurusan', $old, $student) == $item ? 'selected' : '' ?>>

                                        <?= htmlspecialchars($item) ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>


                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Kelas

                            </label>

                            <select
                                name="kelas"
                                required
                                class="form-select">

                                <option value="">-- Pilih Kelas --</option>

                                <?php foreach ($kelasList as $item): ?>

                                    <option
                                        value="<?= htmlspecialchars($item) ?>"
                                        <?= oldValue('kelas', $old, $student) == $item ? 'selected' : '' ?>>

                                        <?= htmlspecialchars($item) ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                    </div>


                    <div class="d-flex justify-content-between">

                        <a
                            href="index.php"
                            class="btn btn-secondary">

                            Kembali

                        </a>

                        <button
                            type="submit"
                            class="btn btn-primary">

                            <?= $isEdit ? 'Update Data' : 'Simpan Data' ?>

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>