<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report</title>

    <style>
        @page { margin: 0.5in; }
        body{
            margin-top: 10rem;
        }
        .header,
        .footer {
            width: 100%;
            position: fixed;
        }
        .header {
            top: 0px;
        }
        .img-left{
            position: absolute;
            top: -10;
            left: 10;
        }
        .img-right{
            position: absolute;
            top: -10;
            right: 10;
        }
        .header-content{
            text-align: center;
            
        }
        .tcgc{
            font-weight: bold;
            font-size: 25px;
        }
        .list{
            font-weight: bold;
            font-size: 15px;
        }
        .list-new{
            margin-top: 1rem;
        }
        table{
            border-collapse: collapse;
            width: 100%;
            
        }
        th, td, tr{
            border: 1px solid black;
        }
        td.table-head-green{
            background: #79d80d;
            text-align: start;
            font-size: 15px;
        }   
        th{
            padding: 5px;
            font-size: 15px;
            font-family: sans-serif;
        }
        td{
            padding: 5px;
            font-size: 13px;
            color: #302f2f;
        }
    </style>
</head>
<body>

    
    <header class="header">
        <div class="header-content">
            <div class="img-left">
                <img src="image/logo.jpg" class="bg" width="80" height="80">
            </div>
            <div class="center">
                <div class="tcgc">TANGUB CITY GLOBAL COLLEGE</div>
                <div class="maloro">Maloro, Tangub City, Misamis Occidental</div>
                <div class="lrc">Learning Resource Center</div>
            </div>
            <div class="center list-new">
                <div class="list">LIST OF PROFESSIONAL BOOKS</div>
                <div class="maloro">{{$program_title}}</div>
                <div class="lrc">(As of {{Carbon\Carbon::parse($date_acquired_from)->format('F d, Y')}} - {{Carbon\Carbon::parse($date_acquired_to)->format('F d, Y')}})</div>
            </div>
            <div class="img-right">
                <img src="image/lrc.png" class="bg" width="80" height="80">
            </div>
        </div>
    </header>

    <div class="header-gap"></div>
    
    <div id="content">
        @foreach ($books as $courseCode => $groupedBooks)
    <table style="margin-bottom: 2rem">
        <thead>
            <tr>
                <td colspan="4" class="table-head-green">Course Code: <b>{{ strtoupper($courseCode) }}</b></td>
            </tr>
            <tr>
                <td colspan="4" class="table-head-green">Course Title: <b>{{ strtoupper($groupedBooks->first()->course_title) }}</b></td>
            </tr>
            <tr>
                <th>Author</th>
                <th style="width: 50%">Title/Subtitle</th>
                <th>Copyright</th>
                <th>Copies</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($groupedBooks as $book)
                <tr>
                    <td style="text-align: center">{{ $book->author }}</td>
                    <td>{{ $book->title }}</td>
                    <td style="text-align: center">{{ $book->publication_year }}</td>
                    <td style="text-align: center">{{ $book->copies }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endforeach
    </div>

</body>
</html>