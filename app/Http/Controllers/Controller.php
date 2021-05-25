<?php

namespace App\Http\Controllers;

use App\Repositories\ResultRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Validation\Rule;

class Controller extends BaseController
{
    /**
     * @var ResultRepository
     */
    private $repository;

    public function __construct(ResultRepository $repository)
    {
        $this->repository = $repository;
    }

    public function calculate(Request $request)
    {
        $data = $request->validate([
            'a' => [
                'required',
                'integer',
                Rule::notIn([0]),
            ],
            'b' => 'required|integer',
            'c' => 'required|integer',
        ]);

        $a = (int)$data['a'];
        $b = (int)$data['b'];
        $c = (int)$data['c'];

        $result = $this->repository->find($a, $b, $c);

        if ($result) {
            return redirect('/')->withInput()->with('result_success', ['x1' => $result->x1, 'x2' => $result->x2]);
        }

        $delta = $b * $b - 4 * $a * $c;

        $x1 = $x2 = null;
        if ($delta < 0) {
            return redirect()->back()->withInput()->with('result_error', 'Delta e mai mica ca 0');
        } else if ($delta === 0) {
            $x1 = $x2 = -($b / (2 * $a));
        } else if ($delta > 0) {
            $x1 = (-$b + sqrt($delta)) / (2 * $a);
            $x2 = (-$b - sqrt($delta)) / (2 * $a);
        }

        $result = $this->repository->create([
            'a'  => $a,
            'b'  => $b,
            'c'  => $c,
            'x1' => $x1,
            'x2' => $x2,
        ]);

        return redirect('/')->withInput()->with('result_success', ['x1' => $result->x1, 'x2' => $result->x2]);
    }
}
