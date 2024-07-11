<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Program;
use App\Models\Activity;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;

class Home extends Component
{

    public $search_input;
    public $location_filter;
    public $program_filter;

    public $program_report;

    public $isEdit = false;
    public $report_type = 0;
    public $date_acquired;
    public $author;
    public $title;
    public $edition;
    public $volume;
    public $extent;
    public $funding_source;
    public $purchase_price;
    public $publisher;
    public $publication_year;
    public $location = '';
    public $remarks;
    public $course_title;
    public $status;
    public $program = [];
    public $program_list;
    public $course_code;
    public $isbn;
    

    public $accession_id;

    //Report Parameter

    public $date_acquired_from;
    public $date_acquired_to;
    public $location_report;
    public $search_data;

    public function render()
    {
        $genres = Genre::get(['genre']);
        $programs = Program::get(['program']);

        $books = Book::when($this->location_filter, function($query){
            $query->where('location', $this->location_filter);
        })->when($this->program_filter, function($query){
            $query->where('program', 'like' ,'%'.$this->program_filter.'%');
        })
        ->when($this->search_input, function($query){
            $query->search('title', $this->search_input)
            ->search('accession_number', $this->search_input)
            ->search('title', $this->search_input)
            ->search('author', $this->search_input)
            ->search('date_acquired', $this->search_input)
            ->search('edition', $this->search_input)
            ->search('volume', $this->search_input)
            ->search('extent', $this->search_input)
            ->search('funding_source', $this->search_input)
            ->search('purchase_price', $this->search_input)
            ->search('location', $this->search_input)
            ->search('remarks', $this->search_input)
            ->search('isbn', $this->search_input);
        })->get();

        
        $this->program_list = implode(", ", $this->program);
        return view('livewire.home', ['books' => $books, 'genres' => $genres, 'programs' => $programs]);
    }

    public function resetFields(){
       $this->date_acquired = '';
       $this->author = '';
       $this->title = '';
       $this->edition = '';
       $this->volume = '';
       $this->extent = '';
       $this->funding_source = '';
       $this->purchase_price = '';
       $this->publisher = '';
       $this->publication_year = '';
       $this->location = '';
       $this->course_title = '';
       $this->remarks = '';
       $this->program = [];
       $this->course_code = '';
       $this->isbn = '';
    }

    public function insertActivity($author, $title, $activity){
        $values = [
            'activity' => $activity.' '.$title.' authored by '.$author,
            'log_time' => Carbon::now('Asia/Manila')
        ];

        Activity::create($values);
    }

    public function addBook(){
        $this->validate([
            'title' => 'required',
            'author' => 'required',
            'date_acquired' => 'required',
            'program_list' => 'required',
            'location' => 'required',
            'isbn' => 'required'

        ]);

        try{
            $value = [
                'date_acquired' => $this->date_acquired,
                'author' => $this->author,
                'title' => $this->title,
                'edition' => $this->edition,
                'volume' => $this->volume,
                'extent' => $this->extent,
                'funding_source' => $this->funding_source,
                'purchase_price' => $this->purchase_price,
                'publisher' => $this->publisher,
                'publication_year' => $this->publication_year,
                'location' => $this->location,
                'remarks' => $this->remarks,
                'course_title' => $this->course_title,
                'program' => $this->program_list,
                'course_code' => $this->course_code,
                'isbn' => $this->isbn,
            ];

            
            //$encoded_program = json_encode($this->program);
            //dd($encoded_program);
            Book::create($value);
            $this->insertActivity($this->author, $this->title, 'Added');
            session()->flash('success', 'Learning Materials Added!');
            $this->resetFields();
            
            $this->dispatchBrowserEvent('add_clicked');
        }catch(\Exception $e){
            session()->flash('error', 'Something went wrong!');
            $this->dispatchBrowserEvent('add_clicked');
        }
    }

    public function getBookId($id){
        $this->accession_id = Crypt::decrypt($id);
        
        if ($this->accession_id) {
            $this->getBookDetails();
        }
    }

