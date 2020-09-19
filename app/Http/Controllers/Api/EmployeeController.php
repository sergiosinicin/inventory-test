<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class EmployeeController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index()
    {
        $employee = Employee::all();
        return response()->json($employee);
    }


    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:employees|max:255',
            'email' => 'required',
            'phone' => 'required|unique:employees',
        ]);

        $employee = new Employee();
        $employee->fill($request->all());
        if($request->photo && $image_url = $this->storeImage($request->photo)) {
            $employee->photo = '/'.$image_url;
        }

        $employee->save();

        return response()->json(['success'=>'Employee saved successfully']);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);

        return response()->json($employee);
    }

    /**
     * @param  Request  $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $currentImage = $employee->photo;

         $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        $employee->fill($request->all());

        if($request->new_photo && $image_url = $this->storeImage($request->new_photo)) {
            if($currentImage && file_exists($currentImage)) {
                unlink($currentImage);
            }
            $employee->photo = '/'.$image_url;
        }

        $employee->save();

        return response()->json(['success' => 'Employee successfully updated']);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        if (!$employee->delete()) {
            return response()->json(['error'=>'Employee don`t deleted!']);
        }

        if (file_exists($employee->photo)) {
            unlink($employee->photo);
        }

        return response()->json(['success' => 'Employee successfully deleted']);
    }

    /**
     * @param $photo
     * @return string
     */
    private function storeImage($photo)
    {
        $position = strpos($photo, ';');
        $sub = substr($photo, 0, $position);
        $ext = explode('/', $sub)[1];

        $name = time().".".$ext;
        $img = Image::make($photo)->resize(240, 200);
        $upload_path = 'backend/employee/';
        $image_url = $upload_path.$name;
        $img->save($image_url);

        return $image_url;
    }
}
