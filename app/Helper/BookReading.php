<?php

namespace App\Helper;


use App\Model\Book;

class BookReading
{
    /**
     * function to calulate shift reading days for book
     * @param  $bookModel : object model of chosen book
     * @return $chaptersArray : array with reading book avaialbe dates
     */
    public static function getChaptersAvailableReadings($bookModel)
    {
        //chapterDaysCost
        $weekLimitOfDays = $bookModel->{Book::$chapter_days_cost};

        $weekDaysShifts = ['sunday' => [],
            'monday' => [],
            'tuesday' => [],
            'wednesday' => [],
            'thursday' => [],
            'friday' => [],
            'saturday' => []];

        $selectedWeekDays = $bookModel->{Book::$available_reading_days};
        $chaptersCount = $bookModel->{Book::$chapters_count};

        $chaptersArray = [];

        $currentDateTime = $bookModel->{Book::$reading_start_date};
        $endDateTime = clone $currentDateTime;
        $endDateTime->modify('+' . $chaptersCount . 'day');
        /*dd($endDateTime->format('l'));*/

        $chaptersMaxStack = [];

        for ($i = 0; ; $i++) {
            $loopCountDate = clone $currentDateTime;
            $loopCountDate->modify('+' . $i . 'day');
            //get current loop day
            $currentloopDay = $loopCountDate->format('l');
            //check if this day matches selected day
            if (in_array($currentloopDay, $selectedWeekDays)) {
                $chaptersMaxStack [] = $loopCountDate->format('l');
                if (count($chaptersMaxStack) == $weekLimitOfDays) {
                    $chaptersArray[] = $chaptersMaxStack;
                    $chaptersMaxStack = [];
                }

            }
            //end of chapters
            if (count($chaptersArray) == $chaptersCount) {
                break;
            }

        }
        return $chaptersArray;
    }
}
