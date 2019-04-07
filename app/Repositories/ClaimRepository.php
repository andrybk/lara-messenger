<?php namespace App\Repositories;
use App\Models\Claim as Model;

class ClaimRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
        // TODO: Implement getModelClass() method.
    }



    /**
     * @return \Illuminate\Contracts\Foundation\Application|mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    public function getAllWithPaginate($perPage = null){
        $columns = [
            'id',
            'theme',
            'message',
            'created_at',
            'user_id',
            'answered'
        ];
        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('created_at', 'DESC')
            ->with([
                'user:id,name,email',
            ])
            ->paginate(($perPage == null) ? 25 : $perPage);
        return $result;
    }
    public function getAllByUserWithPaginate($user_id, $perPage = null){
        $columns = [
            'id',
            'theme',
            'message',
            'created_at',
            'user_id',
            'answered'
        ];
        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('created_at', 'DESC')
            ->with([
                'user:id,name,email',
            ])
            ->where('user_id', $user_id)
            ->paginate(($perPage == null) ? 25 : $perPage);
        return $result;
    }

    public function getShow($id){
        return $this->startConditions()->find($id);
    }
}