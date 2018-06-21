<?php

Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('home'));
});


// Home > Pacients
Breadcrumbs::register('pacients', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Pacienti', route('pacients'));
});

// Home > Pacients > [Pacient] 
Breadcrumbs::register('pacients.show', function ($breadcrumbs, $pacient) {
    $breadcrumbs->parent('pacients');
    $breadcrumbs->push($pacient->firstname ." ". $pacient->lastname, route('pacients.show', $pacient->id));
});

// Home > Pacients > Adauga pacient
Breadcrumbs::register('pacients.add', function ($breadcrumbs) {
    $breadcrumbs->parent('pacients');
    $breadcrumbs->push('Adauga pacient', route('pacients.add'));
});

// Home > Pacients > Editare [Pacient]
Breadcrumbs::register('pacients.edit', function ($breadcrumbs, $pacient) {
    $breadcrumbs->parent('pacients');
    $breadcrumbs->push("Editare " . $pacient->firstname ." ". $pacient->lastname, route('pacients.edit', $pacient->id));
});

// Home > Programari
Breadcrumbs::register('program', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Programari', route('program'));
});

// Home > Adaugare programare
Breadcrumbs::register('program.add', function ($breadcrumbs) {
    $breadcrumbs->parent('program');
    $breadcrumbs->push('Adaugare programare', route('program.add'));
});

// Home > Programare [Pacient]
Breadcrumbs::register('program.show', function ($breadcrumbs, $programs) {
    $breadcrumbs->parent('program');
    $breadcrumbs->push("Programare ", route('program.show', $programs->id));
});

// Home > Editare programare [Pacient]
Breadcrumbs::register('program.edit', function ($breadcrumbs, $programs) {
    $breadcrumbs->parent('program');
    $breadcrumbs->push("Editare programare " , route('program.edit', $programs->id));
});

// Home > Consultatii
Breadcrumbs::register('consults', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Lista Consultatii', route('consults'));
});

// Home > Adaugare Consultatie
Breadcrumbs::register('consults.add', function ($breadcrumbs) {
    $breadcrumbs->parent('consults');
    $breadcrumbs->push('Adaugare consultatie', route('consults.add'));
});

// Home > Consultatie [Pacient]
Breadcrumbs::register('consults.show', function ($breadcrumbs, $consults, $pacient) {
    $breadcrumbs->parent('consults');
    $breadcrumbs->push("Consultatie " . $pacient->firstname. " " .$pacient->lastname, route('consults.show', $consults->id));
});

// Home > Editare Consultatie [Pacient]
Breadcrumbs::register('consults.edit', function ($breadcrumbs, $consults) {
    $breadcrumbs->parent('consults');
    $breadcrumbs->push("Editare consultatie " . $consults->pacient->firstname. " " .$consults->pacient->lastname, route('consults.edit', $consults->id));
});

// Home > Concedii
Breadcrumbs::register('concedii', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Lista Concedii medicale', route('concedii'));
});

// Home > Adaugare Concediu medical
Breadcrumbs::register('concedii.add', function ($breadcrumbs) {
    $breadcrumbs->parent('concedii');
    $breadcrumbs->push('Adaugare Concediu medical', route('concedii.add'));
});

// Home > Concediu medical [Pacient]
Breadcrumbs::register('concedii.show', function ($breadcrumbs, $programs) {
    $breadcrumbs->parent('concedii');
    $breadcrumbs->push("Concediu medical " . $pacient->firstname. " " .$pacient->lastname, route('concedii.show', $programs->id));
});

// Home > Editare Concediu medical [Pacient]
Breadcrumbs::register('concedii.edit', function ($breadcrumbs, $programs) {
    $breadcrumbs->parent('concedii');
    $breadcrumbs->push("Editare Concediu medical " . $programs->pacient->firstname. " " .$programs->pacient->lastname, route('concedii.edit', $programs->id));
});

// Home > Utilizatori

Breadcrumbs::register('users', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Lista utilizatori', route('users'));
});

// Home > Utilizatori > Creare Utilizatori
Breadcrumbs::register('users.add', function ($breadcrumbs) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push('Creare utilizator', route('users.add'));
});

// Home > Utilizatori > Detalii
Breadcrumbs::register('users.show', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push('Detalii utilizator '.$user->name, route('users.show', $user->id));
});


// Home > Utilizatori > Editare 
Breadcrumbs::register('users.edit', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push('Editare utilizator '.$user->name, route('users.edit', $user->id));
});

// Home > Utilizatori > Schimba parola 
Breadcrumbs::register('users.updatepass', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push('Schimba parola '.$user->name, route('users.updatepass', $user->id));
});