<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = ["content", "theory_id", "answer", "name", "created_at", "updated_at"];
    protected $table = "exercises";

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function theory(){
        return $this->belongsTo('App\Models\Theory', 'theory_id');
    }

    /**
     * @param $data
     * @param $type
     * @return string
     */
    public static function getDataUrl($data, $type = "")
    {
        if (!empty($data)) {
            if(!empty($type)){
                return env("APP_URL") . "/img/{$type}/{$data}";
            }
        }
        return env("APP_URL") . '/img/logo.jpeg';
    }

    /**
     * @return array
     */
    public static function listAnswer(){
        return [
            1 => "A",
            2 => "B",
            3 => "C",
            4 => "D"
        ];
    }

    /**
     * @return array
     */
    public static function listText(){
        return array(
            "Chúc mừng bạn đã  hoàn thành xuất sắc bài làm của mình!",
            "Bạn làm bài rất tốt!",
            "Bạn rất xuất sắc!",
            "Thật tuyệt vời! Chúc bạn học tập tốt.",
            "Chúc mừng bạn đã hoàn thành bài làm của mình.",
            "Bạn làm bài tốt đấy ! Hãy xem lại những câu chưa đúng nhé.",
            "Bạn đã hoàn thành bài làm của mình. Chúc bạn làm bài tốt hơn ở lần sau.",
            "Tuyệt đấy. Tôi tin bạn có thể làm tốt hơn nữa.",
            "Bạn đã hoàn thành bài làm. Hãy cố gắng hơn nữa nhé!",
            "Bạn đã đi được một nửa chặng đường. Hãy luyện tập lại để có kết quả tốt hơn.",
            "Bạn đã hoàn thành bài làm. Hãy nỗ lực hơn nữa nhé!",
            "Bạn đã cố gắng. Tôi tin bạn có thể làm tốt hơn nữa.",
            "Chúc mừng bạn đã hoàn thành bài làm. Bạn xem lại những câu chưa đúng nhé.",
            "Chúc mừng bạn. Bạn cần nỗ lực để đạt kết quả tốt hơn.",
            "Không sao ! Hãy tiếp tục nỗ lực để đạt kết quả tốt trong lần làm bài tiếp theo.",
            "Đừng nản chí. Hãy nỗ lực học tập để vươn tới đỉnh cao!"
        );
    }
}
