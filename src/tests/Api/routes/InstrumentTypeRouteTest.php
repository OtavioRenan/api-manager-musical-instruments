<?php
declare(strict_types=1);

namespace Tests\Api\Routes;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\InstrumentTypeModel;
use Tests\TestCase;

/**
 * @group instrumentType
 */
class InstrumentTypeRouteTest extends TestCase
{
    use DatabaseMigrations;

    private $route = '/api/instrument-type/';

    /** @test */
    public function route_need_autentication()
    {
        $response = $this->call('GET', $this->route);
        $this->assertEquals($response->getStatusCode(), 401);

        $json = json_decode($response->getContent(), true);
        $this->assertEquals($json['message'], 'Token não informado.');
    }

    /** @test */
    public function access_route_get_not_return_datas()
    {
        $factory = [];

        $this->withoutMiddleware();

        $response = $this->call('GET', $this->route);

        $this->assertEquals($response->getStatusCode(), 200);
        $this->assertEquals($response->getData(), $factory);
    }

    /** @test */
    public function access_route_get_return_datas()
    {
        $factory = $this->factory();

        $this->withoutMiddleware();

        $response = $this->call('GET', $this->route);
        $this->assertEquals($response->getStatusCode(), 200);
        $this->assertEquals((array)$response->getData()[0], $factory[0]);
    }

    /** @test */
    public function access_route_find_not_return_datas()
    {
        $this->withoutMiddleware();

        $response = $this->call('GET', $this->route . 1);
        $this->assertEquals($response->getStatusCode(), 400);
    }

    /** @test */
    public function access_route_find_return_datas()
    {
        $factory = $this->factory();

        $this->withoutMiddleware();

        $response = $this->call('GET', $this->route . $factory[0]['id']);
        $this->assertEquals($response->getStatusCode(), 200);
        $this->assertEquals((array)$response->getData(), $factory[0]);
    }

    /** @test */
    public function access_route_create_return_error()
    {
        $objetc = [];

        $this->withoutMiddleware();

        $response = $this->call('POST', $this->route, $objetc);
        $this->assertEquals($response->getStatusCode(), 422);
    }

    /** @test */
    public function access_route_create_return_object_created()
    {

        $objetc = $this->newObject();

        $this->withoutMiddleware();

        $response = $this->call('POST', $this->route, $objetc);

        $this->assertTrue($this->createdIsEqual((array)$response->getData(), $objetc));
        $this->assertEquals($response->getStatusCode(), 200);
    }

    /** @test */
    public function access_route_update_return_error()
    {
        $factory = $this->factory();
        $objetc = [];

        $this->withoutMiddleware();

        $response = $this->call('PUT', $this->route . $factory[0]['id'], $objetc);

        $this->assertEquals($response->getStatusCode(), 422);
    }

    /** @test */
    public function access_route_update_return_object_updated()
    {
        $factory = $this->factory();
        $objetc = $this->newObject();

        $this->withoutMiddleware();

        $response = $this->call('PUT', $this->route . $factory[0]['id'], $objetc);

        $this->assertEquals($response->getStatusCode(), 200);
        $this->assertTrue($this->createdIsEqual((array)$response->getData(), $objetc));
    }

    /** @test */
    public function access_route_delete_success()
    {
        $factory = $this->factory();

        $this->withoutMiddleware();

        $response = $this->call('DELETE', $this->route . $factory[0]['id']);
        $this->assertEquals($response->getStatusCode(), 200);
    }

    private function factory() : Array
    {
        $model = InstrumentTypeModel::factory()->create();
        return [
            [
                'id' => $model->inst_typ_id,
                'name' => $model->inst_typ_name,
                'slug' => $model->inst_typ_slug,
            ]
        ];
    }

    private function newObject() : Array
    {
        return [
            'name' => 'Instrument Test',
            'slug' => 'instrument-test',
        ];
    }

    private function isEquals(Array $response, Array $factory) : bool
    {
        if(count($response) > 0 && count($factory) > 0) {
            return (array)$response[0] == $factory[0];
        }

        return $response == $factory;
    }

    private function createdIsEqual(Array $created, Array $objetc) : bool
    {
        foreach($objetc as $index => $key)
        {
            if($created[$index] != $key)
            {
                return false;
            }
        }
        return true;
    }
}
