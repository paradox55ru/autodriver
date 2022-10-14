<?php

namespace Http\Controllers\api\v1;

use App\Http\Controllers\api\v1\AutoController;
use Tests\TestCase;

class AutoControllerTest extends TestCase
{
    public function testView()
    {
        $response = $this->get('/api/auto/'. random_int(10, 999));

        $response->assertStatus($response->status());
    }

    public function testIndex()
    {
        $response = $this->get('/api/auto');

        $response->assertStatus($response->status());
    }

    public function testDelete()
    {
        $response = $this->delete('/api/auto/' . random_int(10, 999));

        $response->assertStatus($response->status());
    }

    public function testUpdate()
    {
        $auto_id = random_int(10, 999);

        $response = $this->put('/api/auto/' . $auto_id, ['name' => 'Автомобиль №' . $auto_id]);

        $response->assertStatus($response->status());
    }

    public function testCreate()
    {
        $response = $this->post('/api/auto', ['name' => 'Автомобиль ' . random_int(10, 999)]);

        $response->assertStatus($response->status());
    }
}
