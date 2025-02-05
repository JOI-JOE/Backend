<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkspaceRequest;
use App\Http\Resources\WorkspaceResource;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class WorkspaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Workspace::all();
        return WorkspaceResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WorkspaceRequest $request)
    {
        return $this->handleRequest(function () use ($request) {
            // Dữ liệu đã được validate trong WorkspaceRequest
            $validatedData = $request->validated();

            $validatedData['display_name'] = $this->convertDisplayNameToName($validatedData['name']);

            // Tạo workspace mới
            $workspace = Workspace::create($validatedData);

            return response()->json([
                'message' => 'Workspace created successfully',
                'data' => new WorkspaceResource($workspace),
            ], 200); // 200 OK
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Workspace $workspace)
    {
        // Mỗi khi bạn gọi new WorkspaceResource($workspace), bạn đang tạo ra một đối tượng WorkspaceResource mới, độc lập với các đối tượng khác.
        return new WorkspaceResource($workspace);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(WorkspaceRequest $request, Workspace $workspace)
    {
        return $this->handleRequest(function () use ($request, $workspace) {
            // Validate the request data
            $validatedData = $request->validated();

            $workspace->update($validatedData);

            return response()->json([
                'message' => 'Workspace updated successfully',
                'data' => new WorkspaceResource($workspace),
            ], 200); // 200 OK
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function handleRequest(callable $callback)
    {
        try {
            // Gọi callback (phương thức store hoặc update)
            return $callback();
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Nếu có lỗi validation, trả về các lỗi chi tiết
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(), // Trả về lỗi chi tiết từ validation
            ], 422); // 422 Unprocessable Entity
        } catch (\Exception $e) {
            // Nếu có lỗi khác, trả về thông báo lỗi chi tiết
            return response()->json([
                'message' => 'Request failed',
                'error' => $e->getMessage(),
            ], 500); // 500 Internal Server Error
        }
    }

    function convertDisplayNameToName($displayName)
    {
        $name = Str::lower($displayName); // Chuyển đổi chữ hoa thành chữ thường
        $name = preg_replace('/[^a-z0-9-]/', '', $name); // Loại bỏ ký tự không phải chữ số, chữ cái hoặc dấu gạch ngang
        $name = Str::slug($name, '-'); // Tạo slug từ chuỗi, thay thế khoảng trắng bằng dấu gạch ngang và loại bỏ các ký tự không hợp lệ
        $name = Str::limit($name, 50, ''); // Giới hạn độ dài chuỗi

        return $name;
    }
}
