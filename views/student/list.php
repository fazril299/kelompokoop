<?php
/**
 * @var string $flash
 * @var int $totalStudent
 * @var float|int $averageScore
 * @var float|int $highestScore
 * @var float|int $lowestScore
 * @var string $keyword
 * @var array $jurusanList
 * @var string $jurusan
 * @var array $kelasList
 * @var string $kelas
 * @var string $sort
 * @var array $pagination
 * @var Student[] $students
 */
require_once __DIR__ . '/../layout/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Data Siswa</h2>
        <small class="text-muted">CRUD OOP PHP dengan Session</small>
    </div>

    <div class="d-flex gap-2">
        <a href="index.php?action=create" class="btn btn-primary">
            Tambah Data
        </a>
        <a href="index.php?action=seed" class="btn btn-success">
            Seed Data
        </a>
        <a href="index.php?action=clear"
            onclick="return confirm('Hapus semua data?')"
            class="btn btn-danger">
            Clear Data
        </a>
    </div>
</div>

<?php if (!empty($flash)) : ?>

    <div class="alert alert-success alert-dismissible fade show">

        <?= htmlspecialchars($flash) ?>

        <button
            class="btn-close"
            data-bs-dismiss="alert">
        </button>

    </div>

<?php endif; ?>


<div class="row mb-4">

    <div class="col-md-3">

        <div class="card text-bg-primary">

            <div class="card-body">

                <h6>Total Siswa</h6>

                <h3><?= $totalStudent ?></h3>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card text-bg-success">

            <div class="card-body">

                <h6>Rata-rata Nilai</h6>

                <h3><?= $averageScore ?></h3>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card text-bg-warning">

            <div class="card-body">

                <h6>Nilai Tertinggi</h6>

                <h3><?= $highestScore ?></h3>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card text-bg-danger">

            <div class="card-body">

                <h6>Nilai Terendah</h6>

                <h3><?= $lowestScore ?></h3>

            </div>

        </div>

    </div>

</div>


<div class="card shadow-sm mb-4">

    <div class="card-header">

        Filter Data

    </div>

    <div class="card-body">

        <form method="GET">

            <div class="row">

                <div class="col-md-3">

                    <input
                        type="text"
                        class="form-control"
                        name="keyword"
                        placeholder="Cari Nama / NIS"
                        value="<?= htmlspecialchars($keyword ?? '') ?>">

                </div>

                <div class="col-md-2">

                    <select
                        class="form-select"
                        name="jurusan">

                        <option value="">Semua Jurusan</option>

                        <?php foreach ($jurusanList as $item): ?>

                            <option
                                value="<?= htmlspecialchars($item) ?>"
                                <?= (($jurusan ?? '') == $item) ? 'selected' : '' ?>>

                                <?= htmlspecialchars($item) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="col-md-2">

                    <select
                        class="form-select"
                        name="kelas">

                        <option value="">Semua Kelas</option>

                        <?php foreach ($kelasList as $item): ?>

                            <option
                                value="<?= htmlspecialchars($item) ?>"
                                <?= (($kelas ?? '') == $item) ? 'selected' : '' ?>>

                                <?= htmlspecialchars($item) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="col-md-2">

                    <select
                        class="form-select"
                        name="sort">

                        <option value="">Urutkan</option>

                        <option value="nama_asc"
                            <?= (($sort ?? '') == 'nama_asc') ? 'selected' : '' ?>>
                            Nama A-Z
                        </option>

                        <option value="nama_desc"
                            <?= (($sort ?? '') == 'nama_desc') ? 'selected' : '' ?>>
                            Nama Z-A
                        </option>

                        <option value="nilai_desc"
                            <?= (($sort ?? '') == 'nilai_desc') ? 'selected' : '' ?>>
                            Nilai Tertinggi
                        </option>

                        <option value="nilai_asc"
                            <?= (($sort ?? '') == 'nilai_asc') ? 'selected' : '' ?>>
                            Nilai Terendah
                        </option>

                    </select>

                </div>

                <div class="col-md-3">

                    <button class="btn btn-primary">

                        Cari

                    </button>

                    <a
                        href="index.php"
                        class="btn btn-secondary">

                        Reset

                    </a>

                </div>

            </div>

        </form>

    </div>

</div>


<div class="card shadow-sm">

    <div class="card-body p-0">

        <table class="table table-striped table-hover mb-0">

            <thead class="table-dark">

                <tr>

                    <th width="60">No</th>

                    <th>NIS</th>

                    <th>Nama</th>

                    <th>Kelas</th>

                    <th>Jurusan</th>

                    <th>Email</th>

                    <th width="90">Nilai</th>

                    <th width="70">Grade</th>

                    <th width="220">Aksi</th>

                </tr>

            </thead>

            <tbody>

                <?php

                $no = (($pagination['currentPage'] - 1)
                    * $pagination['perPage']) + 1;

                ?>

                <?php if (!empty($students)): ?>

                    <?php foreach ($students as $student): ?>

                        <tr>

                            <td><?= $no++ ?></td>

                            <td><?= htmlspecialchars($student->getNis()) ?></td>

                            <td><?= htmlspecialchars($student->getNama()) ?></td>

                            <td><?= htmlspecialchars($student->getKelas()) ?></td>

                            <td><?= htmlspecialchars($student->getJurusan()) ?></td>

                            <td><?= htmlspecialchars($student->getEmail()) ?></td>

                            <td class="text-center">

                                <?= $student->getNilai() ?>

                            </td>

                            <td class="text-center">

                                <span class="badge bg-success">

                                    <?= $student->getGrade() ?>

                                </span>

                            </td>

                            <td>

                                <a
                                    href="index.php?action=detail&id=<?= $student->getId() ?>"
                                    class="btn btn-info btn-sm">

                                    Detail

                                </a>

                                <a
                                    href="index.php?action=edit&id=<?= $student->getId() ?>"
                                    class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                                <a
                                    href="index.php?action=delete&id=<?= $student->getId() ?>"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')"
                                    class="btn btn-danger btn-sm">

                                    Hapus

                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td colspan="9" class="text-center py-4">

                            Belum ada data siswa.

                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>


<?php if (($pagination['totalPage'] ?? 1) > 1): ?>

    <nav class="mt-4">

        <ul class="pagination justify-content-center">

            <?php for ($i = 1; $i <= $pagination['totalPage']; $i++): ?>

                <li class="page-item <?= $i == $pagination['currentPage'] ? 'active' : '' ?>">

                    <a
                        class="page-link"
                        href="?page=<?= $i ?>&keyword=<?= urlencode($keyword ?? '') ?>&jurusan=<?= urlencode($jurusan ?? '') ?>&kelas=<?= urlencode($kelas ?? '') ?>&sort=<?= urlencode($sort ?? '') ?>">

                        <?= $i ?>

                    </a>

                </li>

            <?php endfor; ?>

        </ul>

    </nav>

<?php endif; ?>


<?php require_once __DIR__ . '/../layout/footer.php'; ?>