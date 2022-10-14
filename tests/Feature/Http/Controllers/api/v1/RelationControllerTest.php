<?php

namespace Http\Controllers\api\v1;

use App\Http\Controllers\api\v1\RelationController;
use Tests\TestCase;

class RelationControllerTest extends TestCase
{
    public function testUpdateByDriver()
    {
        $response = $this->put('/api/relation/' . random_int(1, 999), ['auto_id' => random_int(1, 999)]);

        $response->assertStatus($response->status());
    }

    public function testUpdateByAuto()
    {
        $response = $this->put('/api/relation/' . random_int(1, 999), ['driver_id' => random_int(1, 999)]);

        $response->assertStatus($response->status());
    }

    public function testIndex()
    {
        $response = $this->get('/api/relation');

        $response->assertStatus($response->status());
    }

    public function testCreate()
    {
        $response = $this->post('/api/relation', ['driver_id' => random_int(1, 999), 'auto_id' => random_int(1, 999)]);

        $response->assertStatus($response->status());
    }

    public function testDeleteByDriver()
    {
        $response = $this->delete('/api/relation/' . random_int(1, 999));

        $response->assertStatus($response->status());
    }

    public function testDeleteByAuto()
    {
        $response = $this->delete('/api/relation/' . random_int(1, 999));

        $response->assertStatus($response->status());
    }
}
