<?php
namespace App\Widgets;

use App\Widgets\Contract\ContractWidget;
use App\Models\Menu;

class MenuWidget implements ContractWidget
{
    public function execute(){
        $data = Menu::all();
        return view('Widgets::menu', [
            'data' => $data
        ]);
    }
}
