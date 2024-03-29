<?php

namespace Api\Actions\Json;

use Api\Actions\aAction;

class BaseFake extends aAction {

  public function guard() {
//		$this->guardByAutoNumbers();
  }

  public function exec() {
    return [[
      'Госномер' => 'Н290АР197',
      'Бренд' => 'МАЗДА 3',
      'Цвет' => 'СИНИЙ',
      'Год выпуска' => '2007',
      'Объем двигателя' => '1598',
      'Мощность двигателя' => '105',
      'Шасси' => '-',
      'Номер двигателя' => '450689',
      'VIN' => 'JМZВК24V281685887',
    ], [
      'Госномер' => 'Е107АТ77',
      'Бренд' => 'ШЕВРОЛЕ ТАХО GМТ900',
      'Цвет' => 'ЧЕРНЫЙ',
      'Год выпуска' => '2012',
      'Объем двигателя' => '5328',
      'Мощность двигателя' => '325',
      'Шасси' => 'ССR274060',
      'Номер двигателя' => '632789',
      'VIN' => 'ХWFSD3Е01С0000765',
    ], [
      'Госномер' => 'В354ТУ42',
      'Бренд' => 'МИЦУБИСИ АSХ 2.0',
      'Цвет' => 'СЕРЫЙ',
      'Год выпуска' => '2011',
      'Объем двигателя' => '1998',
      'Мощность двигателя' => '150',
      'Шасси' => 'JС0386',
      'Номер двигателя' => '056421',
      'VIN' => 'JМВХТGА2WVE000505',
    ]];
  }
}
