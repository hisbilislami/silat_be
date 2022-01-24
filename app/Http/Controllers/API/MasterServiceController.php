<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\MasterService;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\ValidationException;

class MasterServiceController extends Controller
{
    protected $model;
    public function __construct()
    {
        $this->model = new MasterService();
    }

    public function index(Request $request)
    {
        try {

            $offset = (int)$request->query('offset', 0);
            $limit = (int)$request->query('per_page', 10);
            $page = (int)floor($offset / $limit) + 1;

            $query = $request->query('query');

            $result = $this->model->get($limit, $page, $query);

            $data = [
                'data' => $result->items(),
                'total' => $result->total(),
                'per_page' => $result->perPage(),
                'total_page' => $result->lastPage(),
                'page' => $result->currentPage(),
                'status_code' => Response::HTTP_OK
            ];

            return response()->json(
                $data,
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'error' => $e->getMessage(),
                    'status_code' => Response::HTTP_BAD_REQUEST
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function insert(Request $request)
    {
        try {
            // Validate request
            $request->validate(
                [
                    '*.code' => 'required|string|max:5|unique:m_service',
                    '*.name' => 'required|string|max:100',
                ]
            );

            $userId = Auth::user()->id;

            $data = [];
            foreach ($request->all() as $value) {
                $value['created_by'] = $userId;
                array_push($data, $value);
            }

            $result = $this->model->insert($data);

            $data = [
                'data' => $result,
                'status_code' => Response::HTTP_OK
            ];

            return response()->json(
                $data,
                Response::HTTP_OK
            );
        } catch (ValidationException $e) {
            return response()->json(
                [
                    'error' => $e->errors(),
                    'message' => $e->getMessage(),
                    'status_code' => Response::HTTP_FORBIDDEN
                ],
                Response::HTTP_FORBIDDEN
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'message' => $e->getMessage(),
                    'status_code' => Response::HTTP_BAD_REQUEST
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function update(Request $request)
    {
        try {
            // Validate request
            $request->validate(
                [
                    '*.id' => 'required|integer|exists:m_service,id',
                    '*.code' => 'required|string|max:5',
                    '*.name' => 'required|string|max:100',
                ]
            );

            $userId = Auth::user()->id;

            foreach ($request->all() as $value) {
                $value['updated_by'] = $userId;
                $this->model->updateData($value);
            }

            $data = [
                'data' => '',
                'status_code' => Response::HTTP_OK
            ];

            return response()->json(
                $data,
                Response::HTTP_OK
            );
        } catch (ValidationException $e) {
            return response()->json(
                [
                    'error' => $e->errors(),
                    'message' => $e->getMessage(),
                    'status_code' => Response::HTTP_FORBIDDEN
                ],
                Response::HTTP_FORBIDDEN
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'message' => $e->getMessage(),
                    'status_code' => Response::HTTP_BAD_REQUEST
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function destroy(Request $request)
    {
        try {
            // Validate request
            $request->validate(
                [
                    '*.id' => 'required|integer|exists:m_service,id',
                ]
            );

            foreach ($request->all() as $value) {
                $this->model->deleteData($value);
            }

            $data = [
                'data' => '',
                'status_code' => Response::HTTP_OK
            ];

            return response()->json(
                $data,
                Response::HTTP_OK
            );
        } catch (ValidationException $e) {
            return response()->json(
                [
                    'error' => $e->errors(),
                    'message' => $e->getMessage(),
                    'status_code' => Response::HTTP_FORBIDDEN
                ],
                Response::HTTP_FORBIDDEN
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'message' => $e->getMessage(),
                    'status_code' => Response::HTTP_BAD_REQUEST
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
