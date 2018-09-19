<?php

namespace App\Repository;

Interface InterfaceRepository{

    public function all($attributes=['*'],$orderBy=[]);

    public function find($id,$attributes=['*']);

    public function findByField($field, $value,$attributes=['*'],$orderBy=[]);

    public function findWhere(array $where,$attributes=['*'],$orderBy=[]);

    public function findWhereIn($field, array $where,$attributes=['*'],$orderBy=[]);

    public function findWhereNotIn($field,array $where,$attributes=['*'],$orderBy=[]);

    public function create($attributes=[],$params=[]);

    public function update($id,$attributes=[],$params=[]);

    public function delete($id);

}
