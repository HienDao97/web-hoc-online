<h3><?php if($infomation->status == 0) echo "Thông tin hủy bàn";
            else echo "Thông tin đặt bàn"?></h3>
Tên người đặt bàn: {{ $infomation->user }}
Thời gian: {{ $infomation->time }}
Tên nhà: {{ $infomation->hourse_name }}
Số lượng người lớn: {{ $infomation->adults_count }}
Số lượng trẻ em: {{ $infomation->children_count }}
Số điện thoại người đặt: {{ $infomation->phone_number }}