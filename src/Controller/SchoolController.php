<?php

namespace App\Controller;

use App\Model\SchoolManager;

class SchoolController extends AbstractController
{

    public function index(): string
    {
        //TODO Add your code here for list all school
        $manager = new SchoolManager();
        $schools = $manager->selectAll();

        return $this->twig->render(
            'School/index.html.twig',
            [
                'schools' => $schools,
                'Nom' => 'Guillaume',
                'school' => 'WCS'
            ]
        );
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $school = array_map('trim', $_POST);

            //TODO Add your code here
            $manager = new SchoolManager();
            $manager->insert($school);

            header('Location: /schools');
        }

        return $this->twig->render('School/add.html.twig');
    }

    public function show(int $id) {
        $manager = new SchoolManager();
        $school = $manager->selectOneById($id);

        return $this->twig->render('School/show.html.twig', [
            'school' => $school
        ]);
    }


}
