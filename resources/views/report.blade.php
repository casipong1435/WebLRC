<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report</title>

    <style>
        body{
            margin-top: 5rem;
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
            top: -7;
            left: 300;
        }
        .img-right{
            position: absolute;
            top: -7;
            right: 300;
        }
        .header-content{
            text-align: center;
        }
        .tcgc{
            font-weight: bold;
        }
        .accession{
            color: red;
        }
        table{
            border-collapse: collapse;
            width: 100%;
            
        }
        th, td, tr{
            border: 1px solid black;
        }
        th,td{
            padding: 5px;
            text-align: center;
            font-family: sans-serif;
        }
        th{
            font-size: 12px;
        }
        td{
            font-size: 10px;
            color: #302f2f;
        }
    </style>
</head>
<body>
    
    <div class="header">
        <div class="header-content">
            <div class="img-left">
                <img src="image/logo.jpg" class="bg" width="70" height="70">
            </div>
            <div class="center">
                <div class="tcgc">TANGUB CITY GLOBAL COLLEGE</div>
                <div class="lrc">LEARNING RESOURCE CENTER</div>
                <div class="maloro">Maloro, Tangub City, Misamis Occidental</div>
            </div>
            <div class="img-right">
                <img src="image/lrc.png" class="bg" width="70" height="70">
            </div>
        </div>
        
    </div>
    
    <div class="content">
        <table>
            <thead>
               <tr>
                    <th class="accession">Accession #</th>
                    <th>Date Acquired</th>
                    <th>Author</th>
                    <th>Title/Subtitle</th>
                    <th>Edition</th>
                    <th>Volume #</th>
                    <th>Extent</th>
                    <th>Funding Source</th>
                    <th>Purchase Price</th>
                    <th>Publisher</th>
                    <th>Publication Year</th>
                    <th>Location</th>
                    <th>Program</th>
                    <th>Course Code</th>
                    <th>Course Title</th>
                    <th>Remarks</th>
                    <th>ISBN</th>
               </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td class="accession">{{$book->accession_number}}</td>
                        <td>{{$book->date_acquired}}</td>
                        <td>{{$book->author}}</td>
                        <td>{{$book->title}}</td>
                        <td>{{$book->edition}}</td>
                        <td>{{$book->volume}}</td>
                        <td>{{$book->extent}}</td>
                        <td>{{$book->funding_source}}</td>
                        <td>{{$book->purchase_price}}</td>
                        <td>{{$book->publisher}}</td>
                        <td>{{$book->publication_year}}</td>
                        <td>{{$book->location}}</td>
                        <td>{{$book->program}}</td>
                        <td>{{$book->course_code}}</td>
                        <td>{{$book->course_title}}</td>
                        <td>{{$book->remarks}}</td>
                        <td>{{$book->isbn}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>