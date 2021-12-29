<?php

namespace App\Http\Controllers;

use App\Library\MongoManager;
use App\Library\Fees;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    private $database;

    public function __construct(MongoManager $databaseManager)
    {
        $this->database = $databaseManager;
    }

    private function canContinue()
    {
        return $this->database::isConnected();
    }

    private function stop()
    {
        return 'Você não pode prosseguir devido não possuir configurações básicas válidas';
    }

    public function list()
    {
        if (!$this->canContinue()) {
            return $this->stop();
        }

        $api = new Fees($this->database);
        return $api->get();
    }

    public function store()
    {
        if (!$this->canContinue()) {
            return $this->stop();
        }

        $api = new Fees($this->database);
        return $api->add();
    }

    public function destroy(Request $request)
    {
        if (!$this->canContinue()) {
            return $this->stop();
        }

        $api = new Fees($this->database);

        return [
            'status' => $api->destroy($request->input('id'))
        ];
    }
}