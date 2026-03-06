<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\Models\datapengguna;

class DatapenggunaTest extends TestCase
{
    use RefreshDatabase;

    protected $users;

    protected function setUp(): void
    {
        parent::setUp();

        // Create users manually
        $this->users = [
            [
                'id_pengguna' => 1,
                'nama_pengguna' => 'John Doe',
                'email' => 'john@example.com',
                'alamat' => 'Address 1',
                'no_telp' => '123456789',
                'role' => 'admin',
                'password' => 'password'
            ],
            [
                'id_pengguna' => 2,
                'nama_pengguna' => 'Jane Doe',
                'email' => 'jane@example.com',
                'alamat' => 'Address 2',
                'no_telp' => '987654321',
                'role' => 'user',
                'password' => 'password'
            ],
            [
                'id_pengguna' => 3,
                'nama_pengguna' => 'Alice Smith',
                'email' => 'alice@example.com',
                'alamat' => 'Address 3',
                'no_telp' => '555555555',
                'role' => 'user',
                'password' => 'password'
            ],
        ];

        foreach ($this->users as $user) {
            $datapengguna = new datapengguna($user);
            $datapengguna->save();
        }
    }

    public function test_getUserById()
    {
        $user = $this->users[0];
        $response = $this->get('/api/pengguna/findbyid?id_pengguna=' . $user['id_pengguna']);
        $response->assertStatus(200);
        $response->assertJson(['data' => [
            'id_datapengguna' => $user['id_pengguna'],
            'nama_pengguna' => $user['nama_pengguna'],
            'email' => $user['email'],
            'alamat' => $user['alamat'],
            'no_telp' => (string) $user['no_telp'],
            'role' => $user['role'],
        ]]);
    }

    public function test_getUserByName()
    {
        $user = $this->users[1]; // Access the second user from the array
        $response = $this->get('/api/pengguna/findbyname?nama_pengguna=' . $user['nama_pengguna']);
        $response->assertStatus(200);

        $response->assertJson(['data' => $user]);
    }

    // public function test_storeUser()
    // {
    //     $newUser = [
    //         'nama_pengguna' => 'New User',
    //         'email' => 'newuser@example.com',
    //         'alamat' => 'New Address',
    //         'no_telp' => '111111111',
    //         'role' => 'user',
    //         'password' => 'password'
    //     ];

    //     $response = $this->postJson('/api/pengguna/store', $newUser);
    //     $response->assertStatus(200);
    //     $response->assertJson(['data' => array_merge($newUser, ['id_pengguna' => DB::getPdo()->lastInsertId()])]);
    // }

    // public function test_updateUser()
    // {
    //     $user = $this->users[0]; // Access the first user from the array
    //     $updatedUser = [
    //         'nama_pengguna' => 'Updated Name',
    //         'email' => 'updated@example.com',
    //         'alamat' => 'Updated Address',
    //         'no_telp' => '1234567890',
    //         'role' => 'user',
    //         'password' => 'newpassword'
    //     ];

    //     $response = $this->putJson('/api/pengguna/update/' . $user['id_pengguna'], $updatedUser);
    //     $response->assertStatus(200);
    //     $response->assertJson(['data' => $updatedUser]);
    // }

    // public function test_deleteUser()
    // {
    //     $user = $this->users[2]; // Access the third user from the array
    //     $response = $this->delete('/api/pengguna/delete/' . $user['id_pengguna']);
    //     $response->assertStatus(200);
    //     $response->assertJson(['message' => 'Data pengguna berhasil dihapus.']);
    // }
}



?>
