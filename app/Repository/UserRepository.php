<?php
namespace App\Repository;

use App\User;
use DB;
use Log;

class UserRepository extends Repository{

  protected $model;

  public function __construct(User $model){
    $this->model  =$model;
     parent::__construct($model);
  }

  public function create($attributes=[],$params=[]){
      $return =(Object)[
          'response' => false,
      ];

      DB::beginTransaction();
      try{
          $rol  =DB::select("select id from roles
                            where slug = :slug"
                           ,['slug'=>$params['rol']]);

          $user =$this->model->create($attributes);
          if(isset($params['rol'])){
            DB::table('role_user')->insert([
              'user_id' =>$user->id,
              'role_id' =>$rol[0]->id
            ]);
          }
          $return->response=true;
          $return->success=$user;
          DB::commit();
      }
      catch(\Exception $e){
          Log::info('create : '.$e->getMessage());
          $return->response=false;
          $return->error=$e->getMessage();
          DB::rollback();
      }

      return $return;
  }

  public function update($id,$attributes=[],$params=[]){
      $return =(Object)[
          'response' => false,
      ];

      DB::beginTransaction();
      try{

          $user =$this->model->where('id',$id)->update($attributes);

          if(isset($params['rol'])){
            DB::table('role_user')->where('user_id',$id)->update([
              'role_id' =>$params['rol']
            ]);
          }

          $return->response=true;
          $return->success=$user;
          DB::commit();
      }
      catch(\Exception $e){
          Log::info('update : '.$e->getMessage());
          $return->response=false;
          $return->error=$e->getMessage();
          DB::rollback();
      }

      return $return;
  }

}
