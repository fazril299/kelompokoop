<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'logic/Student.php';
require_once 'logic/Session.php';
require_once 'logic/Validator.php';
require_once 'logic/StudentManager.php';

$manager = new StudentManager();

/*
|--------------------------------------------------------------------------
| Seed Data
|--------------------------------------------------------------------------
*/

if (isset($_GET['action']) && $_GET['action'] == 'seed') {

    $manager->seed();

    header("Location:index.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| Clear Data
|--------------------------------------------------------------------------
*/

if (isset($_GET['action']) && $_GET['action'] == 'clear') {

    $manager->clear();
}

/*
|--------------------------------------------------------------------------
| Routing
|--------------------------------------------------------------------------
*/

$action = $_GET['action'] ?? 'list';

switch ($action) {

    case 'create':

        $student = null;

        $jurusanList = $manager->getJurusanList();
        $kelasList = $manager->getKelasList();

        include 'views/student/form.php';

        break;

    case 'store':

        $manager->store($_POST);

        break;

    case 'edit':

        $student = $manager->find($_GET['id']);

        if (!$student) {
            header("Location:index.php");
            exit;
        }

        $jurusanList = $manager->getJurusanList();
        $kelasList = $manager->getKelasList();

        include 'views/student/form.php';

        break;

    case 'update':

        $manager->update($_GET['id'], $_POST);

        break;

    case 'delete':

        $manager->delete($_GET['id']);

        break;

    case 'detail':

        $student = $manager->find($_GET['id']);

        if (!$student) {
            header("Location:index.php");
            exit;
        }

        include 'views/student/detail.php';

        break;

    default:
        $keyword = $_GET['keyword'] ?? '';
        $sort = $_GET['sort'] ?? '';
        $jurusan = $_GET['jurusan'] ?? '';
        $kelas = $_GET['kelas'] ?? '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        $students = $manager->getAll($keyword, $sort);

        $students = $manager->filterJurusan($students, $jurusan);
        $students = $manager->filterKelas($students, $kelas);

        $pagination = $manager->pagination($students, $page);

        $students = $pagination['data'];

        $totalStudent = $manager->totalStudent();
        $averageScore = $manager->averageScore();
        $highestScore = $manager->highestScore();
        $lowestScore = $manager->lowestScore();

        $jurusanList = $manager->getJurusanList();
        $kelasList = $manager->getKelasList();

        $flash = $manager->getFlash();

        include 'views/student/list.php';

        break;
}
