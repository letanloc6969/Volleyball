<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Province;
use App\Ward;
use App\Feeship;

class DeliveryController extends Controller
{
    public function index()
    {
        $city = City::orderby('matp', 'ASC')->get();
        return view('admin.delivery.index', compact('city'));
    }

    public function select_Delivery(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == 'city') {
                $select_province = Province::where('matp', $data['ma_id'])->orderby('maqh', 'ASC')->get();
                foreach ($select_province as $province) {
                    $output .= '<option value="' . $province->maqh . '">' . $province->name_quanhuyen . '</option>';
                }
            } else {
                $select_wards = Ward::where('maqh', $data['ma_id'])->orderby('xaid', 'ASC')->get();
                foreach ($select_wards as $wards) {
                    $output .= '<option value="' . $wards->xaid . '">' . $wards->name_xaphuong . '</option>';
                }
            }
        }
        echo $output;
    }

    // Lấy các data từ ajax để cập nhật vòa CSDL
    public function store(Request $request)
    {
        $data = $request->all();
        $fee_ship = new Feeship();
        $fee_ship->fee_matp = $data['city'];
        $fee_ship->fee_maqh = $data['province'];
        $fee_ship->fee_xaid = $data['wards'];
        $fee_ship->fee_feeship = $data['fee_ship'];
        $fee_ship->save();
    }

    public function select_Feeship()
    {
        $feeship = Feeship::orderby('fee_id', 'DESC')->get();
        $output = '';
        $output.='
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thread>
                            <tr>
                                <th>Tên thành phố</th>
                                <th>Tên quận huyện</th>
                                <th>Tên xã phường</th>
                                <th>Phí vận chuyển</th>
                            </tr>
                        </thread>
                        <tbody>
                        ';

                        foreach ($feeship as $fee){
                            $output.='
                             <tr>
                                <td>'.$fee->city->name_city.'</td>
                                <td>'.$fee->province->name_quanhuyen.'</td>
                                <td>'.$fee->wards->name_xaphuong.'</td>
                                <td contenteditable data-feeship_id="'.$fee->fee_id.'" class="fee_feeship_edit">'.'$'.$fee->fee_feeship.'</td>
                            </tr>
                            ';
                            }
            $output.='
                        </tbody>
                        </table>
                    </div>
                    ';
                        echo $output;
    }

    // Lấy $data[''] từ ajax để cập nhật vòa CSDL
    public function update_Feeship(Request $request){
        $data = $request->all();
        $fee_ship = Feeship::find($data['feeship_id']);
        // rtrim() để cắt bỏ kí tự . trong chuỗi
//        $fee_value = rtrim($data['fee_value'],'.');
//        $fee_ship->fee_feeship = $data['fee_value'];
        $fee_ship->fee_feeship = $data['fee_value'];
        $fee_ship->save();
    }
}
