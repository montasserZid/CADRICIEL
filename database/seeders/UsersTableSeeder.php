<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Etudiant;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $etudiants = Etudiant::all();

        foreach ($etudiants as $etudiant) {
            User::create([
                'etudiant_id' => $etudiant->id,
                'email' => $etudiant->email,
                'password' => bcrypt(Carbon::createFromFormat('Y-m-d', $etudiant->date_de_naissance)->format('dmY')),
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
