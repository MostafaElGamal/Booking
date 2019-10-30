<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //auto complete columns names
    public static $chapter_days_cost = 'chapter_days_cost';
    public static $available_reading_days = 'available_reading_days';
    public static $chapter_reading_map = 'chapter_reading_map';
    public static $chapters_count = 'chapters_count';
    public static $reading_start_date = 'reading_start_date';

    //set fillable array
    protected $fillable = [
        'chapter_days_cost',
        'available_reading_days',
        'chapter_reading_map',
        'chapters_count',
        'reading_start_date',
    ];

    //set protected dates array
    protected $dates = ['reading_start_date'];

    //set casts json type array
    protected $casts = [
        'available_reading_days' => 'array',
        'chapter_reading_map' => 'array',
    ];


    /**
     * set mutator to store encoded array value of available_reading_days.
     * @param  $value : original value before mutation
     * @return $value : formatted value
     */
    public function setAvailableReadingDaysAttribute($value)
    {
        $available_reading_days = [];

        foreach ($value as $array_item) {
            if (!is_null($array_item)) {
                $available_reading_days[] = $array_item;
            }
        }

        $this->attributes['available_reading_days'] = json_encode($available_reading_days);
    }

    /**
     * set mutator to store encoded array value of chapter_reading_map.
     * @param  $value : original value before mutation
     * @return $value : formatted value
     */
    public function setChapterReadingMapAttribute($value)
    {
        $chapter_reading_map = [];

        foreach ($value as $array_item) {
            if (!is_null($array_item)) {
                $chapter_reading_map[] = $array_item;
            }
        }

        $this->attributes['chapter_reading_map'] = json_encode($chapter_reading_map);
    }

    /**
     * accessor to get array of form of json available_reading_days
     * @param  $value : original value before accessing
     * @return array
     */
    public function getAvailableReadingDaysAttribute($value)
    {
        return json_decode($value, true);
    }

    /**
     * accessor to get array of form of json chapter_reading_map
     * @param  $value : original value before accessing
     * @return array
     */
    public function getChapterReadingMapAttribute($value)
    {
        return json_decode($value, true);
    }
}
