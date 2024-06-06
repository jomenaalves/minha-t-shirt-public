<?php

namespace App\Commom\Abstracts;

use App\Commom\Interfaces\ServiceInterface;
use App\Exceptions\ModelNotFoundException;
use Exception;

class AbstractService implements ServiceInterface
{
    protected $with = [];

    protected $repository;

    public function getAll(array $params = [], $with = [])
    {
        return $this->repository->where($params, $with);
    }

    /**
     * @throws Exception
     */
    public function find($id, array $with = [], array $withCount = [])
    {
        $result = $this->repository->find($id, $with, $withCount);

        if ($result == null) {
            throw new ModelNotFoundException(get_class($this->repository->getModel()));
        }

        return $result;
    }

    public function validateOnInsert(array $params): bool
    {
        return true;
    }

    public function validateOnUpdate($id, array $params): bool
    {
        return true;
    }

    public function validateOnDelete($id): bool
    {
        return true;
    }

    public function afterSave($entity, array $params)
    {
        return $entity;
    }

    public function afterUpdate($entity, array $params)
    {
        return $entity;
    }

    public function afterDelete($entity)
    {
        return $entity;
    }

    public function beforeSave(array $params): array
    {
        return $params;
    }

    public function beforeUpdate($id, array $params)
    {
        return $params;
    }

    public function beforeDelete($entity)
    {
        return $entity;
    }

    public function create(array $params)
    {
        $entity = $this->repository->create($params);
        $this->afterSave($entity, $params);

        return $entity;
    }

    public function update($id, array $params)
    {
        $params = $this->beforeUpdate($id, $params);
        $this->validateOnUpdate($id, $params);
        $entity = $this->find($id);
        $updated = $this->repository->update($entity, $params);

        if ($updated) {
            $this->afterUpdate($entity, $params);
        }

        return $updated;
    }

    public function delete($id): int|string
    {
        $this->validateOnDelete($id);
        $this->beforeDelete($id);
        $this->repository->delete($id);
        $this->afterDelete($id);

        return $id;
    }

    public function save(array $params)
    {
        $params = $this->beforeSave($params);
        if ($this->validateOnInsert($params) !== false) {
            $entity = $this->repository->create($params);
            $this->afterSave($entity, $params);

            return $entity;
        }

        return false;
    }

    public function findOneWhere(array $where, array $with = [], array $withCount = [])
    {
        return $this->repository->findOneWhere($where, $with, $withCount);
    }

    public function getRepository()
    {
        return $this->repository;
    }

    public function createOrUpdate($params, $paramsValidator)
    {
        $params = $this->beforeCreateOrUpdate($params);
        if ($this->validateOnInsert($params) !== false) {
            $entity = $this->repository->createOrUpdate($params, $paramsValidator);
            $this->afterCreateOrUpdate($entity, $params);

            return $entity;
        }

        return false;
    }

    public function afterCreateOrUpdate($entity,array $params)
    {
        return $entity;
    }

    public function beforeCreateOrUpdate(array $params): array
    {
        return $params;
    }
}
