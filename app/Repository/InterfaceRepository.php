<?php

namespace App\Repository;

Interface InterfaceRepository{

    public function all($data=['*'],$orderBy=[]);

    public function find($id,$data=['*']);

    public function create($data=[]);

    public function update($id,$data=[]);

    public function delete($id);

}
