<?php

namespace App\Http\Controllers;
use App\Models\Pedidos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidosController extends Controller
{
    public function index()
    {
        return response()->json(Pedidos::with('usuario')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'total' => 'required|numeric|min:0',
            'estado' => 'required|in:pagado,pendiente,enviado,entregado,cancelado',
            'fecha_pedido' => 'nullable|date',
        ]);

        $pedido = Pedidos::create($validated);

        return response()->json([
            'message' => 'Pedido creado exitosamente',
            'data' => $pedido
        ], 201);
    }

    public function storeCliente(Request $request)
    {
        $validated = $request->validate([
            'total' => 'required|numeric|min:0',
            'fecha_pedido' => 'nullable|date',
            'productos' => 'required|array|min:1',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.precio_unitario' => 'required|numeric|min:0',
        ]);

        $usuario = auth()->user();

        DB::beginTransaction();

        try {
            $pedido = Pedidos::create([
                'usuario_id' => $usuario->id,
                'total' => $validated['total'],
                'estado' => 'enviado',
                'fecha_pedido' => $validated['fecha_pedido'] ?? now(),
            ]);

            foreach ($validated['productos'] as $detalle) {
                $subtotal = $detalle['cantidad'] * $detalle['precio_unitario'];

                $pedido->detallesPedido()->create([
                    'producto_id' => $detalle['producto_id'],
                    'cantidad' => $detalle['cantidad'],
                    'precio_unitario' => $detalle['precio_unitario'],
                    'subtotal' => $subtotal,
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Pedido y detalles creados exitosamente',
                'data' => $pedido->load('detallesPedido')
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al crear el pedido',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $pedido = Pedidos::with('usuario')->find($id);

        if (!$pedido) {
            return response()->json(['message' => 'Pedido no encontrado'], 404);
        }

        return response()->json($pedido);
    }

    public function update(Request $request, $id)
    {
        $pedido = Pedidos::find($id);

        if (!$pedido) {
            return response()->json(['message' => 'Pedido no encontrado'], 404);
        }

        $validated = $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'total' => 'required|numeric|min:0',
            'estado' => 'required|in:pendiente,enviado,entregado,cancelado',
            'fecha_pedido' => 'nullable|date',
        ]);

        $pedido->update($validated);

        return response()->json([
            'message' => 'Pedido actualizado correctamente',
            'data' => $pedido
        ]);
    }

    public function destroy($id)
    {
        $pedido = Pedidos::find($id);

        if (!$pedido) {
            return response()->json(['message' => 'Pedido no encontrado'], 404);
        }

        $pedido->delete();

        return response()->json(['message' => 'Pedido eliminado correctamente']);
    }
}
