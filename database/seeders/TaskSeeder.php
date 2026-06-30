<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'test@example.com')->first();
        Task::create([
            'title' => 'Première tâche',
            'description' => 'Tâche générée automatiquement',
            'status' => 'todo',
            'user_id' => $user->id,
        ]);

        Task::create([
            'title' => 'Deuxième tâche',
            'description' => 'Tâche en cours',
            'status' => 'doing',
            'user_id' => $user->id,
        ]);

        Task::create([
            'title' => 'Tâche terminée',
            'description' => 'Exemple terminé',
            'status' => 'done',
            'user_id' => $user->id,
        ]);
    }
}