<?php
declare(strict_types=1);

namespace Tests\Tables;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Models\InstrumentTypeModel;

/**
 * @group instrumentType
 */
class InstrumentTypeRouteTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function route_need_autentication()
    {
        $response = $this->call('GET', '/api/instrument-type');
        $this->assertEquals($response->getStatusCode(), 401);

        $json = json_decode($response->getContent(), true);
        $this->assertEquals($json['message'], 'Token não informado.');
    }

    /** @test */
    public function route_get_return_datas()
    {
        $factory = $this->factory();

        $this->withoutMiddleware();

        $response = $this->call('GET', '/api/instrument-type');
        $this->assertEquals($response->getStatusCode(), 200);
        $this->assertEquals($response->getData(), $factory);
    }

    /** @test */
    public function route_find_return_datas()
    {
        $factory = $this->factory();

        $this->withoutMiddleware();

        $response = $this->call('GET', '/api/instrument-type/' . $factory['id']);
        $this->assertEquals($response->getStatusCode(), 200);
        $this->assertEquals($response->getData(), $factory);
    }

    /** @test */
    public function route_save_return_datas()
    {
        $objetc = $this->newObject();

        $this->withoutMiddleware();

        $response = $this->call('GET', '/api/instrument-type', $objetc);
        $this->assertEquals($response->getStatusCode(), 200);
    }

    /** @test */
    public function route_update_return_datas()
    {

    }

    /** @test */
    public function route_delete_return_datas()
    {

    }

    private function factory() : Array
    {
        $model = InstrumentTypeModel::factory()->make();
        return [
            'id' => $model->inst_typ_id,
            'name' => $model->inst_typ_name,
            'slug' => $model->inst_typ_slug,
        ];
    }

    private function newObject() : Array
    {
        return [
            'name' => 'Instrument Test',
            'slug' => 'instrument-test',
        ];
    }
}
