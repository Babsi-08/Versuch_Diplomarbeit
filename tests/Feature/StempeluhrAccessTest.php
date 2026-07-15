<?php

use App\Models\Employee;
use App\Models\TimeEntry;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('gäste werden von der stempeluhr zum login umgeleitet', function () {
    $this->get('/stempeln')->assertRedirect('/login');
    $this->get('/uebersicht')->assertRedirect('/login');
    $this->post('/kommen')->assertRedirect('/login');
    $this->post('/gehen')->assertRedirect('/login');
});

test('eingeloggte nutzer sehen die stempeluhr als react-seite', function () {
    $this->actingAs(User::factory()->create());

    $this->get('/stempeln')
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page->component('Stempeln'));

    $this->get('/uebersicht')
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page->component('Uebersicht'));
});

test('kommen erstellt einen zeiteintrag und leitet zur stempeluhr zurück', function () {
    $this->actingAs(User::factory()->create());
    $employee = Employee::create(['name' => 'Testperson']);

    $this->post('/kommen', ['employee_id' => $employee->id])
        ->assertRedirect(route('stempeln'));

    expect(TimeEntry::where('employee_id', $employee->id)->whereNotNull('kommen')->exists())
        ->toBeTrue();
});
