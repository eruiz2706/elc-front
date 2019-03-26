<?php

namespace App\Repository;
use Illuminate\Database\Eloquent\Model;
use DB;
use Log;

abstract class Repository implements InterfaceRepository {

    protected $model;

    public function __construct(Model $modelClass) {
      $this->model  =$modelClass;
    }

    public function all($data=['*'],$orderBy=[['column'=>'id','direction'=>'desc']]){
        $return =(Object)[
            'response' => false,
        ];

        try{
            $model  =$this->model;
            if(!empty($orderBy)){
                foreach ($orderBy as $order) {
                    $model=$model->orderBy($order['column'],$order['direction']);
                }
            }
            $return->response=true;
            $return->success=$model->get($data);
        }
        catch(\Exception $e){
            Log::info('find : '.$e->getMessage());
            $return->response=false;
            $return->error=$e->getMessage();
        }

        return $return;
    }

    public function find($id,$data=['*']){
        $return =(Object)[
            'response' => false,
        ];

        try{
            $return->response=true;
            $return->success=$this->model->find($id,$data);
        }
        catch(\Exception $e){
            Log::info('find : '.$e->getMessage());
            $return->response=false;
            $return->error=$e->getMessage();
        }

        return $return;
    }

    public function create($data=[]){
        $return =(Object)[
            'response' => false,
        ];

        try{
            $return->response=true;
            $return->success=$this->model->create($data);
        }
        catch(\Exception $e){
            Log::info('create : '.$e->getMessage());
            $return->response=false;
            $return->error=$e->getMessage();
        }

        return $return;
    }

    public function update($id,$data=[]){
        $return =(Object)[
            'response' => false,
        ];

        try{
            $return->response=true;
            $return->success=$this->model->where('id',$id)->update($data);
        }
        catch(\Exception $e){
            Log::info('update : '.$e->getMessage());
            $return->response=false;
            $return->error=$e->getMessage();
        }

        return $return;
    }

    public function delete($id){
        $return =(Object)[
            'response' => false,
        ];

        try{
            $return->response=true;
            $return->success=$this->model->destroy($id);
        }
        catch(\Exception $e){
            Log::info('find : '.$e->getMessage());
            $return->response=false;
            $return->error=$e->getMessage();
        }

        return $return;
    }


}
