<?php

namespace Http\Controllers\api\v1;

use App\Http\Controllers\api\v1\DriverController;
use Tests\TestCase;

class DriverControllerTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->get('/api/driver');

        $response->assertStatus($response->status());
    }

    public function testView()
    {
        $response = $this->get('/api/driver/' . random_int(1, 999));

        $response->assertStatus($response->status());
    }

    public function testDelete()
    {
        $response = $this->delete('/api/driver/' . random_int(10, 999));

        $response->assertStatus($response->status());
    }

    public function testUpdate()
    {
        $driver_id = random_int(10, 999);

        $response = $this->put('/api/driver/' . $driver_id, ['name' => 'Водитель №' . $driver_id]);

        $response->assertStatus($response->status());
    }

    public function testCreate()
    {
        $response = $this->post('/api/driver', ['name' => 'Водитель ' . random_int(10, 999)]);

        $response->assertStatus($response->status());
    }
}
