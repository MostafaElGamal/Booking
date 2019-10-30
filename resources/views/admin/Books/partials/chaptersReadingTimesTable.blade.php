<!DOCTYPE html>
<html>
<head>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
        }
    </style>
</head>
<body>

<h2>Cellpadding</h2>
<p>Cell padding specifies the space between the cell content and its borders.</p>

<table style="width:100%">
    <tr>
        <th>رقم الفصل</th>
        <th>تاريخ الأيام المتاحة</th>
    </tr>
    @foreach($chaptersArray as $chapterNumber => $singleChapter)
        <tr>
            <td>{{($chapterNumber}}}</td>
            <td>
                @foreach($singleChapter as $singleDayShift)
                    {{$singleDayShift}}
                @endforeach
            </td>
        </tr>
    @endforeach
</table>


</body>
</html>