    public function getBookDetails(){
        
        $book = Book::where('accession_number', $this->accession_id)->first();
        
        $this->date_acquired = $book->date_acquired;
        $this->author = $book->author;
        $this->title = $book->title;
        $this->edition = $book->edition;
        $this->volume = $book->volume;
        $this->extent = $book->extent;
        $this->funding_source = $book->funding_source;
        $this->purchase_price = $book->purchase_price;
        $this->publisher = $book->publisher;
        $this->publication_year = $book->publication_year;
        $this->location = $book->location;
        $this->course_title = $book->course_title;
        $this->remarks = $book->remarks;
        $this->status = $book->status;
        $this->program = explode(", ", $book->program);
        $this->course_code = $book->course_code;
        $this->isbn = $book->isbn;
    }

    public function EditOrUnedit(){

        if ($this->isEdit){
            $this->isEdit = false;
            $this->getBookDetails();
        }else{
            $this->isEdit = true;
        }
    }

    public function saveEdit(){

        $this->validate([
            'title' => 'required',
            'author' => 'required',
            'date_acquired' => 'required',
            'program_list' => 'required',
            'location' => 'required'
        ]);

        try{
            $value = [
                'date_acquired' => $this->date_acquired,
                'author' => $this->author,
                'title' => $this->title,
                'edition' => $this->edition,
                'volume' => $this->volume,
                'extent' => $this->extent,
                'funding_source' => $this->funding_source,
                'purchase_price' => $this->purchase_price,
                'publisher' => $this->publisher,
                'publication_year' => $this->publication_year,
                'location' => $this->location,
                'course_title' => $this->course_title,
                'remarks' => $this->remarks,
                'program' => $this->program_list,
                'course_code' => $this->course_code,
                'isbn' => $this->isbn
            ];

            Book::where('accession_number', $this->accession_id)->update($value);
            $this->insertActivity($this->author, $this->title, 'Edited');
            $this->isEdit = false;
            session()->flash('success', 'Learning Materials Edited!');
            
        }catch(\Exception $e){
            $this->dispatchBrowserEvent('add_clicked');
            session()->flash('error', 'Something went wrong!');   
        }
    }



    public function changeBookStatus(){
        if($this->status == 0){
            Book::where('accession_number', $this->accession_id)->update(['status' => 1]);
            $this->insertActivity($this->author, $this->title, 'Unarchived');
        }else{
            Book::where('accession_number', $this->accession_id)->update(['status' => 0]);
            $this->insertActivity($this->author, $this->title, 'Archived');
        }
        
        $this->dispatchBrowserEvent('hide_modal');
    }

    public function deleteBook(){
        Book::where('accession_number', $this->accession_id)->delete();
        $this->dispatchBrowserEvent('hide_modal');
    }

    public function findData(){
        
        $this->validate([
            'date_acquired_from' => 'required',
            'date_acquired_to' => 'required'
        ]);

        try{
            
            $data = Book::whereDate('date_acquired', '>=', $this->date_acquired_from)
                ->whereDate('date_acquired', '<=', $this->date_acquired_to)
                ->when($this->location_report, function($query){
                    $query->where('location', $this->location_report);
                })
                ->when($this->program_report, function($query){
                    $query->where('program', 'like', '%'.$this->program_report.'%');
                })
                ->count();

            $this->search_data = [
                'date_acquired_to' => $this->date_acquired_to,
                'date_acquired_from' => $this->date_acquired_from,
                'location_report' => $this->location_report,
                'program_report' => $this->program_report,
                'report_type' => $this->report_type
            ];

            $this->search_data = json_encode($this->search_data);

            $data > 0 ? session()->flash('found', 'Found '.$data.' Data!') : session()->flash('no-found', 'Found '.$data.' Data!');
        }catch(\Exception $e){
            session()->flash('error', 'Something went wrong!');
        }
    }
}
