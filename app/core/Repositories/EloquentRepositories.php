<?php

namespace App\Core\Repositories;

abstract class EloquentRepositories {
    protected $_model;

    public function __construct() {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel() {
        $this->_model = app()->make($this->getModel());
    }
    
    public function getAll() {
        return $this->_model->all();
    }

    public function find($id) {
        return $this->_model->find($id);
    }

    public function create($data) {
        return $this->_model->create($data);
    }

    public function update($id, $data) {
        $result = $this->find($id);
        $result->update($data);
    }
    
    public function delete($data) {
        $result = $this->find($data);
        $result->delete();
    }
}