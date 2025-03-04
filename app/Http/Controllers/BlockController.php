<?php

namespace App\Http\Controllers;

use App\Models\ListeningBlock;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    //Lấy danh sách Phòng/Đội dựa trên Đơn vị
    public function blockList(Request $request)
    {
        $data['block'] = ListeningBlock::where('level_id', $request->level_id)->orderby('block_name', 'ASC')
            ->get(['block_id', 'block_name']);

        return response()->json($data);
    }
}
