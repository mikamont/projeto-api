<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Responses\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    public function criar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'saldo_devedor' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $customer = CLiente::create($request->all());
        return JsonResponse::success('Custumer created successfully', $customer);
    }

    public function editar(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'saldo_devedor' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $customer = Cliente::findOrFail($id);
        $customer->update($request->all());
        
        return JsonResponse::success('Custumer updated successfully', $customer);
    }

    public function excluir(Request $request, $id)
    {
        $customer = Cliente::findOrFail($id);
        $customer->delete();
        
        return JsonResponse::success('Custumer deleted successfully');
    }

    public function listar()
    {
        $clientes = Cliente::all();
        return JsonResponse::success(data: $clientes);
    }

    public function exibirPeloId(Request $request, $id)
    {
        $clientes = Cliente::findOrFail($id);
        return JsonResponse::success('Cliente found', $clientes);
    }
}