<?php

namespace App\Traits;
use App\Services\UploadService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

trait CRUDOperations
{
    public function model(?string $slug = null): Model
    {
        if ($slug) {
            return $this->model->where('slug', $slug)->firstOrFail();
        }

        return app($this->model);
    }

    public function paginate(array $counts = [], array $relationships = [], int $perPage = 10): LengthAwarePaginator
    {
        return $this->model::query()
            ->with($relationships)
            ->withCount($counts)
            ->paginate($perPage);
    }

    public function create(array $data): Model
    {
        $image = $this->uploadImage($data);

        return $this->model::create(array_merge($data, ['image' => $image]));
    }

    public function update(array $data, Model $model): Model
    {
        if (data_get($data, 'image')) {
            UploadService::delete($model->image);

            data_set($data, 'image', $this->uploadImage($data));
        }

        $model->update($data);

        return $model;
    }

    public function delete(Model $model): ?bool
    {
        if ($model->image) {
            UploadService::delete($model->image);
        }

        return $model->delete();
    }

    private function uploadImage(array $data): string
    {
        return UploadService::upload(data_get($data, 'image'), strtolower(class_basename($this->model)));
    }
}
