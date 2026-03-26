<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class CategoryRepository
{
    public function getAll()
    {
        return Category::all();
    }

    public function getById($id)
    {
        return Category::findOrFail($id);
    }

    public function create(array $data)
    {
        try {
            DB::beginTransaction();
            $catgory = Category::create($data);
            DB::commit();
            return (object)
            [
                'status' => 'success',
                'message' => 'Category Created Successfully',
                'data' => $catgory
            ];
        } catch (\Exception $e) {
            DB::rollback();
            return (object)
            [
                'status' => 'error',
                'message' => 'Category Creation Failed: ',
                'error' => $e->getMessage(),
                'data' => null,
            ];
        }
    }



    public function update($id, array $data)
    {
        try {
            DB::beginTransaction();
            $category = Category::findOrFail($id);
            $category->update($data);
            DB::commit();
            return (object)
            [
                'status' => 'success',
                'message' => 'Category Updated Successfully',
                'data' => $category
            ];
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return (object)
            [
                'status' => 'error',
                'message' => 'Category Not Found',
                'error' => $e->getMessage(),
                'data' => null,
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return (object)
            [
                'status' => 'error',
                'message' => 'Category Update Failed: ',
                'error' => $e->getMessage(),
                'data' => null,
            ];
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $category = Category::findOrFail($id);
            $category->delete();
            DB::commit();
            return (object)
            [
                'status' => 'success',
                'message' => 'Category Deleted Successfully',
                'data' => null
            ];
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return (object)
            [
                'status' => 'error',
                'message' => 'Category Not Found',
                'error' => $e->getMessage(),
                'data' => null,
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return (object)
            [
                'status' => 'error',
                'message' => 'Category Deletion Failed: ',
                'error' => $e->getMessage(),
                'data' => null,
            ];
        }
    }
}
