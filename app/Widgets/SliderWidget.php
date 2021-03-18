<?php
namespace App\Widgets;

use App\Widgets\Contract\ContractWidget;

class SliderWidget implements ContractWidget{
    protected $int = 0;

    public function __construct($data = []){
        if (isset($data['int'])){
            $this->int = $data['int'];
        }
    }

    public function execute(){
        $data = 'Слайдер №' . $this->int;
        return view('Widgets::slider', [
            'data' => $data
        ]);
    }
}
