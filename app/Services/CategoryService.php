<?php

namespace App\Service;

use App\Repositories\CategoryRepository;

class CategoryService
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll()
    {
        return $this->categoryRepository->getAll();
    }

    public function getById($id)
    {
        return $this->categoryRepository->getById($id);
    }

    public function create(array $data)
    {
        $category = $this->categoryRepository->create($data);

        return (object)
        [
            'status' => 'success',
            'message' => 'Category Created Successfully',
            'data' => $category
        ];
    }

    public function update($id, array $data)
    {
        $category = $this->categoryRepository->update($id, $data);

        return (object)
        [
            'status' => 'success',
            'message' => 'Category Updated Successfully',
            'data' => $category
        ];
    }
}
