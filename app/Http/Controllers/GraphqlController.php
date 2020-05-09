<?php


namespace App\Http\Controllers;

use App\GraphQL\Schema\Types;
use GraphQL\Error\Debug;
use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use Illuminate\Http\Request;
use Safe\Exceptions\JsonException;

class GraphqlController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('query', $request->post('query'));
        $variables = $request->get('variables', $request->post('variables'));
        $operation = $request->get('operation', $request->post('operation', null));

        if (empty($query)) {
            $rawInput = file_get_contents('php://input');
            $input = json_decode($rawInput, true);
            $query = $input['query'];
            $variables = isset($input['variables']) ? $input['variables'] : [];
            $operation = isset($input['operation']) ? $input['operation'] : null;
        }

        if (!empty($variables) && !is_array($variables)) {
            try {
                $variables = \Safe\json_decode($variables);
            } catch (JsonException $e) {
                $variables = null;
            }
        }

        $schema = new Schema([
            'query' => Types::query(),
            'mutation' => Types::mutation(),
        ]);

        $result = GraphQL::executeQuery(
            $schema,
            $query,
            null,
            null,
            empty($variables) ? null : $variables,
            empty($operation) ? null : $operation
        )->toArray(Debug::INCLUDE_DEBUG_MESSAGE | Debug::INCLUDE_TRACE);

        return response()->json($result);
    }
}
