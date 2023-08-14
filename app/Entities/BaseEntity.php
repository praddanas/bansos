<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class BaseEntity extends Entity
{
    protected $modelName = null;
    protected $model = null;
    public function __construct(array $data = null)
    {
        parent::__construct($data);
        if (isset($this->modelName)) {
            if (!empty($this->modelName)) {
                $this->model = model($this->modelName);
            }
        }
    }

    public function save()
    {
        if ($this->model->save($this)) {
            $data = $this->model->find($this->model->getInsertID());
            return $data;
        } else {
            return false;
        }
    }
    public function update()
    {
        try {
            return $this->model->update($this->id, $this);
        } catch (\Exception $th) {
            //throw $th;
            if ($th->getMessage() === 'There is no data to update.') {
                return true;
            }
            return false;
        }
    }
    public function delete($purge = false)
    {
        try {
            return $this->model->delete($this->id, $purge);
        } catch (\Exception $th) {
            //throw $th;
            return false;
        }
    }
    public function restore()
    {
        try {
            return $this->model->restore($this->id);
        } catch (\Exception $th) {
            //throw $th;
            return false;
        }
    }
}
