<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="row justify-content-center">

    <div class="col-lg-8">

        <div class="card shadow">

            <div class="card-header bg-info text-white">

                <h4 class="mb-0">Detail Data Siswa</h4>

            </div>

            <div class="card-body">

                <div class="row mb-3">

                    <div class="col-md-4 fw-bold">
                        ID
                    </div>

                    <div class="col-md-8">
                        <?= htmlspecialchars($student->getId()) ?>
                    </div>

                </div>

                <div class="row mb-3">

                    <div class="col-md-4 fw-bold">
                        NIS
                    </div>

                    <div class="col-md-8">
                        <?= htmlspecialchars($student->getNis()) ?>
                    </div>

                </div>

                <div class="row mb-3">

                    <div class="col-md-4 fw-bold">
                        Nama
                    </div>

                    <div class="col-md-8">
                        <?= htmlspecialchars($student->getNama()) ?>
                    </div>

                </div>

                <div class="row mb-3">

                    <div class="col-md-4 fw-bold">
                        Kelas
                    </div>

                    <div class="col-md-8">
                        <?= htmlspecialchars($student->getKelas()) ?>
                    </div>

                </div>

                <div class="row mb-3">

                    <div class="col-md-4 fw-bold">
                        Jurusan
                    </div>

                    <div class="col-md-8">
                        <?= htmlspecialchars($student->getJurusan()) ?>
                    </div>

                </div>

                <div class="row mb-3">

                    <div class="col-md-4 fw-bold">
                        Email
                    </div>

                    <div class="col-md-8">
                        <?= htmlspecialchars($student->getEmail()) ?>
                    </div>

                </div>

                <div class="row mb-3">

                    <div class="col-md-4 fw-bold">
                        Nilai
                    </div>

                    <div class="col-md-8">

                        <span class="badge bg-primary fs-6">

                            <?= htmlspecialchars($student->getNilai()) ?>

                        </span>

                    </div>

                </div>

                <div class="row mb-3">

                    <div class="col-md-4 fw-bold">
                        Grade
                    </div>

                    <div class="col-md-8">

                        <span class="badge bg-success fs-6">

                            <?= htmlspecialchars($student->getGrade()) ?>

                        </span>

                    </div>

                </div>

                <div class="row mb-3">

                    <div class="col-md-4 fw-bold">
                        Predikat
                    </div>

                    <div class="col-md-8">

                        <?= htmlspecialchars($student->getPredicate()) ?>

                    </div>

                </div>

                <div class="row mb-4">

                    <div class="col-md-4 fw-bold">
                        Status
                    </div>

                    <div class="col-md-8">

                        <?php if ($student->isPassed()) : ?>

                            <span class="badge bg-success fs-6">

                                LULUS

                            </span>

                        <?php else : ?>

                            <span class="badge bg-danger fs-6">

                                TIDAK LULUS

                            </span>

                        <?php endif; ?>

                    </div>

                </div>

                <hr>

                <div class="d-flex justify-content-between">

                    <a
                        href="index.php"
                        class="btn btn-secondary">

                        Kembali

                    </a>

                    <a
                        href="index.php?action=edit&id=<?= urlencode($student->getId()) ?>"
                        class="btn btn-warning">

                        Edit Data

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>