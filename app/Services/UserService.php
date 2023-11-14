<?php


namespace App\Services;


use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class UserService
{
    private int $updatedCount = 0;
    const CHUNK_SIZE = 200;

    public function prepareData(array $users): array
    {
        $userData = [];
        foreach (array_chunk($users, self::CHUNK_SIZE) as $chunk) {
            foreach ($chunk as $user) {
                $userData[] = [
                    'first_name' => $user['name']['first'],
                    'last_name' => $user['name']['last'],
                    'age' => $user['dob']['age'],
                    'email' => $user['email'],
                ];
            }
        }

        return $userData;
    }

    public function getImportInfo(): array
    {
        $oldCount = cache()->get('usersCount');
        cache()->delete('usersCount');
        $userCount = cache()->remember('usersCount', 60 * 60 * 24, function() {
            return User::all()->count();
        });

        return [
            'updated' => $this->updatedCount,
            'created' => $userCount - $oldCount,
            'all' => $userCount,
        ];
    }

    public function import()
    {
        $this->data = $this->getUsersListFromAPI();
        $this->apiDataCount = count($this->data);
        $data = $this->prepareData(users: $this->data);
        $this->getUpdateDataCount(usersData: $data);
        Db::table('users')->upsert(array_values($data), ['last_name', 'first_name'], ['age', 'email']);
        $this->apiDataCount = DB::table('users')->latest()->count();
    }

    public function createItems(array $usersData): void
    {
        foreach (array_chunk($usersData, self::CHUNK_SIZE) as $data) {
            DB::table('users')->insert($data);
        }
    }

    public function getUpdateDataCount(array $usersData): int
    {
        $first_names = array_map(function($user) {
            return $user['first_name'];
        }, $usersData);

        $last_names = array_map(function($user) {
          return $user['last_name'];
        }, $usersData);

       return User::whereIn('first_name', $first_names)->whereIn('last_name', $last_names)->count();
    }

    public function getUsersListFromAPI(): array
    {
        $response = Http::get('https://randomuser.me/api/?results=5000');
        $arrayData = json_decode($response->body(), true);
        if (isset($arrayData['results']) && count($arrayData) > 0) {
            return $arrayData['results'];
        }

        return [];
    }

}
