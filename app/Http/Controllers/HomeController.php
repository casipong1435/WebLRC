<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Program;
use Illuminate\Support\Facades\Crypt;
use PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function activity(){
        return view('activity');
    }

    public function account(){
        return view('account');
    }

    public function printReport($data){
        //dd($date_acquired_from, $date_acquired_to, $location, $program);
        
        $decrypted_data = Crypt::decrypt($data);

        $first_decoded_data = json_decode($decrypted_data);
        $final_decode = json_decode($first_decoded_data);
        
        $date_acquired_from = $final_decode->date_acquired_from;
        $date_acquired_to = $final_decode->date_acquired_to;
        $location = $final_decode->location_report;
        $program = $final_decode->program_report;
        $report_type = $final_decode->report_type;
        
        if ($report_type == 0){
            $books = Book::whereDate('date_acquired', '>=', $date_acquired_from)
                    ->whereDate('date_acquired', '<=', $date_acquired_to)
                    ->when($program, function($query) use ($program){
                        $query->where('program', 'like', '%'.$program.'%');
                    })
                    ->when($location, function($query) use ($location){
                        $query->where('location', $location);
                    })
                    ->get();

            $books = PDF::loadView('report', ['books' => $books])->setPaper('legal', 'landscape');

            return $books->stream('pdf.accession_book_data');
        }else{
            $program_title = Program::where('program', $program)->first(['program_title'])->program_title;
            $books = Book::whereDate('date_acquired', '>=', $date_acquired_from)
                    ->whereDate('date_acquired', '<=', $date_acquired_to)
                    ->when($program, function($query) use ($program){
                        $query->where('program', 'like', '%'.$program.'%');
                    })
                    ->when($location, function($query) use ($location){
                        $query->where('location', $location);
                    })
                    ->selectRaw('isbn, author, title, course_code, course_title, publication_year, COUNT(*) as copies')
                    ->groupBy('isbn', 'author', 'title','course_code', 'course_title', 'publication_year')
                    ->get()
                    ->groupBy('course_code');

            $books = PDF::loadView('report_professional_book', ['books' => $books, 'program_title' => $program_title, 'date_acquired_from' => $date_acquired_from, 'date_acquired_to' => $date_acquired_to])->setPaper('legal', 'portrait');

            return $books->stream('pdf.professional_book');
        }
    }

}
